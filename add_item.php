<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Add Item</title>
    <?php
session_start();

// Data connection
$mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Validate and sanitize form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST["item_name"];
    $price = $_POST["price"];
    $user_id = 1; // Replace with user authentication logic

    if (empty($itemName) || empty($price)) {
        echo "Item name and price are required.";
    } elseif (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK || !is_uploaded_file($_FILES["image"]["tmp_name"])) {
        echo "Error uploading the image.";
    } elseif (getimagesize($_FILES["image"]["tmp_name"]) === false) {
        echo "Uploaded file is not a valid image.";
    } else {
        // Handle file upload and insert data
        $targetDirectory = __DIR__ . "/uploads/";
        $targetFile = $targetDirectory . uniqid() . "_" . basename($_FILES["image"]["name"]);
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // The file has been successfully moved to the uploads folder.

            // Now, insert the image information into the database
            $insertQuery = "INSERT INTO posts (user_id, item_name, image, price) VALUES (?, ?, ?, ?)";
            
            // Prepare the SQL statement
            $stmt = $mysqli->prepare($insertQuery);
            if ($stmt) {
                // Bind parameters and execute the statement
                $stmt->bind_param("isss", $user_id, $itemName, $targetFile, $price);
                if ($stmt->execute()) {
                    echo '<script>showSuccessAlert();</script>';
                } else {
                    echo "Error adding item to the database: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing the SQL statement: " . $mysqli->error;
            }
        } else {
            echo "Error moving the file to the uploads folder.";
        }
    }
}



// Close the database connection
$mysqli->close();
?>

    <style>
        body {
            background-image: url('https://i.pinimg.com/474x/68/91/fa/6891faac15a83ab550192a3acdab939e.jpg');
            /* background-size: cover; */
            /* background-repeat: no-repeat;
            background-attachment: fixed; */
        }

        .container {
            background-color: #70573f;
            padding: 20px;
            border-radius: 20px;
            margin-top: 100px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #ADA090;
        }

        #h1 {
            color: #ADA090;
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        #addbtn {
            background-color: #947f65;
            color: white;
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
            background-color: #ADA090;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
        }

        input[type="text"],
        input[type="number"] {
            border: none;
            background-color: #ADA090;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            margin-top: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>



<body>
    <?php include('header.php'); ?>

    <div class="container">
        <h1 id="h1">Add New Item</h1>
        <form action="add_item.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" required accept="image/*">
            </div>

            <div class="form-group">
                <label for="item_name">Name:</label>
                <input type="text" name="item_name" id="item_name" required accept="image/*">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" required>
            </div>

            <button id="addbtn" class="btn" type="submit">Add</button>
        </form>
    </div>

    <?php include('footer.php'); ?>

    <div id="success-alert" class="alert alert-success alert-dismissible fade show" style="display: none;">
        <strong>Success!</strong> Item added successfully.
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>

    <script>
        function showSuccessAlert() {
            var alert = document.getElementById("success-alert");
            alert.style.display = "block";
            setTimeout(function () {
                alert.style.display = "none";
            }, 3000); // Hide the alert after 3 seconds
        }
    </script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
