<?php
	//เรียกไฟล์เพื่อเชื่อมต่อ Database
	include('conn.php');
	//ประกาศตัวแปรเพื่อรับค่าจากช่องกรอก
	$p_name = $_POST['p_name'];
	$p_price = $_POST['p_price'];
	$p_quantity = $_POST['p_quantity'];

	$fileupload = $_FILES['p_pic']['tmp_name'];
	$fileupload_name = $_FILES['p_pic']['name'];
	$fileupload_size = $_FILES['p_pic']['size'];
	$fileupload_type = $_FILES['p_pic']['type'];


	//ประกาศตัวแปรเพื่อเอาค่าลง Database
	$sql = "INSERT INTO product (p_name,p_price,p_quantity) VALUES
	('$p_name','$p_price','$p_quantity')";
	

	$query = mysqli_query($conn,$sql);
	

	if($fileupload){
		$array_last = explode(".",$fileupload_name);
		$c = count($array_last) -1;
		$lastname = strtolower($array_last[$c]);
		
	if($lastname == "png" or $lastname == "jpeg" or $lastname  == "jpg"){
		$sql2 = "SELECT max(p_id) FROM product";	
		$result2 = mysqli_query($conn,$sql2);
		$row = mysqli_fetch_row($result2);
		$photoname = $row[0].".".$lastname;
		copy($fileupload,"img/".$photoname);
		$sql3 = "UPDATE product SET p_pic = '$photoname' WHERE p_id = '$row[0]' 
		";
		$result3 = mysqli_query($conn, $sql3);
		}
		unlink($fileupload);
	}
		
		
		//ตรวจสอบว่าข้อมูลลง Database หรือไม่
		if($query){
		echo "<script type = 'text/javascript'>";
		echo "alert('บันทึกสินค้าเรียบร้อย');";
		echo "window.location = 'add_product.php'; ";
		echo "</script>";
	}

	else{
		echo "<script type = 'text/javascript'>";
		echo "alert('ไม่สามารถบันทึกสินค้าได้ กรุณาตรวจสอบ');";
		echo "window.location = 'add_product.php'; ";
		echo "</script>";
	}
	
?>