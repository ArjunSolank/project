<?php
session_start();

// Check if the admin is logged in
if (isset($_SESSION['admin_logged_in'])) {
    // Unset only admin session variables
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_email']);
    // Redirect to the login page
    header("Location: ../login.php");
    exit;
} else {
    // If not logged in, redirect to the login page
    header("Location: ../login.php");
    exit;
}
?>