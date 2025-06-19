<?php
session_start();

if(!isset($_SESSION['user_logged_in']))
{
    echo "<script>alert('Need login first'); window.location.href = 'login.php';</script>";
}

$errors = [];
$success = false;
$marks_10th = 0;
$marks_12th = 0;
$percentage_10th = 0;
$percentage_12th = 0;
$higher_education_name = '';
$degree_certificate = null;
$ineligibility_reasons = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection/connection.php'; 

    // Collect form data
    $first_name_input = trim($_POST['first_name']);
    $last_name_input = trim($_POST['last_name']);
    $email_input = trim($_POST['email']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $mobile_number = trim($_POST['mobile_number']);
    $nationality = trim($_POST['nationality']);
    $marks_10th = floatval($_POST['marks_10th']);
    $marks_12th = floatval($_POST['marks_12th']);
    $known_languages = trim($_POST['known_languages']);
    $ielts_status = $_POST['ielts_status'];

    $percentage_10th = ($marks_10th / 600) * 100;
    $percentage_12th = ($marks_12th / 700) * 100;

    $higher_education_name = isset($_POST['higher_education_name']) ? trim($_POST['higher_education_name']) : null;

    if (empty($first_name_input) || empty($last_name_input) || empty($email_input) || empty($dob) || empty($gender) ||
        empty($mobile_number) || empty($nationality) || empty($known_languages) || empty($ielts_status)) {
        $errors[] = "All required fields must be filled.";
    }

    if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match("/^\+?\d{10,15}$/", $mobile_number)) {
        $errors[] = "Invalid mobile number.";
    }

    if (!isset($_FILES['aadhar_card']) || $_FILES['aadhar_card']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors[] = "Aadhar card upload is required.";
    } else {
        $upload_dir = "uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $aadhar_card = $upload_dir . uniqid() . "_" . basename($_FILES['aadhar_card']['name']);
        if (!move_uploaded_file($_FILES['aadhar_card']['tmp_name'], $aadhar_card)) {
            $errors[] = "Failed to upload Aadhar card.";
        } else {
            if (!file_exists($aadhar_card)) {
                $ineligibility_reasons[] = "Aadhar card upload failed.";
            }
        }
    }

    if (!isset($_FILES['marksheet_10th']) || $_FILES['marksheet_10th']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors[] = "10th marksheet upload is required.";
    } else {
        $marksheet_10th = $upload_dir . uniqid() . "_" . basename($_FILES['marksheet_10th']['name']);
        if (!move_uploaded_file($_FILES['marksheet_10th']['tmp_name'], $marksheet_10th)) {
            $errors[] = "Failed to upload 10th marksheet.";
        }
    }

    if (!isset($_FILES['marksheet_12th']) || $_FILES['marksheet_12th']['error'] == UPLOAD_ERR_NO_FILE) {
        $errors[] = "12th marksheet upload is required.";
    } else {
        $marksheet_12th = $upload_dir . uniqid() . "_" . basename($_FILES['marksheet_12th']['name']);
        if (!move_uploaded_file($_FILES['marksheet_12th']['tmp_name'], $marksheet_12th)) {
            $errors[] = "Failed to upload 12th marksheet.";
        }
    }

    if (isset($_FILES['degree_certificate']) && $_FILES['degree_certificate']['error'] != UPLOAD_ERR_NO_FILE) {
        $degree_certificate = $upload_dir . uniqid() . "_" . basename($_FILES['degree_certificate']['name']);
        if (!move_uploaded_file($_FILES['degree_certificate']['tmp_name'], $degree_certificate)) {
            $errors[] = "Failed to upload degree certificate.";
        }
    }

    // Age calculation
    $birth_date = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($birth_date)->y;

    // Collect ineligibility reasons
    if (strtolower($nationality) !== "indian") {
        $ineligibility_reasons[] = "Only Indian nationals are eligible.";
    }
    if ($age < 18) {
        $ineligibility_reasons[] = "You must be 18 or older.";
    }
    if ($percentage_10th < 33) {
        $ineligibility_reasons[] = "You must pass 10th with at least 33%.";
    }
    if ($percentage_12th < 33) {
        $ineligibility_reasons[] = "You must pass 12th with at least 33%.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        // Set higher education fields to NULL if not eligible (10th or 12th < 33%)
        if ($percentage_10th < 33 || $percentage_12th < 33) {
            $higher_education_name = null;
            $degree_certificate = null;
        }

        $query = "INSERT INTO Eligibility_check (
            First_name, Last_name, Email, DOB, Gender, Mobile_number, Nationality, Aadhar_card,
            Education_10th_percentage, Education_12th_percentage, Marksheet_10th, Marksheet_12th,
            Higher_education_name, Degree_certificate, Known_languages, Ielts_status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $con->prepare($query);
        $stmt->bind_param(
            "ssssssssddssssss",
            $first_name_input, $last_name_input, $email_input, $dob, $gender, $mobile_number, $nationality, $aadhar_card,
            $percentage_10th, $percentage_12th, $marksheet_10th, $marksheet_12th, $higher_education_name, $degree_certificate,
            $known_languages, $ielts_status
        );

        if ($stmt->execute()) {
            $success = true;
            $eligible = (strtolower($nationality) === "indian" && $age >= 18 && $percentage_10th >= 33 && $percentage_12th >= 33 && file_exists($aadhar_card));
        } else {
            $errors[] = "Database insertion failed: " . $con->error;
        }
        $stmt->close();
    }
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eligibility Check - Syntrofia Overseas Consultancy</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="eligibility_check/eligibility_check.css">
    <!-- Load Taskbar -->
    <script src="../components/taskbar/loadTaskbar.js"></script>
    <script src="../components/footer/loadFooter.js"></script>
</head>
<body>
    <!-- Header from newzeland.php -->

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
                        <!-- <a href="#">Visa Services</a> -->
                        <a href="eligibility_check.php">Visa Eligibility Check</a>
                    </div>
                </div>
                <a href="About-us.php" class="nav-link">About Us</a>
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
    <!-- Eligibility Check Form -->
    <section class="eligibility-form">
    <div class="container">
        <h2>Visa Eligibility Check</h2>
        <?php if (!empty($errors)): ?>
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div style="color: green; margin-bottom: 20px;">
                <?php if ($eligible): ?>
                    <p>Congratulations! You are eligible for the visa process.</p>
                <?php else: ?>
                    <p>Sorry, you are not eligible for the visa process.</p>
                    <?php if (!empty($ineligibility_reasons)): ?>
                        <div style="color: red; margin-top: 10px;">
                            <strong>Reasons for Ineligibility:</strong>
                            <ul>
                                <?php foreach ($ineligibility_reasons as $reason): ?>
                                    <li><?php echo htmlspecialchars($reason); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <form action="eligibility_check.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male" <?php echo isset($_POST['gender']) && $_POST['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo isset($_POST['gender']) && $_POST['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo isset($_POST['gender']) && $_POST['gender'] === 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="tel" id="mobile_number" name="mobile_number" required value="<?php echo isset($_POST['mobile_number']) ? htmlspecialchars($_POST['mobile_number']) : ''; ?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality:</label>
                <input type="text" id="nationality" name="nationality" required value="<?php echo isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : ''; ?>">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="aadhar_card">Aadhar Card (PDF):</label>
                <input type="file" id="aadhar_card" name="aadhar_card" accept=".pdf" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="marks_10th">10th Total Marks (out of 600):</label>
                <input type="number" id="marks_10th" name="marks_10th" min="0" max="600" required value="<?php echo isset($_POST['marks_10th']) ? htmlspecialchars($_POST['marks_10th']) : ''; ?>">
                <span class="error"></span>
                <div class="percentage-display" id="percentage_10th">Percentage: <?php echo isset($_POST['marks_10th']) ? number_format(($_POST['marks_10th'] / 600) * 100, 2) : '0'; ?>%</div>
            </div>
            <div class="form-group">
                <label for="marksheet_10th">10th Marksheet (PDF):</label>
                <input type="file" id="marksheet_10th" name="marksheet_10th" accept=".pdf" required>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="marks_12th">12th Total Marks (out of 700):</label>
                <input type="number" id="marks_12th" name="marks_12th" min="0" max="700" required value="<?php echo isset($_POST['marks_12th']) ? htmlspecialchars($_POST['marks_12th']) : ''; ?>">
                <span class="error"></span>
                <div class="percentage-display" id="percentage_12th">Percentage: <?php echo isset($_POST['marks_12th']) ? number_format(($_POST['marks_12th'] / 700) * 100, 2) : '0'; ?>%</div>
            </div>
            <div class="form-group">
                <label for="marksheet_12th">12th Marksheet (PDF):</label>
                <input type="file" id="marksheet_12th" name="marksheet_12th" accept=".pdf" required>
                <span class="error"></span>
            </div>
            <div class="form-group" id="higher_education_group" style="display: block;">
                <label for="higher_education_name">Higher Education Name:</label>
                <input type="text" id="higher_education_name" name="higher_education_name" value="<?php echo isset($_POST['higher_education_name']) ? htmlspecialchars($_POST['higher_education_name']) : ''; ?>">
                <span class="error"></span>
            </div>
            <div class="form-group" id="degree_certificate_group" style="display: block;">
                <label for="degree_certificate">Degree Certificate (PDF):</label>
                <input type="file" id="degree_certificate" name="degree_certificate" accept=".pdf">
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="known_languages">Known Languages:</label>
                <textarea id="known_languages" name="known_languages" rows="4" required><?php echo isset($_POST['known_languages']) ? htmlspecialchars($_POST['known_languages']) : ''; ?></textarea>
                <span class="error"></span>
            </div>
            <div class="form-group">
                <label for="ielts_status">IELTS Status:</label>
                <select id="ielts_status" name="ielts_status" required>
                    <option value="">Select Status</option>
                    <option value="Yes" <?php echo isset($_POST['ielts_status']) && $_POST['ielts_status'] === 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_POST['ielts_status']) && $_POST['ielts_status'] === 'No' ? 'selected' : ''; ?>>No</option>
                </select>
                <span class="error"></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>
    <!-- Footer from newzeland.php -->
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

    <script src="../eligibility_check/eligibility_check.js"></script>
</body>
</html>