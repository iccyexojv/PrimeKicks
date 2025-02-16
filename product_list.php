<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "prime_kicks"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product list with order and payment statuses
$sql = "SELECT id, title, price, order_status, payment_status FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - Prime Kicks</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background: #1b1b1b;
            color: #fff;
        }
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .Pending {
            background: #f39c12;
            color: #fff;
        }
        .Shipping {
            background: #3498db;
            color: #fff;
        }
        .Completed {
            background: #2ecc71;
            color: #fff;
        }
        .Unpaid {
            background: #e74c3c;
            color: #fff;
        }
        .Paid {
            background: #2ecc71;
            color: #fff;
        }
    </style>
</head>
<body>

<h1>Product List with Order and Payment Statuses</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Price (Nrs.)</th>
                <th>Order Status</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td>
                        <span class="status <?php echo $row['order_status']; ?>">
                            <?php echo $row['order_status']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="status <?php echo $row['payment_status']; ?>">
                            <?php echo $row['payment_status']; ?>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No products found.</p>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
