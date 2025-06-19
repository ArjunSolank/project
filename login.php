<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dream Place - Syntrofia Overseas Consultant</title>
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
            backdrop-filter: blur(5px);
            align-items: center;
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
            color: #1e7be5;
            margin-bottom: 30px;
            font-size: 28px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        input[type="email"], input[type="password"] {
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
        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #888;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #1e6ee5;
            box-shadow: 0 0 5px rgba(24, 130, 222, 0.5);
            background-color: rgba(255, 255, 255, 1);
        }
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-container input {
            padding-right: 50px;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            font-size: 14px;
            color: #1e6ee5;
            cursor: pointer;
            user-select: none;
        }
        button {
            width: 100%;
            background-color: #1ebae5;
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
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        .forgot-password a {
            color: #1eb3e5;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .forgot-password a:hover {
            text-decoration: underline;
            color: #1565c0;
        }
    </style>
</head>
<body>

<body>
<div class="container">
        <h2>Your Dream Place</h2>
        <?php
        session_start();
        if(isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <form method="post" action="login_process.php">
            <input type="email" name="User_email" id="username" placeholder="Email" required>
            <div class="password-container">
                <input type="password" name="User_password" id="password" placeholder="Password" required>
                <!-- <span class="toggle-password" onclick="togglePassword()">Show</span> -->
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="forgot-password">
            <p><a href="forgot-pass.php">Forgot Password?</a></p>
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>

<!-- <ss -->

    <script>
       

        // function togglePassword() {
        //     const passwordField = document.getElementById('User_password');
        //     const toggleText = document.querySelector('.toggle-password');
            
        //     if (passwordField.type === "password") {
        //         passwordField.type = "text";
        //         toggleText.textContent = "Hide";
        //     } else {
        //         passwordField.type = "User_password";
        //         toggleText.textContent = "Show";
        //     }
        // }
    </script>
</body>
</html>
