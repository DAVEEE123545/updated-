<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blurry Background Registration Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Blurry background container */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('barangay.jpg'); /* Replace with your actual image */
            background-size: cover;
            background-position: center;
            filter: blur(4px); /* Subtle blur effect */
            z-index: 1;
        }

        /* Overlay for slight darkness effect */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4); /* Slightly dark overlay */
            z-index: 2;
        }

        .container {
            position: relative;
            z-index: 3;
            width: 800px; /* Set a wider width for the container */
            display: flex; /* Use flexbox for side-by-side layout */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(5px); /* Frosted glass effect */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            flex-direction: column; /* Align children in a column */
            align-items: center; /* Center items horizontally */
        }

        .greeting {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        .form-section {
            width: 100%; /* Make the form section full width */
            display: flex; /* Use flexbox for side-by-side layout */
            justify-content: space-between; /* Distribute space evenly */
            gap: 20px; /* Space between the columns */
        }

        .form-column {
            width: 48%; /* Each column takes almost half the width */
            padding: 10px; /* Add padding for inner spacing */
        }

        .container h2 {
            color: #fff;
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #fff;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .gender-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px; /* Add some space below gender selection */
        }

        .gender-group label {
            color: #fff;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #000;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #333;
        }

        .extra-options {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            color: #fff;
        }

        .extra-options a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }

        .extra-options a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <!-- Blurred background -->
    <div class="background"></div>

    <!-- Dark overlay for clarity -->
    <div class="overlay"></div>

    <!-- Registration Form -->
    <div class="container">
        <div class="greeting">
            <h2>Welcome!</h2>
            <p>Please fill out the form below to register.</p>
        </div>
        <form action="register.php" method="POST">
    <div class="form-section">
        <div class="form-column">
            <div class="form-group">
                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="fullname" placeholder="Enter your full name" required> <!-- Changed name to fullname -->
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>
        </div>
        <div class="form-column">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required> <!-- Changed name to confirm_password -->
            </div>
            <div class="form-group gender-group">
                <label>Gender:</label>
                <label><input type="radio" name="gender" value="male"> Male</label>
                <label><input type="radio" name="gender" value="female"> Female</label>
                <label><input type="radio" name="gender" value="prefer-not-to-say"> Prefer not to say</label>
            </div>
            <button type="submit" class="btn">Register</button>
        </div>
   
        </div>

        <div class="extra-options">
            <a href="logins.php">Already have an account?</a>

        </div>
    </div>

</body>
</html>
