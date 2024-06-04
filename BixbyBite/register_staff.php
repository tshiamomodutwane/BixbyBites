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
    $name = $_POST['name'];
    $phone_num = $_POST['phone_num'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT email FROM staff WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        $message = "Email already exists. Please use a different email.";
    } else {
        // Insert new staff member
        $stmt = $conn->prepare("INSERT INTO staff (name, phone_num, email, role, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $name, $phone_num, $email, $role, $password);

        if ($stmt->execute()) {
            $message = "Staff member registered successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
    $checkEmail->close();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Staff</title>
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header>
        <a href="register_staff.php" title="Home"><img src="images/BixbyLogo1.png" height="70" /></a>
    </header>
    
    <main>
        <h1>Register New Staff</h1>
        <form method="POST" action="register_staff.php">
            <table>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" id="name" name="name" required /></td>
                </tr>
                <tr>
                    <td><label for="phone_num">Phone Number:</label></td>
                    <td><input type="tel" id="phone_num" name="phone_num" required /></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" required /></td>
                </tr>
                <tr>
                    <td><label for="role">Role:</label></td>
                    <td><input type="text" id="role" name="role" required /></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required /></td>
                </tr>
            </table>
            <a href = "staff_login.php">Login</a>
            <input type="submit" value="Register Staff" />
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
