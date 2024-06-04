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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $table_num = $_POST['table'];

    // Insert data into reservations table
    $sql = "INSERT INTO reservations (name, email, phone_num, reservation_date, reservation_time, table_num) VALUES ('$name', '$email', '$phone', '$date', '$time', '$table_num')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close MySQL connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reserve a Table - Bixby Bites</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png" />
  </head>
  <body>
    <header class="header">
      <a href="homepage.php" title="Home">
        <img
          src="images/BixbyLogo1.png"
          height="70"
          alt="Bixby Bites Logo"
          class="logo"
        />
      </a>
    </header>

    <nav class="navig">
      <ul class="nav-list">
        <li class="nav-item">
          <a href="aboutus.php" class="nav-link">About us</a>
        </li>
        <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
        <li class="nav-item">
          <a href="contactus.php" class="nav-link">Contact us</a>
        </li>
        <li class="nav-item">
          <a href="reservation.php" class="nav-link">Reserve a Table</a>
        </li>
      </ul>
    </nav>

    <main class="main-content">
      <h1 class="main-title">Reserve a Table</h1>
      <form id="reservation-form" class="reservation-form" method="post">


        <div class="form-group">
          <label for="name" class="email-label">Name:</label>
          <input
            type="text"
            id="name"
            name="name"
            class="form-input"
            placeholder="Name"
            required
          />
        </div>
        <div class="form-group">
          <label for="email" class="email-label">Email:</label>
          <input
            type="email"
            id="email"
            name="email"
            class="form-input"
            placeholder="Email"
            required
          />
        </div>
        <div class="form-group">
          <label for="phone" class="email-label">Phone Number:</label>
          <input
            type="tel"
            id="phone"
            name="phone"
            class="form-input"
            placeholder="phone number"
            required
          />
        </div>
        <div class="form-group">
          <label for="date" class="email-label">Date:</label>
          <input
            type="date"
            id="date"
            name="date"
            class="form-input"
            required
          />
        </div>
        <div class="form-group">
          <label for="time" class="email-label">Time:</label>
          <input
            type="time"
            id="time"
            name="time"
            class="form-input"
            required
          />
        </div>
        <div class="form-group">
          <label for="table" class="email-label">Table Number:</label>
          <select id="table" name="table" class="form-select" required>
            <option value="">Select a table</option>
            <option value="1">Table 1</option>
            <option value="2">Table 2</option>
            <option value="3">Table 3</option>
            <option value="4">Table 4</option>
            <option value="5">Table 5</option>
            <option value="6">Table 6</option>
            <option value="7">Table 7</option>
            <option value="8">Table 8</option>
            <option value="9">Table 9</option>
            <option value="10">Table 10</option>
          </select>
        </div>
        <button type="submit" class="submit-button">Reserve</button>
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

    </script>
  </body>
</html>
