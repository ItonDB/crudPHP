<?php
session_start();
include('conn.php');

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือยัง
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ดึงข้อมูลยอดขาย
$sql_total_sales = "SELECT SUM(r_total) AS total_sales FROM report";
$result_sales = mysqli_query($conn, $sql_total_sales);
$total_sales = mysqli_fetch_assoc($result_sales)['total_sales'];

//ดึงข้อมูลรายการสั่งซื้อทั้งหมด
$sql_total_orders = "SELECT COUNT(*) AS total_orders FROM report";
$result_orders = mysqli_query($conn, $sql_total_orders);
$total_orders = mysqli_fetch_assoc($result_orders)['total_orders'];
//ดึงข้อมูลผู้ใช้ทั้งหมด
$sql_total_user = "SELECT COUNT(*) AS total_user FROM user";
$result_user = mysqli_query($conn, $sql_total_user);
$total_user = mysqli_fetch_assoc($result_user)['total_user'];

//ดึงข้อมูลสินค้าขายดี
$sql_top_product = "SELECT r_name, SUM(r_quantity) AS quantity 
                    FROM report 
                    GROUP BY r_name 
                    ORDER BY quantity DESC 
                    LIMIT 1";
$result_top_product = mysqli_query($conn, $sql_top_product);
$top_product = mysqli_fetch_assoc($result_top_product);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="table.css" />
    <style>
        .card {
            display: inline-block;
            width: 40%;
            margin: 10px;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 8px;
        }
    </style>
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
        <?php endif; ?>
        </div>
      </div>
    </div>
  </aside>

<div class="container">
    <h1>Dashboard</h1>

    <div class="card">
        <h3>ยอดขายรวม</h3>
        <p><?php echo number_format($total_sales, 2); ?> บาท</p>
    </div>

    <div class="card">
        <h3>จำนวนคำสั่งซื้อ</h3>
        <p><?php echo $total_orders; ?> รายการ</p>
    </div>

    <div class="card">
        <h3>สินค้าขายดี</h3>
        <p><?php echo $top_product['r_name']; ?> (<?php echo $top_product['quantity']; ?> รายการ)</p>
    </div>
    <div class="card">
        <h3>จำนวนบัญชีผู้ใช้</h3>
        <p><?php echo $total_user; ?>บัญชี</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>ราคารวม</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_report = "SELECT p_id, r_name, r_quantity, r_total FROM report";
            $result_report = mysqli_query($conn, $sql_report);
            while ($row = mysqli_fetch_assoc($result_report)) {
                echo "<tr>";
                echo "<td>{$row['p_id']}</td>";
                echo "<td>{$row['r_name']}</td>";
                echo "<td>{$row['r_quantity']}</td>";
                echo "<td>" . number_format($row['r_total'], 2) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
