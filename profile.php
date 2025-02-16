<?php
session_start();

// Database connection
$servername = "localhost";    // Database host
$username = "root";           // Database username
$password = "";               // Database password
$dbname = "prime_kicks";      // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in and is not an admin
if (!isset($_SESSION['userEmail']) || $_SESSION['userRole'] !== 'user') {
    header("Location: index.php"); // Redirect non-users or unauthenticated users
    exit;
}

// Fetch current user data
$userEmail = $_SESSION['userEmail'];
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gender = $_POST['gender'];
    $location = $_POST['location'];

    // Update user data
    $update_sql = "UPDATE users SET gender = ?, location = ? WHERE email = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sss", $gender, $location, $userEmail);

    if ($update_stmt->execute()) {
        echo "<p style='color: green;'>Profile updated successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error updating profile: " . $conn->error . "</p>";
    }
}


// Close connection
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Prime Kicks - Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
          *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
          }
          html,body{
            display: grid;
            height: 100%;
            width: 100%;
            place-items: center;
            text-align:center;
            background: #f2f2f2;
          }


        .main-content {
            padding:20px;
            margin-top:0px;
            height: 90%;
             width: 90%;
             text-align:center;
            background: #f2f2f2;
            
        }
        .container {
            padding: 20px;
            margin: 0 auto;
            max-width:600px;
        }
        .profile-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20p
           
        }
        
        .profile-details input[type="text"], 
        .profile-details select, 
        .profile-details textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
                
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px; 
            color: white;
            background-color:black;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background-color:green;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width:500px;
          
               }
        nav {
            position:static;
            background: #1b1b1b;
            width: 100%;
            padding: 5px 0;

          }
          nav .menu {
            max-width: 1250px;
            margin: auto;
            display: flex;
            align-items:center;
            justify-content: space-between;
            padding: 0 20px;
          }
          .menu .logo a {
            text-decoration: none;
            color: #fff;
            font-size: 35px;
            font-weight: 600;
          }
          .menu ul {
            display: inline-flex;
          }
          .menu ul li {
            list-style: none;
            margin-left: 7px;
          }
          .menu ul li:first-child {
            margin-left: 0px;
          }
          .menu ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
          }
          .menu ul li a:hover {
            background: #fff;
            color: black;
          }
          footer{
            background-color:  #1b1b1b;
            text-align: center;
            color: #fff;
            padding: 5px 0;
            width: 100%;
            margin-top:85px;
          }
          
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="menu">
            <div class="logo"><a href="home.php">Prime Kicks</a></div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="cart.php">Mycart</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h1 style="font-size:34px; color:black;"><b>My Profile</b></h1>
            <div class="profile-details">
                <h2 style="color:black;">Profile Information</h2>
                <form action="profile.php" method="post">
                    <label for="username">Name (readonly):</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" readonly>

                    <label for="Email">Email (readonly):</label>
                    <input type="text" name="userEmail" value="<?php echo htmlspecialchars($_SESSION['userEmail']); ?>" readonly>

                    <label for="gender">Gender:</label>
                    <select name="gender">
                        <option value="male" <?php if ($userData['gender'] === 'male') echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if ($userData['gender'] === 'female') echo 'selected'; ?>>Female</option>
                        <option value="other" <?php if ($userData['gender'] === 'other') echo 'selected'; ?>>Other</option>
                    </select>

                    <label for="location">Location:</label>
                    <textarea name="location"><?php echo htmlspecialchars($userData['location']); ?></textarea>

                    <button type="submit" class="btn">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div>
            <p>Privacy Policy | Terms and Conditions</p>
            <p>&copy; 2024 Prime Kicks, Inc.</p>
        </div>
    </footer>
</body>
</html>
