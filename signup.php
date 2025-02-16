<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prime_kicks";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';
$success = '';

// Handle sign-up form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];
    $role = $_POST['role'];

    // Validate form data
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword) || empty($gender) || empty($location) || empty($role)) {
        $error = "All fields are required.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Hash the password and insert new user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password, gender, location, role) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $username, $email, $hashedPassword, $gender, $location, $role);

            if ($stmt->execute()) {
                $success = "Account created successfully. You can now <a href='login.php'>log in</a>.";
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up - Prime Kicks</title>
    <style>
        * {
            background: url(backgroundimage.png);
        }
        #nike_airmax {
            position: absolute;
            left: 950px;
            background: transparent;
            width: 600px;
            height: 800px;
            top: -30px;
        }
        #nike_high {
            position: absolute;
            left: 1290px;
            background: transparent;
            width: 200px;
            height: 250px;
            opacity: 80%;
            top: -10px;
        }
        #nike_j4 {
            position: absolute;
            left: 1200px;
            width: 230px;
            height: 250px;
            background: transparent;
            rotate: -40deg;
            top: 430px;
            opacity: 80%;
        }
        #nike_box {
            position: absolute;
            left: 70px;
            background: transparent;
            height: 550px;
            width: 350px;
            top: 70px;
        }
        #nike_air {
            position: absolute;
            left: 940px;
            background: transparent;
            width: 220px;
            height: 350px;
            top: 10px;
            rotate: -10deg;
            opacity: 80%;
        }
        #slogan {
            color: white;
            font-size: 100px;
            font-style: italic;
            text-align: center;
            position: absolute;
            top: 550px;
            left: 250px;
            background: transparent;
        }
        #heading {
            color: white;
            position: absolute;
            left: 0px;
            top: 0px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        
        }
        .signup-container {
            width: 300px;
            padding: 20px;
            background-color: white;
            border-color: white;
            border-style: solid;
            border-width: 3px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(221, 211, 211, 0.1);
            text-align: center;
            color: white;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            color: white;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        input[type="text"],
input[type="email"],
input[type="password"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    color: white; /* Set text color to white */
    background-color: transparent; /* Optional: make background transparent */
}

        .btn {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        option {
            color:black;
        }
    </style>
</head>
<body>
<div>
    <h1 id="heading">PRIME KICKS</h1>
    <img id="nike_airmax" src="image4.png">
    <img id="nike_high" src="image3.png">
    <img id="nike_j4" src="image5.png">
    <img id="nike_box" src="image7.png">
    <img id="nike_air" src="image6.png">
</div>
<div class="signup-container">
    <h2>Sign Up</h2>
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form action="signup.php" method="post">
        <input type="text" name="username" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <textarea name="location" placeholder="Location" required></textarea>
        <select name="role" required>
            <option value="user">User</option>
        </select>
        <button type="submit" class="btn">Sign Up</button>
    </form>
    <p id="password-feedback" style="font-size: 0.9em; color: red;"></p>
</div>
<script>
  document.querySelector('form').addEventListener('submit', function (e) {
    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
    const feedback = document.getElementById('password-feedback');

    if (password.length < 8) {
      e.preventDefault(); // Prevent form submission
      feedback.textContent = 'Password must be at least 8 characters long.';
    } else if (password !== confirmPassword) {
      e.preventDefault();
      feedback.textContent = 'Passwords do not match.';
    } else {
      feedback.textContent = ''; // Clear feedback if valid
    }
  });
</script>
<p id="slogan">REFRESH YOUR STYLE</p>
</body>
</html>
