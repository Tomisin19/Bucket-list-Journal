<?php
session_start();

// Assuming you have a function to connect to the database
require './includes/library.php';
$pdo = connectDB();
$user_id = $_SESSION['user_id'] ?? 0;

// Fetch bucket list entries for the user
$query = "SELECT * FROM bucket_list_entries WHERE user_id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$user_id]);
$bucket_list_entries = $statement->fetchAll(PDO::FETCH_ASSOC);

// Group entries by list name
$groupedEntries = [];
foreach ($bucket_list_entries as $entry) {
    $listName = $entry['list_name'];
    $groupedEntries[$listName][] = $entry;
}

if (isset($_POST['submit'])) {
    $new_list_name = $_POST['new-list-name'];

    // Perform the insertion into the database
    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO bucket_list_entries (user_id, list_name) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id, $new_list_name]);

    // Redirect to a page or display a message
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script defer src="./scripts/main.js"></script>
    <script src="https://kit.fontawesome.com/b7f786ff51.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>

    <?php include './includes/nav.php'?>
    
    <div class="content">
        <h2 class="welcome"><strong>Welcome to your Bucket lists</strong></h2>
        <!--Bucket list entries-->

        <?php
        // Loop through each group of entries
        foreach ($groupedEntries as $listName => $entries) {
        ?>
            <div class="leg">
                <h2>
                    <!-- Display the list name -->
                    <i class="fa-solid fa-location-dot"></i>
                    <?php echo htmlspecialchars($listName); ?>
                    <a href="delete-list.php?list_name=<?php echo $entry['list_name']; ?>"><i class="fa-solid fa-trash"></i></a>
                </h2>

                <?php
                // Check if the list has entries
                if (!empty($entries)) {
                    // Loop through entries in the current group
                    foreach ($entries as $entry) {
                    ?>
                        <fieldset>
                            <legend class="button" id = <?php echo $entry['entry_id']; ?>><b><?php echo htmlspecialchars($entry['list_entry']); ?></b>
                                <a href="edit-item.php?entry_id=<?php echo $entry['entry_id']; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="delete-item.php?entry_id=<?php echo $entry['entry_id']; ?>" class = "delete-item"><i class="fa-solid fa-trash" id = "delete-icon"></i></a>
                                <a href="view-item.php">View Entry</a>
                            </legend>
                            <div>
                                <label for="completed<?php echo $entry['user_id']; ?>">Completed</label>
                                <input type="checkbox" id="completed<?php echo $entry['user_id']; ?>" name="completed" <?php echo $entry['completed'] ? 'checked' : ''; ?>>
                            </div>
                            <p>
                                <?php echo htmlspecialchars($entry['list_description']); ?>
                            </p>
                        </fieldset>
                    <?php
                    }
                } else {
                    // Display a message if the list has no entries
                    echo "<p>No entries for this list.</p>";
                }
                ?>
            </div>
        <?php
        }
        ?>
        <h2 class="login"><strong>Add new List</strong></h2>
        <div class="add-list">
            <form action="" method="post">
                <!-- Input for adding a new list name -->
                <div class="list">
                    <label for="new-list-name">New List Name:</label>
                    <input type="text" name="new-list-name" id="new-list-name" required>
                </div>

                <div>
                    <button type="submit" name="submit">Add new List</button>
                </div>
            </form>
        </div>
        <?php include './includes/footer.php'?>
    </div>
</body>

</html>
