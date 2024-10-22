<?php
session_start();
session_unset();//ล้าง session
session_destroy();//ทำลาย session
header("Location: login.php");
?>