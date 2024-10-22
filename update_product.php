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

// ตรวจสอบว่ามีข้อมูลที่ส่งมา
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['p_id'])) {
    $p_id = $_POST['p_id'];
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];

    // สร้างคำสั่ง SQL เพื่อลบข้อมูล
    $sql = "UPDATE products SET p_name = ?, p_price = ? WHERE p_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $p_name, $p_price, $p_id); // ใช้ 'ssi' เนื่องจากมีประเภทข้อมูล string และ integer

    // ตรวจสอบผลลัพธ์
    if ($stmt->execute()) {
        echo "แก้ไขสินค้าสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
}
$conn->close();

// เปลี่ยนเส้นทางกลับไปที่หน้าสินค้า
header("Location: product.php"); 
exit();
?>
