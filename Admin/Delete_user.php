<?php
include '../connection/connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM user WHERE User_id='$id'";
mysqli_query($con, $sql);


header("Location: Admin-dashboard.php");
