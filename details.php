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

    if ($result->num_rows > 0) {
        $itemDetails = $result->fetch_assoc();
        include('header.php');
        // Rest of your code to display item details...
        ?>
        <div class="details-container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Image -->
                    <img src="./images/<?php echo $itemDetails['image_path']; ?>" alt="<?php echo $itemDetails['item_name']; ?>" class="img-fluid small-image">
                </div>
                <div class="col-md-6">
                    <!-- Right column with item details and Add to Cart button -->
                    <h1 style="font-family: 'Oswald', sans-serif;"><?php echo $itemDetails['item_name']; ?></h1>
                    <p class="text">RM <?php echo $itemDetails['price']; ?></p>
                    <div class="form-group">
                        <label for="size">Size:</label>
                        <select id="size" name="size" class="form-control">
                            <option value="xs">XS</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="2xl">2XL</option>
                            <!-- Add more size options as needed -->
                        </select>
                    </div>
                    <div class="add-to-cart">
                        <button class="btn btn-info"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                    </div><br>
                </div>
                
                <div class="col-md-11">
                    <!-- Bottom section with product information, material, and inside box -->
                    <p><strong>Product Information:</strong></p>
                    <p><?php echo $itemDetails['product_information']; ?></p>
                    <p><strong>Product Information:</strong></p>
                    <p><?php echo $itemDetails['material']; ?></p>
                    <p><strong>Product Information:</strong></p>
                    <p><?php echo $itemDetails['inside_box']; ?></p>
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

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .small-image {
    max-width: 100%;
    width: 900px;
    height: auto;
    border-radius: 8px;
    
    /* Adjust the max-width and any other styles as needed */
}

.col-md-11{
    margin-left: 10px;
}

.text {
        font-size: 24px;
        font-family: 'Oswald', sans-serif;
    }

  
    </style>
</head>
<body>
    
 
    


    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
