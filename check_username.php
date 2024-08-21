<?php
// Assuming you have a function to connect to the database
require './includes/library.php';
$pdo = connectDB();

// Get the username from the AJAX request
$username = $_POST['username'] ?? '';

// Check if the username already exists
$query = "SELECT COUNT(*) FROM credentials WHERE username = ?";
$statement = $pdo->prepare($query);
$statement->execute([$username]);
$count = $statement->fetchColumn();

// Return the result as JSON
echo json_encode(['exists' => $count > 0]);
?>
