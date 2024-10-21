<?php
  session_start();

  if(!isset($_SESSION['u_id'])){
    $_SESSION["msg"] = "you must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['u_id']);
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home page</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <aside class="sidebar">
    <div class="sidebar-header">
      <img src="images/logo.png" alt="logo" />
    </div>
    <ul class="sidebar-links">
      <h4>
        <span>Main Menu</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="#">
          <span class="material-symbols-outlined"> dashboard </span>Dashboard</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined"> overview </span>Overview</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined"> monitoring </span>Analytic</a>
      </li>
      <h4>
        <span>General</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="#"><span class="material-symbols-outlined"> folder </span>Projects</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined"> groups </span>Groups</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined"> move_up </span>Transfer</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined"> flag </span>All Reports</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined">
            notifications_active </span>Notifications</a>
      </li>
      <h4>
        <span>Account</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="#"><span class="material-symbols-outlined"> account_circle </span>Profile</a>
      </li>
      <li>
        <a href="index.php?logout='1'"><span class="material-symbols-outlined"> logout </span>Logout</a>
      </li>
    </ul>
    <div class="user-account">
      <div class="user-profile">
        <div class="user-detail">
          <?php if(isset($_SESSION['u_id'])) : ?>
          <?php echo $_SESSION['u_name'];?>
          <?php echo $_SESSION['u_email'];?>
          <?php endif ?>
        </div>
      </div>
    </div>
  </aside>

            <?php if (isset($_SESSION['success'])) : ?>
              <div class="success" >
                <h3>
                  <?php
                    echo $_SESSION['sucess'];
                    unset($_SESSION['success'])
                  ?>
                </h3>
              </div>
            <?php endif ?>


</body>
</html>