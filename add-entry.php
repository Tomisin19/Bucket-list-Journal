<?php
session_start();

require './includes/library.php';
$pdo = connectDB();


// Fetch list names from the database
$user_id = $_SESSION['user_id'];
$listNamesQuery = "SELECT DISTINCT list_name FROM bucket_list_entries WHERE user_id = ?";
$stmtListNames = $pdo->prepare($listNamesQuery);
$stmtListNames->execute([$user_id]);
$listNames = $stmtListNames->fetchAll(PDO::FETCH_COLUMN);


if (isset($_POST['submit'])) {

    $list_name = $_POST['list_name'];
    $user_id = $_SESSION['user_id'];
    $list_entry = $_POST['new-list'];
    $list_description = $_POST['list_description'];
    $view = $_POST['view'];

    // Perform the insertion into the database
    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO bucket_list_entries (user_id, list_name, list_entry, list_description, view) 
              VALUES (?,?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id,$list_name, $list_entry, $list_description, $view]);

    // Redirect to a page or display a message
    header("Location: index.php");
    exit;

}
// Fetch list names from the database
$user_id = $_SESSION['user_id'];
$listNamesQuery = "SELECT DISTINCT list_name FROM bucket_list_entries WHERE user_id = ?";
$stmtListNames = $pdo->prepare($listNamesQuery);
$stmtListNames->execute([$user_id]);
$listNames = $stmtListNames->fetchAll(PDO::FETCH_COLUMN);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new list</title>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <?php include './includes/nav.php'?>

    <div class="content">
        <h2 class="login"><strong>Add new List entry</strong></h2>
        <div class="add-list">
            <form action = "" method = "post">
            
            <div class="list">
                    <label for="list_name">List Name:</label>
                    <select name="list_name" id="list_name">
                        <?php foreach ($listNames as $name) : ?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                <label for="new-list">Entry Name:</label>
                <input type="text" name="new-list" id="new-list">
            </div>

            <div class="list">
                <label for="list_description"> List Description:</label>
                <textarea id="list_description" name="list_description" rows="4" cols="50" required></textarea>
            </div>

            <div class="radio">
                <div>
                    <input type="radio" id="public" name="view" value="public">
                    <label for="public">Public List</label>
                </div>

                <div>
                    <input type="radio" id="private" name="view" value="private">
                    <label for="private">Private List</label>
                </div>
            </div>
            <div>
                <button type="submit" name = "submit">Add new List entry</button>
            </div>
            </form>
        </div>
        <?php include './includes/footer.php'?>
    </div>


</body>

</html>