<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_logged_in'])) {
    // Unset only user session variables
    unset($_SESSION['user_logged_in']);
    unset($_SESSION['user_email']);
}

// Redirect to the login page
header("Location: login.php");
exit();
?> 