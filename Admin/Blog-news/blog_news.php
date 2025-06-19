<?php
include '../../connection/connection.php';

$sql = 'SELECT content, image, url FROM blog_news';
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo '<table><tr><th>content</th><th>image</th><th>url</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row['content'] . '</td><td><img src=""' . $row['image'] . '" alt="Image" style="width:100px;height:auto;"></td><td>' . $row['url'] . '</td></tr>';
    }
    echo '</table>';
} else {
    echo '0 results';
}

// Close connection
$con->close();
?>
