<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include('config.php');

if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

 
    $categoryName = getCategoryName($categoryId);

    
    $products = getProductsByCategory($categoryId);

    echo '<h2>' . $categoryName . '</h2>';

  
    foreach ($products as $product) {
        echo '<div>';
        echo '<h3>' . $product['item_name'] . '</h3>';
       
        echo '</div>';
    }
} else {
   
    echo 'No category selected.';
}


function getCategoryName($categoryId) {
    $mysqli = connectDatabase();
    $stmt = $mysqli->prepare("SELECT category_name FROM categories WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();
    $stmt->close();
    $mysqli->close();
    return $category['category_name'];
}

function getProductsByCategory($categoryId) {
    $mysqli = connectDatabase();
    $stmt = $mysqli->prepare("SELECT * FROM posts WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();
    $mysqli->close();

    return $products;
}
?>

    
</body>
</html>