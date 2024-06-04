<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Homepage</title>
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png" />
  </head>

  <body>
    <header>
      <div class="logo-div">
        <a href="index.php" title="Home">
          <img src="images/BixbyLogo1.png" height="70" alt="Bixby Bites Logo" />
        </a>
        <button id="myRegister" class="register-button">Register</button>
        <button id="myLogin" class="login-button">Login</button>
      </div>

      <h1 class ="welcome-text">Welcome to BixbyBites website</h1>
      
    </header>

    <main>
      <div class="chesa-container">
        <div class="chesa-div">
          <img class="chesa-pic" src="images/chesa.png" alt="Chesa Nyama" />
        </div>
        <div class="chesa-text">
          <p class="steak-text">Bixby Chesa Nyama &#174;</p>
          <p class="sizzling-text">
            Sizzling Goodness, Straight from the Flames!
          </p>
        </div>
      </div>

      <div class="icecream-container">
        <div class="icecream-div">
          <img
            class="icecream-pic"
            src="images/icecream.webp"
            alt="Ice Cream"
          />
        </div>
        <div class="icecream-text">
          <h2 class="ice-text">Ice-Cream</h2>
          <p class="scoop-text">
            Scoop by scoop, happiness melts in every bite!
          </p>
        </div>
      </div>

      <div class="drink-container">
        <div class="drink-div">
          <img class="drink-pic" src="images/drinks.png" alt="Fizzy Drinks" />
        </div>
        <div class="drink-text">
          <h2 class="drink-text">Fizzy Drinks</h2>
          <p class="sip-text">
            Sip, smile, repeat. Life is better with every drop!
          </p>
          <button id="signUpButton" class="sign-button">Sign Up</button>
        </div>
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


    <script>
      document.getElementById("myRegister").onclick = function () {
        window.location.href = "register.php";
      };

      document.getElementById("myLogin").onclick = function () {
        window.location.href = "login.php";
      };

      document.getElementById("signUpButton").onclick = function () {
        window.location.href = "register.php";
      };
    </script>
  </body>
</html>
