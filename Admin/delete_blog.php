<?php
include '../connection/connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM blog_news WHERE id='$id'";
mysqli_query($con, $sql);

header("Location: Admin-dashboard.php");


