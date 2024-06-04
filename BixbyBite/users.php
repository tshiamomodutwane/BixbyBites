<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'bixbybitesdatabase';
$username = 'root';
$password = '';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Retrieve all registered customers
try {
    $sql = 'SELECT * FROM customers';
    $statement = $pdo->query($sql);
    $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not retrieve data from the database :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Customers</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="updateMenu.php"><img src="images/BixbyLogo1.png" height="70" alt="Bixby Bites Logo" class="logo"></a>
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
        <main>
            <h1>Registered Customers</h1>
            <div class="reservation-container">
            <?php if (!empty($customers)) : ?>
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
                                <td><?php echo htmlspecialchars($customer['name']); ?></td>
                                <td><?php echo htmlspecialchars($customer['surname']); ?></td>
                                <td><?php echo htmlspecialchars($customer['phone_num']); ?></td>
                                <td><?php echo htmlspecialchars($customer['address']); ?></td>
                                <td><?php echo htmlspecialchars($customer['email']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                        
            <?php else : ?>
                <p>No customers found.</p>
            <?php endif; ?>
            </div>
        </main>
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
