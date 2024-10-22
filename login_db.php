<?php
session_start();

//connect database
$servername = "localhost";
$username ="root";
$password = "";
$dbname = "register_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// ตรวจสอบเชื่อมต่อ
if(!$conn){
	die("Connection failed: ".mysqli_connect_error());
}
//ตรวจสอบการส่งข้อมูลผ่านแบบ POST
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$username = $_POST["username"];
	$password_1 = $_POST["password_1"];
	
	// เตรียมคำสั่ง sql เพื่อตรวจสอบข้อมูล
	$sql = "SELECT * FROM user WHERE username ='$username' AND password = '$password_1'";
	$result = mysqli_query($conn, $sql);
	
	//ตรวจสอบผลลัพธ์
	if (mysqli_num_rows($result) == 1){
		$_SESSION['username'] = $username;
		echo "<script type = 'text/javascript'>";
		echo "alert('เข้าสู่ระบบเรียบร้อย');";
		echo "window.location = 'index.php';";
		echo "</script>";
	}else{
		echo "<script type = 'text/javascript'>";
		echo "alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');";
		echo "window.location = 'login.php';";
		echo "</script>";
	}
}
?>