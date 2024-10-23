<?php
session_start();
include('conn.php');
$total = 0;
$p_id = $_REQUEST['p_id']; 
$act = $_REQUEST['act'];
if($act=='add' && !empty($p_id))
{
  if(isset($_SESSION['order'][$p_id]))
  {
    $_SESSION['order'][$p_id]++;
  }
  else
  {
    $_SESSION['order'][$p_id]=1;
  }
}
if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
{
  unset($_SESSION['order'][$p_id]);
}
if($act=='update')
{
  $amount_array = $_POST['amount'];
  foreach($amount_array as $p_id=>$amount)
  {
    $_SESSION['order'][$p_id]=$amount;
  }
}
// บันทึกรายการเมื่อมีการกดปุ่มชำระเงิน
if (isset($_POST['checkout'])) {
  include('conn.php');

  foreach ($_SESSION['order'] as $p_id => $qty) {
      // ดึงข้อมูลสินค้าจากฐานข้อมูล
      $sql = "SELECT * FROM product WHERE p_id = $p_id";
      $query = mysqli_query($conn, $sql);
      $product = mysqli_fetch_array($query);

      $p_name = $product['p_name'];
      $p_price = $product['p_price'];
      $total_price = $p_price * $qty;

      // บันทึกข้อมูลลงในตาราง `report`
      $sql_insert_order = "INSERT INTO report (p_id, r_name, r_price, r_total, r_quantity) 
                           VALUES ('$p_id', '$p_name', '$p_price', '$total_price', '$qty')";
      mysqli_query($conn, $sql_insert_order);
  }

  // ล้างตะกร้าหลังชำระเงินเสร็จ
  unset($_SESSION['order']);

  echo "<script type='text/javascript'>";
  echo "alert('สั่งซื้อเรียบร้อย');";
  echo "window.location = 'product.php';";
  echo "</script>";
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

  <form method="post">
  <div class="container">
        <h2>รายการสั่งซื้อ</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #4CAF50;">
                    <th style="padding: 10px; border: 1px solid #ddd;">รหัสสินค้า</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">ชื่อสินค้า</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">ราคา</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">จำนวน</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">วันที่</th>
                    <th style="padding: 10px; border: 1px solid #ddd;"></th>
                </tr>
            </thead>
            <tbody>
  <?php
$total=0;
if(!empty($_SESSION['order']))
{
	include('conn.php');
	foreach($_SESSION['order'] as $p_id=>$qty)
	{
		$sql = "SELECT * FROM product where p_id=$p_id";
		$query = mysqli_query($conn, $sql);
		$order = mysqli_fetch_array($query);
		$sum = $order['p_price'] * $qty;
		$total += $sum;    
    echo '<tr>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $order['p_id'] . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $order['p_name'] . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">฿' . number_format($order['p_price'], 2) . '</td>';
    echo "<td style='padding: 10px; border: 1px solid #ddd;'><input type='number' name='amount[$p_id]' value='$qty' min='1' size='2'/></td>";
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . $order['p_date'] . '</td>';
    
    // ปุ่มลบ
    echo "<td><a href='order.php?p_id=" . $order["p_id"] . "&act=remove' class='btn btn-delete'>ลบ</a></td>";
	}
	echo "<tr>";
  	echo "<td bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>";
  	echo "<td bgcolor='#CEE7FF'>"."<b>".number_format($total,2)."</b>"."</td>";
  	echo "<td  bgcolor='#CEE7FF'></td>";
	echo "</tr>";
}
  ?>
            </tbody>
        </table>
        

            <button type="submit" name="checkout" style="background-color: #4CAF50; color: white; padding: 10px; border-radius: 5px;">ชำระเงิน</button>
            <input type="submit"  style="background-color: #4CAF50; color: white; padding: 10px; border-radius: 5px;" name="button" id="button" value="ปรับปรุง" />
    </div>
    </form>
</body>
</html>

<?php
// ปิดการเชื่อมต่อ
mysqli_close($conn);
?>
