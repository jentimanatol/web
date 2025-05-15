<?php session_start(); 

$servername = "127.0.0.1";
$username = "root";  // your database username
$password = 'admin';      // your database password
$dbname = "bargainbuy";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$lastname = $firstname = $company = $city = $country = $phone = $email = $pass = "";
$insert_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $company = $_POST['company'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // SQL query to insert new customer with the current date for SubscriptionDate
    $sql = "INSERT INTO customers (lastname, firstName, company, city, country, phone, email, pass, SubscriptionDate)
            VALUES (?, ?, ?, ?, ?, ?, ?, SHA2(?, 512), CURDATE())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $lastname, $firstname, $company, $city, $country, $phone, $email, $pass);

    if ($stmt->execute()) {
        $insert_success = true;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Customer</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
        }
        input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .success-message {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Insert Customer</h1>
        <h3>Welcome back <?php echo $_SESSION['name']; ?></h3>
        
        <?php if ($insert_success): ?>
            <p class="success-message">Customer inserted successfully!</p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="company">Company:</label>
            <input type="text" id="company" name="company">

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" required>

            <button type="submit">Insert Customer</button>
        </form>
    </div>

</body>
</html>
