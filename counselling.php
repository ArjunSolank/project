<?php
session_start();
include 'connection/connection.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_logged_in'])) {
    echo "<script>alert('To get free counselling ,please login first...'); window.location.href = 'login.php';</script>";
    exit();
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mo_no = $_POST['mo_no'];
    $appointment_date = $_POST['appointment_date'];
    $counselling_hours = $_POST['counselling_hours'];
    $reasons = isset($_POST['reasons']) ? implode(", ", $_POST['reasons']) : ""; // Convert array to comma-separated string

    // Prepare and execute SQL query
    $stmt = $con->prepare("INSERT INTO counselling_data (First_name, Last_name, Mo_no, Appointment_date, Counselling_hours, reason_for_counselling) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $mo_no, $appointment_date, $counselling_hours, $reasons);

    if ($stmt->execute()) {
        echo "<script>alert('Counselling appointment booked successfully,we'll contact you shortly'); window.location.href = 'counselling.php';</script>";
    } else {
        echo "<script>alert('Error booking appointment. Please try again.');</script>";
    }

    $stmt->close();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counselling Form - Syntrofia Overseas Consultancy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #fff; color: #333; line-height: 1.6; }
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
        .mobile-menu-btn { display: none; font-size: 1.5em; cursor: pointer; }

        .form-section { padding: 50px 0; text-align: center; }
        .form-section h2 { font-size: 2.5em; color: #28a745; margin-bottom: 25px; margin-top: 10px; }
        .form-container { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px #0003; max-width: 600px; margin: 0 auto; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; }
        .form-group input[type="text"], .form-group input[type="tel"], .form-group input[type="date"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .form-group input[type="radio"] { margin-right: 5px; }
        .form-group .radio-group { 
            display: flex; 
            flex-direction: column;
            gap: 10px;
        }
        
        .radio-item {
            display: flex;
            align-items: center;
        }
        
        .radio-item label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .radio-item input[type="radio"] {
            margin-right: 8px;
        }
        .form-group input[type="checkbox"] { margin-right: 5px; }
        .form-group .checkbox-group { display: flex; flex-wrap: wrap; gap: 15px; }
        .form-group .error { color: red; font-size: 0.9em; display: none; }
        .submit-btn { background: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .submit-btn:hover { background: #218838; }

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
            .notification-bar .container { flex-direction: column; text-align: center; }
            .main-nav .container { flex-wrap: wrap; }
            .nav-links { display: none; width: 100%; flex-direction: column; text-align: center; margin-top: 10px; }
            .nav-links.active { display: flex; }
            .mobile-menu-btn { display: block; }
        }
    </style>
</head>
<body>
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

    <section class="form-section">
        <div class="container">
            <h2>Book Your Counselling Appointment</h2>
            
            <div class="form-container">
                <form id="counsellingForm" method="POST" action="counselling.php">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="mo_no">Mobile Number</label>
                        <input type="tel" id="mo_no" name="mo_no" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_date">Appointment Date</label>
                        <input type="date" id="appointment_date" name="appointment_date" required>
                        <span class="error" id="dateError">Please select a future date.</span>
                    </div>
                    <div class="form-group">
                        <label>Counselling Hours</label>
                        <div class="radio-group">
                            <div class="radio-item"><label><input type="radio" name="counselling_hours" value="11-12" required> 11-12</label></div>
                            <div class="radio-item"><label><input type="radio" name="counselling_hours" value="12-1"> 12-1</label></div>
                            <div class="radio-item"><label><input type="radio" name="counselling_hours" value="1-2"> 1-2</label></div>
                            <div class="radio-item"><label><input type="radio" name="counselling_hours" value="2-3"> 2-3</label></div>
                            <div class="radio-item"><label><input type="radio" name="counselling_hours" value="3-4"> 3-4</label></div>
                            <div class="radio-item"><label><input type="radio" name="counselling_hours" value="4-5"> 4-5</label></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Reason for Counselling</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="reasons[]" value="Visa Inquiry"> Visa Inquiry</label>
                            <label><input type="checkbox" name="reasons[]" value="Study Abroad Guidance"> Study Abroad Guidance</label>
                            <label><input type="checkbox" name="reasons[]" value="Work Permit Assistance"> Work Permit Assistance</label>
                            <label><input type="checkbox" name="reasons[]" value="University Selection"> University Selection</label>
                            <label><input type="checkbox" name="reasons[]" value="Immigration Advice"> Immigration Advice</label>
                            <label><input type="checkbox" name="reasons[]" value="Other"> Other</label>
                        </div>
                        <span class="error" id="reasonError">Please select at least one reason.</span>
                    </div>
                    <button type="submit" class="submit-btn">Book Appointment</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer Container -->
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
                        <li><a href="Countrys\Countrys.php">Countries</a></li>
                        <li><a href="University\University.php">Universities</a></li>
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
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector(".close-notification")?.addEventListener("click", () => {
                document.querySelector(".notification-bar").style.display = "none";
                document.querySelector(".main-nav").style.top = "0";
                document.querySelector(".form-section").style.paddingTop = "60px";
            });
            document.querySelector(".mobile-menu-btn")?.addEventListener("click", () => {
                document.querySelector(".nav-links").classList.toggle("active");
                document.querySelector(".mobile-menu-btn").innerHTML = document.querySelector(".nav-links").classList.contains("active") ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            });

            // Date validation
            const dateInput = document.getElementById("appointment_date");
            const today = new Date();
            today.setDate(today.getDate() + 1); // Minimum date is tomorrow
            const minDate = today.toISOString().split("T")[0];
            dateInput.setAttribute("min", minDate);

            dateInput.addEventListener("change", () => {
                const selectedDate = new Date(dateInput.value);
                const todayCompare = new Date();
                todayCompare.setHours(0, 0, 0, 0);
                if (selectedDate <= todayCompare) {
                    document.getElementById("dateError").style.display = "block";
                    dateInput.value = "";
                } else {
                    document.getElementById("dateError").style.display = "none";
                }
            });

            // Form submission validation
            document.getElementById("counsellingForm").addEventListener("submit", (e) => {
                const reasons = document.querySelectorAll('input[name="reasons[]"]:checked');
                if (reasons.length === 0) {
                    e.preventDefault();
                    document.getElementById("reasonError").style.display = "block";
                } else {
                    document.getElementById("reasonError").style.display = "none";
                }
            });
        });
    </script>
</body>
</html>