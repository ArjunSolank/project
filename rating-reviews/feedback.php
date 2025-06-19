<?php
session_start(); // Start session at the beginning
include '../connection/connection.php'; // Database connection

// Check if user is logged in
if(!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "<script>
        alert('Please login first to share your valuable feedback with us.');
        window.location.href = '../login.php';
    </script>";
    exit;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely
    $User_phone = isset($_POST['User_phone']) ? trim($_POST['User_phone']) : null;
    $rating = isset($_POST['rating']) ? trim($_POST['rating']) : null;
    $star_rating = isset($_POST['star_rating']) ? (int)$_POST['star_rating'] : 0;
    $comments = isset($_POST['comments']) ? trim($_POST['comments']) : null;

    // Validate required fields
    if (empty($User_phone) || empty($rating) || empty($comments)) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit;
    }

    // Validate Mobile Number (Only numbers, 10-digit length)
    if (!preg_match("/^[6-9][0-9]{9}$/", $User_phone)) {
        echo "<script>alert('Invalid mobile number. Please enter a valid 10-digit mobile number.'); window.history.back();</script>";
        exit;
    }

    // Check if User_phone exists in the user table
    $sql_check = "SELECT COUNT(*) FROM user WHERE User_phone = ?";
    $stmt_check = $con->prepare($sql_check);

    if (!$stmt_check) {
        die("Prepare failed: " . $con->error);
    }

    $stmt_check->bind_param("s", $User_phone);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close(); // Close statement before next query

    if ($count == 0) {
        echo "<script>alert('User phone number not found. Please register first.'); window.history.back();</script>";
        exit;
    }

    // Prepare and bind SQL query
    $sql = "INSERT INTO rating_reviews (User_phone, selected_review, star_rating, comments) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("ssds", $User_phone, $rating, $star_rating, $comments);

    // Execute and check result
    if ($stmt->execute()) {
        echo "<script>
            alert('Thank you for your valuable feedback! Your insights help us improve our services and provide better experiences for all our students. We truly appreciate you taking the time to share your thoughts with us.');
            window.location.href='../newzealand.php';
        </script>";
        exit;
    } else {
        echo "<script>alert('Error submitting feedback. Please try again later.'); window.history.back();</script>";
        exit;
    }

    // Close resources
    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Feedback - SOC Overseas</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e8b57; /* Sea Green */
            --secondary-color: #3cb371; /* Medium Sea Green */
            --accent-color: #f0fff0; /* Honeydew */
            --text-color: #333;
            --light-green: #e8f5e9;
            --dark-green: #1b5e20;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-green);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-bottom: 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .page-header p {
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .container {
            width: 90%;
            max-width: 500px;
            margin: 0 auto 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        
        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }
        
        label {
            font-weight: 500;
            display: block;
            margin-top: 15px;
            color: var(--text-color);
            margin-bottom: 5px;
        }
        
        textarea, select, input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: border 0.3s;
        }
        
        textarea:focus, select:focus, input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(46, 139, 87, 0.2);
        }
        
        .stars {
            display: flex;
            justify-content: center;
            font-size: 35px;
            cursor: pointer;
            margin: 15px 0;
        }
        
        .stars input {
            display: none;
        }
        
        .stars label {
            color: #ddd;
            transition: color 0.3s;
            margin: 0 2px;
        }
        
        .stars input:checked ~ label,
        .stars label:hover,
        .stars label:hover ~ label {
            color: #ffd700; /* Gold */
        }
        
        button {
            margin-top: 20px;
            padding: 14px;
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .back-link:hover {
            color: var(--dark-green);
        }
        
        .back-link i {
            margin-right: 5px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .rating-text {
            text-align: center;
            font-size: 14px;
            margin-top: 5px;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }
            
            .page-header {
                padding: 20px 0;
            }
            
            .page-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Your Opinion Matters</h1>
        <p>Help us improve our services by sharing your experience</p>
    </div>
    
    <div class="container">
        <h2>Share Your Feedback</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="User_phone"><i class="fas fa-phone"></i> Your Registered Mobile Number</label>
                <input type="number" id="User_phone" name="User_phone" placeholder="Enter your 10-digit mobile number" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-chart-bar"></i> How would you rate our service?</label>
                <select name="rating">
                    <option value="Excellent">Excellent</option>
                    <option value="Good">Good</option>
                    <option value="Average">Average</option>
                    <option value="Poor">Poor</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-star"></i> Rate your overall experience</label>
                <div class="stars">
                    <input type="radio" name="star_rating" id="star5" value="5"><label for="star5">★</label>
                    <input type="radio" name="star_rating" id="star4" value="4"><label for="star4">★</label>
                    <input type="radio" name="star_rating" id="star3" value="3"><label for="star3">★</label>
                    <input type="radio" name="star_rating" id="star2" value="2"><label for="star2">★</label>
                    <input type="radio" name="star_rating" id="star1" value="1"><label for="star1">★</label>
                </div>
                <div class="rating-text">Click on a star to rate us</div>
            </div>

            <div class="form-group">
                <label for="comments"><i class="fas fa-comment"></i> Your Feedback</label>
                <textarea id="comments" name="comments" rows="5" placeholder="We value your opinion! Please share your experience with our services..." required></textarea>
            </div>

            <button type="submit"><i class="fas fa-paper-plane"></i> Submit Feedback</button>
        </form>
        <a href="../newzealand.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>
</body>
</html> 