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

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "SELECT img_path FROM products WHERE id = $delete_id";
    $delete_result = $conn->query($delete_query);

    // Delete the image file
    if ($delete_result && $delete_result->num_rows > 0) {
        $img_row = $delete_result->fetch_assoc();
        if (file_exists($img_row['img_path'])) {
            unlink($img_row['img_path']); // Delete the image file from the server
        }
    }

    // Delete the product from the database
    $sql = "DELETE FROM puma WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product deleted successfully');</script>";
        echo "<script>window.location.href='view_products.php';</script>";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}
// Fetch products from the database
$sql = "SELECT * FROM puma ORDER BY id DESC";
$result = $conn->query($sql);
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
  margin-top:560px;
}
        .product {
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #fff;
            padding: 10px;  
            margin: 15px 0;
            display: flex;
            align-items: center;
            gap: 300px
           
        }
        .product img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .details {
            flex: 1;
        }
        .details h3 {
            margin: 0 0 10px;
        }
        .details p {
            margin: 5px 0;
        }
        
        
        .button {
            color:white;
            background-color: #e74c3c;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
            text-decoration: none;
        }
        .button:hover {
            background-color:darkred;
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
    
    <div class="brand">
    <ul><li><a href="view_products.php">All</a></li>
        <li><a href="nike_product.php">Nike</a></li>
        <li><a href="puma_product.php">Puma</a></li>
        <li><a href="nb_product.php">NB</a></li>
    </ul></div>
    <br><br>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<img src="' . $row['img_path'] . '" alt="' . $row['title'] . '">';
            echo '<div class="details">';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '<p><strong>Price:</strong> Nrs.' . $row['price'] . '</p>';
            echo '<p><strong>Size Range:</strong> ' . $row['size_range'] . '</p>';
            echo '<p><strong>Color:</strong> ' . $row['color'] . '</p>';
            echo '<p>' . $row['description'] . '</p>';
            echo '</div>';
            echo '<div>';
            echo '<form method="get" style="display: inline;">';
            echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="button":none;>Delete</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No products found.</p>';
    }
    $conn->close();
    ?>
</body>
<footer>
      <p> Privacy Policy | Terms and Conditions</p>       
         <p>@ 2024 Prime Kicks, Inc.</p>
    </footer>
</html>
