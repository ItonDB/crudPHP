<?php 
    session_start();
    include('conn.php');

    $errors = array();

    if (isset($_POST['login'])) {
        $u_email = mysqli_real_escape_string($conn, $_POST['u_email']);
        $u_password = mysqli_real_escape_string($conn, $_POST['u_password']);

        if (empty($u_email)) {
            array_push($errors, "Username is required");
        }

        if (empty($u_password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $u_password = md5($u_password);
            $query = "SELECT * FROM users_db WHERE u_email = '$u_email' AND u_password = '$u_password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['u_email'] = $u_email;
                $_SESSION['success'] = "Your are now logged in";
                header("location: index.php");
                exit();
            } else {
                array_push($errors, "Wrong Username or Password");
                $_SESSION['error'] = "Wrong Username or Password!";
                header("location: login.php");
                exit();
            }
        } else {
            array_push($errors, "Username & Password is required");
            $_SESSION['error'] = "Username & Password is required";
            header("location: login.php");
            exit();
        }
    }
    

?>