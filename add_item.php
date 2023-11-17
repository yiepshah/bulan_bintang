<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



function connectDatabase() {
    $mysqli = new mysqli("localhost", "root", "", "bulan_bintang");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    return $mysqli;
}

function uploadImage() {
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK || !is_uploaded_file($_FILES["image"]["tmp_name"])) {
        echo "Error uploading the image.";
        return false;
    }

    $targetDirectory = __DIR__ . "/images/";
    $uniqueFilename = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDirectory . $uniqueFilename;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        return $uniqueFilename;
    } else {
        echo "Error moving the file to the images folder.";
        return false;
    }
}

function addItemToDatabase($user_id, $itemName, $imagePath, $price, $material, $productInformation, $category_id) {
    $mysqli = connectDatabase();

    $insertQuery = "INSERT INTO posts (user_id, item_name, image_path, price, material, product_information, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($insertQuery);

    if ($stmt) {
        $stmt->bind_param("isssssi", $user_id, $itemName, $imagePath, $price, $material, $productInformation, $category_id);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error adding item to the database: " . $stmt->error;
            echo " SQL Query: " . $insertQuery;
        }

        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $mysqli->error;
    }

    $mysqli->close();
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST["item_name"];
    $price = $_POST["price"];
    $user_id = 1; // Assuming a default user ID; you may need to modify this based on your user system.

    // Additional fields from the form
    $material = $_POST["material"];
    $productInformation = $_POST["product_information"];

    if (empty($itemName) || empty($price) || !isset($_POST["category"])) {
        echo "Item name, price, and category are required.";
    } else {
        $category_id = (int)$_POST["category"];

        $imagePath = uploadImage();

        if ($imagePath !== false) {
            if (addItemToDatabase($user_id, $itemName, $imagePath, $price, $material, $productInformation, $category_id)) {
                echo '<script>showSuccessAlert("' . $itemName . '");</script>';
                header('Location: adminpage.php');
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Add Item</title>

    <style>
        body {
            background-image: url('https://bulanbintang.onpay.my/media/uploads/majestic%20black2.jpg');
            background-size: cover;
        }

        .container {
            background-color: rgba(211, 211, 211, 0.5);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 90px;
        }

        #h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        #addbtn {
            color: white;
            background-color: black;
            border: none;
        }

        #addbtn:hover {
            background-color: #ADA090;
        }

        label {
            font-weight: bold;
        }

        input[type="file"],
        input[type="text"],
        input[type="number"] {
            border: none;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        #categories {
            display: flex;
            flex-wrap: wrap;
        }

        .category-options {
            display: flex;
            gap: 10px;
        }

        .category-options label {
            display: flex;
            align-items: center;
        }

        .category-options input {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 id="h1">Add New Item</h1>
        <form action="add_item.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" required accept="image/*">
            </div>

            <div class="form-group">
                <label for="item_name">Name:</label>
                <input type="text" name="item_name" id="item_name" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" required>
            </div>

            <div class="form-group">
                <label for="product_information">Product Information:</label>
                <input type="text" name="product_information" id="product_information">
            </div>

            <div class="form-group">
                <label for="material">Material:</label>
                <input type="text" name="material" id="material" required>
            </div>

            <div class="form-group">
                <label for="inside_box">What's Inside the Box:</label>
                <input type="text" name="inside_box" id="inside_box" required>
            </div>

            <div class="form-group" id="categories">
                <label for="category">Category:</label>
                <div class="category-options">
                    <label><input type="radio" name="category" value="1"> Baju Melayu</label>
                    <label><input type="radio" name="category" value="2"> Baju Melayu Slim Fit</label>
                    <label><input type="radio" name="category" value="3"> Baju Melayu Tailored Fit</label>
                    <label><input type="radio" name="category" value="4"> Baju Melayu Teluk Belanga</label>
                    <label><input type="radio" name="category" value="5"> Samping</label>
                    <label><input type="radio" name="category" value="6"> Kurta A</label>
                    <label><input type="radio" name="category" value="7"> Kurta B</label>
                    <label><input type="radio" name="category" value="8"> Kurta C</label>
                    <label><input type="radio" name="category" value="9"> Kurta D</label>
                    <label><input type="radio" name="category" value="10"> Kurta E</label>
                </div>
            </div>

            <button id="addbtn" class="btn" type="submit">Add</button>
        </form>
    </div>

    <script>
        function showSuccessAlert(itemName) {
            var alert = document.getElementById("success-alert");
            alert.style.display = "block";
            alert.innerHTML = '<strong>Success!</strong> ' + itemName + ' has been added to your cart.';

            // You can customize the success alert here

            setTimeout(function () {
                alert.style.display = "none";
            }, 5000); // Hide the alert after 5 seconds
        }
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
