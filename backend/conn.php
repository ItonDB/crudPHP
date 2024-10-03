<?php
// ตั้งตัวแปลเพื่อเชื่อมต่อ database
$conn = mysqli_connect("localhost","root","","pos_byphpdb") or die ("Error Connect Database" . mysqli_connect_error($conn));
mysqli_query($conn,"SET NAMES 'utf8' ")
?>