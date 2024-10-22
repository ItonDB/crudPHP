<?php 
include('conn.php');

if (isset($_GET['id'])) {
    $p_id = $_GET['id'];
    // ใช้ prepared statements เพื่อป้องกัน SQL injection
    $query = "DELETE FROM product WHERE p_id = '$p_id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ลบสำเร็จ');";
        echo "window.location = 'edit.php';";
        echo "</script>";
        exit();
    }
} else {
    echo "No ID specified for deletion.";
}
?>
