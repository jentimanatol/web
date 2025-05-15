<?php
session_start();

// Change this to your connection info.
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'admin';
$DATABASE_NAME = 'bargainbuy';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['psw'])) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}

$username = $_POST['username'];
$userPassword = $_POST['psw'];

// Run the stored function
$sql = "SELECT customers_login(?, ?) AS result";

// Prepare the SQL statement
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $username, $userPassword);
$stmt->execute();
$result = $stmt->get_result();

// Check if query execution was successful
if ($result) {
    // Fetch the result
    $row = $result->fetch_assoc();
    if ($row['result'] != 'x') {
        $_SESSION['name'] = $row['result'];
        // Redirect to another page
        header("Location: success.php");
        exit(); // Ensures the script stops executing after redirection
    } else {
        // Invalid email/password
        $_SESSION['error'] = "Invalid email/password";
        header("Location: faillure.php");
        exit();
    }
} else {
    // Query failed
    $_SESSION['error'] = "Query failed: " . mysqli_error($con);
    header("Location: faillure.php");
    exit();
}

// Close the statement and connection
$stmt->close();
$con->close();
?>
