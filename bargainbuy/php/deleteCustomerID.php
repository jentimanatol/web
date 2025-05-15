<?php session_start(); 

$servername = "127.0.0.1";
$username = "root";  // your database username
$password = 'admin';      // your database password
$dbname = "bargainbuy";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customerID = "";
$delete_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $customerID = $_POST['customerID'];

    // SQL query to delete customer
    $sql = "DELETE FROM customers WHERE customerID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerID);

    if ($stmt->execute()) {
        $delete_success = true;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0.
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px.
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column.
        }
        label {
            margin: 10px 0 5px.
        }
        input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px.
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer.
        }
        button:hover {
            background-color: #0056b3.
        }
        .success-message {
            color: green;
            text-align: center.
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Delete Customer</h1>
        <h3>Welcome back <?php echo $_SESSION['name']; ?></h3>

        <?php if ($delete_success): ?>
            <p class="success-message">Customer deleted successfully!</p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="customerID">Customer ID:</label>
            <input type="number" id="customerID" name="customerID" required>
            <button type="submit">Delete Customer</button>
        </form>
    </div>

</body>
</html>
