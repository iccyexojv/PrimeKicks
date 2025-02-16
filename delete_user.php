<?php
session_start();
$conn = new mysqli("localhost", "root", "", "prime_kicks");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: user.php?msg=User deleted successfully");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
