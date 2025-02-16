<?php
session_start();

// Check if the user is an admin
if (isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin') {
    // Destroy the session to log out the admin
    header("Location: index.php"); // Redirect to the login or homepage
    exit;
} else {
    // If the user is not an admin, redirect them to a different page or deny access
    header("Location: index.php"); // Create an unauthorized access page
    exit;
}
?>
