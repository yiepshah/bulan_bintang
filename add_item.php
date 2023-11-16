<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Add Item</title>


    <?php



function connectDatabase() {
    $mysqli = new mysqli("localhost", "root", "", "bulan_bintang");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    return $mysqli;
}

//METHOD BEFORE

// function uploadImage() {
//     if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK || !is_uploaded_file($_FILES["image"]["tmp_name"])) {
//         echo "Error uploading the image.";
//         return false;
//     }
    
//     $targetDirectory = __DIR__ . "/images/";
//     $targetFile = $targetDirectory . uniqid() . "_" . basename($_FILES["image"]["name"]);

//     if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
//         return $targetFile;
//     } else {
//         echo "Error moving the file to the images folder.";
//         return false;
//     }
// }

//METHOD AFTER
function uploadImage() {
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK || !is_uploaded_file($_FILES["image"]["tmp_name"])) {
        echo "Error uploading the image.";
        return false;
    }
    
    $targetDirectory = __DIR__ . "/images/";
    $uniqueFilename = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDirectory . $uniqueFilename;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        return $uniqueFilename; // Return only the unique filename without the path
    } else {
        echo "Error moving the file to the images folder.";
        return false;
    }
}

function addItemToDatabase($user_id, $itemName, $imagePath, $price, $material, $productInformation) {
    $mysqli = connectDatabase();

    $insertQuery = "INSERT INTO posts (user_id, item_name, image_path, price, material, product_information) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($insertQuery);

    if ($stmt) {
        $stmt->bind_param("isssss", $user_id, $itemName, $imagePath, $price, $material, $productInformation);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error adding item to the database: " . $stmt->error;
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
    if (empty($itemName) || empty($price)) {
        echo "Item name and price are required.";
    } else {
        $imagePath = uploadImage();

        if ($imagePath !== false) {
            // Change $id to $user_id in the function call
            if (addItemToDatabase($user_id, $itemName, $imagePath, $price, $material, $productInformation)) {
                // Display success alert with item name
                echo '<script>showSuccessAlert("' . $itemName . '");</script>';
                header('Location: adminpage.php');
                exit;
            }
        }
    }
}

?>






    <style>
        body {
            background-image: url('https://pa1.narvii.com/5811/fc8bf7368163d5f369652495826dfcd57197e2a7_hq.gif');
            /* background-image: url('https://bulanbintang.onpay.my/media/uploads/majestic%20black2.jpg'); */
            background-size: cover;
        }

        .container {
            background-color: rgba(211, 211, 211, 0.5);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            /* color: #ADA090; */
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

        input[type="file"] {
            border: none;
            
            padding: 10px;
            border-radius: 10px;
            width: 100%;
        }

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
            <button id="addbtn" class="btn" type="submit">Add</button>
        </form>
    </div>


    <script>
    function showSuccessAlert(itemName) {
        var alert = document.getElementById("success-alert");
        alert.style.display = "block";
        alert.innerHTML = '<strong>Success!</strong> ' + itemName + ' has been added to your cart.';

        // Add size information
        var sizeSelect = document.getElementById("size");
        var selectedSize = sizeSelect.options[sizeSelect.selectedIndex].text;
        alert.innerHTML += '<br>Size: ' + selectedSize;

        // Add stock information
        var stockInfo = document.getElementById("stock-info");
        var stockText = stockInfo.innerText;
        alert.innerHTML += '<br><span style="font-size: 12px; color: #555;">' + stockText + '</span>';

        setTimeout(function () {
            alert.style.display = "none";
        }, 5000); // Hide the alert after 5 seconds
    }
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
