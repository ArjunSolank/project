<?php
include '../connection/connection.php'; 

$sql = "SELECT r.User_phone, r.selected_review, r.star_rating, r.comments, r.created_at, u.first_name, u.last_name 
        FROM rating_reviews r 
        JOIN user u ON r.User_phone = u.User_phone 
        ORDER BY r.created_at DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Reviews</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; 
            text-align: center; 
        }
        .container { 
            width: 50%; 
            margin: auto; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); 
            margin-top: 50px;
        }
        h2 {
            color: #007BFF;
        }
        .feedback { 
            border-bottom: 1px solid #ddd; 
            padding: 15px; 
            text-align: left;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .feedback:hover {
            background: #f9f9f9;
        }
        .stars { 
            color: gold; 
            font-size: 22px; 
        }
        .date {
            font-size: 12px;
            color: gray;
        }
        .email {
            font-size: 14px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>User Feedback</h2>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='feedback'>";
                echo "<div class='email'>📞 " . htmlspecialchars($row['User_phone']) . "</div>"; // Display User_phone
                echo "<strong>Review by: " . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</strong><br>";
                echo "<strong>Review: " . htmlspecialchars($row['selected_review']) . "</strong><br>";
                echo "<div class='stars'>" . str_repeat("★", $row['star_rating']) . "</div>";
                echo "<p>Comments: " . htmlspecialchars($row['comments']) . "</p>";
                echo "<div class='date'>🕒 Submitted on: " . $row['created_at'] . "</div>";
                echo "<a href='delete_feedback.php?User_phone=" . urlencode($row['User_phone']) . "' class='delete-button'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No feedback yet!</p>";
        }
        $con->close();
        ?>
    </div>

</body>
</html>
