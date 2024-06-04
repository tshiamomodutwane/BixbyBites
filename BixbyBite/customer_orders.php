<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bixbybitesdatabase";

// Create connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection, if it fails, terminate script and display error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all orders from the 'orders' table
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    <link rel="stylesheet" href="style.css">
    <a href="updateMenu.php"><link rel="icon" type="image/png" href="images/Bixbyfavico.png"></a>
</head>
<body>
    <div class="container">
        <!-- Header section with logo -->
        <header class="header">
            <a href="updateMenu.php" title="Home"><img src="images/BixbyLogo1.png" height="70" /></a>
            <nav class="navig">
            <ul>
                    <li><a href="updateMenu.php">Update Menu</a></li>
                    <li><a href="menuAdmin.php">Menu</a></li>
                    <li><a href="reserved.php">Reserved tables</a></li>
                    <li class="nav-item">
                        <a href="reservationAdmin.php" class="nav-link">Reserve a Table</a>
                    </li>
                    <li><a href="customer_orders.php">Orders Placed</a></li>
                    <li><a href="users.php">Registered Customers</a></li>
                    <li><a href="Staff_users.php">Registered Staff</a></li>
                </ul>
            </nav>
        </header>
        <h1>Customer Orders</h1>
        <!-- Table to display orders -->
        <div class="reservation-container">
            <table class="reservation-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Email</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any results from the query
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['order_id'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['order_status'] . "</td>
                                    <td>" . $row['order_date'] . "</td>
                                  </tr>";
                        }
                    } else {
                        // Display message if no orders are found
                        echo "<tr><td colspan='4'>No orders found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>About BixbyBites</h2>
                <p>BixbyBites is your ultimate destination for delicious food and great dining experiences. Explore our menu, reserve a table, or order online today!</p>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                    <li><a href="reservation.php">Reserve a Table</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h2>Contact Information</h2>
                <ul>
                    <li>Email: info@bixbybites.com</li>
                    <li>Phone: 068 798 7706</li>
                    <li>Address: 3572 Chestnut Street, Section H, Palm Springs, 1984</li>
                </ul>
            </div>
            <div class="footer-section social">
                <h2>Follow Us</h2>
                <ul>
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2024 BixbyBites | All rights reserved
    </div>
</footer>
</body>
</html>
