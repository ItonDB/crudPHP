<?php
    session_start();
    include('conn.php');
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration or Sign Up form in HTML CSS | CodingLab </title> 
    <link rel="stylesheet" href="register.css">
   </head>
<body>
  <div class="wrapper">
    <h2>Sign up</h2>
    <form action="register_db.php" method="post" enctype="multipart/form-data">
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
      <div class="input-box">
        <input type="text" id="u_name" name="u_name" placeholder="Enter your name" required>
      </div>
      <div class="input-box">
        <input type="text" id="u_email" name="u_email" placeholder="Enter your email" required>
      </div>
      <div class="input-box">
        <input type="password" id="u_password" name="u_password" placeholder="Create password" required>
      </div>
      <div class="input-box">
        <input type="password" id="u_password2" name="u_password2" placeholder="Confirm password" required>
      </div>
      <div class="input-box button">
        <input type="Submit" name="reg_user" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>