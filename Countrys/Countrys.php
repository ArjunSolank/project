<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Countries - SOC Overseas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Notification Bar */
        .notification-bar {
            background: linear-gradient(90deg, #4CAF50, #45a049);
            color: white;
            padding: 10px 0;
            font-size: 14px;
        }

        .notification-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .notification-bar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }

        .close-notification {
            cursor: pointer;
            padding: 0 10px;
        }

        /* Navigation */
        .main-nav {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: relative; /* Ensure z-index works */
        }

        .main-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo img {
            height: 75px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #4CAF50;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 1000; /* Increased z-index to bring dropdown to front */
            top: 100%; /* Position below the nav-link */
            left: 0; /* Align with the left of dropdown */
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background 0.3s;
        }

        .dropdown-content a:hover {
            background: #f5f5f5;
            color: #4CAF50;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background: #45a049;
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 2px solid #4CAF50;
            color: #4CAF50;
        }

        .btn-outline:hover {
            background: #4CAF50;
            color: white;
        }

        /* Main Content */
        .main-content {
            padding: 50px 0;
        }

        .main-content h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
        }

        .main-content p {
            text-align: center;
            margin-bottom: 40px;
            color: #666;
        }

        /* Scroll Section */
        .scroll-section {
            padding: 20px 0;
        }

        .scroll-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 40px 0;
            opacity: 0;
            transform: translateX(-100%);
            transition: all 0.5s ease;
            /* Forced space using margin on text */
        }

        .scroll-item:nth-child(even) {
            flex-direction: row-reverse;
            transform: translateX(100%);
        }

        .scroll-item.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-image {
            width: 500px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            flex-shrink: 0;
            margin-right: 40px; 
            border-spacing: 10px;/* Space on right of image */
        }

        .scroll-text {
            flex: 1;
            padding: 0 20px; /* Padding inside text */
            margin-left: 40px;
            border-spacing: 10px; /* Space on left of text */
        }

        .scroll-text h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #4CAF50;
        }

        .scroll-text p {
            font-size: 1em;
            color: #555;
            text-align: justify;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 80px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo {
            height: 50px;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            color: white;
            font-size: 20px;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: #4CAF50;
        }

        .footer-section h4 {
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: #4CAF50;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .scroll-item {
                flex-direction: column;
                text-align: center;
                gap: 30px;
            }

            .scroll-image {
                width: 100%;
                max-width: 500px;
                height: auto;
                margin-right: 0; /* Remove margin on mobile */
            }

            .scroll-text {
                margin-left: 0; /* Remove margin on mobile */
                padding: 20px 0;
            }

            .scroll-text p {
                text-align: justify;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }

            .nav-links {
                flex-direction: column;
                gap: 15px;
                margin-top: 15px;
            }

            .main-nav .container {
                flex-direction: column;
            }

            .auth-buttons {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
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

    <section class="main-content">
        <div class="container">
            <h1>Explore Countries with SOC.</h1>
            <p>Discover the best countries for your education and career opportunities with SOC.</p>
            <div class="scroll-section">
                <div class="scroll-item">
                    <img src="../images/US.jpg" alt="United States" class="scroll-image">
                    <div class="scroll-text">
                        <h2>United States</h2>
                        <p>The United States is a land of opportunity with diverse cities like New York and natural wonders like the Grand Canyon. It's a hub for education, tech, and the "American Dream." At SOC Overseas, we proudly help people chase their dreams in the US, connecting them to top universities, jobs, and vibrant communities. With our expert guidance, your journey to this global powerhouse becomes smooth and exciting. The US leads in innovation and culture, offering endless possibilities. Trust SOC Overseas to make your American adventure a reality, from visa support to settling in!</p>
                    </div>
                </div>
                <div class="scroll-item">
                    <img src="../images/United_Kingdom2.jpg" alt="United Kingdom" class="scroll-image">
                    <div class="scroll-text">
                        <h2>United Kingdom</h2>
                        <p>The United Kingdom blends history and modernity, from London's Big Ben to Scotland's castles. Known for elite education (Oxford, Cambridge) and a strong economy, it's a dream destination. SOC Overseas takes pride in sending people to the UK, ensuring they experience its rich culture and opportunities. Whether it's studying, working, or exploring tea and rainy days, we've got your back. Our dedicated team simplifies visas and relocation, making your UK journey seamless. With SOC Overseas, live the British life with confidence and ease!</p>
                    </div>
                </div>
                <div class="scroll-item">
                    <img src="../images/Canada.jpg" alt="Canada" class="scroll-image">
                    <div class="scroll-text">
                        <h2>Canada</h2>
                        <p>Canada offers stunning landscapes like the Rockies and welcoming cities like Toronto. Famous for maple syrup and multiculturalism, it's perfect for a fresh start. SOC Overseas specializes in helping you relocate to Canada, a land of peace and prosperity. We guide you through visas, job opportunities, and settling into its friendly communities. With a thriving economy in tech and resources, Canada promises a high quality of life. Let SOC Overseas turn your Canadian dream into reality, ensuring a smooth transition!</p>
                    </div>
                </div>
                <div class="scroll-item">
                    <img src="../images/Australia.jpg" alt="Australia" class="scroll-image">
                    <div class="scroll-text">
                        <h2>Australia</h2>
                        <p>Australia, with its sunny beaches and unique wildlife, is an adventure lover's paradise. From Sydney's Opera House to the Outback, it's a land of opportunity. SOC Overseas is your trusted partner in reaching Australia, offering expert support for education, work, and migration. We help you navigate visas and connect with its booming industries like mining and tech. With our personalized assistance, experience the Aussie lifestyle—surfing, BBQs, and kangaroos—worry-free. Choose SOC Overseas for a hassle-free journey Down Under!</p>
                    </div>
                </div>
                <div class="scroll-item">
                    <img src="../images/New_Zealand.jpg" alt="New Zealand" class="scroll-image">
                    <div class="scroll-text">
                        <h2>New Zealand</h2>
                        <p>New Zealand dazzles with its Lord of the Rings landscapes, from fjords to mountains. A small yet vibrant nation, it's ideal for nature lovers. SOC Overseas proudly sends people to this Pacific gem, ensuring a smooth move for study, work, or living. We handle everything—visas, relocation, and settling in—so you can enjoy rugby, Maori culture, and kiwi life. With a strong tourism and agriculture economy, New Zealand shines. Let SOC Overseas make your dream of living in this green paradise come true!</p>
                    </div>
                </div>
                <div class="scroll-item">
                    <img src="../images/Europe.jpg" alt="Europe" class="scroll-image">
                    <div class="scroll-text">
                        <h2>Europe</h2>
                        <p>Europe, a continent of 44 countries, offers history, culture, and modernity—from Paris's Eiffel Tower to Germany's tech hubs. It's a dream for settlers alike. SOC Overseas excels in sending people to Europe, tailoring your journey to study, work, or explore. We simplify visas and connect you to opportunities across nations like France, Italy, and Spain. With our support, experience Europe's diverse charm, from Alps skiing to Mediterranean vibes. SOC Overseas ensures your European adventure is seamless, opening doors to this vibrant continent!</p>
                    </div>
                </div>
                <div class="scroll-item">
                    <img src="../images/Japan.jpg" alt="Japan" class="scroll-image">
                    <div class="scroll-text">
                        <h2>Japan</h2>
                        <p>Japan blends ancient temples with futuristic cities like Tokyo. Famous for sushi, tech (Sony, Toyota), and cherry blossoms, it's a unique destination. SOC Overseas takes pride in helping you reach Japan, whether for education, work, or culture. We guide you through visas and relocation, ensuring you thrive in its disciplined, innovative society. With our expertise, embrace Japan's harmony and lifestyle effortlessly. From bullet trains to Mount Fuji, SOC Overseas makes your Japanese dream a reality, connecting you to this land of progress!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeNotification = document.querySelector('.close-notification');
            if (closeNotification) {
                closeNotification.addEventListener('click', function() {
                    this.parentElement.style.display = 'none';
                });
            }

            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const link = dropdown.querySelector('.nav-link');
                const content = dropdown.querySelector('.dropdown-content');

                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    content.style.display = content.style.display === 'block' ? 'none' : 'block';
                });

                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target)) {
                        content.style.display = 'none';
                    }
                });
            });

            const scrollItems = document.querySelectorAll('.scroll-item');
            function checkScroll() {
                scrollItems.forEach(item => {
                    const rect = item.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        item.classList.add('visible');
                    } else {
                        item.classList.remove('visible');
                    }
                });
            }

            window.addEventListener('scroll', checkScroll);
            checkScroll();
        });
    </script>
</body>
</html>