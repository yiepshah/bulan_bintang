<?php


session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$itemDetails = null;



$id = isset($_GET['item_id']) ? $_GET['item_id'] : 0;





if ($id) {

    $query = "SELECT item_name, image_path, price, product_information, material, inside_box FROM posts WHERE item_id = ?";
    
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        die('Error: ' . $mysqli->error);
    }

    $stmt->bind_param("i", $id);

    $stmt->execute();

    if ($stmt->error) {
        echo "Error: " . $stmt->error;
    }

    $result = $stmt->get_result();

    $mysqli->close();
    


if ($result->num_rows > 0) {
    $itemDetails = $result->fetch_assoc();
    $breadcrumb = '<a href="home.php">Home</a> / ';
    $breadcrumb .= '<a href="category.php">Baju Melayu Slim Fit</a> / ';
    $breadcrumb .= '<span>' . $itemDetails['item_name'] . '</span>';
    ?>
    <?php include ('header.php') ?>
    
        <div class="details-container">
            <div class="row">
                <div class="col-md-6">      
                    <img src="./images/<?php echo $itemDetails['image_path']; ?>" alt="<?php echo $itemDetails['item_name']; ?>" class="img-fluid small-image">       
                </div>
               
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent pl-0">
                            <li class="breadcrumb-item"><a href="index.php">HOME</a></li>
                            <li class="breadcrumb-item"><a href="category.php">BAJU MELAYU</a></li>
                            <li class="breadcrumb-item active" aria-current="page">BM TAILORED FIT</li>
                        </ol>
                    </nav>
               
                    <h4 class="h4" style="font-family: 'Oswald', sans-serif;"><?php echo $itemDetails['item_name']; ?></h4><hr>
                    <p class="detailPrice">$ <?php echo $itemDetails['price']; ?></p>
                    <div class="form-group">
                        
                        <div class="form-group">
                            <label for="size"><strong>Size:</strong></label>
                                <div id="sizeCheck" class="size-box-container">
                                    <?php
                                    $sizeOptions = array("XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL");
                                    foreach ($sizeOptions as $size) {
                                        echo '
                                            <div class="size-box">
                                                <input type="checkbox" id="size_' . $size . '" name="size[]" value="' . $size . '" class="form-check-input size-checkbox">
                                                <label for="size_' . $size . '" class="form-check-label">' . $size . '</label>
                                            </div>';
                                    }
                                    ?>
                                </div>
                        </div>

                        <form method="post" action="cart.php">
                            <input type="hidden" name="add_to_cart">
                            <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="item_name" value="<?php echo $itemDetails['item_name']; ?>">
                            <input type="hidden" name="image_path" value="<?php echo $itemDetails['image_path']; ?>">
                            <input type="hidden" name="price" value="<?php echo $itemDetails['price']; ?>">
                            <input type="hidden" name="size[]" value="<?php echo isset($_POST['size']) ? implode(',', $_POST['size']) : ''; ?>">
                            <button id="button" class="btn btn-btn" type="submit">Add to Cart</button>
                            <a href="javascript:void(0);" onclick="clearPage()" class="clear-link">Clear</a>
                        </form>

                </div><hr>
                
                <div id="details-css" class="col-md-11">
                    <p class="product-info"><strong>Product Information:</strong></p>
                    <ul>
                        <?php
                        
                        $productInfoArray = explode(', ', $itemDetails['product_information']);
                        foreach ($productInfoArray as $info) {
                            echo '<li id= product>' . $info . '</li>';
                        }
                        ?>
                    </ul>
                        
                    <p class="material-info"><strong>Material:</strong></p>
                    <ul>
                        <?php
                        
                        $productInfoArray = explode(', ', $itemDetails['material']);
                        foreach ($productInfoArray as $info) {
                            echo '<li>' . $info . '</li>';
                        }
                        ?>
                    </ul>
                        <br>
                        <p class="inside-box-info"><strong>Inside Box:</strong></p>
                    <ul>
                        <?php
                        
                        $insideBoxInfoArray = explode(', ', $itemDetails['inside_box']);
                        foreach ($insideBoxInfoArray as $info) {
                            echo '<li>' . $info . '</li>';
                        }
                        ?>
                    </ul><hr>
                </div>
            </div>
        </div>
        <?php
    } else {
       
        ?>
        <div class="details-container">
            <p class="text-danger">Error: Item not found</p>
        </div>
        <?php
    }

    
    $stmt->close();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title> <?php echo $itemDetails['item_name']; ?> ;</title>

    <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);


    .small-image {
        max-width: 100%;
        width: 800px;
        height: auto;
        border-radius: 8px;
        
    }

    .col-md-11{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;    
    }



    .text {
        font-size: 24px;
        font-family: 'Oswald', sans-serif;
        font-weight: bolder;
    }

    .size-box-container {
        display: flex;
        gap: 10px; 
        border: none;
        
    }

    .size-box {
        display: flex;
        align-items: center;
        padding: 10px;
        width: 40px;
        border: none;
        
    }

    .size-box input {
       
        display: none;
        border: none;
        
        
    }

    .size-box label {     
        border-color: white;
        border: 1px solid; 
        border-radius: 3px;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .size-box label:hover{
        transform: scale(1.4);
    }

    .h4{
        color: #003366;
        font-family: 'Times New Roman', Times, serif;
        font-weight: bolder;
    }

    #button {
        background-color: #8EBAFF; 
        color: #fff; 
        border: none; 
        border-radius: 20px 20px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        height: 40px;
        transition: transform 0.3s ease-in-out;
        
    }

    #button:hover {
        background-color: black; 
        transform: scale(1.3);
        animation-timing-function: ease-in;
    }

    .breadcrumb-item a {
        color:#4C4244 ; 
        text-decoration: none; 
        transition: color 0.3s ease; 
    }

 
    .breadcrumb-item a:hover {
        color: #0056b3; 
    }



    .clear-link {
        margin-left: 70px;         
        text-decoration: none; 
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    .clear-link:hover {
        text-decoration: underline; 
        cursor: pointer; 
    }



    #details-css{

        font-style: oblique;
    }

    .detailPrice {
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-weight: 600;
    }
    
    </style>
</head>
<body>

<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        var sizeCheckboxes = document.querySelectorAll('.size-checkbox');

        sizeCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    
                    this.nextElementSibling.style.backgroundColor = '#007bff';
                    this.nextElementSibling.style.color = '#fff';
                } else {
                    
                    this.nextElementSibling.style.backgroundColor = 'transparent';
                    this.nextElementSibling.style.color = '#007bff';
                }
            });
        });
    });
</script>

<script>
function clearPage() {
    
    location.reload();
}
</script>

    <br>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
