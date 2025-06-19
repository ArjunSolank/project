<?php
session_start();
include 'connection/connection.php';

if (isset($_POST['User_email']) && isset($_POST['User_password'])) {
    $email = $_POST['User_email'];
    $password = $_POST['User_password'];

    $admin_query = "SELECT * FROM admin WHERE Admin_email = ? AND Admin_password = ?";
    $stmt_admin = $con->prepare($admin_query);
    $stmt_admin->bind_param("ss", $email, $password);
    $stmt_admin->execute();
    $admin_result = $stmt_admin->get_result();

    if ($admin_result->num_rows == 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: Admin/Admin-dashboard.php");
        exit();
    } else {
        $user_query = "SELECT User_id, First_name, Last_name, User_email, User_DOB, User_Gender, User_phone FROM user WHERE User_email = ? AND User_password = ?";
        $stmt_user = $con->prepare($user_query);
        $stmt_user->bind_param("ss", $email, $password);
        $stmt_user->execute();
        $user_result = $stmt_user->get_result();

        if ($user_result->num_rows == 1) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_email'] = $email;
            echo "<script>alert('Login successful');</script>";
            header("Location: newzealand.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password";
            header("Location: login.php");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>