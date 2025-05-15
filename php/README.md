simple e-commerce platform built using PHP and MySQL. The project demonstrates key features such as user authentication, order management, and data retrieval from a MySQL database.

## Features
- **User Authentication**: Secure login and registration for customers.
- **Order Management**: Manage orders, view order details, and track customer purchases.
- **Data Retrieval**: Fetch and display data from multiple related tables using complex SQL queries.
- **Responsive Design**: User-friendly interface built with HTML and CSS.

## Installation
Follow these steps to set up the project on your local machine:

### Step 1: Install XAMPP
- Download XAMPP from the official website: [XAMPP](https://www.apachefriends.org/index.html)
- Run the installer and follow the setup instructions.
- Start the Apache and MySQL modules from the XAMPP Control Panel.
- Screenshot:
![XAMPP Control Panel](https://github.com/jentimanatol/php_sql/blob/2f27278d76d1bdc8a0d5e2f028b8f4a591c7ced9/bargainbuy/Screenshot/index.php.jpg)

### Step 2: Install MySQL Workbench
- Download MySQL Workbench from the official website: [MySQL Workbench](https://dev.mysql.com/downloads/workbench/)
- Run the installer and follow the setup instructions.
- Open MySQL Workbench and connect to your MySQL database.
- Screenshot:
![MySQL Workbench](https://github.com/jentimanatol/php_sql/blob/2f27278d76d1bdc8a0d5e2f028b8f4a591c7ced9/bargainbuy/Screenshot/orderDetails.php.jpg)

### Step 3: Clone the Repository
```bash
git clone https://github.com/yourusername/bargain-buy.git
cd bargain-buy
Step 4: Setup Database
Import the provided SQL file into your MySQL database to create the necessary tables.

sql
mysql -u yourusername -p yourpassword bargainbuy < database.sql
Step 5: Configure Database Connection
Open config.php and update the database connection details.

php
<?php
$mysqli = new mysqli("localhost", "root", "admin", "bargainbuy");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
Step 6: Start the Server
Open XAMPP Control Panel and start Apache and MySQL.

Navigate to http://localhost in your browser to access the project.

Usage
Login Page
Navigate to the login page (index.php).

Enter the email and password to log in.

Example credentials:

Email: jentimanato@gmail.com

Password: 123456

Welcome Page
After logging in, you will be redirected to the welcome page (welcome.php).

Available actions:

View Customer Emails

View Order Details

View Andersen Orders

View Product Details

Order and Product Details
Click the respective buttons to view detailed information about orders and products.

Project Structure
plaintext
bargain-buy/
├── index.php
├── login.php
├── welcome.php
├── emails.php
├── orderDetails.php
├── andersenOrders.php
├── productDetails.php
├── config.php
├── assets/
│   ├── css/
│   └── js/
└── database.sql
Technologies Used
PHP: Server-side scripting.

MySQL: Database management.

HTML/CSS: Front-end structure and design.

XAMPP: Local development environment.