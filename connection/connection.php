<?php
    $con = mysqli_connect("localhost","root","","soc_project");
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>