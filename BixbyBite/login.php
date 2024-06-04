<?php
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
    $email = $_POST['lemail'];
    $password = $_POST['lpassword'];

    // Check if user exists and verify password
    $stmt = $conn->prepare("SELECT customer_id, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($customer_id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['customer_id'] = $customer_id;
            header("Location: menu.php");
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
    <link rel="stylesheet" href="style.css" />
    <title>Login</title>
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png" />
</head>
<body>
    <header>
        <a href="index.php" title="Home"><img src="images/BixbyLogo1.png" height="70" /></a>
    </header>
   
    <main>
        <form method="POST" action="login.php">
            <h1 class="sign-title">Sign in</h1>
            <table>
                <tr>
                    <td><label class="email-label" for="lemail">Email address:</label></td>
                    <td><input class="email2-box" type="text" id="lemail" name="lemail" placeholder="email address" required /></td>
                </tr>
                <tr>
                    <td><label class="password-label" for="lpassword">Password:</label></td>
                    <td><input class="password2-box" type="password" id="lpassword" name="lpassword" placeholder="Password" required /></td>
                </tr>
            </table>
            <p class="forgot-text"><a href="forgotpassword.php">Forgot your password?</a></p>
            <input class="submit-button" type="submit" value="Login" />
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
