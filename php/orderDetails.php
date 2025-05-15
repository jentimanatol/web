<?php
session_start();

//verify if user have been loged 
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

// Include the database connection file
require_once 'config.php'; 

// SQL query to fetch order details
$sql = "SELECT orderID, Customers.firstname AS customer_firstname, Customers.lastname AS customer_lastname, 
        employees.firstname AS employee_firstname, employees.lastname AS employee_lastname
        FROM orders 
        JOIN customers ON orders.customerID = Customers.customerID 
        JOIN employees ON orders.employeeID = employees.employeeID";

$result = $mysqli->query($sql); // Execute the query

// Check if there are any results
if ($result->num_rows > 0) {

    echo "<p> sql Query used : </p>
         <p>  SELECT orderID, Customers.firstname</p>
         <p>  AS customer_firstname, Customers.lastname </p>
         <p>  AS customer_lastname, employees.firstname </p>
         <p>  AS employee_firstname, employees.lastname</p>
         <p>  AS employee_lastname</p>
         <p>  FROM orders </p>
         <p>  JOIN customers ON orders.customerID = Customers.customerID </p>
         <p>  JOIN employees ON orders.employeeID = employees.employeeID  </p>
    
    
    
    
    <h1>Order Details</h1> 
    
    
    <table border='1'>




    <tr><th>Order ID</th>
    <th>Customer First Name</th>
    <th>Customer Last Name</th>
    <th>Employee First Name</th>
    <th>Employee Last Name</th></tr>";


    
    while($row = $result->fetch_assoc()) {


        // Loop through each row and display the order details
        echo "<tr>
        
                  <td>" . htmlspecialchars($row["orderID"]) . "</td>
                  <td>" . htmlspecialchars($row["customer_firstname"]) . "</td>
                  <td>" . htmlspecialchars($row["customer_lastname"]) . "</td>
                  <td>" . htmlspecialchars($row["employee_firstname"]) . "</td>
                  <td>" . htmlspecialchars($row["employee_lastname"]) . "</td>
                  
                  
             </tr>";
    }
    echo "</table>";
} else {
    // If no results are found, display a message
    echo "No order details found.";
}

$mysqli->close(); // Close the database connection
?>
