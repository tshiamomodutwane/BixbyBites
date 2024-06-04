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

// Handle adding, updating, and deleting items in the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            if (isset($_POST['menu_item_id']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
                $menu_item_id = $_POST['menu_item_id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];

                // Insert a new item into the cart
                $insertCart = $conn->prepare("INSERT INTO cart (menu_item_id, name, price, quantity) VALUES (?, ?, ?, ?)");
                $insertCart->bind_param("isdi", $menu_item_id, $name, $price, $quantity);
                $insertCart->execute();
                $insertCart->close();
            }
        } elseif ($_POST['action'] == 'update') {
            if (isset($_POST['cart_id']) && isset($_POST['quantity'])) {
                $cart_id = $_POST['cart_id'];
                $quantity = $_POST['quantity'];

                // Update the quantity in the cart
                $updateCart = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
                $updateCart->bind_param("ii", $quantity, $cart_id);
                $updateCart->execute();
                $updateCart->close();
            }
        } elseif ($_POST['action'] == 'delete') {
            if (isset($_POST['cart_id'])) {
                $cart_id = $_POST['cart_id'];

                // Delete the item from the cart
                $deleteCart = $conn->prepare("DELETE FROM cart WHERE id = ?");
                $deleteCart->bind_param("i", $cart_id);
                $deleteCart->execute();
                $deleteCart->close();
            }
        }
    }
}

// Fetch cart items
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);

// Calculate total price
$total = 0;
$cartItems = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total += $row['price'] * $row['quantity'];
        $cartItems[] = $row;
    }
}

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'confirm') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $order_status = 'Pending';
        $order_date = date('Y-m-d H:i:s');

        // Check if email exists
        $checkCustomer = $conn->prepare("SELECT email FROM customers WHERE email = ?");
        $checkCustomer->bind_param("s", $email);
        $checkCustomer->execute();
        $checkCustomer->store_result();

        if ($checkCustomer->num_rows > 0) {
            // Insert a new order
            $insertOrder = $conn->prepare("INSERT INTO orders (email, order_status, order_date) VALUES (?, ?, ?)");
            $insertOrder->bind_param("sss", $email, $order_status, $order_date);
            $insertOrder->execute();
            $order_id = $insertOrder->insert_id;
            $insertOrder->close();

            

            // Clear the cart
            $conn->query("DELETE FROM cart");

        } else {
            echo "<p>Invalid email address.</p>";
        }

        $checkCustomer->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        </header>
        <h1>Cart</h1>
        <div class="cart-items">
            <?php
            if (!empty($cartItems)) {
                foreach ($cartItems as $item) {
                    echo "<div class='cart-item'>
                            <h2>" . $item['name'] . "</h2>
                            <p class='price'>R" . $item['price'] . " x " . $item['quantity'] . "</p>
                            <form method='POST' action='cart.php'>
                                <input type='hidden' name='cart_id' value='" . $item['id'] . "'>
                                <input type='number' name='quantity' value='" . $item['quantity'] . "' min='1' max='10'>
                                <button type='submit' name='action' value='update'>Update</button>
                                <button type='submit' name='action' value='delete'>Delete</button>
                            </form>
                          </div>";
                }
                echo "<h3>Total: R$total</h3>";
                echo "<form method='POST' action='cart.php'>
                        <label for='email'>Email:</label>
                        <input type='email' name='email' id='email' required>
                        <button type='submit' name='action' value='confirm'>Confirm Order</button>
                      </form>";
            } else {
                echo "<p>No items in the cart</p>";
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
</body>
</html>
