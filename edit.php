<?php
session_start();
// ตรวจสอบว่ามีการเข้าสู่ระบบ
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('conn.php');

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$show = "SELECT * FROM product";
$query = mysqli_query($conn, $show);

if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="style.css" />
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
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php while($result_product = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                <tr>
                    <td><?php echo $result_product['p_id']; ?></td>
                    <td><?php echo $result_product['p_name']; ?></td>
                    <td><?php echo $result_product['p_price']; ?></td>
                    <td>
                        <a href="update_product.php?id=<?php echo $result_product['p_id']; ?>" class="btn btn-success">แก้ไข</a>
                        <a href="delete_product.php?id=<?php echo $result_product['p_id']; ?>" class="btn btn-delete">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
  </div>
            
</body>
</html>
