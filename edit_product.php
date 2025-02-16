<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prime_kicks";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $price = $_POST['price'];
    $size_range = $_POST['size_range'];
    $color = $_POST['color'];
    $description = $_POST['description'];

    $sql = "UPDATE products SET title=?, price=?, size_range=?, color=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssi", $title, $price, $size_range, $color, $description, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.location.href='view_products.php';</script>";
    } else {
        echo "Error updating product: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, textarea, button {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
        }
        button {
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        .cancel-btn {
            background-color: #6c757d;
        }
        .cancel-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required>
            <label>Price:</label>
            <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            <label>Size Range:</label>
            <input type="text" name="size_range" value="<?php echo htmlspecialchars($product['size_range']); ?>" required>
            <label>Color:</label>
            <input type="text" name="color" value="<?php echo htmlspecialchars($product['color']); ?>" required>
            <label>Description:</label>
            <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <button type="submit">Update</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='view_products.php';">Cancel</button>
        </form>
    </div>
</body>
</html>
