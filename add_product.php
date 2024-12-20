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
  <title>Add page</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="from.css"/>
  <link rel="stylesheet" href="table.css" />
</head>
<body>
  <aside class="sidebar">
    <div class="sidebar-header">
      <img src="picture/blockchain.png" alt="logo" />
    </div>
    <ul class="sidebar-links">
      <h4>
        <span>DATA</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="index.php">
          <span class="material-symbols-outlined"> dashboard </span>Dashboard</a>
      </li>
      <h4>
        <span>MENU</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="product.php"><span class="material-symbols-outlined"> folder </span>Product</a>
      </li>
      <li>
        <a href="edit.php"><span class="material-symbols-outlined"> groups </span>Edit</a>
      </li>
      <li>
        <a href="add_product.php"><span class="material-symbols-outlined"> move_up </span>Add</a>
      </li>
      <li>
      <li>
        <a href="report.php"><span class="material-symbols-outlined">
            List </span>Report</a>
      </li>
      <h4>
        <span>Account</span>
        <div class="menu-separator"></div>
      </h4>
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
        <input type="text" id="p_name" name="p_name" placeholder="กรอกชื่อสินค้า" required>
      </div>

      <div class="form-group">
        <label for="email">ราคา</label>
        <input type="text" id="p_price" name="p_price" placeholder="กรอกราคา" required>
      </div>

      <div class="form-group">
        <label for="email">จำนวน</label>
        <input type="text" id="p_quantity" name="p_quantity" placeholder="กรอกจำนวน" required>
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