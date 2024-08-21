<?php

// Declare empty array to add errors to
$errors = array();

$username = $_POST['username'] ?? "";
$name = $_POST['name'] ?? "";
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
$password_again = $_POST['password-again'] ?? "";

if (isset($_POST['submit'])) {  // (only run if the form has just been submitted)


    // // Form Validation
    // if (strlen($username) === 0) {
    //     $errors['username'] = true; // put a flag in the errors array
    // }

    // if (strlen($name) === 0) {
    //     $errors['name'] = true; 
    // }

    // if (strlen($email) === 0) {
    //     $errors['email'] = true; 
    // }
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $errors['email'] = true;
    // }
    // if (strlen($password) === 0) {
    //     $errors['password'] = true;  
    // }
    // if (strlen($password_again) === 0) {
    //     $errors['password-again'] = true;  
    // }
    // if ($password !== $password_again){
    //     $errors['password-again'] = true; 
    // }


    if (count($errors) === 0) { 
        // require "./includes/library.php"; // Include the library file
        // $pdo = connectdb(); // Constructing a database object by calling the relevant function from the 'library.php' file
        // $query = "INSERT INTO credentials (username, name, email, password) VALUES (:username, :name, :email, :password)";
        // $stmt = $pdo->prepare($query);

        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // $stmt->bindParam(':username', $username);
        // $stmt->bindParam(':name', $name);
        // $stmt->bindParam(':email', $email);
        // $stmt->bindParam(':password', $hashedPassword);

        // // Execute the statement
        // $stmt->execute();
        
        header("Location: index.php");
        exit;
    } 




}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script defer src="./scripts/main.js"></script>
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
        <h2 class="login"><strong>Create a new account</strong></h2>
        <p>Complete the form below to create your account</p>
        <section class="register">
            <form action="" method="post" id = "form">
                <div>
                    <!--This is the form to register a user-->
                    <i class="fa-solid fa-user"></i>
                    <label for="username"><b>USERNAME: </b></label>
                    <div>
                        <input type="text" placeholder="Enter Username" name="username" id="username" value="<?= $username ?>">
                        <span class="error <?= !isset($errors['username']) ?  'hidden' : ''  ?>">Invalid username. Try again</span>
                    </div>                                      

                    <i class="fa-regular fa-address-card"></i>
                    <label for="name"><b>NAME: </b></label>
                    <div>
                        <input type="text" placeholder="Enter Name" name="name" id="name" value="<?= $name ?>">
                        <span class="error <?= !isset($errors['name']) ? 'hidden' : '' ?>">Please enter your name.</span>
                    </div>

                    <i class="fa-solid fa-envelope"></i>
                    <label for="email"><b>EMAIL: </b></label>
                    <div>
                        <input type="text" placeholder="Johnsmith24@email.com" name="email" id="email" value="<?= $email ?>">
                        <span class="error <?= !isset($errors['email']) ? 'hidden' : '' ?>">Please enter a valid email</span>
                    </div>
                    <div>
                    <i class="fa-solid fa-lock"></i>
                    <label for="passwd"><b>PASSWORD: </b></label>
                    <div>
                        <input type="password" placeholder="Enter password" name="password" id="passwd" value="<?= $password ?>">
                        <i id="show-password-icon" class="fa-solid fa-eye"></i>
                        <span class="error <?= !isset($errors['password']) ? 'hidden' : '' ?>">Please enter a valid password</span>
                    </div>
                     <!-- Password strength indicator -->
                    <progress value="0" max="100" id="password-strength"></progress>
                    <span id="password-strength-text"></span>
                    </div>
                    <i class="fa-solid fa-lock"></i>
                    <label for="password-again"><b>PASSWORD: </b></label>
                    <div>
                        <input type="password" placeholder="Enter password again" name="password-again" id="password-again" value="<?= $password_again ?>">
                            <span class="error <?= !isset($errors['password-again']) ? 'hidden' : '' ?>">Password does not match</span>
                    </div>

                    <!--This form get the list from the user-->
                    <fieldset>
                        <legend>
                            <h2>List Information</h2>
                        </legend>
                        <div>
                            <label for="list_name">List Name:</label>
                            <input type="text" id="list_name" name="list_name" required>
                        </div>

                        <label for="list_description">List Description:</label>
                        <div>
                            <textarea id="list_description" name="list_description" rows="4" cols="50"
                                required></textarea>
                        </div>

                        <div>
                            <label for="public_view">Publicly Viewable:</label>
                            <input type="checkbox" id="public_view" name="public_view">
                        </div>

                    </fieldset>
                    
                </div>
                <button type="submit" name="submit" id="submit">Register</button>
            </form>
            


        </section>
        <?php include './includes/footer.php'?>
    </div>
    
</body>

</html>