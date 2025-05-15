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

$order_count = 0;
$cust_lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';

if ($cust_lastname) {
    // SQL query to call the function
    $sql = "SELECT GetCustomerOrderCount(?) AS order_count";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $cust_lastname);
    if ($stmt->execute() === false) {
        die("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    if ($result === false) {
        die("Getting result set failed: " . $stmt->error);
    }

    if ($row = $result->fetch_assoc()) {
        $order_count = $row['order_count'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Customer Order Count</title>
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
            text-align: center;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        input[type="text"] {
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
        <h1>Get Customer Order Count</h1>
        <h3>Welcome back <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></h3>

        <form method="POST" action="">
            <label for="lastname">Customer Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>
            <button type="submit">Get Order Count</button>
        </form>

        <?php
        if ($cust_lastname) {
            echo "<p>Total Orders for $cust_lastname: $order_count</p>";
        }
        ?>

        <form method="GET" action="http://127.0.0.1/success.php">
            <button type="submit">Back</button>
        </form>
    </div>

</body>
</html>
