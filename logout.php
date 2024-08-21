<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: Login.php"); // Replace "login.php" with the actual filename or path of your login page
exit;
?>
