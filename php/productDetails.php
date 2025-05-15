<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

// Include the database connection file
require_once 'config.php'; 






// SQL query to fetch the detailed order information

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
        JOIN suppliers ON products.SupplierID = suppliers.SupplierID
        WHERE Customers.lastname LIKE 'Andersen'
        AND products.ProductName LIKE 'Geitost'";








$result = $mysqli->query($sql); // Execute the query

// Check if there are any results
if ($result->num_rows > 0) {
    echo "
    
    <p> join 5 tables </p>
    
    <h1>Detailed Order Information for Customers with Last Name 'Andersen' and Product 'Geitost'</h1>
    <table border='1'>
    <tr><th>Order ID</th><th>Customer First Name</th><th>Customer Last Name</th>
    <th>Employee First Name</th><th>Employee Last Name</th><th>Order Detail ID</th>
    <th>Product ID</th><th>Product Name</th><th>Supplier ID</th><th>Supplier Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        // Loop through each row and display the details



        echo "<tr>
        
              <td>" . htmlspecialchars($row["orderID"]) . "</td>
              <td>" . htmlspecialchars($row["Customers Firstname"]) . "</td>
              <td>" . htmlspecialchars($row["Customers Lastname"]) . "</td>
              <td>" . htmlspecialchars($row["Employees Firstname"]) . "</td>
              <td>" . htmlspecialchars($row["Employees Lastname"]) . "</td>
              <td>" . htmlspecialchars($row["OrderDetailID"]) . "</td>
              <td>" . htmlspecialchars($row["ProductID"]) . "</td>
              <td>" . htmlspecialchars($row["ProductName"]) . "</td>
              <td>" . htmlspecialchars($row["SupplierID"]) . "</td>
              <td>" . htmlspecialchars($row["SupplierName"]) . "</td></tr>";



    }
    echo "</table>";
} else {
    // If no results are found, display a message
    echo "No detailed orders found for customers with the last name 'Andersen' and product 'Geitost'.";
}

$mysqli->close(); // Close the database connection
?>
