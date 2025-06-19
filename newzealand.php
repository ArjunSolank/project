<?php
session_start();


if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    include 'connection/connection.php'; // Include database connection
    $email = $_SESSION['user_email'];
    $query = "SELECT First_name, Last_name FROM user WHERE User_email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $first_name = $user['First_name'];
        $last_name = $user['Last_name'];
    } else {
        $first_name = "Guest";
        $last_name = "";
    }
    $stmt->close();
} else {
    $first_name = "Guest";
    $last_name = "";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study in New Zealand - Education & Immigration Services</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
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
        .main-nav {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .main-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
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
            overflow: hidden;
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
            border: 2px solidrgb(69, 209, 73);
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
        .hero {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }
        .hero-content h1 {
            font-size: 3em;
            margin-bottom: 20px;
            color: #1a1a1a;
            line-height: 1.2;
        }
        .hero-content p {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 30px;
        }
        .hero-buttons {
            display: flex;
            gap: 20px;
        }
        .hero-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 20px;
        }
        .features {
            padding: 80px 0;
            background: url('images/SKY.webp') no-repeat center center;
            background-size: cover;
        }
        .features h2 {
            text-align: center;
            margin-bottom: 50px;
            font-size: 2.5em;
            color: #1a1a1a;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .feature-card {
            background: url('SKY.webp'); 
    background-size: cover;
    background-position: center;     border-radius: 10px; /* Thoda smooth look dene ke liye */
    padding: 20px; 
            padding: 30px;
            text-align: center;
            z-index: 20;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .feature-card i {
            font-size: 2.5em;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .feature-card h3 {
            margin-bottom: 15px;
            color: #1a1a1a;
        }/* Flight Booking Section */
.flight-booking {
    position: relative;
    padding: 120px 0;
    background: url('SKY.webp') no-repeat center center;
    background-size: cover;
    margin-top: -150px;
    padding-top: 200px;
    overflow: hidden;
    z-index: 1;
}

.flight-booking::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.img {
    width: 100%;
    -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1) 15%, rgba(0, 0, 0, 1) 85%, rgba(0, 0, 0, 0));
    mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1) 15%, rgba(0, 0, 0, 1) 85%, rgba(0, 0, 0, 0));
  }

.flight-booking .container {
    position: relative;
    z-index: 2;
}

.flight-booking h2 {
    color: #fff;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.booking-form {
    background: rgba(255, 255, 255, 0.95);
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    gap: 15px;
    max-width: 900px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.input-group {
    position: relative;
    flex: 1;
}

.input-group i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
}

.input-group input {
    width: 100%;
    padding: 8px 8px 8px 35px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 0.9rem;
    outline: none;
    transition: border-color 0.3s;
}

.input-group input:focus {
    border-color: #007bff;
}

.swap-btn {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 50%;
    background: #007bff;
    color: white;
    cursor: pointer;
    transition: transform 0.3s;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.swap-btn:hover {
    transform: rotate(180deg);
}

.date-buttons {
    display: flex;
    gap: 5px;
}

.date-btn {
    padding: 8px 12px;
    border: 1px solid #007bff;
    border-radius: 5px;
    background: transparent;
    color: #007bff;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 0.9rem;
}

.date-btn.active,
.date-btn:hover {
    background: #007bff;
    color: white;
}

.search-btn {
    padding: 8px 20px;
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.3s;
    flex-shrink: 0;
}

.search-btn:hover {
    background: #c0392b;
}

.moving-plane {
    position: absolute;
    width: 200px;
    height: 100px;
    background: url('Airoplane.png') no-repeat center center;
    background-size: contain;
    bottom: 50px;
    left: -200px;
    animation: flyPlane 15s linear infinite;
    z-index: 3;
}

@keyframes flyPlane {
    from {
        left: -200px;
        transform: translateY(0);
    }
    25% {
        transform: translateY(-20px);
    }
    50% {
        transform: translateY(0);
    }
    75% {
        transform: translateY(-20px);
    }
    to {
        left: calc(100% + 200px);
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .booking-form {
        flex-direction: column;
        padding: 15px;
    }
    
    .input-group {
        width: 100%;
    }
    
    .swap-btn {
        transform: rotate(90deg);
    }
    
    .date-buttons {
        width: 100%;
        justify-content: center;
    }
    
    .search-btn {
        width: 100%;
    }
}

/* Animations */
@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes slideInRight {
    from {
        transform: translateX(100px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInLeft {
    from {
        transform: translateX(-100px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

        .countries {
            padding: 80px 0;
            background: #f8f9fa;
            text-align: center;
        }
        .countries h2 {
            margin-bottom: 40px;
        }
        .countries .container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .card {
            width: 350px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card img {
            width: 100%;
            border-radius: 16px 16px 0 0;
        }
        .card-content {
            padding: 20px;
        }
        .slider-container {
            padding: 80px 40px;
            position: relative;
            overflow: hidden;
        }
        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }
        .slider-card {
            min-width: 300px;
            padding: 20px;
            margin-right: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 100;
        }
        .prev-btn {
            left: 10px;
        }
        .next-btn {
            right: 10px;
        }
        .cta {
            padding: 80px 0;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            text-align: center;
        }
        .cta h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .cta p {
            margin-bottom: 30px;
            font-size: 1.2em;
        }

        /* AI Float Styling */
.ai-float {
    position: fixed;
    bottom: 110px;
    right: 40px;
    /* background: #4CAF50; */
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s;
    z-index: 1000;
    text-decoration: none;
}

.ai-float img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 50%;
}

.ai-float:hover {
    transform: scale(1.1);
}

        .whatsapp-float {
            position: fixed;
            bottom: 40px;
            right: 40px;
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s;
            z-index: 1000;
        }
        .whatsapp-float:hover {
            transform: scale(1.1);
        }
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
        @media (max-width: 768px) {
            .hero .container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .hero-buttons {
                justify-content: center;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
            .nav-links, .auth-buttons {
                display: none;
            }
            .slider-card {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
  

    <!-- Taskbar Container -->
    <div id="taskbar-container"></div>

    <!-- Welcome Message -->
    <div style="text-align: center; padding: 10px; font-size: 24px; font-family: 'Poppins', sans-serif;">
        Welcome, <?php echo htmlspecialchars($first_name) . " " . htmlspecialchars($last_name); ?>!
    </div>

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
                <a href="../project/newzealand.php">
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
                        <!-- <a href="#">Visa Services</a> -->
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>"The world is waiting for you. Take the first step with your visa today."</h1>
                <p>Get all-in-one education and immigration services here</p>
                <div class="hero-buttons">
                    <a href="counselling.php" class="btn btn-primary">Get Free Counselling</a>
                    <a href="University/University.php" class="btn btn-secondary">Explore Universities</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="images/student.jpg" alt="Student with New Zealand flag">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Why Choose Us?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Expert Counselling</h3>
                    <p>Get guidance from our experienced education consultants</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-file-alt"></i>
                    <h3>Visa Assistance</h3>
                    <p>Complete support for student visa application</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-hands-helping"></i>
                    <h3>Career Guidance</h3>
                    <p>Professional advice for your career path in NZ</p>
                </div>
            </div>
        </div>
    </section>

   <!-- Flight Booking Section -->
   <section class="flight-booking">
        <div class="container">
            <h2>Plan Your Journey Everywhere in INDIA</h2>
            <img src="../images/SKY.webp" alt="Sky Background" style="width: 100%; height: auto; position: absolute; top: 0; left: 0; z-index: 0; opacity: 0.2;">
            <div class="booking-form" style="position: relative; z-index: 1;">
                <div class="input-group">
                    <i class="fas fa-plane-departure"></i>
                    <input type="text" placeholder="From Airport">
                </div>
                <button class="swap-btn">
                    <i class="fas fa-exchange-alt"></i>
                </button>
                <div class="input-group">
                    <i class="fas fa-plane-arrival"></i>
                    <input type="text" placeholder="To Airport">
                </div>
                <div class="input-group">
                    <i class="fas fa-calendar"></i>
                    <input type="date" value="2025-02-09">
                </div>
                <div class="date-buttons">
                    <button class="date-btn active">Today</button>
                    <button class="date-btn">Tomorrow</button>
                </div>
                <button class="search-btn">Search</button>
            </div>
        </div>
        <div class="moving-plane"></div>
    </section>

    <!-- Universities Section -->
    <section class="countries">
    <h2>Study Abroad</h2>
    <div class="container">
        <div class="card">
            <a href="University/University.php"><img src="images/CMU.jpg" alt="Carnegie Mellon University"></a>
            <div class="card-content">
                <p>Carnegie Mellon University</p>
                <p>Renowned for technology, engineering, and computer science.</p>
            </div>
        </div>
        <div class="card">
            <a href="University/University.php"><img src="images/Oxford university.jpg" alt="University of Oxford"></a>
            <div class="card-content">
                <p>University of Oxford</p>
                <p>One of the oldest and most prestigious universities globally.</p>
            </div>
        </div>
        <div class="card">
            <a href="University/University.php"><img src="images/RWTH.jpg" alt="RWTH Aachen University"></a>
            <div class="card-content">
                <p>RWTH Aachen University</p>
                <p>Leading university in Germany for engineering programs.</p>
            </div>
        </div>
    </div>
</section>
    <!-- Opinion Section (Manual Slider with Rating) -->
    <section class="slider-container">
        <div class="container">
            <h2>What Our Clients Say</h2>
            <button class="slider-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
            <div class="slider">
                <div class="slider-card">
                    <h3>Kedar Chaudhari</h3>
                    <p>Client</p>
                    <p>My case was unique, but they processed my files efficiently.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Urvesh Patel</h3>
                    <p>Student</p>
                    <p>Best consultancy for New Zealand with perfect work.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Ruchit Patel</h3>
                    <p>Student</p>
                    <p>Thanks for my successful visa during a tough time.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Rahul Sharma</h3>
                    <p>Student</p>
                    <p>Amazing support for my visa application!</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Priya Singh</h3>
                    <p>Client</p>
                    <p>Very professional and quick service.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Amit Verma</h3>
                    <p>Student</p>
                    <p>Helped me choose the best university.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Neha Gupta</h3>
                    <p>Client</p>
                    <p>Fantastic experience, highly recommend!</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Vikram Yadav</h3>
                    <p>Student</p>
                    <p>Visa process was smooth and fast.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Sneha Patel</h3>
                    <p>Client</p>
                    <p>Great team, very supportive.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Rohit Kumar</h3>
                    <p>Student</p>
                    <p>Got my visa on time, thanks!</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Anjali Desai</h3>
                    <p>Client</p>
                    <p>Best consultancy for abroad studies.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Karan Malhotra</h3>
                    <p>Student</p>
                    <p>Very helpful and friendly staff.</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="slider-card">
                    <h3>Meera Joshi</h3>
                    <p>Client</p>
                    <p>Excellent guidance throughout.</p>
                    <div class="stars">★★★★★</div>
                </div>
            </div>
            <button class="slider-btn next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta">
        <div class="container">
            <h2>Start Your Journey to New Zealand</h2>
            <p>Book a free counselling session with our experts</p>
            <a href="counselling.php" class="btn btn-primary">Book Now</a>
        </div>
    </section>

    <!-- AI Float -->
<a href="working_AI.php" class="ai-float">
    <img src="AI_Image.png" alt="AI Icon">
</a>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/9499519097" class="whatsapp-float">
        <i class="fab fa-whatsapp"></i>
    </a>   <!-- Footer Container -->
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
        // Manual Slider Logic
        const slider = document.querySelector('.slider');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const cardWidth = document.querySelector('.slider-card').offsetWidth + 20;
        let currentIndex = 0;

        nextBtn.addEventListener('click', () => {
            if (currentIndex < document.querySelectorAll('.slider-card').length - 1) {
                currentIndex++;
                slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
            }
        });

        // Flight Booking Functionality
        const dateInput = document.querySelector('.flight-booking input[type="date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;

        const swapBtn = document.querySelector('.flight-booking .swap-btn');
        swapBtn.addEventListener('click', () => {
            const fromInput = document.querySelector('.flight-booking input[placeholder="From Airport"]');
            const toInput = document.querySelector('.flight-booking input[placeholder="To Airport"]');
            const tempValue = fromInput.value;
            fromInput.value = toInput.value;
            toInput.value = tempValue;
        });

        const dateBtns = document.querySelectorAll('.flight-booking .date-btn');
        dateBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                dateBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const date = new Date();
                if (this.textContent === 'Tomorrow') {
                    date.setDate(date.getDate() + 1);
                }
                dateInput.value = date.toISOString().split('T')[0];
            });
        });

        const searchBtn = document.querySelector('.flight-booking .search-btn');
        searchBtn.addEventListener('click', () => {
            const from = document.querySelector('.flight-booking input[placeholder="From Airport"]').value;
            const to = document.querySelector('.flight-booking input[placeholder="To Airport"]').value;
            const date = dateInput.value;
            if (!from || !to) {
                alert('Please enter both departure and arrival airports');
                return;
            }
            alert(`Searching for flights from ${from} to ${to} on ${date}`);
        });
    </script>
</body>
</html>
