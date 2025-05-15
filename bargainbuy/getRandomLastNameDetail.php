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

$random_customer = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SQL query to call the procedure
    $sql = "CALL getRandomLastNameDetail()";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Query failed: " . $conn->error);
    }

    if ($random_customer = $result->fetch_assoc()) {
        // Store customer details in $random_customer array
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Random Last Name Detail</title>
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
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        table td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Get Random Last Name Detail</h1>
        <h3>Welcome back <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></h3>

        <form method="POST" action="">
            <button type="submit">Get Random Last Name Detail</button>
        </form>

        <?php
        if ($random_customer) {
            echo '<table>';
            echo '<tr><th>CustomerID</th><th>FirstName</th><th>LastName</th><th>Company</th><th>City</th><th>Country</th><th>Phone</th><th>Email</th><th>SubscriptionDate</th></tr>';
            echo '<tr>';
            foreach ($random_customer as $detail) {
                echo '<td>' . $detail . '</td>';
            }
            echo '</tr>';
            echo '</table>';
        }
        ?>

        <form method="GET" action="http://127.0.0.1/success.php">
            <button type="submit">Back</button>
        </form>
    </div>

</body>
</html>
