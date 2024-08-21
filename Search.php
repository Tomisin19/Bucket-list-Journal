<?php
session_start();
require './includes/library.php';
$pdo = connectdb();

// Check if the form is submitted
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];

    // Assuming you have a table named 'bucket_list_entries'
    $query = "SELECT * FROM bucket_list_entries WHERE list_name LIKE ? OR list_entry LIKE ?";
    $statement = $pdo->prepare($query);
    $statement->execute(["%$searchTerm%", "%$searchTerm%"]);
    $search_results = $statement->fetchAll(PDO::FETCH_ASSOC);
} else {
    $search_results = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>

    <?php include './includes/nav.php'?>

    <div class="content">
        <!-- Search form -->
        <form action="" method="post">
            <label for="search"><b>Search: </b></label>
            <input type="text" id="search" name="search" class="search-box">
            <button type="submit" class="search-button">Search</button>
            <button type="button" class="random-search-button">Random suggestion</button>
        </form>

        <!-- Search results -->
        <div id="search_results">
            <h2>Search results:</h2>
            <?php if (!empty($search_results)) { ?>
                <div class="result">
                    <?php foreach ($search_results as $result) { ?>
                        <div class="leg">
                            
                            <fieldset>
                                <legend class="button"><b><?php echo htmlspecialchars($result['list_entry']); ?></b>
                                    <a href="view-item.php">View Entry</a>
                                </legend>
                                <div>
                                    <label for="completed<?php echo $result['user_id']; ?>">Completed</label>
                                    <input type="checkbox" id="completed<?php echo $result['user_id']; ?>" name="completed" <?php echo $result['completed'] ? 'checked' : ''; ?>>
                                </div>
                                <p>
                                    <?php echo htmlspecialchars($result['list_description']); ?>
                                </p>
                            </fieldset>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <p>No results found.</p>
            <?php } ?>
        </div>

        <h2>Random Suggestion:</h2>
        <div id="random_suggestion">
            <div class="suggestion">
                <h3>Outdoor Adventures <i class="fa-regular fa-face-smile"></i></h3>
                <p><b>Description:</b></p>
                <p>This bucket list item represents the desire to connect with the natural
                    world, to challenge one's physical limits, and to immerse oneself in the
                    beauty and serenity of nature. It's a journey of discovery, adventure, and
                    a profound appreciation for the wonders of the Earth, reminding us of the
                    importance of preserving our planet for future generations.</p>
                <p>Written by: Jason Barkley</p>
            </div>
        </div>
        <?php include './includes/footer.php'?>
    </div>
</body>

</html>
