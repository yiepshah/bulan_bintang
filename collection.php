<?php
session_start();

    include('config.php');

    $mysqli = connectDatabase();
    

if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

    
    $query = "SELECT item_id, item_name, image_path, price FROM posts WHERE category_id = $categoryId ORDER BY item_id DESC";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Error: " . $mysqli->error);
    }

    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
} else {
   
    $query = "SELECT item_id, item_name, image_path, price FROM posts ORDER BY item_id DESC";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Error: " . $mysqli->error);
    }

    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

    $categoriesQuery = "SELECT category_id, category_name FROM categories where parent_id is null";
    $categoriesResult = $mysqli->query($categoriesQuery);

    if (!$categoriesResult) {
        die("Error fetching categories: " . $mysqli->error);
    }

    $categories = array();

    while ($row = $categoriesResult->fetch_assoc()) {
        $categories[] = $row;
    }

?>
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<title>Collection</title>

<head>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
        body {
            background-image: url('your-background-image-url.jpg');
            background-repeat: repeat;
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
            margin-top: 20px;
        }

        .item figure {
            position: relative;
        }

        .item {
            width: calc(32% - 20px);
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);

        }

        .item figure img {
            max-width: 100%;
            height: auto;
            border-radius: 5px 5px;

            -webkit-transition: .3s ease-in-out;
            transition: .3s ease-in-out;
        }



        .item:hover figure::before {
            opacity: 1;
        }

        .item figure::before {
            content: 'Click here';           
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 20px;
            font-weight: bold;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
          
        }

        .item p {
            margin-top: 5px;
            font-weight: bold;
            font-size: 15px;
            color: black;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        #itemprice {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: 600;

        }

        .add-to-cart a {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .item:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
        }

        #detail {
            text-decoration: none;
        }

        .add-to-cart button {
            background-color: transparent;
            color: black;
            border: none;
            padding: 1px;
            font-family: poppins, sans-serif;
            font-weight: 500;
        }

        .add-to-cart button:hover {
            background-color: transparent;
            color: #0056b3;
        }


        .categories-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .category-card {
            width: calc(32% - 20px);
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .category-link {
            text-decoration: none;
            color: black;
        }

        .category-card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 1.0);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.category-link').on('click', function (e) {
                e.preventDefault();
                var categoryId = $(this).data('category-id');
                window.location.href = 'collection.php?id=' + categoryId;
            });
        });
    </script>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="items-container">
        <?php
        foreach ($items as $index => $item) {
            echo '<div class="item">';
            echo '<a id="detail" href="details.php?item_id=' . $item['item_id'] . '">';
            echo '<figure>';
            echo '<img src="./images/' . $item['image_path'] . '" alt="' . $item['item_name'] . '">';
            echo '</figure>';
            echo '<p>' . $item['item_name'] . '</p>';
            echo '<p id=itemprice >$' . $item['price'] . '</p>';
            echo '<div class="add-to-cart">
                    <button onclick="addToCart(' . $item['item_id'] . ', \'' . $item['item_name'] . '\', ' . $item['price'] . ')">
                        Add to Cart <i class="fas fa-cart-plus"></i>
                    </button>
                </div>';
            echo '</a></div>';
        }
        ?>
    </div>








    <script>
        $(document).ready(function () {

            $('#search-icon').on('click', function () {
                $('#search-input').toggle();
            });


            $("#search-input").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".item").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>