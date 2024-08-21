<?php


$errors = array();

$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

if (isset($_POST['submit'])) {
    require './includes/library.php';
    $pdo = connectDB();

    $query = "SELECT * FROM `credentials` WHERE `username` = ?";
    $user_stmt = $pdo->prepare($query);
    $user_stmt->execute([$username]);

    // Check if the user was found
    if (!$user_stmt->fetch()) {
        $errors['username'] = true;
    } else {
        $user_stmt->execute([$username]);
        $user = $user_stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password is provided
        if (empty($password)) {
            $errors['password'] = true;
        } else {
            // If the passwords match, start the session and redirect
            if (password_verify($password, $user['password'])) {
                // Start session
                session_start();

                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];



                if (isset($_POST['remember-me']) && $_POST['remember-me'] == 'on') {
                    setcookie('remembered_user', $user['username'], time() + (30 * 24 * 60 * 60)); // 30 days
                }

                // Redirect to index.php
                header("Location: index.php");
                exit;
            } else {
                // If passwords don't match, set an error
                $errors['password'] = true;
            }
        }
    }
}
// Check if the user has a remembered cookie
if (isset($_COOKIE['remembered_user'])) {
    $remembered_user = $_COOKIE['remembered_user'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <!--Sidebar-->
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
                        <li><a href="register.php"><i class="fa-solid fa-plus"></i>Create account</a></li>
                    </ul>
                </div>
            </div>

        </div>

    </section>



    <!--Log in form-->
    <div class="content">
        <h2 class="login"><strong>Log in to an existing account</strong></h2>

        <form class="login-form" action="" method="post">
            <div>
                <span class="fa-solid fa-user"></span>
                <label for="fname"><strong>Username</strong></label>
                <div>
                    <input type="text" id="fname" name="username" placeholder="Enter username" value="<?= $username ?>">
                    <span class="error <?= !isset($errors['username']) ? 'hidden' : '' ?>">That user does not exist.</span>
                </div>
            </div>

            <div>
                <span class="fa-solid fa-lock"></span>
                <label for="lname"><strong>Password</strong></label>
                <div>
                    <input type="password" id="lname" name="password" placeholder="Enter password">
                    <span class="error <?= !isset($errors['password']) ? 'hidden' : '' ?>">That password is incorrect.</span>
                </div>
            </div>

            <div>
                <input type="checkbox" id="remember-me"  name="remember-me" <?php echo isset($_COOKIE['remembered_user']) ? 'checked' : ''; ?>>
                <label for="remember-me"> Remember me</label>
                <div class="man">
                    <input type="submit" value="submit" name = "submit">
                </div>
            </div>
            <h4><a href="forgot.php"><i>Forgot password?</i></a></h4>

        </form>
        <?php include './includes/footer.php'?>

    </div>
</body>

</html>