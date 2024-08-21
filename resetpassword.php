<?php
$errors = array();

$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
$password_again = $_POST['password-again'] ?? "";



if (isset($_POST['submit'])) {  // (only run if the form has just been submitted)
    if (strlen($email) === 0) {
        $errors['email'] = true;
    }
    if (strlen($password) === 0) {
        $errors['password'] = true;  
    }
    if (strlen($password_again) === 0) {
        $errors['password-again'] = true;  
    }
    if ($password !== $password_again){
        $errors['password-again'] = true; 
    }

    if (count($errors) == 0)
    {
        // Start the session
        session_start();

        require './includes/library.php';
        $pdo = connectdb();
        // Check if the email exists in the database
        $query = "SELECT * FROM `credentials` WHERE `email` = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Email not found, handle accordingly (display error, redirect, etc.)
            $errors['email'] = true;
        } else {
            // Email found, proceed with password update
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $updateQuery = "UPDATE `credentials` SET `password` = ? WHERE `email` = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute([$hashedPassword, $email]);

            // Redirect to login.php
            header("Location: Login.php");
            exit;
        }
    }



}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot page</title>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>

    <section>
        <div class="sidenav">
            <h1><a href="index.html"><i class="fa-solid fa-bucket"></i>LifeLux</a></h1>

            <nav>
                <h2 class="heading">Explore</h2>
                <ul>
                    <li><a href="Search.html"><i class="fa-solid fa-search"></i>Search</a></li>
                    <li><a href="list.html"><i class="fa-brands fa-wpexplorer"></i>Explore public lists</a></li>
                    <li><a href="Search.html"><i class="fa-solid fa-shuffle"></i>Random list entry</a></li>
                </ul>

            </nav>

            <div class="user">
                <h3><a href="#">Join</a></h3>
                <div class="profile">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-right-to-bracket"></i>Log in</a></li>
                        <li><a href="register.html"><i class="fa-solid fa-plus"></i>Create account</a></li>
                    </ul>
                </div>
            </div>

        </div>

    </section>


    <div class="content">
        <h2 class="login"><strong>Reset Password</strong></h2>
        <p><b>Enter your new password</b></p>
        
        <form class="forgot-form" action="" method="post">
            <div>
                <!--This is the form used to reset your password-->
                
                <div class="new-password">
                <i class="fa-solid fa-envelope"></i>
                    <label for="email"><b>EMAIL: </b></label>
                    <div>
                        <input type="text" placeholder="Johnsmith24@email.com" name="email" id="email" value="<?= $email ?>">
                        <span class="error <?= !isset($errors['email']) ? 'hidden' : '' ?>">Please enter a valid email</span>
                    </div>
                    <i class="fa-solid fa-lock"></i>
                    <label for="password-again"><b>PASSWORD: </b></label>
                    <div>

                        <input type="password" placeholder="Enter new password" name="password" id="passwd">
                        <span class="error <?= !isset($errors['password']) ? 'hidden' : '' ?>">Please enter a valid password</span>
                    </div>

                    <i class="fa-solid fa-lock"></i>
                    <label for="password-again"><b>PASSWORD: </b></label>
                    <div>
                        <input type="password" placeholder="Enter password again" name="password-again"
                            id="password-again">
                            <span class="error <?= !isset($errors['password-again']) ? 'hidden' : '' ?>">Password does not match</span>
                    </div>
                    <button type="submit" name = "submit" id="submit">Save password</button>
                </div>

 
            </div>
        </form>
        <?php include './includes/footer.php'?>
    </div>
    
</body>

</html>