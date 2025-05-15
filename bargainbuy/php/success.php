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
            max-width: 1200px;
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
        .group-container {
            display: flex;
            justify-content: space-around;
        }
        .group {
            text-align: center;
        }
        .group h3 {
            color: #007bff;
        }
        .group .option button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
        }
        .group .option button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bargain and Buy</h1>
        <h3>Welcome back <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></h3>
    </div>

    <div class="menu">
        <h2>Main Menu</h2>
        <div class="group-container">

            <!-- CREATE FUNCTION -->
            <div class="group">
                <h3>CREATE FUNCTION</h3>
                <div class="option">
                    <button onclick="showCountCustomersByYear()">Show All Count Customers By Year</button>
                </div>
                <div class="option">
                    <button onclick="countOrdersByCustomerAndProduct()">Count Orders By Customer And Product</button>
                </div>



                <div class="option"> <button onclick="getCustomerOrderCount()">Get Customer Order Count</button> </div>






            </div>

            
            <!-- CREATE PROCEDURE -->
            <div class="group">
                <h3>CREATE PROCEDURE</h3>
                <div class="option">
                    <button onclick="showCountTodayOrders()">Show Count Today Orders</button>
                </div>


                <div class="option">
            <button onclick="getTotalSalesByCustomer()">Get Total Sales By Customer</button>
            </div>



            <div class="option">
                <button onclick="getRandomLastName()">Get Random Last Name</button>
            </div>


            <div class="option">
                 <button onclick="getRandomLastNameDetail()">Get Random Last Name Detail</button> 
                </div>


                <div class="option">
            <button onclick="getEmployeeLastNamesByPattern()">Get Employee Last Names By Pattern</button>
                </div>






            </div>

            <!-- Regular Query -->
            <div class="group">
                <h3>Regular Query</h3>
                <div class="option">
                    <button onclick="showinsertCustomer()">Insert new customer</button>
                </div>
                <div class="option">
                    <button onclick="showdeleteCustomerID()">Delete customer by ID</button>
                </div>
                <div class="option">
                    <button onclick="searchOrders()">Search Order History</button>
                </div>
                <div class="option">
                    <button onclick="searchOrdersDetails3Table()">Search Orders Details Joint 5 Table</button>
                </div>
                <div class="option">
                    <button onclick="searchOrdersByCustomerLastName()">Search Orders By Customer LastName</button>
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
                    <button onclick="showCountSelectDateOrders()">Show Count Select Date Orders</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showinsertCustomer() {
            alert("use bargainbuy;\ninsert into customers \n                  (lastname,\n                  firstName,\n                  company,\n                  city, \n                 country,\n                  phone, \n                 email,\n                  pass,\n                  SubscriptionDate  )\nvalue ('Anatoli', 'Jentimi', 'BHCC', 'boston','USA', '222-222-222', 'jentimanato@gmail.com', sha2('123456', 512), CURDATE());");
            location.href = "insertCustomer.php";
        }

        function showdeleteCustomerID() {
            alert("Query used :  \n DELETE FROM customers \n WHERE customerID = 10001;");
            location.href = "deleteCustomerID.php";
        }

        function searchOrders() {
            alert("Query used : select * from  orders where customerID = 1001");
            location.href = "orders.php";
        }

        function searchOrdersDetails3Table() {
            alert("Query used: \nSELECT orderdetails.orderID, \nCustomers.firstname AS 'Customers Firstname', \nCustomers.lastname AS 'Customers Lastname', \nemployees.firstname AS 'Employees Firstname', \nemployees.lastname AS 'Employees Lastname', \norderdetails.OrderDetailID, \norderdetails.ProductID, \nproducts.ProductName, \nproducts.SupplierID, \nsuppliers.SupplierName \nFROM orders \nJOIN customers ON orders.customerID = Customers.customerID \nJOIN employees ON orders.employeeID = employees.employeeID \nJOIN orderdetails ON orders.OrderID = orderdetails.OrderID \nJOIN products ON orderdetails.ProductID = products.ProductID \nJOIN suppliers ON suppliers.SupplierID = products.SupplierID \nWHERE Customers.lastname LIKE 'Andersen' \nAND products.ProductName LIKE 'Geitost';\n#join 5 tables \n#-------------------------------------------------------------------------------------------");
            location.href = "searchOrderDetails.php";
        }

        function searchOrdersByCustomerLastName() {
            alert("Query used: \n SELECT orderID, \n Customers.firstname AS 'Customers Firstname', \n Customers.lastname AS 'Customers LastName',\n employees.firstname AS 'Employees Firstname', \n employees.lastname AS 'Employees Lastname' \n FROM orders \n JOIN customers ON orders.customerID = Customers.customerID \n JOIN employees ON orders.employeeID = employees.employeeID \n WHERE Customers.lastname LIKE 'Andersen';");
            location.href = "searchOrdersByCustomerLastName.php";
        }

        function showProducts() {
            alert("Query used : SELECT productID, productName, Unit, Price FROM products;");
            location.href = "products.php";
        }

        function showEmails() {
            alert("Query used : SELECT Email FROM customers;");
            location.href = "emails.php";
        }

        function showCustomers() {
            alert("Query used : select CustomerID, FirstName, LastName, Company,City, Country , Phone, Email, SubscriptionDate from customers;");
            location.href = "custumers.php";
        }

        function showCountCustomersByYear() {
            alert("Query used:\n USE bargainbuy;\nDELIMITER //\nCREATE FUNCTION CountCustomersByYear(input_year INT)\nRETURNS INT\nREADS SQL DATA\nBEGIN\n DECLARE customer_count INT;\n SELECT COUNT(*) INTO customer_count\n FROM customers\n WHERE YEAR(SubscriptionDate) = input_year;\n RETURN customer_count;\nEND\nDELIMITER ;");
            location.href = "CountCustomersByYear.php";
        }

        function showCountTodayOrders() {
            alert("Query used : #--------------------------------\nUSE bargainbuy;\nDELIMITER //\nCREATE PROCEDURE CountTodayOrdersReturnInt()\n BEGIN\n SELECT COUNT(*) AS order_count\n FROM orders\n WHERE DATE(OrderDate) = CURDATE();\n END //\nDELIMITER ;\n#------------------------------------");
            location.href = "CountTodayOrders.php";
        }

        function showCountSelectDateOrders() {
            alert ("// SQL query to fetch orders on the selected date\n$sql = \"SELECT OrderID, \n CustomerID,\n EmployeeID, \n ShipperID,\n OrderDate\n FROM orders\n WHERE DATE(OrderDate) = ?\";\n\n$stmt = $conn->prepare($sql);\n$stmt->bind_param(\"s\", $date);\n$stmt->execute();\n$result = $stmt->get_result();\n$total_orders = $result->num_rows;");
            location.href = "CountSelectDateOrders.php";
        }

        function countOrdersByCustomerAndProduct() {
            alert("Query used:\nDELIMITER //\nCREATE FUNCTION CountOrdersByCustomerAndProduct(cust_lastname VARCHAR(255), prod_name VARCHAR(255))\nRETURNS INT\nREADS SQL DATA\nBEGIN\n    DECLARE order_count INT;\n    SELECT COUNT(*) INTO order_count\n    FROM orders\n    JOIN customers ON orders.customerID = customers.customerID\n    JOIN orderdetails ON orders.OrderID = orderdetails.OrderID\n    JOIN products ON orderdetails.ProductID = products.ProductID\n    WHERE customers.lastname LIKE cust_lastname AND products.ProductName LIKE prod_name;\n    RETURN order_count;\nEND //\nDELIMITER ;");
            location.href = "CountOrdersByCustomerAndProduct.php";
        }







        function getTotalSalesByCustomer() {
    alert("Query used:\nDELIMITER //\nCREATE PROCEDURE GetTotalSalesByCustomer(\n IN cust_lastname VARCHAR(255), \n IN start_date DATE, \n IN end_date DATE\n)\nBEGIN\n SELECT \n Customers.firstname AS 'Customer Firstname',\n Customers.lastname AS 'Customer Lastname',\n SUM(orderdetails.Quantity * orderdetails.UnitPrice) AS 'Total Sales'\n FROM orders\n JOIN customers ON orders.customerID = customers.customerID\n JOIN orderdetails ON orders.OrderID = orderdetails.OrderID\n WHERE customers.lastname = cust_lastname\n AND orders.OrderDate BETWEEN start_date AND end_date\n GROUP BY customers.customerID;\nEND //\nDELIMITER ;");
    location.href = "GetTotalSalesByCustomer.php";
}




function getRandomLastName() {
    alert("Query used:\nDELIMITER //\nCREATE PROCEDURE getRandomLastName()\nBEGIN\n SELECT lastname \n FROM customers \n ORDER BY RAND() \n LIMIT 1;\nEND //\nDELIMITER ;");
    location.href = "getRandomLastName.php";
}

function getRandomLastNameDetail() {
    alert("Query used:\nDELIMITER //\nCREATE PROCEDURE getRandomLastNameDetail()\nBEGIN\n SELECT CustomerID, FirstName, LastName, Company, City, Country, Phone, Email, SubscriptionDate \n FROM customers \n ORDER BY RAND() \n LIMIT 1;\nEND //\nDELIMITER ;");
    location.href = "getRandomLastNameDetail.php";
}




function getCustomerOrderCount() { 
    alert("Query used:\nDELIMITER //\nCREATE FUNCTION GetCustomerOrderCount(cust_lastname VARCHAR(255))\nRETURNS INT\nREADS SQL DATA\nBEGIN\n DECLARE order_count INT;\n SELECT COUNT(*) INTO order_count\n FROM orders\n JOIN customers ON orders.customerID = customers.customerID\n WHERE customers.lastname = cust_lastname;\n RETURN order_count;\nEND //\nDELIMITER ;"); 
    location.href = "getCustomerOrderCount.php"; }



function getEmployeeLastNamesByPattern() {
    alert("Query used:\nDELIMITER //\nCREATE PROCEDURE getEmployeeLastNamesByPattern(IN pattern VARCHAR(255))\nBEGIN\n SELECT LastName \n FROM Employees \n WHERE LastName LIKE pattern;\nEND //\nDELIMITER ;");
    location.href = "getEmployeeLastNamesByPattern.php";
}


    </script>
</body>
</html>
