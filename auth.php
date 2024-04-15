<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="style.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
    function validateLoginForm() {
      var email = document.forms["loginForm"]["email"].value;
      var password = document.forms["loginForm"]["password"].value;
      if (email == "") {
        alert("Please enter your email.");
        return false;
      }
      if (password == "") {
        alert("Please enter your password.");
        return false;
      }
      return true;
    }

    function validateSignupForm() {
      var name = document.forms["signupForm"]["name"].value;
      var email = document.forms["signupForm"]["email"].value;
      var password = document.forms["signupForm"]["password"].value;
      var userType = document.forms["signupForm"]["user-type"].value;
      if (name == "") {
        alert("Please enter your name.");
        return false;
      }
      if (email == "") {
        alert("Please enter your email.");
        return false;
      }
      if (password == "") {
        alert("Please enter your password.");
        return false;
      }
      if (userType == "") {
        alert("Please select your user type.");
        return false;
      }

      // Vérifier si le nom a une longueur minimale
      if (name.length < 6) {
        alert("Name must be at least 6 characters long.");
        return false;
      }

      // Vérifier si l'email est vide
      if (email == "") {
        alert("Please enter your email.");
        return false;
      }

      // Vérifier si l'email est au bon format
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
      }
      if (password == "") {
        alert("Please enter your password.");
        return false;
      }

      // Vérifier si le mot de passe contient au moins une lettre, un caractère spécial et un chiffre
      var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert("Password must contain at least one letter, one special character, one digit, and be at least 8 characters long.");
        return false;
      }
      return true;
    }
    function validateLoginForm() {
      var email = document.forms["loginForm"]["email"].value;
      var password = document.forms["loginForm"]["password"].value;

      // Vérifier si l'email est vide
      if (email == "") {
        alert("Please enter your email.");
        return false;
      }

      // Vérifier si l'email est au bon format
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
      }
      if (password == "") {
        alert("Please enter your password.");
        return false;
      }

      // Vérifier si le mot de passe contient au moins une lettre, un caractère spécial et un chiffre
      var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert("Password must contain at least one letter, one special character, one digit, and be at least 8 characters long.");
        return false;
      }

      // Si toutes les conditions sont remplies, retourner true
      return true;
    }

  </script>
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="images/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
          <!-- Ajout d'un événement onsubmit pour appeler la fonction de validation -->
          <?php if (isset($_SESSION['message'])): ?>
            <div class="message-box"
              style="padding: 10px; margin-bottom: 10px; <?php echo ($_SESSION['message_type'] === 'error') ? 'background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;' : 'background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;'; ?> border-radius: 5px;">
              <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
          <?php endif; ?>


          <form name="loginForm" action="login.php" method="post" onsubmit="return validateLoginForm()">
            <div class="input-box">
              <i class="fas fa-envelope"></i>
              <input type="text" name="email" placeholder="Enter your email">
            </div>
            <div class="input-box">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Enter your password">
            </div>
            <div class="text"><a href="#">Forgot password?</a></div>
            <div class="button input-box">
              <input type="submit" name="submit" value="Submit">
            </div>
            <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
          </form>
        </div>
        <div class="signup-form">
          <div class="title">Signup</div>
          <!-- Ajout d'un événement onsubmit pour appeler la fonction de validation -->
          <form name="signupForm" action="signup.php" method="post" onsubmit="return validateSignupForm()">
            <div class="input-box">
              <i class="fas fa-user"></i>
              <input type="text" name="name" placeholder="Enter your name">
            </div>
            <div class="input-box">
              <i class="fas fa-envelope"></i>
              <input type="text" name="email" placeholder="Enter your email">
            </div>
            <div class="input-box">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Enter your password">
            </div>
            <div class="input-box">
              <i class="fas fa-user-tie"></i>
              <select name="user-type">
                <option value="" disabled selected>Select User Type</option>
                <option value="client">Client</option>
                <option value="vendeur">Vendeur</option>
              </select>
            </div>
            <div class="button input-box">
              <input type="submit" name="signup-submit" value="Submit">
            </div>
            <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
          </form>
        </div>
      </div>
    </div>
</body>

</html>