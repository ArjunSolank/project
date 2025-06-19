<?php
include 'connection/connection.php';

session_start();

// Fetch blog and news data from the database using prepared statements
$query = "SELECT title ,content, url, image, created_at FROM blog_news";
$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - SOC Overseas</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Dashbord\Dashbord\newzealand.css">
    <style>
        .blog-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .blog-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .blog-card:hover {
            transform: translateY(-10px);
        }
        .blog-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .blog-card-content {
            padding: 20px;
        }
        .blog-card-content h3 {
            margin-bottom: 10px;
        }
        .blog-card-content .author {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }
        .blog-card-content .author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Taskbar Container -->
    <div id="taskbar-container"></div>
    

 
<!-- Notification Bar -->
<div class="notification-bar">
    <div class="container">
        <div class="contact-info">
            <a href="tel:9898501119"><i class="fas fa-phone"></i> +91 9898501119</a>
            <a href="tel:9898511162"><i class="fas fa-phone"></i> +91 9898511162</a>
            <a href="mailto:syntrofiaoverseas105@gmail.com"><i class="fas fa-envelope"></i> syntrofiaoverseas105@gmail.com</a>
        </div>
        <div class="notification-text">
            Aiming to Study in Abroad? Get free counselling from SOC.
            <span class="close-notification">×</span>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="main-nav">
    <div class="container">
        <div class="logo">
            <a href="newzealand.php">
                <img src="images/SOC.jpg" alt="SOC">
            </a>
        </div>
        <div class="nav-links">
            <a href="Blog-news.php" class="nav-link">Blogs</a>

            <div class="dropdown">
                <a href="University/University.php" class="nav-link">Universities</a>
            </div>
            <a href="Countrys/Countrys.php" class="nav-link">Countries</a>
            <div class="dropdown">
                <a href="#" class="nav-link">Our Services <i class="fas fa-chevron-down"></i></a>
                <div class="dropdown-content">
                    <a href="counselling.php">Counselling</a>
                    <a href="eligibility_check.php">Visa Eligibility Check</a>
                </div>
            </div>
            <a href="About-us.php" class="nav-link">About Us</a>
        </div>
        <div class="auth-buttons">
            <?php if (isset($_SESSION['user_logged_in'])): ?>
                <a href="logout.php" class="btn btn-outline">Logout</a>
            <?php else: ?>
                <a href="login.php" class="  btn btn-outline">Sign In</a>
                <a href="signup.php" class="btn btn-primary">Sign Up</a>
            <?php endif; ?>
        </div>
       
    </div>
</nav>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 50px;">Latest Blogs</h2>
            <div class="blog-grid">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="blog-card">
                    <?php 
                    if (!empty($row['image'])) {
                        echo '<img src="Admin/' . htmlspecialchars($row['image']) . '" alt="Blog Image">';
                    } else {
                        echo '<img src="uploads/default.jpg" alt="No Image">';
                    }
                    ?>
                    <div class="blog-content">
                        <h3><?php echo htmlspecialchars($row['title']); ?> </h3>
                        <br>
                        <h5><?php echo htmlspecialchars($row['content']); ?></h5>
                        <p><?php echo date("F j, Y", strtotime($row['created_at'])); ?></p>
                        <a href="<?php echo htmlspecialchars($row['url']); ?>" target="_blank">Read More</a>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
 

    <div style="position: fixed; bottom: 110px; right: 40px; display: flex; align-items: center; gap: 20px; z-index: 1000;">
        <img id="ai-image" src="AI_Image.png" alt="AI" style="width: 60px; height: 60px; border-radius: 50%; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: transform 0.3s;">
        <a href="https://wa.me/9499519097" class="whatsapp-float">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <a href="newzealand.php">
                        <img src="images/SOC.jpg" alt="SOC logo" class="footer-logo">
                    </a>
                    <p>Your trusted partner for education and immigration services in abroad.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="About-us.php">About Us</a></li>
                        <li><a href="Countrys/Countrys.php">Countries</a></li>
                        <li><a href="University/University.php">Universities</a></li>
                        <li><a href="rating-reviews/feedback.php">Write a review...</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="counselling.php">Counselling</a></li>
                        <li><a href="eligibility_check.php">Visa eligibility check</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <p><i class="fas fa-phone"></i> +91 9898511162</p>
                    <p style="font-size: 0.9em;"><i class="fas fa-envelope"></i> syntrofiaoverseas105@gmail.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Maradiya Plaza Lane, Off C G Road, Ellisbridge, Ahmedabad – 380 006, Gujarat</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© <?php echo date('Y'); ?> SOC. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        document.getElementById('ai-image').addEventListener('click', function() {
            window.location.href = 'working_AI.php';
        });
    </script>
</body>
</html>