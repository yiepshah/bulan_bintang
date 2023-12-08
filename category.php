<?php
include('config.php');

if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

    // Fetch items related to the selected category
    $result = $mysqli->query("SELECT * FROM items WHERE category_id = $categoryId");

    // Display items
    while ($row = $result->fetch_assoc()) {
        // Display item details
    }

    $mysqli->close();
}
?>