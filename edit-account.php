<?php
$errors = array();

// Assuming you have a user ID stored in the session
$userId = $_SESSION['user_id'] ?? null;
require "./includes/library.php";
$pdo = connectdb();
session_start();
// echo "User ID: " . $_SESSION['user_id'];

if (!$userId = $_SESSION['user_id']) {
    // Redirect to the login page if the user is not logged in
    header("Location: Login.php");
    exit;
}

if (isset($_POST['submit'])) {
    // Form Validation
    // Similar validation as in the registration page
    // ...

    if (count($errors) === 0) {
        // require "./includes/library.php";
        // $pdo = connectdb();

        // Fetch user data from the database
        $query = "SELECT * FROM credentials WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Update the user's information based on the form data
            $username = $_POST['username'] ?? $user['username'];
            $name = $_POST['name'] ?? $user['name'];
            $email = $_POST['email'] ?? $user['email'];
            $hashedPassword = $user['password']; // Retain the existing hashed password

            // Update the user's information in the database
            $updateQuery = "UPDATE credentials SET username = ?, name = ?, email = ?, password = ? WHERE id = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute([$username, $name, $email, $hashedPassword, $userId]);

            // Redirect to the main page
            header("Location: index.php");
            exit;
        }
    }
}

// Fetch user data again to pre-populate the form
$query = "SELECT * FROM credentials WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Populate form fields with existing user data
$username = $user['username'] ?? "";
$name = $user['name'] ?? "";
$email = $user['email'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <?php include './includes/nav.php'?>

    <div class="content">
        <h2 class="login"><strong>Edit Your Account</strong></h2>
        <p>Update your account information below</p>
        <section class="register">
            <form action="" method="post">
                <div>
                    <!-- Form fields remain the same, but with pre-populated values -->
                    <i class="fa-solid fa-user"></i>
                    <label for="username"><b>USERNAME: </b></label>
                    <div>
                        <input type="text" placeholder="Enter Username" name="username" id="username" value="<?= $username ?>">
                    </div>

                    <i class="fa-regular fa-address-card"></i>
                    <label for="name"><b>NAME: </b></label>
                    <div>
                        <input type="text" placeholder="Enter Name" name="name" id="name" value="<?= $name ?>">
                    </div>

                    <i class="fa-solid fa-envelope"></i>
                    <label for="email"><b>EMAIL: </b></label>
                    <div>
                        <input type="text" placeholder="Johnsmith24@email.com" name="email" id="email" value="<?= $email ?>">
                    </div>


                    <button type="submit" name="submit" id="submit">Update Account</button>
                </div>
            </form>
        </section>
        <?php include './includes/footer.php'?>
    </div>
    
</body>

</html>
