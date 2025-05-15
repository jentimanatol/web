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





// SQL query to fetch products from the database

$sql = "SELECT Email FROM customers";

///$sql = "select * from  orders where customerID = 1001"; 

//$sql = "SELECT productID, productName, Unit, Price FROM products";





$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Emails table</title>
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
    </style>
</head>
<body>

    <div class="container">
        <h1>Product List</h1>
        <h3>Welcome back <?php echo $_SESSION['name']; ?></h3>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                   
                    </tr>
                </thead>
                <tbody>
                   
                <?php  while($row = $result->fetch_assoc()) {
                    
                    echo '<tr>';
                      



                        echo '<td>' . $row["Email"] . '</td>';
                  
                        echo '</tr>';
                }
              
                ?>
                  
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
