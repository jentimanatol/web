<?php session_start();

$servername = "127.0.0.1";
$username = "root";  // your database username
$password = 'admin';  // your database password
$dbname = "bargainbuy";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employee_lastnames = [];
$pattern = isset($_POST['pattern']) ? $_POST['pattern'] : '';

if ($pattern) {
    // SQL query to call the procedure
    $sql = "CALL getEmployeeLastNamesByPattern(?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $pattern);
    if ($stmt->execute() === false) {
        die("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    if ($result === false) {
        die("Getting result set failed: " . $stmt->error);
    }

    while ($row = $result->fetch_assoc()) {
        $employee_lastnames[] = $row['LastName'];
    }

    $stmt->close();
    $result->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Employee Last Names By Pattern</title>
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
            text-align: center;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            background-color: #f9f9f9;
            margin: 5px 0;
            border-radius: 4px;
        }
        .pattern-explanation {
            text-align: left;
            margin-top: 20px;
        }
        .pattern-explanation ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Get Employee Last Names By Pattern</h1>
        <h3>Welcome back <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></h3>

        <form method="POST" action="">
            <label for="pattern">Last Name Pattern:</label>
            <input type="text" id="pattern" name="pattern" placeholder="e.g., M%L%" required>
            <button type="submit">Get Employee Last Names</button>
        </form>

        <?php
        if ($employee_lastnames) {
            echo '<ul>';
            foreach ($employee_lastnames as $lastname) {
                echo '<li>' . $lastname . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No results found. Try a different pattern exemple : L% for leverling.</p>';
        }
        ?>







<div class="pattern-explanation"> <h2>Pattern Explanation:</h2> <ul> <li><strong>Percentage Sign (%):</strong> Matches any sequence of characters (including zero characters). <ul> <li><strong>Example:</strong> M%L% matches any string that starts with 'M' and contains 'L' at any position, such as "Michael," "Maryland," or "Marcell."</li> </ul> </li> <li><strong>Underscore (_):</strong> Matches any single character. <ul> <li><strong>Example:</strong> M_L_ matches any string that starts with 'M,' has exactly three characters where the second character can be anything and the third character is 'L,' such as "Milo" or "Mila."</li> </ul> </li> <li><strong>Combining Patterns:</strong> You can combine % and _ to create more specific patterns. <ul> <li><strong>Example:</strong> J%N__ matches any string that starts with 'J,' contains 'N' at some position, and ends with any two characters, such as "Johnson," "Jensen," or "Jonathan."</li> <li><strong>Example:</strong> P_R%E matches any string that starts with 'P,' has any single character in the middle, followed by 'R,' and ends with an 'E,' such as "Pure," "Pierre," or "Parker."</li> </ul> </li> </ul> </div>




        <form method="GET" action="http://127.0.0.1/success.php">
            <button type="submit">Back</button>
        </form>
    </div>

</body>
</html>
