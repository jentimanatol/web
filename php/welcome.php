<?php
// Start a new session or resume the existing session
session_start();

// Check if the user is logged in (if the username session variable is set)
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <!-- Display a welcome message with the user's name -->
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>You have successfully logged in.</p>



    <!-- Form with a button that redirects to the emails.php page when clicked -->
    <form action="emails.php" method="post"><button type="submit">View Customer Emails</button> </form>



     <p> </p><!-- text between butons -->
    <!-- // Add one more button for order detail to redirects to a new page called orderDetails.php   -->
    <form action="orderDetails.php" method="post"> <button type="submit">View Order Details</button> </form>  




    <p> </p><!-- text between butons -->
  <!-- // Add one more button foranderson orders    -->
    <form action="andersenOrders.php" method="post"> <button type="submit">View Andersen Orders</button> </form>


    <p> </p><!-- text between butons -->
  <!-- // Add one more button product detail     -->
    </form> <form action="productDetails.php" method="post"> <button type="submit">View Product Details</button>


    

</body>
</html>
