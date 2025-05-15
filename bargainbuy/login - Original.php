<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'admin';
$DATABASE_NAME = 'bargainbuy';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['psw']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

$username = $_POST['username'];
$userPassword = $_POST['psw'];

//run the store proc
$sql = "SELECT customers_login('$username', '$userPassword') AS result";

// Execute the query
$result = mysqli_query($con, $sql);

// Check if query execution was successful
if ($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
    if ($row['result'] != 'X') {
    $_SESSION['name'] = $row['result'];
    // Redirect to another page
       header("Location: success.php");
     exit(); // Ensures the script stops executing after redirection
    }
    
} 
    $_SESSION['error'] = "Invalid email/password";
  //  echo "Error: " . mysqli_error($con);
  header("Location: faillure.php");
  exit();


// Close the connection
$con->close();

// //loop the result set
// while ($row = mysqli_fetch_array($result)){     
//   echo $row; 
// }


// // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
// if ($stmt = $con->prepare('SELECT customerID, lastname, firstname, psw FROM Customers WHERE email = ?')) {
// 	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
// 	$stmt->bind_param('s', $_POST['username']);
// 	$stmt->execute();
//     exit("here");
// // 	// Store the result so we can check if the account exists in the database.
// 	$stmt->store_result();
    
//     if ($stmt->num_rows > 0) {
//         $stmt->bind_result($id, $lastname, $firstname, $password);
//         $stmt->fetch();
//         // Account exists, now we verify the password.
//         // Note: remember to use password_hash in your registration file to store the hashed passwords.
//         if (password_verify(sha2($_POST['psw'], 512), $password)) {
//             // Verification success! User has logged-in!
//             // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
//             session_regenerate_id();
//             $_SESSION['loggedin'] = TRUE;
//             $_SESSION['name'] = $lastname . ", " . $firstname;
//             $_SESSION['id'] = $id;
//             echo 'Welcome back, ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES) . '!';
//         } else {
//             // Incorrect password
//             echo 'Incorrect username and/or password!';
//         }
//     } else {
//         // Incorrect username
//         echo 'Incorrect username and/or password!';
//     }


	// $stmt->close();
// }



?>