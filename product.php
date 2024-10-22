<?php
session_start();
// ตรวจสอบว่ามีการเข้าสู่ระบบ
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "register_db";

    // Create Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    } 

// ดึงข้อมูลสินค้า
$sql = "SELECT p_id, p_name, p_price, p_pic FROM product";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="view.css" />
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
      <li>
        <a href="#"><span class="material-symbols-outlined"> overview </span>Overview</a>
      </li>
      <li>
        <a href="#"><span class="material-symbols-outlined"> monitoring </span>Analytic</a>
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

  <div class="product-list">
    <?php
    if ($result->num_rows > 0) {
        // แสดงรายการสินค้าทีละรายการ
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-item">';
            echo '<img src="img/' . $row["p_pic"] . '" alt="' . $row["p_name"] . '">';
            echo '<h2>' . $row["p_name"] . '</h2>';
            echo '<p>ราคา: ฿' . number_format($row["p_price"], 2) . '</p>';
            echo '<div class="button-group">'; // กลุ่มปุ่ม
            echo '<button class="select-button">สั่ง</button>'; // ปุ่มเลือก
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>ไม่มีสินค้าที่จะแสดง</p>";
    }
    $conn->close(); // ปิดการเชื่อมต่อ
    ?>
</div>




</body>
</html>