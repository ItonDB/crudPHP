<?php
    include('conn.php');
    $t_name = $_POST['t_name'];

    // สร้างตัวแปล และเก็บค่าลงใน database
    $sql = "INSERT INTO type(t_name) VALUES ('$t_name')";
    $query = mysqli_query($conn,$sql);

    if($query){
        echo "<script type = 'text/javascript'>";
        echo "alert('เพิ่มข้อมูลเรียบร้อย');";
        echo "window.location = '/php/php/type.php';";
        echo "</script>";
    }
    else{
        echo "<script type = 'text/javascript'>";
        echo "alert('เพิ่มข้อมูลไม่สำเร็จ');";
        echo "window.location = '/php/php/type.php';";
        echo "</script>";
    }
?>