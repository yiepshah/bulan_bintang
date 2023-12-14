<?php
include('config.php');

if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

 
    $result = $mysqli->query("SELECT * FROM items WHERE category_id = $categoryId");

    
    if ($result->num_rows > 0) {
     
        while ($row = $result->fetch_assoc()) {
            
            echo '<div>';
            echo '<h2>' . $row['item_name'] . '</h2>';
            echo '<p>Price: $' . $row['price'] . '</p>';
            echo '<p>' . $row['product_information'] . '</p>';
            
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