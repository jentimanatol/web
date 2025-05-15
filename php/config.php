<?php
// Create a new MySQLi object to connect to the database
// Parameters: "localhost" (server), "root" (username), "admin" (password), "bargainbuy" (database name)
$mysqli = new mysqli("localhost", "root", "admin", "bargainbuy");

// Check if the connection was successful
if ($mysqli->connect_error) {
    // If there is a connection error, terminate the script and display the error message
    die("Connection failed: " . $mysqli->connect_error);
}
?>
