<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .menu {
            margin: 20px auto;
            width: 90%;
            max-width: 600px;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .menu h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .option {
            margin: 20px 0;
            text-align: center;
        }
        .option button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
        }
        .option button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bargain and Buy</h1>
        <h3>Welcome back <?php echo $_SESSION['name']; ?></h3>
    </div>

    <div class="menu">
        <h2>Main Menu</h2>




        <div class="option">
            <button onclick="showinsertCustomer()">Insert new customer </button>
        </div>



        <div class="option">
            <button onclick="showdeleteCustomerID()">Delete customer by ID </button>
        </div>





        <div class="option">
            <button onclick="searchOrders()">Search Order History</button>
        </div>





        <div class="option">
            <button onclick="searchOrdersDetails3Table()">search Orders Details Joint 5 Table </button>
        </div>







        
        <div class="option">
            <button onclick="searchOrdersByCustomerLastName()">search Orders By Customer LastName</button>
        </div>








        <div class="option">
            <button onclick="showProducts()">Show Available Products</button>
        </div>
        


        <div class="option">
            <button onclick="showEmails()">Show All emails from Database</button>
        </div>
        


        <div class="option">
            <button onclick="showCustomers()">Show All Customers details</button>
        </div>
        

        

        <div class="option">
            <button onclick="showCountCustomersByYear()">Show All Count Customers By Year</button>
        </div>
        


        
        <div class="option">
            <button onclick="showCountTodayOrders()">Show Count Today Orders</button>
        </div>
        

                
        <div class="option">
            <button onclick="showCountSelectDateOrders()">Show Count Select Date Orders</button>
        </div>
        


        


    </div>






    <script>


        function showinsertCustomer() {
            // Replace with actual products display functionality
            alert("use bargainbuy;\ninsert into customers \n                  (lastname,\n                  firstName,\n                  company,\n                  city, \n                 country,\n                  phone, \n                 email,\n                  pass,\n                  SubscriptionDate  )\nvalue ('Anatoli', 'Jentimi', 'BHCC', 'boston','USA', '222-222-222', 'jentimanato@gmail.com', sha2('123456', 512), CURDATE());");
            // Redirect to the products page
             location.href = "insertCustomer.php";
        }





        function showdeleteCustomerID() {
            // Replace with actual search functionality
            alert("Query used :  \n DELETE FROM customers \n WHERE customerID = 10001;");
            // Redirect to the search page
             location.href = "deleteCustomerID.php";
        }






        function searchOrders() {
            // Replace with actual search functionality
            alert("Query used : select * from  orders where customerID = 1001");
            // Redirect to the search page
             location.href = "orders.php";
        }






        function searchOrdersDetails3Table() {
            // Replace with actual search functionality
            alert("Query used: \nSELECT orderdetails.orderID, \nCustomers.firstname AS 'Customers Firstname', \nCustomers.lastname AS 'Customers Lastname', \nemployees.firstname AS 'Employees Firstname', \nemployees.lastname AS 'Employees Lastname', \norderdetails.OrderDetailID, \norderdetails.ProductID, \nproducts.ProductName, \nproducts.SupplierID, \nsuppliers.SupplierName \nFROM orders \nJOIN customers ON orders.customerID = Customers.customerID \nJOIN employees ON orders.employeeID = employees.employeeID \nJOIN orderdetails ON orders.OrderID = orderdetails.OrderID \nJOIN products ON orderdetails.ProductID = products.ProductID \nJOIN suppliers ON suppliers.SupplierID = products.SupplierID \nWHERE Customers.lastname LIKE 'Andersen' \nAND products.ProductName LIKE 'Geitost';\n#join 5 tables \n#-------------------------------------------------------------------------------------------");

            // Redirect to the search page
             location.href = "searchOrderDetails.php";
        }











        function searchOrdersByCustomerLastName() {
            // Replace with actual search functionality
         //   alert("Query used : SELECT orderID, Customers.firstname AS 'Customers Firstname', Customers.lastname AS 'Customers Lastname', employees.firstname AS 'Employees Firstname', employees.lastname AS 'Employees Lastname'\\nFROM orders\\nJOIN customers ON orders.customerID = Customers.customerID\\nJOIN employees ON orders.employeeID = employees.employeeID\\nWHERE Customers.lastname LIKE 'Andersen';");
       alert("Query used: \n SELECT orderID, \n Customers.firstname AS 'Customers Firstname', \n Customers.lastname AS 'Customers Lastname',\n  employees.firstname AS 'Employees Firstname', \n employees.lastname AS 'Employees Lastname' \n FROM orders \n JOIN customers ON orders.customerID = Customers.customerID \n JOIN employees ON orders.employeeID = employees.employeeID \n WHERE Customers.lastname LIKE 'Andersen';");
         
         // Redirect to the search page
             location.href = "searchOrdersByCustomerLastName.php";
        }






        function showProducts() {
            // Replace with actual products display functionality
            alert("Query used : SELECT productID, productName, Unit, Price FROM products;");
            // Redirect to the products page
             location.href = "products.php";
        }



        

        function showEmails() {
            // Replace with actual products display functionality
    alert("Query used : SELECT Email FROM customers;");
            // Redirect to the products page
             location.href = "emails.php";
        }





        function showCustomers() {
            // Replace with actual products display functionality
           alert("Query used : select CustomerID, FirstName, LastName, Company,City, Country , Phone, Email, SubscriptionDate from customers;");
            // Redirect to the products page
             location.href = "custumers.php";
        }


        function showCountCustomersByYear() {
            // Replace with actual products display functionality
            alert("Query used:\n USE bargainbuy;\nDELIMITER //\nCREATE FUNCTION CountCustomersByYear(input_year INT)\nRETURNS INT\nREADS SQL DATA\nBEGIN\n    DECLARE customer_count INT;\n    SELECT COUNT(*) INTO customer_count\n    FROM customers\n    WHERE YEAR(SubscriptionDate) = input_year;\n    RETURN customer_count;\nEND\nDELIMITER ;");

            // Redirect to the products page
             location.href = "CountCustomersByYear.php";
        }

      


        function showCountTodayOrders() {
            // Replace with actual products display functionality
            alert("Query used : #--------------------------------\nUSE bargainbuy;\nDELIMITER //\nCREATE PROCEDURE CountTodayOrdersReturnInt()\n  BEGIN\n    SELECT COUNT(*) AS order_count\n    FROM orders\n    WHERE DATE(OrderDate) = CURDATE();\n  END //\nDELIMITER ;\n#------------------------------------");

            // Redirect to the products page
             location.href = "CountTodayOrders.php";
        }

      

        function showCountSelectDateOrders() {
            // Replace with actual products display functionality
            alert ("// SQL query to fetch orders on the selected date\n$sql = \"SELECT OrderID, \n          CustomerID,\n           EmployeeID, \n          ShipperID,\n          OrderDate\n        FROM orders\n        WHERE DATE(OrderDate) = ?\";\n\n$stmt = $conn->prepare($sql);\n$stmt->bind_param(\"s\", $date);\n$stmt->execute();\n$result = $stmt->get_result();\n$total_orders = $result->num_rows;");

            // Redirect to the products page
             location.href = "CountSelectDateOrders.php";
        }

      



      






    </script>
</body>
</html>
