<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bixbybitesdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reservations
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations Made</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png">
</head>
<body>
    <header>
        <div class="logo-div">
            <a href="updateMenu.php" title="Home">
                <img src="images/BixbyLogo1.png" height="70" alt="Bixby Bites Logo">
            </a>
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
            
        </div>
        <h1 class="menu-title">Reservations Made</h1>
    </header>
    <main>
        <div class="reservation-container">
            <table class="reservation-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Table Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['reservation_id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['phone_num'] . "</td>
                                    <td>" . $row['reservation_date'] . "</td>
                                    <td>" . $row['reservation_time'] . "</td>
                                    <td>" . $row['table_num'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No reservations found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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
    
</body>
</html>

<?php
$conn->close();
?>
