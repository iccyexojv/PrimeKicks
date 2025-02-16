<?php
$servername = "localhost";
$username = "root"; // Update if necessary
$password = ""; // Update if necessary
$dbname = "prime_kicks"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $size_range = $_POST['size_range'];
    $color = $_POST['color'];
    $description = $_POST['description'];

    // Handle image upload
    $image = $_FILES['image'];
    $image_name = basename($image['name']); // Ensure only the file name is used
    $image_tmp_name = $image['tmp_name'];
    $upload_directory = 'uploads/'; // Directory to save images
    $image_folder = $upload_directory . $image_name;

    // Ensure the 'uploads/' directory exists
    if (!is_dir($upload_directory)) {
        mkdir($upload_directory, 0777, true); // Create directory with proper permissions
    }

    // Move the uploaded file
    if (move_uploaded_file($image_tmp_name, $image_folder)) { 
        // Insert data into the database
        $sql = "INSERT INTO nb (title, price, size_range, color, description, img_path) 
                VALUES ('$title', '$price', '$size_range', '$color', '$description', '$image_folder')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product uploaded successfully!'); window.location.href = 'order_list.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Failed to upload image.');</script>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Kicks - Cart</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
html,body{
  height: 100%;
  width: 100%;
  place-items: center;
  background: #f2f2f2;
  
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
  margin-top:100px;
}
       
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;  
            margin-top:40px;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            background-color: #1b1b1b;
            color: white;
            border: none;
        }
        button:hover {
            background-color: #333;
        }

        .brand {
    margin: auto;
    padding: 10px;
    display: inline-flex;
    align-items: center;
    background-color: #1b1b1b;
    margin-top: 10px;
    border-radius: 10px;
    justify-content: space-between; /* To evenly space the items */
}

.brand ul {
    display: inline-flex;
}

.brand ul li a {
    text-decoration: none;
    color: #fff;
    padding: 8px 15px;
    border-radius: 5px;
    list-style: none;
}

.brand ul li {
    list-style: none;
}

.brand ul li a:hover {
    background: #fff;
    color: black;
}
    </style>
</head>
<body>
<nav>
      <div class="menu">
        <div class="logo">
        <a href="order_list.php">Prime Kicks</a>
        </div>
        <ul>
                <li><a href="order_list.php">Order-List</a></li>
                <li><a href="product.php">New Stock</a></li>
                <li><a href="user.php">User</a></li>
                <li><a href="view_products.php">Store</a></li>
                <li><a href="Logout_admin.php">Logout</a></li>
        </ul>
      </div>
    </nav>
    <br>
    <h3>Upload Your New Balance Stock Only ! </h3>

    <div class="brand">
    <ul>
        <li><a href="nike_upload.php">Nike</a></li>
        <li><a href="puma_upload.php">Puma</a></li>
        <li><a href="nb_upload.php">NB</a></li>
    </ul></div>

    <form action="nb_upload.php" method="POST" enctype="multipart/form-data">

        <label for="title">Product Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="price">Price (Nrs.):</label>
        <input type="number" name="price" id="price" required>

        <label for="size_range">Size Range:</label>
        <input type="text" name="size_range" id="size_range" required>

        <label for="color">Color:</label>
        <input type="text" name="color" id="color" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="3" required></textarea>

        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <button type="submit" name="upload">Upload Product</button>
    </form>
</body>
<footer>
      <p> Privacy Policy | Terms and Conditions</p>       
         <p>@ 2024 Prime Kicks, Inc.</p>
    </footer>
</html>
