<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prime Kicks</title>
  <link rel="stylesheet" href="style.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
    html, body {
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      background: #f2f2f2;
    }
    nav {
      background: #1b1b1b;
      width: 100%;
      padding: 10px 0;
    }
    nav .menu {
      max-width: 1250px;
      margin: auto;
      display: flex;
      align-items: center;
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
      margin-left: 0;
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
    
    .product-detail {
      text-align: center;
      margin: 50px 20px;
    }
    .product-detail h1 {
      font-size: 36px;
      color: #333;
      font-weight: 700;
      margin-bottom: 20px;
    }
    .product-detail p {
      font-size: 18px;
      color: #666;
      line-height: 1.6;
      margin-bottom: 20px;
    }
    .product-gallery {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }
    .product-card {
      width: 250px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      padding: 15px;
      transition: transform 0.3s ease;
    }
    .product-card:hover {
      transform: scale(1.05);
    }
    .product-card img {
      width: 100%;
      max-width: 200px;
      height: auto;
      margin-bottom: 10px;
    }
    .product-card h3 {
      font-size: 20px;
      color: #333;
      margin: 10px 0;
    }
    .product-card p {
      font-size: 16px;
      color: #666;
      margin-bottom: 15px;
    }
    .product-card button {
      background: #1b1b1b;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .product-card button a {
      text-decoration: none;
      color: #fff;
    }
    .product-card button:hover {
      background: #333;
    }
    .sneaker-culture {
      text-align: center;
      padding: 40px 20px;
      background: #fff;
      margin: 50px 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .sneaker-culture h2 {
      font-size: 30px;
      color: #333;
      margin-bottom: 20px;
      padding-left: 30px;
    }
    .sneaker-culture p {
      font-size: 18px;
      color: #666;
      line-height: 1.6;
      margin-bottom: 20px;
    }
    .social-links {
      text-align: center;
      margin-top: 30px;
    }

    .social-links a {
      text-decoration: none;
      color: #1b1b1b;
      font-size: 30px;
      margin: 0 15px;
      transition: color 0.3s ease;
    }

    .social-links a:hover {
      color: #4CAF50; /* Green color for hover effect */
    }
    
  </style>
</head>
<body>
  <nav>
    <div class="menu">
      <div class="logo">
        <a href="#">Prime Kicks</a>
      </div>
      <ul>
        <li><a href="front_Product.php">Product</a></li>
        <li><a href="Aboutus.php">About us</a></li>
        <li><a href="index.php">Login</a></li>
      </ul>
    </div>
  </nav>

  <!-- Product Detail Section -->
  <div class="product-detail">
    <h1>Prime Kicks Sneaker Collection</h1>
    <p>Experience the best in style and comfort with our premium sneaker collection.
         Handpicked from top global brands, these sneakers are designed to elevate your footwear game.</p>
    <H3>Featured Item<H3>

    <div class="product-gallery">
    <div class="product-card">
        <img src="7.png" alt="Sneaker 4">
        <h3>Classic Kicks</h3>
        <p>Price: Nrs.999999</p>
        <button><a href="index.php">Buy Now</a></button>
      </div>
      <div class="product-card">
        <img src="5.png" alt="Sneaker 4">
        <h3>Classic Kicks</h3>
        <p>Price: Nrs.999999</p>
        <button><a href="index.php">Buy Now</a></button>
      </div>

      <div class="product-card">
        <img src="8.png" alt="Sneaker 4">
        <h3>Classic Kicks</h3>
        <p>Price: Nrs.999999</p>
        <button><a href="index.php">Buy Now</a></button>
      </div>


      <!-- Sneaker Culture Section -->
  <div class="sneaker-culture">
  <h2>Authentic Gaurentee<h2>

  <p>All our items are 100% authentic. 
  Our team of expert authenticators thoroughly inspect your item before sending it to you.</p>
</div>
  

  <div class="product-gallery">
    <div class="product-card">
        <img src="i.png" alt="Sneaker 4">
        <h3>Classic Kicks</h3>
        <p>Price: Nrs.9999</p>
        <button><a href="index.php">Buy Now</a></button>
      </div>
      <div class="product-card">
        <img src="j.png" alt="Sneaker 4">
        <h3>Classic Kicks</h3>
        <p>Price: Nrs.9999</p>
        <button><a href="index.php">Buy Now</a></button>
      </div>

      <div class="product-card">
        <img src="j.png" alt="Sneaker 4">
        <h3>Classic Kicks</h3>
        <p>Price: Nrs.9999</p>
        <button><a href="index.php">Buy Now</a></button>
      </div>
      <div class="product-card">
        <img src="k.png" alt="Sneaker 4">
        <h3>Classic Kicks</h3>
        <p>Price: Nrs.9999</p>
        <button><a href="index.php">Buy Now</a></button>
      </div>
</div>
  <!-- Sneaker Culture Section -->
  <div class="sneaker-culture">
    <h2>The Culture Behind Sneakers</h2>
    <p>Sneakers are more than just footwear; they are a lifestyle, a statement,
         and an art form. From iconic designs to collaborations with artists,
          sneakers have become a symbol of creativity and individuality.
          Explore the history, the hype, and the passion that drives the sneaker community worldwide.</p>
    </div>
  </div>

  <div class="social-links">
      <a href="https://www.instagram.com" target="_blank">
        <img src="instagram.png" alt="Instagram" width="40" height="40">
      </a>
      <a href="https://www.facebook.com" target="_blank">
        <img src="facebook.svg" alt="Facebook" width="40" height="40">
      </a>
    </div>

  <footer>
    <div>
      <p>Privacy Policy | Terms and Conditions</p>
      <p>© 2025 Prime Kicks, Inc.</p>
    </div>
  </footer>
</body>
</html>
