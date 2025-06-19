<?php
include '../connection/connection.php';
$id = $_GET['delete_id'];
$sql = "DELETE FROM eligibility_check WHERE ECF_id='$id'";
mysqli_query($con, $sql);
header("Location: Admin-dashboard.php");
$con->close();
?>