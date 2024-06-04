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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are set
    if (isset($_POST['menu_item_id']) && isset($_POST['name']) && isset($_POST['price'])) {
        $menu_item_id = $_POST['menu_item_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        // Check if the item is already in the cart
        $checkCart = $conn->prepare("SELECT id, quantity FROM cart WHERE menu_item_id = ?");
        $checkCart->bind_param("i", $menu_item_id);
        $checkCart->execute();
        $checkCart->store_result();
        $checkCart->bind_result($cart_id, $quantity);

        if ($checkCart->num_rows > 0) {
            $checkCart->fetch();
            // Update the quantity if the item already exists in the cart
            $quantity += 1;
            $updateCart = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            $updateCart->bind_param("ii", $quantity, $cart_id);
            $updateCart->execute();
            $updateCart->close();
        } else {
           // Insert a new item if it doesn't exist in the cart
            $quantity = 1; // Assign the value here
            $insertCart = $conn->prepare("INSERT INTO cart (menu_item_id, name, price, quantity) VALUES (?, ?, ?, ?)");
            $insertCart->bind_param("isdi", $menu_item_id, $name, $price, $quantity);
            $insertCart->execute();
            $insertCart->close();

        }
        $checkCart->close();
    }
}

// Fetch menu items
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);

// No need to close connection here

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png">
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="homepage.php" title="Home"><img src="images/BixbyLogo1.png" height="70" /></a>
            <nav class="navig">
                <ul>
                    <li><a href="aboutus.php">About us</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="contactus.php">Contact us</a></li>
                    <li class="nav-item">
                        <a href="reservation.php" class="nav-link">Reserve a Table</a>
                    </li>
                </ul>
            </nav>
            <button id ="MyOrders" class="register-button">Orders</button>
        </header>
        <h1>Menu</h1>
        <div class="menu-items">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='menu-item'>
                            <img class='image-item' src='images/" . $row['image'] . "' alt='" . $row['name'] . "' class='menu-image'>
                            <h2>" . $row['name'] . "</h2>
                            <p class='price'>R" . $row['price'] . "</p>
                            <p class='description'>" . $row['description'] . "</p>
                            <p class='category'>" . $row['category'] . "</p>
                            <form method='POST' action='menu.php'>
                            <input type='hidden' name='menu_item_id' value='" . $row['item_id'] . "'>
                            <input type='hidden' name='name' value='" . $row['name'] . "'>
                            <input type='hidden' name='price' value='" . $row['price'] . "'>
                            
    <button type='submit'>Add to Order</button>
</form>

                          </div>";
                }
            } else {
                echo "<p>No menu items found</p>";
            }
            ?>
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
    <script>
    document.getElementById("MyOrders").onclick = function () {
        window.location.href = "cart.php";
    };
</script>

</body>
</html>
