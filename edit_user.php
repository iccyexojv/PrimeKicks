<?php
session_start();
$conn = new mysqli("localhost", "root", "", "prime_kicks");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username=?, email=?, gender=?, location=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $email, $gender, $location, $role, $id);

    if ($stmt->execute()) {
        header("Location: user.php?msg=User updated successfully");
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
</head>
<body>
    <form method="post" action="edit_user.php">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>"><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
        <label>Gender:</label>
        <select name="gender">
            <option value="male" <?php if ($user['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($user['gender'] == 'female') echo 'selected'; ?>>Female</option>
        </select><br>
        <label>Location:</label>
        <input type="text" name="location" value="<?php echo $user['location']; ?>"><br>
        <label>Role:</label>
        <input type="text" name="role" value="<?php echo $user['role']; ?>"><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
