<?php
// Start a new session or resume the existing session
session_start();

// Check if the user is logged in (if the username session variable is set)
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("location: index.php");
    exit();
}

// Include the database connection file
require_once 'config.php'; 

// SQL query to select all emails from the customers table

$sql = "SELECT Email FROM customers";

$result = $mysqli->query($sql);  // Execute the query

// Check if there are any results
if ($result->num_rows > 0) {

    // If there are results, display them in a list

    echo " <p> sql Query used : </p>
           <p> SELECT Email FROM customers </p>
    
    
    <h1>Customer Emails</h1><ul>";
    while($row = $result->fetch_assoc()) {
        // Loop through each row and display the email
        echo "<li>" . htmlspecialchars($row["Email"]) . "</li>";
    }
    echo "</ul>";
} else {
    // If no results are found, display a message
    echo "No emails found.";
}

$mysqli->close();  // Close the database connection
?>
