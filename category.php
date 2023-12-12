<?php
include('config.php');

if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

    // Fetch items related to the selected category
    $result = $mysqli->query("SELECT * FROM items WHERE category_id = $categoryId");

    // Check if there are items in the category
    if ($result->num_rows > 0) {
        // Display items
        while ($row = $result->fetch_assoc()) {
            // Display item details
            echo '<div>';
            echo '<h2>' . $row['item_name'] . '</h2>';
            echo '<p>Price: $' . $row['price'] . '</p>';
            echo '<p>' . $row['product_information'] . '</p>';
            // Add more details as needed
            echo '</div>';
        }
    } else {
        echo '<p>No items found in this category.</p>';
    }

    $result->close();
    $mysqli->close();
} else {
    echo '<p>Invalid category ID.</p>';
}
?>