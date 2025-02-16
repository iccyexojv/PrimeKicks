<?php
$servername = "localhost";
$username = "root"; // Update if necessary
$password = ""; // Update if necessary
$dbname = "prime_kicks"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM puma ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Prime Kicks</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      border-radius:30px;
    }
    html,body{
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      text-align:center;
      background: #f2f2f2;
      
    }
    .slider{
      max-width: 1100px;
      display: flex;
      
    }
    .slider .card{
      flex: 1;
      margin: 0 10px;
      background: #fff;
    }
    .slider .card .img{
      height: 200px;
      width: 100%;
    }
    .slider .card .img img{
      height: 100%;
      width: 100%;
      object-fit: cover;
      
    }
    .slider .card .content{
      padding: 10px 20px;
      margin-bottom:50px;
      
    }
    .card .content .title{
      font-size: 25px;
      font-weight: 600;
      
    }
    .card .content .sub-title{
      font-size: 20px;
      font-weight: 600;
      color: #e74c3c;
      line-height: 20px;
    }
    .card .content p{
      text-align: justify;
      margin: 10px 0;
     
      
    }
    .card .content .btn{
      display: block;
      text-align:center;
      margin: 10px 0;
      position:relative;
      
    }
    .btn2{
      margin-left:20px;  
    }
    .card .content .btn button{
      background: #e74c3c;
      color: #fff;
      border: none;
      outline: none;
      font-size: 17px;
      padding: 5px 8px;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.2s;
    }
    .card .content .btn button:hover{
      transform: scale(0.9);
    
    }
    
    nav {
      position:static;
      background: #1b1b1b;
      width: 100%;
      padding: 5px 0;
      border-radius:0px;
    
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
      margin-top:430px;
      border-radius:0px;
  
    }
    .brand {
    margin: auto;
    padding: 10px;
    display: flex;
    align-items: center;
    background-color: #1b1b1b;
    margin-top: 20px;
    margin-bottom: 40px;
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

.brand .search-icon {
    height: 30px; /* Reduce height */
    width: 180px; /* Reduce width */
    display: flex;
    background: #f2f2f2;
    border-radius: 5px;
    margin-left: 20px; /* Adds space between search bar and brand items */
}

.brand .search-icon input {
    height: 100%;
    width: 140px; /* Adjust width */
    border: none;
    outline: none;
    padding: 0 10px;
    color: #000;
    font-size: 14px; /* Reduce font size */
    border-radius: 5px 0 0 5px;
}

.brand .search-icon .icon {
    height: 100%;
    width: 40px;
    line-height: 30px; /* Adjust to match reduced height */
    text-align: center;
    border: 1px solid #cccccc;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}

.brand .search-icon .icon span {
    color: #222222;
    font-size: 16px; /* Reduce font size */
}


    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="menu">
            <div class="logo">
                <a href="home.php">Prime Kicks</a>
            </div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="About.php">About us</a></li>
                <li><a href="cart.php">Mycart</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Brand Filters -->
    <div class="brand">
    <ul>
        <li><a href="nike.php">Nike</a></li>
        <li><a href="puma.php">Puma</a></li>
        <li><a href="nb.php">NB</a></li>
    </ul>
   
    <!-- Search Bar -->
    <div class="search-icon">
    <form method="GET" action="search.php">
        <input type="search" name="search" placeholder="Search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">
            <span class="fas fa-search"></span>
        </button>
    </form>
</div>
</div>


<!-- First Product Slider -->
<div class="slider owl-carousel">
    <?php
    if ($result->num_rows > 0) {
        // Reset result pointer and fetch products
        $result->data_seek(0); 
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '    <div class="img"><img src="' . $row['img_path'] . '" alt="' . $row['title'] . '"></div>';
            echo '    <div class="content">';
            echo '        <div class="title">' . $row['title'] . '</div>';
            echo '        <div class="sub-title">Nrs.' . $row['price'] . '</div>';
            echo '        <p>Size: ' . $row['size_range'] . '</p>';
            echo '        <p>Color: ' . $row['color'] . '</p>';
            echo '        <p>' . $row['description'] . '</p>';
            echo '        <div class="btn">';
            echo '            <button class="add-to-cart" ';
            echo '                data-title="' . $row['title'] . '" ';
            echo '                data-price="' . $row['price'] . '" ';
            echo '                data-img="' . $row['img_path'] . '">';
            echo '                ADD TO CART';
            echo '            </button>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
    } else {
        echo '<p>No products available.</p>';
    }
    ?>
</div>

<!-- Second Product Slider -->
<div class="slider owl-carousel">
    <?php
    if ($result->num_rows > 0) {
        // Reset result pointer and fetch products
        $result->data_seek(0); 
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '    <div class="img"><img src="' . $row['img_path'] . '" alt="' . $row['title'] . '"></div>';
            echo '    <div class="content">';
            echo '        <div class="title">' . $row['title'] . '</div>';
            echo '        <div class="sub-title">Nrs.' . $row['price'] . '</div>';
            echo '        <p>Size: ' . $row['size_range'] . '</p>';
            echo '        <p>Color: ' . $row['color'] . '</p>';
            echo '        <p>' . $row['description'] . '</p>';
            echo '        <div class="btn">';
            echo '            <button class="add-to-cart" ';
            echo '                data-title="' . $row['title'] . '" ';
            echo '                data-price="' . $row['price'] . '" ';
            echo '                data-img="' . $row['img_path'] . '">';
            echo '                ADD TO CART';
            echo '            </button>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
    } 
    ?>
</div>
</div>

<!-- Third Product Slider -->
<div class="slider owl-carousel">
    <?php
    if ($result->num_rows > 0) {
        // Reset result pointer and fetch products
        $result->data_seek(0); 
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '    <div class="img"><img src="' . $row['img_path'] . '" alt="' . $row['title'] . '"></div>';
            echo '    <div class="content">';
            echo '        <div class="title">' . $row['title'] . '</div>';
            echo '        <div class="sub-title">Nrs.' . $row['price'] . '</div>';
            echo '        <p>Size: ' . $row['size_range'] . '</p>';
            echo '        <p>Color: ' . $row['color'] . '</p>';
            echo '        <p>' . $row['description'] . '</p>';
            echo '        <div class="btn">';
            echo '            <button class="add-to-cart" ';
            echo '                data-title="' . $row['title'] . '" ';
            echo '                data-price="' . $row['price'] . '" ';
            echo '                data-img="' . $row['img_path'] . '">';
            echo '                ADD TO CART';
            echo '            </button>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
    }
      ?>
  </div>
  </div>

    <!-- Footer -->
    <footer>
        <p>Privacy Policy | Terms and Conditions</p>
        <p>© 2024 Prime Kicks, Inc.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        $(".slider").owlCarousel({
            loop: false,
            autoplay: false,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
        });

        $(document).ready(function() {
            $(".add-to-cart").click(function(event) {
                event.preventDefault();

                const productData = {
                    title: $(this).data("title"),
                    price: $(this).data("price"),
                    img: $(this).data("img")
                };

                $.ajax({
                    url: "cart.php",
                    type: "POST",
                    data: productData,
                    success: function(response) {
                        alert("Product added to cart successfully!");
                    },
                    error: function() {
                        alert("Failed to add the product to the cart. Try again.");
                    }
                });
            });
        });
        
    </script>
</body>
</html>
