
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
      <div class="input-box">
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="input-box">
        <input type="text" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="input-box">
        <input type="password" id="password_1" name="password_1" placeholder="Create password" required>
      </div>
      <div class="input-box">
        <input type="password" id="password_2" name="password_2" placeholder="Confirm password" required>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>