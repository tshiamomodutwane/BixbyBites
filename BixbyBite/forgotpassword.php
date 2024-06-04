<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Forgot Password</title>
    <link rel="icon" type="image/png" href="images/Bixbyfavico.png" />
  </head>
  <body>
    <header>
      <a href="index.php" title="Home"
        ><img src="images/BixbyLogo1.png" height="70"
      /></a>
    </header>

    <nav class="navig">
      <ul>
        <li><a href="aboutus.php">About us</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="contactus.php">Contact us</a></li>
        
      </ul>
    </nav>

    <main>
      <form>
        <h1 class="forgot">Forgot Password</h1>
        <p class="confirm-text">
          Just need to confirm your email so we can send further information of
          how to reset your password
        </p>
        <table>
          <tr>
            <td>
              <label class="email-text" for="femail">Email address:</label>
            </td>
            <td>
              <input
                class="email-box"
                type="text"
                id="femail"
                placeholder="email address"
              /><br />
            </td>
          </tr>
          <tr>
            <td><button class="reset-button">Reset Password</button><br /></td>
          </tr>
        </table>

        <a href="">Can't access email?</a>
      </form>
    </main>
    <footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section about">
                <h2>About BixbyBites</h2>
                <p>BixbyBites is your ultimate destination for delicious food and great dining experiences. Explore our menu, reserve a table, or order online today!</p>
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
