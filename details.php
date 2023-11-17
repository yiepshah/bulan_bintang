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

// Step 1: Check if id is set in the URL
$id = isset($_GET['item_id']) ? $_GET['item_id'] : 0;

// Output the received item ID for debugging
// echo "Debug: Item ID from URL: " . $id;

if ($id) {
    // Step 2: Prepare and execute the SQL query
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
    

 // Check if the item is found
if ($result->num_rows > 0) {
    $itemDetails = $result->fetch_assoc();

    // Generate breadcrumb based on item details
    $breadcrumb = '<a href="home.php">Home</a> / ';
    $breadcrumb .= '<a href="category.php">Baju Melayu Slim Fit</a> / ';
    $breadcrumb .= '<span>' . $itemDetails['item_name'] . '</span>';

    // Include header with breadcrumb
    include('header.php');
    
    ?>
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
                    <!-- Right column with item details and Add to Cart button -->
                    <h4 class="h4" style="font-family: 'Oswald', sans-serif;"><?php echo $itemDetails['item_name']; ?></h4><hr>
                    <p class="text">RM <?php echo $itemDetails['price']; ?></p>
                    <div class="form-group">
                        
                        <div class="form-group">
                            <label for="size">Size:</label>
                            <div class="size-box-container">
                                <?php
                                // Array of size options
                                $sizeOptions = array("XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL","5XL");

                                foreach ($sizeOptions as $size) {
                                    ?>
                                    <div class="size-box">
                                        <input type="checkbox" id="size_<?php echo $size; ?>" name="size[]" value="<?php echo $size; ?>" class="form-check-input size-checkbox">
                                        <label for="size_<?php echo $size; ?>" class="form-check-label"><?php echo $size; ?></label>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                    <form method="post" action="cart.php">
                        <!-- Add hidden input fields to send item details to the cart page -->
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="item_name" value="<?php echo $itemDetails['item_name']; ?>">
                        <input type="hidden" name="price" value="<?php echo $itemDetails['price']; ?>"><br>
                        <!-- Add more hidden fields as needed (e.g., size) -->



                        <div class="add-to-cart d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-info">Add to Cart</button>
                            <!-- Move the Clear link to the right -->
                            <a href="#" onclick="clearPage()">Clear</a>
                        </div><hr>
                    </form>
                </div>
                
                <div class="col-md-11">
                    <p class="product-info"><strong>Product Information:</strong></p>
                    <ul>
                        <?php
                        // Assuming $itemDetails['product_information'] is a comma-separated string
                        $productInfoArray = explode(', ', $itemDetails['product_information']);
                        foreach ($productInfoArray as $info) {
                            echo '<li>' . $info . '</li>';
                        }
                        ?>
                    </ul>
                        
                    <p class="material-info"><strong>Material:</strong></p>
                    <ul>
                        <?php
                        // Assuming $itemDetails['product_information'] is a comma-separated string
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
                        // Assuming $itemDetails['product_information'] is a comma-separated string
                        $productInfoArray = explode(', ', $itemDetails['inside_box']);
                        foreach ($productInfoArray as $info) {
                            echo '<li>' . $info . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    } else {
        // Step 4: Handle the case when the item is not found
        ?>
        <div class="details-container">
            <p class="text-danger">Error: Item not found</p>
        </div>
        <?php
    }

    // Close the statement
    $stmt->close();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title> <?php echo($item_name)?> ;</title>
    <style>

        .small-image {
        max-width: 100%;
        width: 900px;
        height: auto;
        border-radius: 8px;
        margin-left: 10px;
        
        /* Adjust the max-width and any other styles as needed */
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
        gap: 10px; /* Adjust the spacing between size boxes as needed */
    }

    .size-box {
        display: flex;
        align-items: center;
    }

    .size-box input {
        /* Hide the checkbox */
        display: none;
    }

    .size-box label {     
        border-color: white;
        border: 1px solid; /* Add border for styling */    
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .size-box input:checked + label {
        background-color: darkgrey;
        color: #fff;
    }

    .h4{
        color: #003366;
        font-family: 'Times New Roman', Times, serif;
        font-weight: bolder;
    }

    .add-to-cart button {
        background-color: #8EBAFF; /* Change the background color to your preferred color */
        color: #fff; /* Change the text color to white or another contrasting color */
        border: 1px solid #8EBAFF; /* Add a border for styling */
        border-radius: 20px 20px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        height: 40px;
    }

    .add-to-cart button:hover {
        background-color: #003366; /* Change the background color on hover */
    }

    .breadcrumb-item a {
    color:#4C4244 ; /* Change this color to your desired color */
    text-decoration: none; /* Remove the default underline */
    transition: color 0.3s ease; /* Add a smooth color transition on hover */
    }

    /* Change the color on hover */
    .breadcrumb-item a:hover {
        color: #0056b3; /* Change this color to your desired hover color */
    }






  
    </style>
</head>
<body>
    
 
<script>
    // Add this script to handle checkbox behavior
    document.addEventListener("DOMContentLoaded", function () {
        var sizeCheckboxes = document.querySelectorAll('.size-checkbox');

        sizeCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    // If checkbox is checked, change the color
                    this.nextElementSibling.style.backgroundColor = '#007bff';
                    this.nextElementSibling.style.color = '#fff';
                } else {
                    // If checkbox is unchecked, change the color back to transparent
                    this.nextElementSibling.style.backgroundColor = 'transparent';
                    this.nextElementSibling.style.color = '#007bff';
                }
            });
        });
    });
</script>

<script>
function clearPage() {
    // Reload the current page
    location.reload();
}
</script>

    <br>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
