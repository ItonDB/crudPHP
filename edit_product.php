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

// ตรวจสอบว่ามีการส่ง ID ของสินค้ามาหรือไม่
if (isset($_GET['p_id'])) {
    $product_id = $_GET['p_id'];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM product WHERE p_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // แสดงฟอร์มแก้ไขข้อมูลสินค้า
        ?>
        <h2>แก้ไขสินค้า</h2>
        <form action="update_product.php" method="POST">
            <input type="hidden" name="p_id" value="<?php echo $row['p_id']; ?>">
            <label for="p_name">ชื่อสินค้า:</label>
            <input type="text" name="p_name" value="<?php echo $row['p_name']; ?>" required>
            <br>
            <label for="p_price">ราคา:</label>
            <input type="number" name="p_price" value="<?php echo $row['p_price']; ?>" required>
            <br>
            <label for="p_pic">รูปภาพ:</label>
            <img src="img/<?php echo $row['p_pic']; ?>" alt="<?php echo $row['p_name']; ?>" style="width:100px;">
            <p>ไม่สามารถเปลี่ยนรูปภาพได้</p>
            <br>
            <button type="submit">บันทึกการเปลี่ยนแปลง</button>
        </form>
        <?php
    } else {
        echo "ไม่พบสินค้าที่ระบุ";
    }

    $stmt->close();
}
$conn->close();
?>
