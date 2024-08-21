<?php


$errors = array();

$username = $_POST['username'] ?? "";
$email = $_POST['email'] ?? "";


if (isset($_POST['submit'])) {  // (only run if the form has just been submitted)
    require './includes/library.php';
    $pdo = connectDB();

    $query = "SELECT * FROM `credentials` WHERE `username` = ?";
    $user_stmt = $pdo->prepare($query);
    $user_stmt->execute([$username]);

    // Check if the user was found
    if (!$user_stmt->fetch()) {
        $errors['username'] = true;
    } else {
        $query = "SELECT * FROM `credentials` WHERE `username` = ? AND `email` = ?";
        $user_stmt = $pdo->prepare($query);
        $user_stmt->execute([$username, $email]);

        if ($user_stmt->fetch()) {
            // Redirect to mail.php to send a mail
            header("Location: ./includes/mail.php?username=$username&email=$email");
            exit;
        } else {
            
            $errors['email'] = true;
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
        <p>Enter your E-mail and Username to reset your password</p>
        <p>If an account exists with this E-mail, a link would be sent to your inbox to reset your password </p>
        <form class="forgot-form" action="" method="post">
            <div>
                <!--This is the for used to reset your password-->


                <div class="reset">
                    <i class="fa-solid fa-user"></i>
                    <label for="username">Username: </label>
                    <div>
                        <input type="text" id="username" placeholder="Enter your username" name="username" value="<?= $username ?>">
                        <span class="error <?= !isset($errors['username']) ? 'hidden' : '' ?>">That user does not exist.</span>
                    </div>

                    <i class="fa-solid fa-envelope"></i>
                    <label for="email">Email: </label>
                    <div>
                        <input type="text" id="email" placeholder="Johnsmith24@email.com" name="email" value="<?= $email ?>">
                    </div>
                    <div>
                        <button type="submit" name="submit" id="submit">Reset Password</button>
                    </div>
                </div>


            </div>
        </form>
        <?php include './includes/footer.php'?>
    </div>
    
</body>

</html>