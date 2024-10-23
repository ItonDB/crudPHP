<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบการส่งข้อมูลผ่าน POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password_1 = $_POST["password_1"];
    $password_2 = $_POST["password_2"];

    // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
    if ($password_1 !== $password_2) {
        echo "<script type='text/javascript'>";
        echo "alert('รหัสผ่านไม่ตรงกัน');";
        echo "window.location = 'register.php';";
        echo "</script>";
        exit();
    }

    // ตรวจสอบว่าชื่อผู้ใช้หรืออีเมลซ้ำหรือไม่
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['username'] === $username) {
            echo "<script type='text/javascript'>";
            echo "alert('ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว');";
            echo "window.location = 'register.php';";
            echo "</script>";
        } elseif ($row['email'] === $email) {
            echo "<script type='text/javascript'>";
            echo "alert('อีเมลนี้ถูกใช้ไปแล้ว');";
            echo "window.location = 'register.php';";
            echo "</script>";
        }
    } else {
        // บันทึกรหัสผ่าน
        $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password_1);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>";
            echo "alert('สมัครสำเร็จแล้ว');";
            echo "window.location = 'login.php';";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('เกิดข้อผิดพลาดในการสมัคร');";
            echo "window.location = 'register.php';";
            echo "</script>";
        }
    }
    $stmt->close();
}
$conn->close();
?>
