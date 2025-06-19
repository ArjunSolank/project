<?php

include '../connection/connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = mysqli_real_escape_string($con, $_POST['blogContent']);
    $url = mysqli_real_escape_string($con, $_POST['blogUrl']);
    $title=mysqli_real_escape_string($con, $_POST['blogTitle']);

    // Handle image upload
    $target_dir = "Blog-news/uploads/";
    $target_file = $target_dir . basename($_FILES["blogImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["blogImage"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["blogImage"]["tmp_name"], $target_file)) {
            // Insert into database
            $sql = "INSERT INTO blog_news (content,image,url,title) VALUES ('$content', '$target_file', '$url','$title')";
            if (mysqli_query($con, $sql)) {
                header("Location: Admin-dashboard.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>