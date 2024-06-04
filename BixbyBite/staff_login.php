<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bixbybitesdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if staff exists and verify password
    $stmt = $conn->prepare("SELECT staff_id, role, password FROM staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($staff_id, $role, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['staff_id'] = $staff_id;
            $_SESSION['role'] = $role;
            header("Location: updateMenu.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No account found with that email.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Login</title>
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header>
        <a href="homepage.php" title="Home"><img src="images/BixbyLogo1.png" height="70" /></a>
    </header>
    <main>
        <form method="POST" action="staff_login.php">
            <h1>Staff Login</h1>
            <table>
                <tr>
                    <td><label for="email">Email address:</label></td>
                    <td><input type="email" id="email" name="email" required /></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required /></td>
                </tr>
            </table>
            <input type="submit" value="Login" />
            <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
        </form>
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
