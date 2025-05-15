<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

// Include the database connection file
require_once 'config.php'; 


// SQL query to fetch specific order details
$sql = "SELECT 
        orderID, 
        Customers.firstname AS 'Customers Firstname',
        Customers.lastname AS 'Customers Lastname', 
        employees.firstname AS 'Employees Firstname',
        employees.lastname AS 'Employees Lastname'

        FROM orders 
        JOIN customers ON orders.customerID = Customers.customerID 
        JOIN employees ON orders.employeeID = employees.employeeID
        WHERE Customers.lastname LIKE 'Andersen'";


$result = $mysqli->query($sql); // Execute the query

// Check if there are any results
if ($result->num_rows > 0) {

    echo "<h1>Order Details for Customers with Last Name 'Andersen'</h1>
    <table border='1'><tr><th>Order ID</th>
    <th>Customer First Name</th>
    <th>Customer Last Name</th>
    <th>Employee First Name</th>
    <th>Employee Last Name</th>
    </tr>";

    while($row = $result->fetch_assoc()) {

        // Loop through each row and display the order details
        echo "<tr>

              <td>" . htmlspecialchars($row["orderID"]) . "</td>
              <td>" . htmlspecialchars($row["Customers Firstname"]) . "</td>
              <td>" . htmlspecialchars($row["Customers Lastname"]) . "</td>
              <td>" . htmlspecialchars($row["Employees Firstname"]) . "</td>
              <td>" . htmlspecialchars($row["Employees Lastname"]) . "</td></tr>";

    }
    echo "</table>";
} else {
    // If no results are found, display a message
    echo "No orders found for customers with the last name 'Andersen'.";
}

$mysqli->close(); // Close the database connection
?>
