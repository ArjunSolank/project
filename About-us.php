<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Syntrofia Overseas Consultancy</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            line-height: 1.6;
            background-color: #fff;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
        }

        /* Notification Bar */
        .notification-bar {
            background-color: #28a745;
            color: #fff;
            padding: 10px 0;
            font-size: 0.9em;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            height: 40px; /* Standardized height to match other pages */
            display: flex;
            align-items: center;
        }

        .notification-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .contact-info a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
            transition: color 0.3s;
        }

        .contact-info a:hover {
            color: #e6ffe6;
        }

        .contact-info i {
            margin-right: 5px;
        }

        .notification-text {
            position: relative;
        }

        .close-notification {
            cursor: pointer;
            margin-left: 10px;
            font-size: 1.2em;
        }

        /* Main Navigation */
        .main-nav {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 40px; /* Adjusted for notification bar height */
            z-index: 999;
        }

        .main-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 50px;
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            margin: 0 15px;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: #28a745;
        }

        .dropdown {
            position: relative;
        }

        .dropdown .nav-link i {
            margin-left: 5px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            top: 100%;
            left: 0;
            min-width: 150px;
            border-radius: 5px;
        }

        .dropdown-content a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #f8f9fa;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

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
        .btn-secondary {
            background: white;
            color: #4CAF50;
            border: 2px solid #4CAF50;
        }
        .btn-secondary:hover {
            background: #4CAF50;
            color: white;
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

        /* Main Content Section */
        .about-us-section {
            padding-top: 120px; /* Space for fixed header and notification bar */
            padding-bottom: 60px;
        }

        .about-us-section h2 {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 40px;
            color: #28a745;
        }

        .reveal-zoom {
            animation: revealZoom 1s ease-out;
        }

        @keyframes revealZoom {
            from { transform: scale(0); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .reveal {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }

        .reveal.visible {
            opacity: 1;
        }

        .reveal-left {
            animation: revealLeft 1s ease-out forwards;
        }

        .reveal-right {
            animation: revealRight 1s ease-out forwards;
        }

        .reveal.delay-1 { transition-delay: 0.2s; }
        .reveal.delay-2 { transition-delay: 0.4s; }
        .reveal.delay-3 { transition-delay: 0.6s; }
        .reveal.delay-4 { transition-delay: 0.8s; }

        @keyframes revealLeft {
            from { transform: translateX(-100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes revealRight {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .glass {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .text-content h2 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #333;
        }

        .text-content h4 {
            font-size: 1.5em;
            color: #666;
            margin-bottom: 25px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5em;
            font-weight: 700;
            color: #28a745;
        }

        .stat-label {
            font-size: 1em;
            color: #666;
        }

        .features-list {
            list-style: none;
            margin: 20px 0;
        }

        .features-list li {
            margin-bottom: 15px;
            position: relative;
            padding-left: 25px;
            font-size: 1.1em;
        }

        .features-list li:before {
            content: "✓";
            color: #28a745;
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .text-content p {
            font-size: 1.1em;
            margin-bottom: 15px;
            line-height: 1.8;
        }

        .vision-mission {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin: 50px 0;
        }

        .vision, .mission {
            width: 48%;
            text-align: center;
        }

        .vision img, .mission img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .vision-content, .mission-content {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .vision-content h2, .mission-content h2 {
            font-size: 1.8em;
            color: #28a745;
            margin-bottom: 15px;
        }

        .tabs-container {
            margin: 50px 0;
        }

        .section-title {
            font-size: 2em;
            text-align: center;
            margin-bottom: 30px;
            color: #28a745;
        }

        .tab-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .tab-button {
            padding: 12px 25px;
            border: none;
            background-color: #f8f9fa;
            cursor: pointer;
            border-radius: 25px;
            font-size: 1em;
            font-weight: 500;
            transition: all 0.3s;
        }

        .tab-button.active, .tab-button:hover {
            background-color: #28a745;
            color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .tab-content {
            display: none;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .tab-content.active {
            display: block;
        }

        .icon-bg {
            position: absolute;
            font-size: 5em;
            color: #f8f9fa;
            opacity: 0.1;
            top: 20px;
            left: 20px;
        }

        .feature-card {
            margin-left: 80px;
        }

        .feature-icon {
            font-size: 2em;
            color: #28a745;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .service-section {
            margin: 50px 0;
            text-align: center;
        }

        .service-title {
            font-size: 2em;
            margin-bottom: 15px;
            color: #28a745;
        }

        .service-description {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 30px;
        }

        .service-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .service-card {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card i {
            font-size: 2em;
            color: #28a745;
            margin-bottom: 15px;
        }

        .service-card h3 {
            font-size: 1.3em;
            margin-bottom: 10px;
        }

        .service-card p {
            font-size: 1em;
            color: #666;
        }

        .programs-section {
            margin: 50px 0;
        }

        .programs-title h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 30px;
            color: #28a745;
        }

        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .program-card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .program-card:hover {
            transform: translateY(-5px);
        }

        .program-card h3 {
            font-size: 1.3em;
            margin-bottom: 10px;
        }

        .scroll-progress {
            position: fixed;
            top: 0;
            right: 0;
            width: 5px;
            height: 100%;
            background: #e0e0e0;
        }

        .scroll-progress-bar {
            width: 100%;
            height: 0;
            background: #28a745;
            transition: height 0.3s;
        }

        .scroll-down {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            border: 2px solid #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounce 2s infinite;
        }

        .scroll-down span {
            display: block;
            width: 10px;
            height: 10px;
            border-left: 2px solid #28a745;
            border-bottom: 2px solid #28a745;
            transform: rotate(-45deg);
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
            40% { transform: translateY(-10px) translateX(-50%); }
            60% { transform: translateY(-5px) translateX(-50%); }
        }

        /* Footer Styles */
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
            .notification-bar .container {
                flex-direction: column;
                text-align: center;
            }

            .contact-info a {
                margin: 5px 0;
            }

            .notification-text {
                margin-top: 10px;
            }

            .main-nav .container {
                flex-wrap: wrap;
                padding: 10px;
            }

            .nav-links {
                display: none;
                width: 100%;
                flex-direction: column;
                text-align: center;
                margin-top: 10px;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-link, .dropdown {
                margin: 10px 0;
            }

            .dropdown-content {
                position: static;
                box-shadow: none;
                background: #f8f9fa;
            }

            .auth-buttons {
                margin-top: 10px;
            }

            .mobile-menu-btn {
                display: block;
            }

            .vision-mission {
                flex-direction: column;
            }

            .vision, .mission {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    
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
<br><br>
    <!-- Main Content Section -->
    <section class="about-us-section">
        <div class="container">
            <h2 class="reveal-zoom">About Us</h2>
            <div class="content">
                <div class="about-section reveal">
                    <div class="about-content glass">
                        <div class="text-content">
                            <h2 class="reveal-left">Who Are We</h2>
                            <h4 class="reveal-right">SOC is Your Trusted Visa Consultancy Partner</h4>
                            
                            <div class="stats-grid glass">
                                <div class="stat-item reveal delay-1">
                                    <div class="stat-number">20+</div>
                                    <div class="stat-label">Years Experience</div>
                                </div>
                                <div class="stat-item reveal delay-2">
                                    <div class="stat-number">5000+</div>
                                    <div class="stat-label">Happy Clients</div>
                                </div>
                                <div class="stat-item reveal delay-3">
                                    <div class="stat-number">400+</div>
                                    <div class="stat-label">Visas Granted</div>
                                </div>
                            </div>

                            <p>A dedicated team comprising three Licensed Immigration Advisers and 50+ tour specialists providing comprehensive support for your international journey.</p>

                            <ul class="features-list">
                                <li>Expert visa consultation and procurement for tourist and work visas</li>
                                <li>Integrated national ticket booking system for convenient air travel arrangements</li>
                                <li>24/7 AI-powered chatbot support for instant assistance.</li>
                                <li>Automated feedback and review management system</li>
                            </ul>

                            
                            <p>Proud partners with 500+ prestigious academic institutions across Dream Country, providing unparalleled access to top-ranked universities, including various top ranked university and Category 1 Private Training Establishments (PTEs).</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vision-mission">
                <div class="vision reveal">
                    <img src="images/nz.jpg" alt="New Zealand Vision">
                    <div class="vision-content">
                        <h2>Our Vision</h2>
                        <p>In Your Dream Place visa is consultancy To be the most trusted and renowned visa consultancy worldwide, helping individuals achieve their dreams of traveling, working, and settling in their dream destinations with ease. We strive to provide seamless, transparent, and efficient visa solutions, making international opportunities accessible for everyone.</p>
                    </div>
                </div>
                <div class="mission reveal">
                    <img src="images/mission.jpg" alt="Our Mission">
                    <div class="mission-content">
                        <h2>Our Mission</h2>
                        <p>To empower individuals with their global aspirations by providing expert visa consultation, maintaining the highest standards of professionalism, and delivering personalized solutions. We are committed to making the visa process smooth and stress-free while ensuring compliance with all regulatory requirements.</p>
                    </div>
                </div>
            </div>

            <div class="tabs-container scroll-reveal">
                <h2 class="section-title">What Makes Your Dream Place Unique?</h2>
                <div class="tab-buttons">
                    <button class="tab-button active" onclick="openTab(event, 'worldwide')">
                        <i class="fas fa-globe"></i>
                        Renowned Worldwide
                    </button>
                    <button class="tab-button" onclick="openTab(event, 'booking')">
                        <i class="fas fa-ticket-alt"></i>
                        National/Ticket Booking
                    </button>
                    <button class="tab-button" onclick="openTab(event, 'services')">
                        <i class="fas fa-plus-circle"></i>
                        Added Services
                    </button>
                    <button class="tab-button" onclick="openTab(event, 'documentation')">
                        <i class="fas fa-file-alt"></i>
                        Documentation
                    </button>
                </div>

                <div id="worldwide" class="tab-content active">
                    <i class="fas fa-globe icon-bg"></i>
                    <div class="feature-card">
                        <i class="fas fa-globe feature-icon"></i>
                        <h3>Renowned Worldwide</h3>
                        <p>Trustful agents of IELTS and ICEF that provide reliable, fast, and professional visa process and immigration guidance to people worldwide. Specializing in U.S.A, CANADA, etc. country visit visas, this consultancy provides comprehensive services including consultation, application assistance, interview preparation, and travel insurance.</p>
                    </div>
                </div>

                <div id="booking" class="tab-content">
                    <i class="fas fa-ticket-alt icon-bg"></i>
                    <div class="feature-card">
                        <i class="fas fa-ticket-alt feature-icon"></i>
                        <h3>National Ticket Booking Support</h3>
                        <p>In Your Dream Place website has seamless traveling in Flight. To be a client has booking Air Ticket into state to state traveling with discount.</p>
                    </div>
                </div>

                <div id="services" class="tab-content">
                    <i class="fas fa-plus-circle icon-bg"></i>
                    <div class="feature-card">
                        <i class="fas fa-plus-circle feature-icon"></i>
                        <h3>Added Services</h3>
                        <p>In Our website's offer various extra services to make travel easier, including guidance and inputs on statements of purpose, letters of recommendation, housing, scholarships, foreign exchange, national ticketing, and many-more. In Your Dream Place website we are added chatbot option to help us for traveling in flight or national ticket booking, AI chatbot helps in Feedback management.</p>
                    </div>
                </div>

                <div id="documentation" class="tab-content">
                    <i class="fas fa-file-alt icon-bg"></i>
                    <div class="feature-card">
                        <i class="fas fa-file-alt feature-icon"></i>
                        <h3>Thorough Documentation</h3>
                        <p>We will help you with a detailed checklist with all necessary information, including transcripts, bank statements for visa payment, and more, to traveling in abroad or immigrate to any other country. We will also provide verification services to ensure your VISA process is smoother.</p>
                    </div>
                </div>
            </div>

            <div class="service-section">
                <h2 class="service-title">Additional Services</h2>
                <p class="service-description">Discover our comprehensive range of services designed to make your journey smooth and successful.</p>
                
                <div class="service-cards">
                    <div class="service-card">
                        <i class="fas fa-check-circle"></i>
                        <h3>High Visa Success Rate</h3>
                        <p>We have the highest visa success rate because our Licensed Immigration Advisers in various foreign country have decades of expertise working as overseas consultants.</p>
                    </div>
                    
                    <div class="service-card">
                        <i class="fas fa-comments"></i>
                        <h3>AI-Powered Chatbot Assistant</h3>
                        <p>Our intelligent chatbot provides 24/7 support for visa processes, ticket bookings, and general inquiries. Get instant help with application tracking, FAQs, feedback management, and step-by-step guidance throughout your journey.</p>
                    </div>
                    
                    <div class="service-card">
                        <i class="fas fa-plane"></i>
                        <h3>National Ticket Booking System</h3>
                        <p>Book your flights directly through our integrated ticket booking platform. Enjoy hassle-free reservations, competitive prices, and instant confirmation. Our system provides real-time updates and easy ticket management.</p>
                    </div>

                    <div class="service-card">
                        <i class="fas fa-user-tie"></i>
                        <h3>Visa Interview Preparation</h3>
                        <p>Take advantage of one-on-one sample interviews and guidance from our expert team.</p>
                    </div>
                    
                    <div class="service-card">
                        <i class="fas fa-fast-forward"></i>
                        <h3>Fast & Smooth Process</h3>
                        <p>With Your Dream Place, you'll have access to everything you need to organize and carry out your trip. Monitor your application progress and receive real-time updates.</p>
                    </div>
                </div>
            </div>

            <div class="programs-wrapper">
                <section class="programs-section">
                    <div class="programs-title">
                        <h2>Our Programs We Provide</h2>
                    </div>
                    <div class="programs-grid">
                        <div class="program-card reveal-left delay-1">
                            <div class="program-content">
                                <h3>Visitor Visa</h3>
                                <p>Short-term visa for tourism, visiting family, business meetings, or other temporary visits. Perfect for exploring new destinations and creating memorable experiences.</p>
                            </div>
                        </div>

                        <div class="program-card reveal-right delay-2">
                            <div class="program-content">
                                <h3>Work Permit</h3>
                                <p>Legal authorization to work in foreign countries with full employment rights. Open doors to international career opportunities and professional growth.</p>
                            </div>
                        </div>

                        <div class="program-card reveal-left delay-3">
                            <div class="program-content">
                                <h3>Study Visa</h3>
                                <p>Educational opportunities at prestigious institutions worldwide. Pursue your academic dreams and gain international exposure in top universities.</p>
                            </div>
                        </div>

                        <div class="program-card reveal-right delay-4">
                            <div class="program-content">
                                <h3>Business Visa</h3>
                                <p>For entrepreneurs and business professionals seeking international opportunities. Expand your business horizons and establish global connections.</p>
                            </div>
                        </div>

                        <div class="program-card reveal-left delay-1">
                            <div class="program-content">
                                <h3>Permanent Residence</h3>
                                <p>Long-term settlement options for qualified individuals and families. Build a new life with full residential benefits in your chosen country.</p>
                            </div>
                        </div>

                        <div class="program-card reveal-right delay-2">
                            <div class="program-content">
                                <h3>Dependent Visa</h3>
                                <p>Family reunification visas for spouses and children. Keep your family together while pursuing international opportunities.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Add scroll progress bar -->
            <div class="scroll-progress">
                <div class="scroll-progress-bar"></div>
            </div>

            <!-- Add scroll down indicator -->
            <div class="scroll-down">
                <span></span>
            </div>
        </div>
    </section>

    <!-- Footer from newzealand.php -->
    <!-- Footer Container -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <a href="newzealand.php">
                        <img src="images/SOC.jpg" alt="SOC Logo" class="footer-logo">
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
                        <!-- <li><a href="#">Visa services</a></li> -->
                        <li><a href="eligibility_check.php">visa eligibility check</a></li>

                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <p><i class="fas fa-phone"></i> +91 9898511162</p>
                    <p><i class="fas fa-envelope"></i> syntrofiaoverseas105@gmail.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Maradiya Plaza Lane, Off C G Road, Ellisbridge, Ahmedabad – 380 006, Gujarat</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© <?php echo date('Y'); ?> SOC. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Tab Functionality
        function openTab(evt, tabName) {
            var i, tabcontent, tabbuttons;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tabbuttons = document.getElementsByClassName("tab-button");
            for (i = 0; i < tabbuttons.length; i++) {
                tabbuttons[i].className = tabbuttons[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Reveal Animation on Scroll
        function revealElements() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;

                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("visible");
                } else {
                    reveals[i].classList.remove("visible");
                }
            }
        }

        window.addEventListener("scroll", revealElements);
        window.addEventListener("load", revealElements);

        // Scroll Progress Bar
        window.addEventListener("scroll", function() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.querySelector(".scroll-progress-bar").style.height = scrolled + "%";
        });

        // Notification Bar Close
        document.addEventListener("DOMContentLoaded", function() {
            const closeBtn = document.querySelector(".close-notification");
            const notificationBar = document.querySelector(".notification-bar");
            const mainNav = document.querySelector(".main-nav");

            if (closeBtn && notificationBar) {
                closeBtn.addEventListener("click", function() {
                    notificationBar.style.display = "none";
                    mainNav.style.top = "0";
                    document.querySelector(".about-us-section").style.paddingTop = "80px";
                });
            }

            // Mobile Menu Toggle
            const mobileMenuBtn = document.querySelector(".mobile-menu-btn");
            const navLinks = document.querySelector(".nav-links");

            if (mobileMenuBtn && navLinks) {
                mobileMenuBtn.addEventListener("click", function() {
                    navLinks.classList.toggle("active");
                    mobileMenuBtn.innerHTML = navLinks.classList.contains("active") ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
                });
            }
        });
    </script>
    <!-- Cloudflare Script -->
    <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'92057308ff8a7be2',t:'MTc0MTk3MjkwNi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script>
</body>
</html>