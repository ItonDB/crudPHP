<?php 
    session_start();
    include('conn.php');
    
    $errors = array();

    if (isset($_POST['reg_user'])) {
        $u_email = mysqli_real_escape_string($conn, $_POST['u_email']);
        $u_namw = mysqli_real_escape_string($conn, $_POST['u_name']);
        $u_password = mysqli_real_escape_string($conn, $_POST['u_password']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

        if (empty($u_name)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required";
        }
        if (empty($u_mail)) {
            array_push($errors, "Email is required");
            $_SESSION['error'] = "Email is required";
        }
        if (empty($u_password)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        }
        if ($password != $password2) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = "The two passwords do not match";
        }

        $user_check_query = "SELECT * FROM users_db WHERE u_email = '$u_email'LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // if user exists
            if ($result['u_email'] === $u_email) {
                array_push($errors, "Username already exists");
            }
        }

        if (count($errors) == 0) {
            $u_password = md5($u_password_1);

            $sql = "INSERT INTO users_db (u_email, u_name, u_password) VALUES ('$u_email', '$u_name', '$u_password')";
            mysqli_query($conn, $sql);

            $_SESSION['u_email'] = $u_email;
            $_SESSION['success'] = "You are now logged in";
            header('location: login.php');
        } else {
            header("location: register.php");
        }
    }

?>