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

// Retrieve all registered staff members
try {
    $sql = 'SELECT * FROM staff';
    $statement = $pdo->query($sql);
    $staff_members = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not retrieve data from the database :" . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Staff Members</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png">
</head>
<body>
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

        <main class="main-content">
            <h1>Registered Staff Members</h1>
            <div class="reservation-container">
            <?php if (!empty($staff_members)) : ?>
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staff_members as $staff) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($staff['staff_id']); ?></td>
                                <td><?php echo htmlspecialchars($staff['name']); ?></td>
                                <td><?php echo htmlspecialchars($staff['phone_num']); ?></td>
                                <td><?php echo htmlspecialchars($staff['email']); ?></td>
                                <td><?php echo htmlspecialchars($staff['role']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No staff members found.</p>
            <?php endif; ?>
            </div>
        </main>

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
    </div>
</body>
</html>
