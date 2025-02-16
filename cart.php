<?php
session_start();

// Database connection
$host = "localhost";
$dbname = "prime_kicks";
$username = "root";
$password = "";
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize cart and confirmed orders if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['confirmed_orders'])) {
    $_SESSION['confirmed_orders'] = [];
}

// Handle adding products to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['price'], $_POST['img'])) {
    $product = [
        'title' => $_POST['title'],
        'price' => $_POST['price'],
        'img' => $_POST['img']
    ];
    $_SESSION['cart'][] = $product;
    $_SESSION['message'] = "Product added to cart.";
    echo json_encode($_SESSION['cart']);
    exit;
}

// Handle removing products from the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $removeIndex = $_GET['remove'];
    unset($_SESSION['cart'][$removeIndex]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
    $_SESSION['message'] = "Product removed from cart.";
    header("Location: cart.php");
    exit;
}

// Handle order confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order_details'])) {
    $username = $_POST['username'];
    $location = $_POST['location'];
    $size = $_POST['size'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['payment_method'];
    $order_date = date('Y-m-d H:i:s');


    foreach ($_SESSION['cart'] as $item) {
        $stmt = $conn->prepare(
            "INSERT INTO orders (username, location, size, email, title, price, img, payment_method, order_date) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "sssssdsss",
            $username, $location, $size, $email,
            $item['title'], $item['price'], $item['img'],
            $paymentMethod, $order_date
        );
        $stmt->execute();

        $_SESSION['confirmed_orders'][] = [
            'username' => $username,
            'location' => $location,
            'size' => $size,
            'email' => $email,
            'title' => $item['title'],
            'price' => $item['price'],
            'img' => $item['img'],
            'payment_method' => $paymentMethod,
            'order_date' => $order_date
        ];
    }

    $_SESSION['cart'] = []; // Clear the cart
    $_SESSION['message'] = "Order confirmed successfully.";
    header("Location: cart.php");
    exit;
}
// Fetch orders for the current user (use a session variable for user ID in production)
// For demonstration, fetching all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Kicks</title>
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
            text-align: center;
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
            margin-top:500px;
        }

        .cart-items, .confirmed-orders {
            display: flex;
            flex-direction: column;
            align-items: bottom;
            width: 40%;
            margin-top: 20px;
        }

        .cart-item, .confirmed-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: #fff;
            margin: 10px 0;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .cart-item img, .confirmed-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-item h3, .confirmed-item h3 {
            font-size: 20px;
            font-weight: 600;
        }

        .cart-item p, .confirmed-item p {
            font-size: 16px;
            font-weight: 500;
            color: #e74c3c;
        }

        .remove-btn {
            text-decoration: none;
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .remove-btn:hover {
            background: #c0392b;
        }

        .btn-confirm {
            background-color: #e74c3c;
            color: #fff;
            padding: 12px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        .btn-confirm:hover {
            background-color:Green;
        }

        .order-form {
            display:none;
            flex-direction:column;
            margin-top: 20px;
        }

        .order-form input {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 0px;
        }

        .order-form button {
            background-color: #e74c3c;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .order-form button:hover {
            background-color: green;
        }


        .order-items {
            display: flex;  
            flex-direction:column;
            width: 40%;
            margin-top: 20px;
            gap: 15px;
            text-align:center;
        }

        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: #fff;
            margin: 10px 0;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .order-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .order-item h3 {
            font-size: 20px;
            font-weight: 600;
        }

        .order-item p {
            font-size: 16px;
            font-weight: 500;
        }

        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 40%;
            position: relative;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }
        .order-form {
            display: flex;
            flex-direction: column;
        }
        .order-form input, .order-form select, .order-form button {
            margin-bottom: 10px;
            padding: 8px;
        }

        #openModalBtn{
            background-color: #e74c3c;
            color: #fff;
            padding: 12px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.3s ease;
        }
        #openModalBtn:Hover{
            background-color:Green;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
            font-weight: bold;
            color: #333;
        }
        .close:hover {
            color: red;
        }
    </style>
    </style>
<script>
        function showOrderForm() {
            document.getElementById('orderForm').style.display = 'flex';
        }
    </script>
</head>
<body>
<nav>
    <div class="menu">
        <div class="logo">
            <a href="home.php">Prime Kicks</a>
        </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="cart.php">Mycart</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<?php if (isset($_SESSION['message'])): ?>
    <p style="color: green; font-weight: bold;"><?php echo $_SESSION['message']; ?></p>
    <?php unset($_SESSION['message']); // Clear the message after displaying ?>
<?php endif; ?>

<h2>Your Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty. Start shopping!</p>
<?php else: ?>
    <div class="cart-items">
        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
            <div class="cart-item">
                <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['title']; ?>">
                <div>
                    <h3><?php echo $item['title']; ?></h3>
                    <p>Price: Nrs. <?php echo $item['price']; ?></p>
                </div>
                <a href="cart.php?remove=<?php echo $index; ?>" class="remove-btn">Remove</a>
            </div>
        <?php endforeach; ?>
    </div>

   

     <!-- Popup Button -->
    <button id="openModalBtn" >Place Order</button>

    <!-- Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
        <button class="close" id="closeModalBtn">&times;</button>
            <h2>Order Details</h2>
            <form id="orderForm" class="order-form" method="POST" action="cart.php">
                <input type="text" name="username" placeholder="Full name" required>
                <input type="text" name="location" placeholder="Delivery location" required>
                <input type="number" name="size" placeholder="Size (Recheck)" required>
                <input type="email" name="email" placeholder="Email" required>
                
                <label for="payment_method">Choose a Payment Method:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="Mobile Banking">Mobile Banking</option>
                    <option value="Online Wallet">Online Wallet</option>
                    <option value="Cash On Delivery">Cash On Delivery</option>
                </select>
                <button type="submit" name="confirm_order_details">Submit</button>
            </form>
        </div>
    </div>

<?php endif; ?>

  <!-- After Place Order -->
<script>
        // Get elements
        const modal = document.getElementById("orderModal");
        const openModalBtn = document.getElementById("openModalBtn");
        const closeModalBtn = document.getElementById("closeModalBtn");

        // Open modal when button is clicked
        openModalBtn.onclick = function() {
            modal.style.display = "block";
        };

        // Close modal when close button is clicked
        closeModalBtn.onclick = function() {
            modal.style.display = "none";
        };

        // Close modal when clicking outside the modal
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    </script>

<h2>Confirmed Orders</h2>
<?php if ($result->num_rows > 0): ?>
    <div class="order-items">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="order-item">
                <img src="<?php echo $row['img']; ?>" alt="<?php echo $row['title']; ?>">
                <div>
                    <h3><?php echo $row['title']; ?></h3>
                    <p>Price: Nrs. <?php echo $row['price']; ?></p>
                    <p>Order Date: <?php echo $row['order_date']; ?></p>
                    <p><strong>Order Status:</strong> <?php echo $row['order_status']; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>


<footer>
    <p>Privacy Policy | Terms and Conditions</p>
    <p>&copy; 2024 Prime Kicks, Inc.</p>
</footer>
</body>
</html>
