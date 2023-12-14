
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <title>Document</title>

    <style>
        .w3-sidebar:hover + .main--content {
            margin-left: 200px;
        }

        .w3-sidebar a {
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            padding: 30px;
            text-align: center;
        }

        .w3-sidebar:hover {
            width: 200px;
        }

        .w3-sidebar {
            height: 100%;
            width: 90px;
            background-color: #111;
            position: fixed;
            overflow-x: hidden;
             transition: width 0.3s;
            z-index: 1;
        }

        @media (max-width: 768px) {
    .w3-sidebar {
        width: 10px;
    }

    .w3-sidebar:hover {
        width: 200px;
    }

    .main--content {
        width: calc(100% - 200px);
        margin-left: 200px;
    }
}


    </style>
</head>
<body>
<div class="w3-sidebar">
    <a href="adminpage.php" class="w3-bar-item w3-button" title="Home"><i class="fa fa-home"></i></a>
    
    <a href="collection.php" class="w3-bar-item w3-button" title="Store"><i class="fas fa-store"></i></a>
   
    <?php

    if (isset($_SESSION['user_id'])) {
        echo '<a class="nav-link" title="Add Item" href="add_item.php"><i class="fas fa-plus"></i></a>';
    }

    if (isset($_SESSION['user_id'])) {
        echo '<a class="nav-link" title="Log out" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>';
    }
    ?>

</div>



</body>
</html>