<?php
session_start();

require './includes/library.php';
$pdo = connectDB();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Delete all data associated with the user
try {
    // Delete bucket list entries
    $deleteEntriesQuery = "DELETE FROM bucket_list_entries WHERE user_id = ?";
    $deleteEntriesStatement = $pdo->prepare($deleteEntriesQuery);
    $deleteEntriesStatement->execute([$user_id]);

    // Delete the user account
    $deleteUserQuery = "DELETE FROM users WHERE user_id = ?";
    $deleteUserStatement = $pdo->prepare($deleteUserQuery);
    $deleteUserStatement->execute([$user_id]);

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit;
} catch (PDOException $e) {
    // Handle any errors that occur during the deletion process
    echo "Error deleting account: " . $e->getMessage();
    exit;
}
?>