<?php session_start();

$servername = "127.0.0.1";
$username = "root";  // your database username
$password = 'admin';  // your database password
$dbname = "bargainbuy";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cust_lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$total_sales = 0;

if ($cust_lastname && $start_date && $end_date) {
    // SQL query to call the procedure
    $sql = "CALL GetTotalSalesByCustomer(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $cust_lastname, $start_date, $end_date);
    if ($stmt->execute() === false) {
        die("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    if ($result === false) {
        die("Getting result set failed: " . $stmt->error);
    }

    if ($row = $result->fetch_assoc()) {
        $total_sales = $row['Total Sales'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Sales By Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-container {
            margin: 20px 0;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Total Sales By Customer</h1>
        <h3>Welcome back <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></h3>

        <div class="form-container">
            <form method="POST" action="">
                <label for="lastname">Customer Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
                <button type="submit">Get Total Sales</button>
            </form>
        </div>

        <?php
        if ($cust_lastname && $start_date && $end_date) {
            echo "<p>Total Sales for $cust_lastname from $start_date to $end_date: $$total_sales</p>";
        }
        ?>
    </div>

</body>
</html>
