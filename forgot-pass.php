<?php
    // Database connection
    $con = mysqli_connect("localhost","root","","SOC_project");
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['phone']) && isset($_POST['new_password'])) {
            $phone = $_POST['phone'];
            $new_password = $_POST['new_password'];
            
            // Check if phone exists in database
            $check_phone = mysqli_query($con, "SELECT * FROM user WHERE User_phone='$phone'");
            
            if(mysqli_num_rows($check_phone) > 0) {
                // Update password
                mysqli_query($con, "UPDATE user SET User_password='$new_password' WHERE User_phone='$phone'");
                echo "<script>alert('Password has been reset successfully!'); window.location.href='login.html';</script>";
            } else {
                echo "<script>alert('Phone number not found in our records!');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot  Password</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-image: url('images/backImage.webp');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter:blur(2px);
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.3);
        }
        .container {
            position: relative;
            z-index: 1;
            max-width: 400px;
            width: 100%;
            padding: 40px;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        h2 {
            text-align: center;
            color: #1e88e5;
            margin-bottom: 30px;
            font-size: 28px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #90caf9;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        input::placeholder {
            color: #888;
        }
        input:focus {
            outline: none;
            border-color: #1e88e5;
            box-shadow: 0 0 5px rgba(30, 136, 229, 0.5);
            background-color: rgba(255, 255, 255, 1);
        }
        button {
            width: 100%;
            background-color: #1e88e5;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background-color: #1565c0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }
        .back-to-login a {
            color: #1e88e5;
            text-decoration: none;
            font-weight: bold;
        }
        .back-to-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <h2>Forgot Password</h2>
        <form method="POST" action="" onsubmit="return validateForm()">
            <div class="input-group">
                <input type="tel" name="phone" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number" required>
            </div>
            <div class="input-group">
                <input type="password" name="new_password" id="new_password" placeholder="Enter new password" required>
            </div>
            <div class="input-group">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
            </div>
            <button type="submit" href="login.php">Reset Password</button>
        </form>
        <div class="back-to-login">
            <p><a href="login.php">Back to Login</a></p>
        </div>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById('new_password').value;
            var confirm = document.getElementById('confirm_password').value;
            
            if (password !== confirm) {
                alert('Passwords do not match!');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
