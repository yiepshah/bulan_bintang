<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // If the user is logged in, destroy the session to log them out
    session_destroy();
}

// Redirect the user to a login page or any other desired location
header("Location: login.php"); // Replace "login.php" with the desired destination
exit; // Make sure to exit to prevent further execution
?>