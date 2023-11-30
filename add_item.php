<?php

// not settled yet 

if($_SERVER["REQUEST_METHOD"]== "POST") {
    $host = "localhost";
    $username = "root";         //check jika form ni dah submit
    $password = "";
    $database = "bulan_bintang";


    $conn = mysqli_connect($host, $username, $password, $database); // buat connection dgn database


    if (!$conn) {
        die("Connection failed:" . mysqli_connect_error()); // check connection
    }


    //buat process form data
    $item_name = $_POST["item_name"];  
    $price = $_POST["price"] ;
    $product_information = $_POST["product_information"];
    $material = $_POST["material"];
    $inside_box = $_POST["inside_box"];

    //file upload handling
    $target_dir = "images";
    $target_file = $target_dir . basename($_FILES["image_path"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    //check sama ada gambar yg di upload adalah actual image atau fake image

    $check = getimagesize($_FILES["image_path"]["tmp_name"]);
    if ($check === false) {
        echo "Sorry, your file is not an image.";
        $uploadOk = 0;
    }

   
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check size file yang di upload

    // Check size file yang di upload
if ($_FILES["image_path"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
} else {
    // Check file type (extension)
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed. Your file has extension: $fileExtension";
        $uploadOk = 0;
    }

    // Check file type (content type)
    $allowedContentTypes = array("image/jpeg", "image/png", "image/gif");
    $fileContentType = mime_content_type($_FILES["image_path"]["tmp_name"]);

    if (!in_array($fileContentType, $allowedContentTypes)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed. Your file has content type: $fileContentType";
        $uploadOk = 0;
    }
}
  
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["image_path"]["name"]) . " has been uploaded.";

            $sql = "INSERT INTO posts (image_path, item_name, price, product_information, material, inside_box) 
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $target_file, $item_name, $price, $product_information, $material, $inside_box);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Item added successfully.";
                } else {
                    echo "Error executing statement: " . mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing statement: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            justify-content: center;
            height: 100%;
            background-image: url('https://i.pinimg.com/564x/6e/94/f4/6e94f414f98de6b1323056902ff91ffb.jpg');            
            background-position: center;
            background-size:auto         
            
        }

        .container {

            border: 2px solid rgba(255, 255, 255, 2);
            box-shadow: 0 0 20px rgba(0, 0, 0, .2);
            background: transparent;
            color:#ffff; 
            backdrop-filter: blur(10px);     
            border-radius: 10px 10px;
            border: none;
        }



        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
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
            margin-bottom: 15px;

        }

        #addbtn {
            color: #ffff;
            border: none;
            margin-top: 10px;     
            background-color: #363062;     
            width: 100px; 
            
        }

        #addbtn:hover {
            background-color: black;
        }

        #bblogo {
            border-radius: 5px 5px;
            display: flex;
            justify-content: center ;
            align-items: center ;
            margin-right: 10px;
        }
        
    </style>
</head>
<?php include('header.php') ?>
<?php include('adminsidebar.php')?>
<body>    
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Add New Item</h1>
                <form action="add_item.php" method="post" enctype="multipart/form-data" class="justify-content-center">
                <img id="bblogo" src="https://bulanbintanghq.com/wp-content/uploads/2022/01/bulanbintanglogo-1040x800.png"
												style="width: 80px; height: auto; margin-right: 10px;" alt="">
                    <div class="form-group">
                        <label for="image_path">Image:</label>
                        <input class="form-control" type="file" name="image_path" id="image_path"  required accept="image/*">
                    </div><br>

                    <div class="form-group">
                        <label for="item_name">Name:</label>
                        <input type="text" class="form-control" name="item_name" id="item_name" required>
                    </div><br>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_information">Product Information:</label>
                        <input type="text" class="form-control" name="product_information" id="product_information">
                    </div><br>

                    <div class="form-group">
                        <label for="material">Material:</label>
                        <input type="text" class="form-control" name="material" id="material" required>
                    </div><br>

                    <div class="form-group">
                        <label for="inside_box">What's Inside the Box:</label>
                        <input type="text" class="form-control" name="inside_box" id="inside_box" required>
                    </div><br><br>
                
                    <button id="addbtn" class="btn" name="submit" type="submit">Add</button>

                </form>

            </div>
        </div>
    </div>

   <?php include('footer.php') ?>
</body>
</html>
