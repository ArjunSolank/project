<?php
include '../connection/connection.php'; 

$User_phone = isset($_GET['User_phone']) ? trim($_GET['User_phone']) : null;

if ($User_phone) {
    $sql = "DELETE FROM rating_reviews WHERE User_phone = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $User_phone);

    if ($stmt->execute()) {
        echo "<script>alert('Review deleted successfully.'); window.location.href='view_feedback.php';</script>";
    } else {
        echo "<script>alert('Error deleting review. Please try again later.'); window.history.back();</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}

$con->close();
?> 