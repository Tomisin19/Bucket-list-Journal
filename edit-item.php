<?php

// Declare empty array to add errors to
$errors = array();

$Title = $_POST['title'] ?? "";
$aboutDescription = $_POST['about_description'] ?? "";
$rating = $_POST['rating'] ?? "";
$about = $_POST['about'] ?? "";
$date = $_POST['date'] ?? "";
$complete = $_POST['complete'] ?? "";



if (isset($_POST['submit'])) { 




    if (count($errors) === 0) { 
        
        
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
    <title>Edit-Item</title>
    <script defer src="./scripts/edit.js"></script>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
<?php include './includes/nav.php'?>


    <div class="content">
        <div class="top">
            <ul>
                <li class="grey"><a href="index.html">My Lists</a></li>
                <li><i class="fa-solid fa-greater-than"></i></li>
                <li class="light"><a href="">Travel Adventures</a></li>
                <li><i class="fa-solid fa-greater-than"></i></li>
                <li class="light"><a href="view-item.html">Explore Europe</a></li>
                <li><i class="fa-solid fa-greater-than"></i></li>
                <li class="dark"><a href="">Edit entry</a></li>
            </ul>
        </div>

        <h2 class="login" id="view-content"><strong>Edit List Item</strong></h2>
        <div class="backg">
        <form method = "post" action = "" id="editForm">

                <div class="edit">

                    <div>
                        <label for="title">Title: </label>
                        <input type="text" id="title" name="title" placeholder="Enter new title">
                        <span class="error <?= !isset($errors['title']) ?  'hidden' : ''  ?>">Please enter a title.</span>
                    </div>

                    <label for="about_description">Description: </label>
                    <div>
                        <textarea id="about_description" name="about_description" rows="10" cols="80"
                            ></textarea>
                        <span class="error <?= !isset($errors['about_description']) ?  'hidden' : ''  ?>">Please enter a description</span>
                        
                    </div>
                    <p><b>Rate the experience out of 5</b></p>
                    <label for="rating">Rating: </label>
                    <input type="range" id="rating" name="rating" min="1" max="5">
                    <span class="error <?= !isset($errors['rating']) ?  'hidden' : ''  ?>">Please enter a rating</span>
                </div>
                    

            <div class="about">
                <div>
                    <label for="about">About:</label>
                    <textarea id="about" name="about" rows="4" cols="100" ></textarea>
                    <span class="error <?= !isset($errors['about']) ?  'hidden' : ''  ?>">This field cannot be empty</span>
                    <span id="about-char-count"></span>
                </div>

                <fieldset>
                    <legend>Date</legend>
                    <form>
                        <div>
                            <label for="date">Started: </label>
                            <input type="date" id="date" name="date">
                            <span class="error <?= !isset($errors['title']) ?  'hidden' : ''  ?>">Please specify at least a start date.</span>
                        </div>

                        <div>
                            <label for="complete">Completed: </label>
                            <input type="date" id="complete" name="complete">
                        </div>


                </fieldset>




                <fieldset>
                    <legend>Progress</legend>
                    <div>
                        <input type="radio" id="progress-1" name="progress" value="In-progress">
                        <label for="progress-1">In-progress</label>
                    </div>

                    <div>
                        <input type="radio" id="progress-2" name="progress" value="completed">
                        <label for="progress-2">Completed</label>
                    </div>
                    <span class="error <?= !isset($errors['complete']) ?  'hidden' : ''  ?>">Please choose an option</span>
                </fieldset>

                <fieldset>
                    <legend>Proof of completion</legend>
                    <form>
                        <p>Click the "Browse" button to upload a file:</p>
                        <div>
                            <input type="file" id="myFile" name="filename">
                        </div>

                    
                </fieldset>
                <button type="submit" name="submit" id="submit">Submit update</button>
                </form>
            </div>
        </div>
        <?php include './includes/footer.php'?>
    </div>
</body>

</html>