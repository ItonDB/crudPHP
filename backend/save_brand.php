<?php
    include('conn.php');
    $b_name = $_POST['b_name'];

    $sql = "INSERT INTO brand(b_name) VALUES ('$b_name')";
    $query = mysqli_query($conn,$sql); 

    if ($query) {
        echo "<script type='text/javascript'>"; 
        echo "alert('บันทึกข้อมูลสำเร็จ');";
        echo "window.location = '/php/php/brand.php';"; 
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>"; 
        echo "alert('บันทึกข้อมูลไม่สำเร็จ');"; 
        echo "window.location = '/php/php/brand.php';"; 
        echo "</script>";
    }
?>

