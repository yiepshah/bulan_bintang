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

$mysqli = connectDatabase();

function connectDatabase() {
    $hostname = "localhost"; 
    $username = "root"; 
    $password = " "; 
    $database = "bulan_bintang";

    $mysqli = new mysqli($hostname, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    return $mysqli;
}

if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

    $mysqli = connectDatabase();

    
    $categoryName = getCategoryName($mysqli, $categoryId);

    echo '<h2>' . $categoryName . '</h2>';

    
    $products = getProductsByCategory($mysqli, $categoryId);

    foreach ($products as $product) {
        echo '<div>';
        echo '<h3>' . $product['item_name'] . '</h3>';
        
        echo '</div>';
    }

    $mysqli->close();
    } else {
        echo 'No category selected.';
    }


function getCategoryName($mysqli, $categoryId) {
        $stmt = $mysqli->prepare("SELECT category_name FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        $stmt->close();
        return $category['category_name'];
    }

    function getProductsByCategory($mysqli, $categoryId) {
        $stmt = $mysqli->prepare("SELECT * FROM posts WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $stmt->close();

        return $products;
    }
?>

    
</body>
</html>