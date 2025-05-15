<?php
// Start a new session or resume the existing session
session_start();

// Include the database connection file path "C:\xampp\htdocs\config.php" in the basicaly are $mysqli = new mysqli("localhost", "root", "admin", "bargainbuy");

require_once 'config.php'; 



// Check if the form was submitted using the POST method

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Get the email and password from the POST request 


    $email = $_POST['username'];
    $password = $_POST['psw'];


    // Prepare the SQL statement using the custom MySQL function
    // The '?' placeholders will be replaced with the actual values


    $sql = "SELECT customers_login(?, ?)";


//--------------------------------------------------------------------------------------
//Certainly! The $stmt object in PHP is a prepared statement created using the mysqli extension.
// Prepared statements help prevent SQL injection and improve performance by allowing the database 
//to parse and compile the SQL statement once, and then execute it multiple times with different parameters.

    $stmt = $mysqli->prepare($sql);


    // Check if the statement was prepared successfully
    if ($stmt === false) {
        // If the statement preparation failed, terminate the script and display the error
        die('Error preparing statement: ' . htmlspecialchars($mysqli->error));
    }

    // Bind the input parameters to the SQL query
    // "ss" indicates that both parameters are strings
    $stmt->bind_param("ss", $email, $password);




//Executes the prepared statement. This sends the query to the database with the bound parameters.
    $stmt->execute();  // Execute the SQL query


//$result will hold the value returned by the SQL query (in your case, the return value of the customers_login function).
    $stmt->bind_result($result);  // Bind the result of the query to the $result variable



//Fetches the result from the executed statement into the bound variables. In this case, it assigns the returned value to $result.
    $stmt->fetch();  // Fetch the result



    // Check if the login was successful (if the result is not 'x') from SQL bench -> 	else  set   result_message  = 'x';  end if;


    if ($result !== 'x') {



        // Store the result (user's name) in the session and redirect to the welcome page
        $_SESSION['username'] = $result;

//if aprovied go to the welcome dot PHP page 

        header("location: welcome.php");
    } else {
        // Display an error message if the login credentials are invalid
        echo "Invalid login credentials.";
    }
    $stmt->close();  // Close the statement
}
$mysqli->close();  // Close the database connection
?>
