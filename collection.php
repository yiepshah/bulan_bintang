<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <?php
    
    session_start();
    
    $items = array(
        array(
            'image' => 'path-to-large-image-1.jpg',
            'name' => 'Baju Melayu',
            'price' => 'RM279.99',
        ),
        array(
            'image' => 'path-to-large-image-2.jpg',
            'name' => 'Another Item',
            'price' => 'RM149.99',
        ),
        // Add more items here
    );
    ?>

    <script>
        function openModal(index) {
            var modal = document.getElementById("imageModal");
            var modalImage = document.getElementById("modalImage");

            modal.style.display = "block";
            modalImage.src = items[index].image;
        }

        var closeModal = document.getElementById("closeModal");
        closeModal.onclick = function () {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }
    </script>

    <style>
        /* Your custom styles here */
        body {
            background-image: url('https://i.etsystatic.com/15611670/r/il/3a6100/1515201072/il_fullxfull.1515201072_4wyu.jpg');
            background-repeat: repeat;
            background-size: cover;
        }

        .collection {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .item {
            margin: 10px;
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 200px; /* Set a fixed width for the image container */
        }

        .item img {
            max-width: 100%;
            height: 150px; /* Set a fixed height for the images */
        }

        .item h4 {
            margin-top: 10px;
        }

        .item p {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        #collection{
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        color: lightcyan;
        margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container">
        <h3 id="collection" class="collection">Collection</h3>
        <div class="collection">
            <?php
            // Display items from the $items array
            foreach ($items as $index => $item) {
                echo '<div class="item" onclick="openModal(' . $index . ')">';
                echo '<img src="' . $item['image'] . '" alt="' . $item['name'] . '">';
                echo '<h4>' . $item['name'] . '</h4>';
                echo '<p>Price: ' . $item['price'] . '</p>';
                echo '<button class="btn btn-dark">Add to Cart</button>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <div id="imageModal" class="modal">
        <span class="close" id="closeModal">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script>
        var items = <?php echo json_encode($items); ?>;

        function openModal(index) {
            var modal = document.getElementById("imageModal");
            var modalImage = document.getElementById("modalImage");

            modal.style.display = "block";
            modalImage.src = items[index].image;
        }

        var closeModal = document.getElementById("closeModal");
        closeModal.onclick = function () {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }
    </script>
</body>
</html>
