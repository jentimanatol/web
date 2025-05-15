<?php
// Start the session
session_start();

// Retrieve error message if available
$error = $_SESSION['error'] ?? 'Unknown error occurred.';

// Clear the error message to prevent it from persisting
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20%;
            background-color: #ffe6e6;
        }
        h1 {
            color: #d9534f;
        }
        p {
            color: #555;
        }
        .retry-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #f0ad4e;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .retry-link:hover {
            background-color: #ec971f;
        }
    </style>
</head>
<body>
    <h1>Login Failed</h1>
    <p><?php echo htmlspecialchars($error); ?></p>
</body>
</html>