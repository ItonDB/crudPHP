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

    // สร้างคำสั่ง SQL เพื่อลบข้อมูล
    $sql = "DELETE FROM product WHERE p_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $p_id); // ใช้ 'i' เนื่องจากเป็น integer

    // ตรวจสอบผลลัพธ์
    if ($stmt->execute()) {
        echo "ลบสินค้าสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
}
$conn->close();

// เปลี่ยนเส้นทางกลับไปที่หน้าสินค้า
header("Location: product.php"); // เปลี่ยนให้เป็น URL ของหน้าสินค้าของคุณ
exit();
?>