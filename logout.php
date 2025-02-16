<?php
session_start();

// Check if the user is logged in and their role
if (isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'user') {
    // Logout process for users
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect users to the main page
    exit;
} else {
    // If not a user, redirect back to the admin profile or another appropriate page
    header("Location: index.php");
    exit;
}
?>
