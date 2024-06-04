<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.php");
    exit();
}

// Check if the logged-in staff member is an admin
if ($_SESSION['role'] !== 'admin') {
    die("Access denied: You do not have permission to update the menu.");
}

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
    $name = $_POST['item-name'];
    $price = $_POST['item-price'];
    $description = $_POST['item-description'];
    $category = $_POST['item-category'];
    $image = $_FILES['item-image']['name'];
    $target = "images/" . basename($image);

    if (move_uploaded_file($_FILES['item-image']['tmp_name'], $target)) {
        $sql = "INSERT INTO menu (name, price, description, category, image) VALUES ('$name', '$price', '$description', '$category', '$image')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Menu item updated successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Failed to upload image";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href= "updateMenu.php"><img src="images/BixbyLogo1.png" height="70" alt="Bixby Bites Logo" class="logo"></a>
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
        <h1>Update Menu and Prices</h1>
        <?php
        if (!empty($message)) {
            echo "<p>$message</p>";
        }
        ?>
        <form id="menu-form" enctype="multipart/form-data" action="updateMenu.php" method="POST">
            <div class="form-group">
                <label class="update" for="item-name">Item Name:</label>
                <input type="text" id="item-name" name="item-name" class="update-text" required>
            </div>
            <div class="form-group">
                <label class="update" for="item-price">Item Price:</label>
                <input type="number" step="0.01" id="item-price" name="item-price" class="update-text" required>
            </div>
            <div class="form-group">
                <label class="update" for="item-description">Item Description:</label>
                <textarea id="item-description" name="item-description" required class="update-area"></textarea>
            </div>
            <div class="form-group">
                <label for="item-category" class="update">Category:</label>
                <select id="item-category" name="item-category" required class="options">
                    <option value="appetizer">Appetizer</option>
                    <option value="main-course">Main Course</option>
                    <option value="dessert">Dessert</option>
                    <option value="beverage">Beverage</option>
                </select>
            </div>
            <div class="form-group">
                <label class="update" for="item-image">Item Image:</label>
                <input type="file" id="item-image" name="item-image" accept="image/*" required>
            </div>
            <button type="submit" class="update-button">Update Menu</button>
        </form>
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
