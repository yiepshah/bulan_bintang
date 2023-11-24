 <?php session_start()?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Collection</title>

    <?php


    $mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $query = "SELECT item_id, item_name, image_path, price FROM posts";
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
        body {
            background-image: url('your-background-image-url.jpg');
            background-repeat: repeat;
            margin: 0;
            padding: 0;
        }

        #collection {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            color: darkslategray;
            margin-top: 50px;
        }

        .items-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; 
        }

        .item {
            width: calc(32% - 20px); 
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            transition: box-shadow 0.3s ease; 
        }

        .item img {
            max-width: 100%;
            height: auto;
        }

        .item p {
            margin-top: 10px;
            font-weight: bold;
            font-size: 16px;
            color: black;
        }

        .add-to-cart a {
            display: block;
            text-decoration: none;
            color: inherit;
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

        .item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /
        }

        #detail {
            text-decoration: none;
        }

        .add-to-cart button {
            background-color: transparent; /* Set the background color to transparent */
            color: #000033;
            border: none;
            padding: 5px 10px;
        }

        .add-to-cart button:hover {
            background-color: transparent; 
            color: #0056b3;
        }

        @media (max-width: 768px) {
            .item {
                width: calc(48% - 20px); 
            }
        }

        @media (max-width: 576px) {
            .item {
                width: calc(100% - 20px); 
            }
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="items-container">
        <?php
        foreach ($items as $index => $item) {
            echo '<div class="item">';
            echo '<a id="detail" href="details.php?item_id=' . $item['item_id'] . '">';
            echo '<img src="./images/' . $item['image_path'] . '" alt="' . $item['item_name'] . '">';
            echo '<p>' . $item['item_name'] . '</p>';
            echo '<p>$' . $item['price'] . '</p>';
            echo '<div class="add-to-cart"><a href="cart.php"><button><i class="fas fa-cart-plus"></i></button></a></div>';
            echo '</a></div>';
        }
        ?>
    </div>

    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
