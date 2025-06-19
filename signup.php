<?php
    $con = mysqli_connect("localhost","root","","SOC_project");
    if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Generate unique hexadecimal user_id
        $user_id = bin2hex(random_bytes(8)); // generates 16 character hex
        
        // Get form data
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $number = $_POST['contactNumber'];
        $password = $_POST['password']; // Store original password without hashing

        // Insert data into database
        $sql = "INSERT INTO user (User_id, First_Name, Last_Name, User_email, User_DOB, User_Gender, User_phone, User_password) 
                VALUES ('$user_id', '$fname', '$lname', '$email', '$dob', '$gender', '$number', '$password')";

        if(mysqli_query($con, $sql)) {
            echo "Registration successful!";
            header('Location:login.php');
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
    mysqli_close($con);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Dream Place</title>
  
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-image: url('images/backImage.webp');
      background-size: cover;
      background-repeat: initial;
      background-position: center;
      padding: 20px;
      backdrop-filter: blur(5px);
    }

    .signup-container {
      max-width: 550px;
      margin: auto;
      background-color: rgba(255, 255, 255, 0.9);
      padding: 50px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #4c9eaf;
      font-size: 24px;
    }

    h1 {
      /* text-align: center;
      margin-bottom: 10px;
      color: #0000CD;
      font-size: 28px; */

      text-align: center;
            color: #1e7be5;
            margin-bottom: 30px;
            font-size: 28px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .form-group {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 15px;
      margin-bottom: 15px;
    }

    .form-group label {
      flex: 1;
      font-size: 16px;
      color: #333;
      font-weight: 450;
      
    }

    .form-group input,
    .form-group select {
      flex: 2;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;

     
    }
    input[type="text"]:focus, input[type="password"]:focus,input[type="email"]:focus,input[type="date"]:focus,input[type="tel"]:focus {
            outline: none;
            border-color: #1e6ee5; 
            box-shadow: 0 0 5px rgba(24, 130, 222, 0.5);
            background-color: rgba(255, 255, 255, 1); 
        }

    button.submit-btn {
      /* width: 100%;
      padding: 12px;
      background-color: #4c9eaf;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer; */
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
            margin-top: 15px;
            margin-bottom: 5px;
    }

    button.submit-btn:hover {
      background-color: #3b87a0;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }


    .back-to-login {
            text-align: center;
            margin-top: 20px;
            
    }
    .back-to-login a {
            color: #1eb3e5;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
        }
    .back-to-login a:hover {
            text-decoration: underline;
            color: #1565c0;
        }

  </style>
</head>
<body>

  <div class="signup-container">
    <h1>Your Dream Place</h1>
    <h2>Sign-Up</h2>
    <form id="signupForm" onsubmit="return validateForm()" method="post">
      <div class="form-group">
        <label for="firstName">First Name<span style="color: red;">*</span></label>
        <input type="text" id="firstName" name="firstName" required>
      </div>
      <div class="form-group">
        <label for="lastName">Last Name<span style="color: red;">*</span></label>
        <input type="text" id="lastName" name="lastName" required>
      </div>
      <div class="form-group">
        <label for="email">Email<span style="color: red;">*</span></label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth<span style="color: red;">*</span></label>
        <input type="date" id="dob" name="dob" required>
      </div>
      <div class="form-group">
        <label for="gender">Gender<span style="color: red;">*</span></label>
        <select id="gender" name="gender" required>
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="form-group">
        <label for="contactNumber">Contact Number</label>
        <input type="tel" id="contactNumber" name="contactNumber" pattern="[0-9]{10}" placeholder="1234567890">
      </div>
      <div class="form-group">
        <label for="password">Password<span style="color: red;">*</span></label>
        <input type="password" id="password" name="password" required>
        
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password<span style="color: red;">*</span></label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
      </div>
      <button type="submit" class="submit-btn">Sign Up</button>
      <div class="back-to-login">
            <p><a href="login.php">Alredy have an Account? click here to login</a></p>
        </div>
    </form>
    <p id="errorMessage" class="error-message"></p>
  </div>
 
  <script>
    function validateForm() {
      const firstName = document.getElementById('firstName').value;
      const lastName = document.getElementById('lastName').value;
      const email = document.getElementById('email').value;
      const dob = document.getElementById('dob').value;
      const gender = document.getElementById('gender').value;
      const contactNumber = document.getElementById('contactNumber').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      const errorMessage = document.getElementById('errorMessage');

      // Reset error message
      errorMessage.textContent = '';

      // Basic validation
      if (!firstName || !lastName || !email || !dob || !gender || !password || !confirmPassword) {
        errorMessage.textContent = 'All required fields must be filled!';
        return false;
      }

      // Validate email format
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        errorMessage.textContent = 'Please enter a valid email address!';
        return false;
      }

      // Validate contact number format if entered
      if (contactNumber && !/^[0-9]{10}$/.test(contactNumber)) {
        errorMessage.textContent = 'Please enter a valid 10-digit contact number!';
        return false;
      }

      // Validate passwords match
      if (password !== confirmPassword) {
        errorMessage.textContent = 'Passwords do not match!';
        return false;
      }

      alert('Form submitted successfully!');
      return true;
    }
  </script>

</body>
</html>
