<?php
session_start();
// ตรวจสอบว่ามีการเข้าสู่ระบบ
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
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
  <link rel="stylesheet" href="from.css"/>
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
        <a href="index.php">
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
        <a href="product.php"><span class="material-symbols-outlined"> folder </span>Product</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined"> groups </span>Groups</a>
      </li>
      <li>
        <a href="add_product.php"><span class="material-symbols-outlined"> move_up </span>Add Product</a>
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
        <a href="logout.php"><span class="material-symbols-outlined"> logout </span>Logout</a>
      </li>
    </ul>
    <div class="user-account">
      <div class="user-profile">
        <div class="user-detail">
        <?php if (isset($_SESSION['username'])) : ?>
            <p><strong><?php echo $_SESSION['username']; ?></strong></p>
        <?php endif ?>
        </div>
      </div>
    </div>
  </aside>

  <div class="form-container">
    <h2>บันทึกสินค้า</h2>
    <form action="save_product.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">ชื่อสินค้า</label>
        <input type="text" id="p_name" name="p_name" placeholder="กรอกชื่อของคุณ" required>
      </div>

      <div class="form-group">
        <label for="email">ราคา</label>
        <input type="text" id="p_price" name="p_price" placeholder="กรอกอีเมลของคุณ" required>
      </div>

      <div class="form-group">
        <label for="profileImage">เพิ่มรูปภาพ</label>
        <input type="file" id="p_pic" name="p_pic" accept="image/*" required>
      </div>

      <div class="form-group">
        <button type="submit">บันทึก</button>
      </div>
    </form>
</body>
</html>