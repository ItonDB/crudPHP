<?php
    session_start();
    include('conn.php');
?>

<!DOCTYPE html>
<!-- Source Codes By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form in HTML and CSS | CodingNepal</title>
  <link rel="stylesheet" href="style_login.css" />
</head>
<body>
  <div class="login_form">
    <!-- Login form container -->
    <form action="login_db.php" method="post" enctype="multipart/form-data" >
    <?php include('errors.php'); ?>
    <?php if (isset($_SESSION['error'])) : ?>
              <div class="error" >
                <h3>
                  <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                  ?>
                </h3>
              </div>
            <?php endif ?>
      <h3>Log in with</h3>

      <div class="login_option">
        <!-- Google button -->
        <div class="option">
          <a href="#">
            <img src="logos/google.png" alt="Google" />
            <span>Google</span>
          </a>
        </div>

        <!-- Apple button -->
        <div class="option">
          <a href="#">
            <img src="logos/apple.png" alt="Apple" />
            <span>Apple</span>
          </a>
        </div>
      </div>

      <!-- Login option separator -->
      <p class="separator">
        <span>or</span>
      </p>
      <!-- Email input box -->
      <div class="input_box">
        <label for="email">Email</label>
        <input type="email" id="u_email" name="u_email" placeholder="Enter email address" required />
      </div>

      <!-- Paswwrod input box -->
      <div class="input_box">
        <div class="password_title">
          <label for="password">Password</label>
          <a href="#">Forgot Password?</a>
        </div>

        <input type="password" id="u_password" name="u_password" placeholder="Enter your password" required />
      </div>

       <!-- Login button -->
      <button type="submit" name="login" >Log In</button>

      <p class="sign_up">Don't have an account? <a href="register.php">Sign up</a></p>
    </form>
  </div>
</body>
</html>