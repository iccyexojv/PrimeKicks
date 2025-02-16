<html>
  <head>
    <meta charset="utf-8">
    <title>Prime Kicks</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  </head>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    html, body {
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      background: #f2f2f2;
    }

    nav {
      position: static;
      background: #1b1b1b;
      width: 100%;
      padding: 5px 0;
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

    footer {
      background-color: #1b1b1b;
      text-align: center;
      color: #fff;
      padding: 5px 0;
      width: 100%;
      margin-top: 50px;
    }

    .info {
      text-align: center;
      margin-top: 50px;
      padding: 0 20px;
    }

    .info h1 {
      font-size: 36px;
      color: #333;
      font-weight: 700;
    }

    .info p {
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

    .location {
      text-align: center;
      font-size: 16px;
      margin-top: 20px;
      color: #555;
    }

    .img {
      text-align: center;
      margin-top: 40px;
    }

    .img img {
      width:100%;
      max-width:200px;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
  <body>
    <!-- Navigation -->
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

    <div class="info">
      <h1>Welcome to Prime Kicks</h1><br><br>
      Your ultimate destination for sneaker enthusiasts!<br><br>

      At Prime Kicks, we believe in the power of sneakers to express personality, elevate style, and provide comfort. We are passionate about bringing the best sneakers to our customers, carefully curated from global brands known for their innovation and quality. Whether you're looking for iconic models or the latest trends, we have something for every sneaker lover.<br><br>
      </div>
      <h3>Explore Our Collections</h3>
      
      
  

    <div class="img">
      <!-- Sample Sneaker Image -->
      <img src="5.png" alt="Prime Kicks Sneaker Collection">
      <img src="7.png" alt="Prime Kicks Sneaker Collection">
      <img src="5.png" alt="Prime Kicks Sneaker Collection">
      <img src="8.png" alt="Prime Kicks Sneaker Collection">
    </div>
    <h2>We’re Here to Elevate Your Sneaker Game.</h2>
    <br><br>
    <h3>Join Our Sneaker Community</h3>
      Being a part of the Prime Kicks family means more than just shopping.
      
    



    <!-- Social Media Links and Location -->
    <div class="social-links">
      <a href="https://www.instagram.com" target="_blank">
        <img src="instagram.png" alt="Instagram" width="40" height="40">
      </a>
      <a href="https://www.facebook.com" target="_blank">
        <img src="facebook.svg" alt="Facebook" width="40" height="40">
      </a>
    </div>

    <div class="location">
      <p>Location: Kathmandu, Nepal</p>
    </div>

    <!-- Footer -->
    <footer>
      <div>
        <p>Privacy Policy | Terms and Conditions</p>       
        <p>© 2024 Prime Kicks, Inc.</p>
      </div> 
    </footer>
  </body>
</html>
