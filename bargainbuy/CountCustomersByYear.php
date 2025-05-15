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

$year = isset($_POST['year']) ? $_POST['year'] : '';
$customer_count = 0;

if ($year) {


    // SQL query to call the function  

    //USE bargainbuy;

   // DELIMITER //
    
    //CREATE FUNCTION CountCustomersByYear(input_year INT)
    //RETURNS INT
    //READS SQL DATA
    //BEGIN
    //    DECLARE customer_count INT;
     //   SELECT COUNT(*) INTO customer_count
    //    FROM customers
    //    WHERE YEAR(SubscriptionDate) = input_year;
    //    RETURN customer_count;
    //END //
    
    //DELIMITER ;
    //save and run in worckBench Anatolie Jentimir comented 
    // cal the function 




    $sql_count = "SELECT CountCustomersByYear(?) AS customer_count";






    
    $stmt = $conn->prepare($sql_count);

    $stmt->bind_param("i", $year);
    $stmt->execute();
    
    $result_count = $stmt->get_result();
    
    if ($row_count = $result_count->fetch_assoc()) {
        $customer_count = $row_count['customer_count'];
    }

    // SQL query to fetch customers subscribed in the selected year
    $sql = "SELECT CustomerID, FirstName, LastName, Company, City, Country, Phone, Email, SubscriptionDate 
            FROM customers 
            WHERE YEAR(SubscriptionDate) = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Count Customers By Year</title>
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
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        table td {
            background-color: #f9f9f9;
        }
        table tr:nth-child(even) td {
            background-color: #f1f1f1;
        }
        table tr:hover td {
            background-color: #e2e2e2;
        }
        .table-container {
            overflow-x: auto;
        }
        .form-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Count Customers By Year</h1>
        <h3>Welcome back <?php echo $_SESSION['name']; ?></h3>

        <div class="form-container">
            <form method="POST" action="">
                <label for="year">Introduce Year:</label>
                <input type="number" id="year" name="year" required>
                <button type="submit">Enter</button>
            </form>
        </div>

        <?php
        if ($year) {
            echo "<p>Total Customers Subscribed in $year: $customer_count</p>";
        ?>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>CustomerID</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Company</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>SubscriptionDate</th>
                    </tr>
                </thead>
                <tbody>
                   
                <?php  
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["CustomerID"] . '</td>';
                    echo '<td>' . $row["FirstName"] . '</td>';
                    echo '<td>' . $row["LastName"] . '</td>';
                    echo '<td>' . $row["Company"] . '</td>';
                    echo '<td>' . $row["City"] . '</td>';
                    echo '<td>' . $row["Country"] . '</td>';
                    echo '<td>' . $row["Phone"] . '</td>';
                    echo '<td>' . $row["Email"] . '</td>';
                    echo '<td>' . $row["SubscriptionDate"] . '</td>';
                    echo '</tr>';
                }
                ?>
                  
                </tbody>
            </table>
        </div>

        <?php 
        }
        ?>
    </div>

</body>
</html>
