<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study in abroad - Education & Immigration Services</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="University.css">
    <!-- Load Footer CSS -->
    <link rel="stylesheet" href="../components/footer/footer.css">
    <script src="University.js"></script>
    <!-- Load Taskbar -->
    <script src="../components/taskbar/loadTaskbar.js"></script>
</head>

<body>
    <!-- Taskbar Container -->
    <?php session_start(); ?>

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
                <a href="../newzealand.php">
                    <img src="../images/SOC.jpg" alt="SOC">
                </a>
            </div>
            <div class="nav-links">
                <a href="../Blog-news.php" class="nav-link">Blogs</a>

                <div class="dropdown">
                    <a href="../University/University.php" class="nav-link">Universities</a>
                </div>
                <a href="../Countrys/Countrys.php" class="nav-link">Countries</a>
                <div class="dropdown">
                    <a href="#" class="nav-link">Our Services <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-content">
                        <a href="../counselling.php">Counselling</a>
                        <!-- <a href="#">Visa Services</a> -->
                        <a href="../eligibility_check.php">Visa Eligibility Check</a>
                    </div>
                </div>
                <a href="../About-us.php" class="nav-link">About Us</a>
            </div>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['user_logged_in'])): ?>
                    <a href="../logout.php" class="btn btn-outline">Logout</a>
                <?php else: ?>
                    <a href="../login.php" class="  btn btn-outline">Sign In</a>
                    <a href="../signup.php" class="btn btn-primary">Sign Up</a>
                <?php endif; ?>
            </div>

        </div>
    </nav>
    <!-- Hero Section with Image and Text -->
    <section class="hero-section">
        <div class="hero-image">
            <img src="../images/University.jpg" alt="Visa Consultancy">
            <div class="hero-text">
                <p>Your Gateway to Abroad.</p>
                <a href="../counselling.php" class="btn btn-primary">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Card section -->
    <div class="slider-container">
        <section class="card-slider">
            <div class="card">
                <img src="../images/CMU.jpg" alt="image" />
                <div class="card-content">
                    <p>Carnegie Mellon University</p>
                    <p>Carnegie Mellon University (CMU) is a prestigious private research university located in Pittsburgh, Pennsylvania, United States. It is renowned for its strong emphasis on technology, engineering, computer science, and the arts.</p>
                </div>
            </div>

            <div class="card">
                <img src="../images/Oxford university.jpg" alt="image" />

                <div class="card-content">
                    <p> University of Oxford</p>
                    <p>The University of Oxford, located in Oxford, England, is one of the oldest and most prestigious universities in the world. Known for its rigorous academics, historic traditions, and global influence, Oxford has produced numerous world leaders, Nobel laureates, and influential thinkers.</p>
                </div>
            </div>

            <div class="card">
                <img src="../images/RWTH.jpg" alt="image" />

                <div class="card-content">
                    <p>RWTH Aachen University</p>
                    <p>RWTH Aachen University (Rheinisch-Westfälische Technische Hochschule Aachen) is one of Germany's leading universities, particularly renowned for its engineering and technical programs. Located in Aachen, Germany, it is one of the largest and most prestigious technical universities in Europe.</p>
                </div>
            </div>

            <div class="card">
                <img src="../images/UM.jpg" alt="image" />

                <div class="card-content">
                    <p>University of Manchester</p>
                    <p>The University of Manchester is a public research university located in Manchester, England.The University of Manchester is a public research university located in Manchester, England.</p>
                </div>
            </div>

            <div class="card">
                <img src="../images/UUIC.jpeg" alt="image" />

                <div class="card-content">
                    <p>University of Illinois Urbana-Champaign</p>
                    <p>The University of Illinois Urbana-Champaign (UIUC) is one of the top-ranked universities in the United States, known for its excellence in engineering, computer science, and business programs. Located in Illinois, UIUC consistently ranks among the best public universities, particularly for STEM fields.</p>
                </div>
            </div>

            <div class="card">
                <img src="../images/BCC.jpg" alt="image" />

                <div class="card-content">
                    <p>Berlin Institute of Technology</p>
                    <p>The Berlin Institute of Technology (Technische Universität Berlin - TU Berlin) is one of Germany's top technical universities, known for its strong engineering, computer science, and business programs. Located in Berlin, Germany, it is part of the prestigious TU9 group, which consists of Germany's best technical universities. </p>
                </div>
            </div>
        </section>

        <button class="slider-btn prev-btn">&lt;</button>
        <button class="slider-btn next-btn">&gt;</button>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <a href="../newzealand.php">
                        <img src="../images/SOC.jpg" alt="SOC Logo" class="footer-logo">
                    </a>
                    <p>Your trusted partner for education and immigration services in Abroad.</p>
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
                        <li><a href="../About-us.php">About Us</a></li>
                        <li><a href="../Countrys/Countrys.php">Countries</a></li>
                        <li><a href="../University/University.php">Universities</a></li>
                        <li><a href="../rating-reviews/feedback.php">Write a review...</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="../counselling.php">Counselling</a></li>
                        <!-- <li><a href="#">Visa services</a></li> -->
                        <li><a href="../eligibility_check.php">visa eligibility check</a></li>

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

    <script src="./script.js"></script>
</body>

</html>