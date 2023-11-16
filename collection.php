<!-- collection.php -->

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Collection</title>
<head>


    <?php
    session_start();

    $mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $query = "SELECT item_id, item_name, image_path, price FROM posts"; // Added item_id to the query
    $result = $mysqli->query($query);

    if (!$result) {
        die("Error: " . $mysqli->error);
    }

    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    ?>

    <style>
        /* Your existing styles here */
        body {
            background-image: url('your-background-image-url.jpg');
            background-repeat: repeat;
        }

        #collection {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            color: darkslategray;
            margin-top: 50px;
        }

        .item {
            width: 23%;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
        }

        .item img {
            max-width: 100%;
            height: auto;
        }

        .item p {
            margin-top: 10px;
        }

        .item p {
            font-weight: bold;
            font-size: 16px;
            color: black;
            
            
        }

        .add-to-cart a {
            display: block; /* Make the link fill the entire container */
            text-decoration: none; /* Remove default underline style */
            color: inherit; /* Use the parent's color */
        }

        .add-to-cart button {
            background-color: #000033;
            color: white;
            border: none;
            padding: 5px 10px;
        }

        .add-to-cart button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 992px) {
            .item {
                width: 25%;
            }
        }

        @media (max-width: 768px) {
            .item {
                width: 33.33%;
            }
        }

        @media (max-width: 576px) {
            .item {
                width: 50%;
            }
        }

        #detail{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="">

    <?php
    foreach ($items as $index => $item) {
        echo '<div class="item">';
        echo '<a id = "detail" href="details.php?item_id=' . $item['item_id'] . '">';
        echo '<img src="./images/' . $item['image_path'] . '" alt="' . $item['item_name'] . '">';
        echo '<p>' . $item['item_name'] . '</p>';
        echo '<p>' . $item['price'] . '</p>';
        echo '<div class="add-to-cart"><a href="cart.php"><button><i class="fas fa-cart-plus"></i></button></a></div>';
        echo '</a></div>';
    }
    ?>

    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
