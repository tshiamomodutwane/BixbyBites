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
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT email FROM customers WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        $message = "Email already exists. Please use a different email.";
    } else {
        // Insert new customer
        $stmt = $conn->prepare("INSERT INTO customers (name, surname, phone_num, address, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fname, $lname, $phone, $address, $email, $password);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
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
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png" />
    <link rel="stylesheet" href="style.css" />
    <script>
        function validateForm() {
            const fname = document.getElementById('fname').value.trim();
            const lname = document.getElementById('lname').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const address = document.getElementById('address').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (fname === "" || lname === "" || phone === "" || address === "" || email === "" || password === "") {
                alert("All fields are required.");
                return false;
            }

            if (!validateEmail(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (!validatePhoneNumber(phone)) {
                alert("Please enter a valid phone number.");
                return false;
            }

            if (!validatePassword(password)) {
                alert("Password must be at least 8 characters long and include both letters and numbers.");
                return false;
            }

            return true;
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }

        function validatePhoneNumber(phoneNumber) {
            const re = /^\d{10}$/; // Adjust this regex based on the required phone number format
            return re.test(String(phoneNumber));
        }

        function validatePassword(password) {
            const re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Minimum 8 characters, at least one letter and one number
            return re.test(String(password));
        }
    </script>
</head>
<body>
<header>
    <a href="index.php" title="Home"><img src="images/BixbyLogo1.png" height="70" /></a>
</header>

<main>
    <form method="POST" action="register.php" onsubmit="return validateForm()">
        <table>
            <tr>
                <td><label class="first-text" for="fname">First name:</label></td>
                <td><input class="first-box" type="text" id="fname" name="fname" placeholder="First name:" required /></td>
            </tr>
            <tr>
                <td><label class="last-text" for="lname">Last Name:</label></td>
                <td><input class="last-box" type="text" id="lname" name="lname" placeholder="Last Name:" required /></td>
            </tr>
            <tr>
                <td><label class="phone-num" for="phone">Phone number: </label></td>
                <td><input class="phone-box" type="tel" id="phone" name="phone" placeholder="Phone Number" required /></td>
            </tr>
            <tr>
                <td><label class="last-text" for="address">Address: </label></td>
                <td><input class="last-box" type="text" id="address" name="address" placeholder="Residential address" required /></td>
            </tr>
            <h3 class="account-title">Account Security</h3>
            <tr>
                <td><label class="address-text" for="email">Email Address: </label></td>
                <td><input class="address-box" type="email" id="email" name="email" placeholder="Email address:" required /></td>
            </tr>
            <tr>
                <td><label class="pass-text" for="password">Password:</label></td>
                <td><input class="pass-box" type="password" id="password" name="password" placeholder="Password" required /></td>
            </tr>
        </table>
        <div class="news-div">
            <p class="news-text">Would you like to receive emails about offers and news from BixbyBites?</p>
            <input type="checkbox" id="agree" />
            <label for="agree">Yes, I would like to receive emails</label>
        </div>
        <br />
        <input class="submit-button" type="submit" id="sub" value="Register" />
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
