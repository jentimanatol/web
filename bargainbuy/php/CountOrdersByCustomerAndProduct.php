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
$prod_name = isset($_POST['productname']) ? $_POST['productname'] : '';
$order_count = 0;

if ($cust_lastname && $prod_name) {
    // SQL query to call the function
    $sql_count = "SELECT CountOrdersByCustomerAndProduct(?, ?) AS order_count";
    $stmt = $conn->prepare($sql_count);
    $stmt->bind_param("ss", $cust_lastname, $prod_name);
    $stmt->execute();
    
    $result_count = $stmt->get_result();
    
    if ($row_count = $result_count->fetch_assoc()) {
        $order_count = $row_count['order_count'];
    }

    // SQL query to fetch orders based on customer last name and product name
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
            JOIN customers ON orders.customerID = customers.customerID
            JOIN employees ON orders.employeeID = employees.employeeID
            JOIN orderdetails ON orders.OrderID = orderdetails.OrderID
            JOIN products ON orderdetails.ProductID = products.ProductID
            JOIN suppliers ON suppliers.SupplierID = products.SupplierID
            WHERE customers.lastname LIKE ? AND products.ProductName LIKE ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $cust_lastname, $prod_name);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Count Orders By Customer And Product</title>
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
        <h1>Count Orders By Customer And Product</h1>
        <h3>Welcome back <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></h3>

        <div class="form-container">
            <form method="POST" action="">
                <label for="lastname">Introduce Customer Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
                <label for="productname">Introduce Product Name:</label>
                <input type="text" id="productname" name="productname" required>
                <button type="submit">Enter</button>
            </form>
        </div>

        <?php
        if ($cust_lastname && $prod_name) {
            echo "<p>Total Orders for $cust_lastname and $prod_name: $order_count</p>";
        ?>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>OrderID</th>
                        <th>Customers Firstname</th>
                        <th>Customers Lastname</th>
                        <th>Employees Firstname</th>
                        <th>Employees Lastname</th>
                        <th>OrderDetailID</th>
                        <th>ProductID</th>
                        <th>ProductName</th>
                        <th>SupplierID</th>
                        <th>SupplierName</th>
                    </tr>
                </thead>
                <tbody>
                   
                <?php  
                while($row = $result->fetch_assoc()) {
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
                ?>
                  
                </tbody>
            </table>
        </div>

        <?php 
        }
        ?>
    </div>

</body>
</html>
