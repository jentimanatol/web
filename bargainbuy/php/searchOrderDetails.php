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

$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$productname = isset($_POST['productname']) ? $_POST['productname'] : '';

// Initialize the query and result variables
$sql = "";
$result = null;

if ($lastname && $productname) {
    // SQL query to fetch order details by joining multiple tables
    $sql = "SELECT 
            orderdetails.orderID, 
            Customers.firstname AS 'Customers Firstname', 
            Customers.lastname AS 'Customers Lastname', 
            employees.firstname AS 'Employees Firstname', 
            employees.lastname AS 'Employees Lastname',
            orderdetails.OrderDetailID,
            orderdetails.ProductID,
            products.ProductName,
            products.SupplierID,
            suppliers.SupplierName
            FROM orders
            JOIN customers ON orders.customerID = Customers.customerID
            JOIN employees ON orders.employeeID = employees.employeeID
            JOIN orderdetails ON orders.OrderID = orderdetails.OrderID
            JOIN products ON orderdetails.ProductID = products.ProductID
            JOIN suppliers ON suppliers.SupplierID = products.SupplierID
            WHERE Customers.lastname LIKE ? AND products.ProductName LIKE ?";
    
    $stmt = $conn->prepare($sql);
    $likeLastName = "%" . $lastname . "%";
    $likeProductName = "%" . $productname . "%";
    $stmt->bind_param("ss", $likeLastName, $likeProductName);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Order Details</title>
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
        table tr:nth-child(even) td {
            background-color: #f1f1f1;
        }
        table tr:hover td {
            background-color: #e2e2e2;
        }
        .table-container {
            overflow-x: auto;
        }
        .form-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Search Order Details</h1>
        <h3>Welcome back <?php echo $_SESSION['name']; ?></h3>

        <div class="form-container">
            <form method="POST" action="">
                <label for="lastname">Enter Customer Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="productname">Enter Product Name:</label>
                <input type="text" id="productname" name="productname" required>
                
                <button type="submit">Search</button>
            </form>
        </div>

        <?php
        if ($lastname && $productname) {
            if ($result->num_rows > 0) {
                echo '<div class="table-container">';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>OrderID</th>';
                echo '<th>Customer Firstname</th>';
                echo '<th>Customer Lastname</th>';
                echo '<th>Employee Firstname</th>';
                echo '<th>Employee Lastname</th>';
                echo '<th>OrderDetailID</th>';
                echo '<th>ProductID</th>';
                echo '<th>ProductName</th>';
                echo '<th>SupplierID</th>';
                echo '<th>SupplierName</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["orderID"] . '</td>';
                    echo '<td>' . $row["Customers Firstname"] . '</td>';
                    echo '<td>' . $row["Customers Lastname"] . '</td>';
                    echo '<td>' . $row["Employees Firstname"] . '</td>';
                    echo '<td>' . $row["Employees Lastname"] . '</td>';
                    echo '<td>' . $row["OrderDetailID"] . '</td>';
                    echo '<td>' . $row["ProductID"] . '</td>';
                    echo '<td>' . $row["ProductName"] . '</td>';
                    echo '<td>' . $row["SupplierID"] . '</td>';
                    echo '<td>' . $row["SupplierName"] . '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p>No results found for lastname: ' . htmlspecialchars($lastname) . ' and product name: ' . htmlspecialchars($productname) . '</p>';
            }
        }
        ?>
    </div>

</body>
</html>
