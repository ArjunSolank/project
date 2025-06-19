<?php
include '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title= mysqli_real_escape_string($con, $_POST['blogTitle']);
    $content = mysqli_real_escape_string($con, $_POST['blogContent']);
    $url = mysqli_real_escape_string($con, $_POST['blogUrl']);
    $image = $_FILES['blogImage']['name'] ? "uploads/" . basename($_FILES['blogImage']['name']) : $_POST['existingImage'];

    if ($_FILES['blogImage']['name']) {
        move_uploaded_file($_FILES['blogImage']['tmp_name'], $image);
    }

    $sql = "UPDATE blog_news SET title='$title' ,content='$content', image='$image', url='$url' WHERE id='$id'";
    mysqli_query($con, $sql);
    header("Location: Admin-dashboard.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM blog_news WHERE id='$id'";
$result = mysqli_query($con, $sql);
$post = mysqli_fetch_assoc($result);
?>

<form action="edit_blog.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <div class="form-group">
        <label for="blogTitle">Blog Title:</label>
        <textarea id="blogTitle" name="blogTitle" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="blogContent">Blog Content:</label>
        <textarea id="blogContent" name="blogContent" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="blogImage">Blog Image:</label>
        <input type="file" id="blogImage" name="blogImage" accept="image/*">
        <input type="hidden" name="existingImage" value="<?php echo htmlspecialchars($post['image']); ?>">
    </div>
    <div class="form-group">
        <label for="blogUrl">Blog URL:</label>
        <input type="url" id="blogUrl" name="blogUrl" value="<?php echo htmlspecialchars($post['url']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>