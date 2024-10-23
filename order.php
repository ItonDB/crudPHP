<?php
session_start();
include('conn.php');

// ลบรายการเมื่อมีการกดปุ่มลบ
if (isset($_GET['s_id']) && isset($_GET['act']) && $_GET['act'] == 'remove') {
    $s_id = $_GET['s_id'];
    
    // ลบข้อมูลจากตาราง sale
    $sql_delete = "DELETE FROM sale WHERE s_id = '$s_id'";
    mysqli_query($conn, $sql_delete);
}

// ตรวจสอบว่ามีการส่งข้อมูลจาก product.php
if (isset($_GET['p_id']) && isset($_GET['act']) && $_GET['act'] == 'add') {
    $p_id = $_GET['p_id'];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT p_name, p_price FROM product WHERE p_id = $p_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $s_name = $row['p_name']; // ชื่อสินค้า
        $s_price = $row['p_price']; // ราคาสินค้า
        $s_quantity = 1; // จำนวนสินค้าเริ่มต้นเป็น 1
        $s_total = $s_price * $s_quantity; // คำนวณราคาสุทธิ

        // เพิ่มข้อมูลการสั่งซื้อในตาราง sale
        $sql_insert = "INSERT INTO `sale` (`p_id`, `s_name`, `s_price`, `s_total`, `s_quantity`) 
                       VALUES ('$p_id', '$s_name', '$s_price', '$s_total', '$s_quantity')";
        mysqli_query($conn, $sql_insert);
    }
}

// บันทึกรายการเมื่อมีการกดปุ่มชำระเงิน
if (isset($_POST['checkout'])) {
    // คุณอาจจะต้องเพิ่มฟิลด์ในฐานข้อมูลเพื่อลงข้อมูลการชำระเงิน เช่น order_id
    // ตัวอย่างการบันทึก
    $sql_insert_order = "INSERT INTO orders (total_amount) VALUES ('$totalPrice')";
    mysqli_query($conn, $sql_insert_order);

    // ลบรายการในตาราง sale หลังจากชำระเงิน
    $sql_delete_all = "DELETE FROM sale";
    mysqli_query($conn, $sql_delete_all);
}

// แสดงรายการสั่งซื้อ
$sql_sale = "SELECT * FROM sale";
$result_orders = mysqli_query($conn, $sql_sale);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ตะกร้าสินค้า</title>
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
        <a href="order.php"><span class="material-symbols-outlined"> notifications_active </span>Order</a>
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
        <h2>รายการสั่งซื้อ</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #4CAF50;">
                    <th style="padding: 10px; border: 1px solid #ddd;">รหัสสินค้า</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">ชื่อสินค้า</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">ราคา</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">จำนวน</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">รวม</th>
                    <th style="padding: 10px; border: 1px solid #ddd;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalPrice = 0;
                while ($order = mysqli_fetch_assoc($result_orders)) {
                    $subtotal = $order['s_price'] * $order['s_quantity'];
                    echo '<tr>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $order['p_id'] . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $order['s_name'] . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">฿' . number_format($order['s_price'], 2) . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $order['s_quantity'] . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">฿' . number_format($subtotal, 2) . '</td>';
                    echo '<td style="padding: 10px; border: 1px solid #ddd;">
                    <a href="order.php?s_id=' . $order['s_id'] . '&act=remove" class="btn btn-delete">ลบ</a></td>';
                    echo '</tr>';
                    $totalPrice += $subtotal;
                }
                ?>
            </tbody>
        </table><br>
        <h3>ราคารวมทั้งหมด: ฿<?php echo number_format($totalPrice, 2); ?></h3><br>
        
        <form method="post">
            <button type="submit" name="checkout" style="background-color: #4CAF50; color: white; padding: 10px; border-radius: 5px;">ชำระเงิน</button>
        </form>
    </div>

</body>
</html>

<?php
// ปิดการเชื่อมต่อ
mysqli_close($conn);
?>
