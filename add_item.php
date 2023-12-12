    <?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bulan_bintang";
    $port = 3306;

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $item_name = $_POST["item_name"];
    $price = $_POST["price"];
    $product_information = $_POST["product_information"];
    $material = $_POST["material"];
    $inside_box = $_POST["inside_box"];

    // File upload handling
    $target_dir = "C:/xampp/htdocs/bulan_bintang/images/";
    $imageFileName = $_FILES["image_path"]["name"];
    $filename = time() . '_' . $imageFileName;
    $target_file = $target_dir . $filename;
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image_path"]["tmp_name"]);
    if ($check === false) {
        echo "Sorry, your file is not an image.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["image_path"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $allowedExtensions = array("jpg", "jpeg", "png", "gif", "webp");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, and WEBP files are allowed. Your file has extension: $imageFileType";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["image_path"]["name"]) . " has been uploaded.";

            // Insert data into database
            $sql = "INSERT INTO posts (image_path, item_name, price, product_information, material, inside_box) 
            VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $filename, $item_name, $price, $product_information, $material, $inside_box);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Item added successfully.";

                    // Display the uploaded image
                    $imagePath = './images/' . $filename;
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="' . $item_name . '">';
                    } else {
                        echo 'Image not found!';
                    }
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
    <?php
    include('header.php');
    include ('adminsidebar.php');
    ?>
<head>
    <style>
        body {
            justify-content: center;
            height: 100%;
            background-image: url('https://i.pinimg.com/564x/6e/94/f4/6e94f414f98de6b1323056902ff91ffb.jpg');              
            background-size:auto                    
        }

        .container {
            border: 2px solid rgba(255, 255, 255, 2);
            box-shadow: 0 0 20px rgba(0, 0, 0, .2);
            background: transparent;
            color:#ffff; 
            /* backdrop-filter: blur(10px);      */
            border-radius: 10px 10px;
            border: none;
            margin-top: 30px;
        }



        h1 {
            text-align: center;
            font-size: 29px;
            margin-bottom: 10px;
            margin-top: 10px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
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
            background-color: #363062;     
            width: 100px;    
            transition: transform 0.3s ease-in-out; 
            border-radius: 20px 20px;   
               
        }

        #addbtn:hover {
            background-color: black;
            transform: scale(1.2);
            
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
                        <button id="addbtn" class="btn" name="submit" type="submit">Add</button>
                    </div><br><br>                  
                </form>
            </div>
        </div>
    </div>

   <?php include('footer.php') ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
