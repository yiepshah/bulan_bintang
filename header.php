<?php

// Include the file with the database connection function
include('config.php');

// Check if 'id' is set in the query parameters
if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

    // Fetch products based on the selected category
    $mysqli = connectDatabase(); // Assuming connectDatabase() is defined in your database file
    echo "SELECT * FROM posts WHERE category_id = $categoryId";
    $result = $mysqli->query("SELECT * FROM posts WHERE category_id = $categoryId");

    if (!$result) {
        echo "Error: " . $mysqli->error;
    }

    $stmt = $mysqli->prepare("SELECT * FROM posts WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display products
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<h2>' . $row['item_name'] . '</h2>';
        // Add more product information as needed
        echo '</div>';
    }

    $mysqli->close(); // Close the database connection
} else {
    // Handle cases where no category is selected
    ;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>


    <style>
         .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color:white; 
        padding: 10px; 
    }

    .logo {
        height: 62px;
    }

    .nav-item.dropdown:hover .dropdown-menu {
    display: block;
}

   
    .navbar .navbar-nav .nav-item a {
        color: #000033; 
        font-weight: 500; 
        margin-right: 20px;
        text-decoration: none; 
    }

    
    .navbar .navbar-nav .nav-item a:hover {
        color: #000033;
    }

    
    .navbar .navbar-nav .nav-item i {
        margin-right: 10px; 
    }

  

    #loginbutton{
        margin-right: 40px ;
        background-color:#033366 ;
    }

    #logoutbtn{
        margin-right: 10px;
    }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="https://th.bing.com/th/id/OIP.IV6E-NjlfboqXML32zgvtAHaFs?w=247&h=190&c=7&r=0&o=5&pid=1.7" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    
                <?php
                    // Fetch categories from the database
                    $mysqli = connectDatabase(); // Ensure you have the connectDatabase() function
                    $result = $mysqli->query("SELECT * FROM categories"); // Assuming you have a 'categories' table

                    while ($row = $result->fetch_assoc()) {
                        $categoryId = $row['category_id'];
                        $categoryName = $row['category_name'];
                        echo '<li class="nav-item"><a class="nav-link" href="category.php?id=' . $categoryId . '">' . $categoryName . '</a></li>';
                    }

                    $mysqli->close();
                    ?>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="collection.php" role="button" data-toggle="dropdown">Men</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="collection.php?category=baju_melayu">BAJU MELAYU</a></li>
                            <li><a class="dropdown-item" href="collection.php?category=slim_fit">Baju Melayu Slim Fit</a></li>
                            <li><a class="dropdown-item" href="#">Baju Melayu Tailored Fit</a></li>
                            <li><a class="dropdown-item" href="#">Baju Melayu Teluk Belanga</a></li>
                            <li><a class="dropdown-item" href="#">Samping</a></li><hr> 

                            <li><a class="dropdown-item" href="#">KURTA</a></li>
                            <li><a class="dropdown-item" href="#">kurta A</a></li>
                            <li><a class="dropdown-item" href="#">kurta B</a></li>
                            <li><a class="dropdown-item" href="#">kurta C</a></li>
                            <li><a class="dropdown-item" href="#">kurta D</a></li>
                            <li><a class="dropdown-item" href="#">kurta E</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown">Women</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">GLAM SILVER</a></li>
                        <li><a class="dropdown-item" href="#">Adeline</a></li>
                        <li><a class="dropdown-item" href="#">Alyssa</a></li>
                        <li><a class="dropdown-item" href="#">Amy</a></li>
                        <li><a class="dropdown-item" href="#">Camelia</a></li>
                        <li><a class="dropdown-item" href="#">Dayana</a></li>
                        <li><a class="dropdown-item" href="#">Elyana</a></li>
                        <li><a class="dropdown-item" href="#">Jessica</a></li>
                        <li><a class="dropdown-item" href="#">Lana</a></li>
                        <li><a class="dropdown-item" href="#">Marsha</a></li>
                        <li><a class="dropdown-item" href="#">Tyra</a></li> <hr>
                        <li><a class="dropdown-item" href="#">Glam Gold</a></li>
                        <li><a class="dropdown-item" href="#">Alicia</a></li>
                        <li><a class="dropdown-item" href="#">Emelda</a></li>
                        <li><a class="dropdown-item" href="#">Elisya</a></li>
                        <li><a class="dropdown-item" href="#">Emma</a></li>
                        <li><a class="dropdown-item" href="#">Fasha</a></li>
                        <li><a class="dropdown-item" href="#">Ladyyana</a></li>
                        <li><a class="dropdown-item" href="#">Olivia</a></li>
                        <li><a class="dropdown-item" href="#">Sabrina</a></li>
                        <li><a class="dropdown-item" href="#">Victoria</a></li><hr>
                        <li><a class="dropdown-item" href="#">GLAM PLATINUM</a></li>
                        <li><a class="dropdown-item" href="#">Ariana</a></li>
                        <li><a class="dropdown-item" href="#">Dayang</a></li>
                        <li><a class="dropdown-item" href="#">Deanna</a></li>
                        <li><a class="dropdown-item" href="#">Delisha</a></li><hr>
                        <li><a class="dropdown-item" href="#">LUXE SILVER</a></li>
                        <li><a class="dropdown-item" href="#">Amely</a></li>
                        <li><a class="dropdown-item" href="#">Anna</a></li>
                        <li><a class="dropdown-item" href="#">Adriana</a></li>
                        <li><a class="dropdown-item" href="#">Bella</a></li>
                        <li><a class="dropdown-item" href="#">Betty</a></li>
                        <li><a class="dropdown-item" href="#">Hanna</a></li>
                        <li><a class="dropdown-item" href="#">Janna</a></li>
                        <li><a class="dropdown-item" href="#">Lisa</a></li>
                        <li><a class="dropdown-item" href="#">Marisa</a></li>
                        <li><a class="dropdown-item" href="#">Nelissa</a></li>
                        <li><a class="dropdown-item" href="#">Nelydia</a></li>
                        <li><a class="dropdown-item" href="#">Sally</a></li><hr>
                        <li><a class="dropdown-item" href="#">LUXE BRONZE</a></li>
                        <li><a class="dropdown-item" href="#">Dynass</a></li>
                        <li><a class="dropdown-item" href="#">Farah</a></li>
                        <li><a class="dropdown-item" href="#">Nabila</a></li>
                        <li><a class="dropdown-item" href="#">Natalie</a></li>
                        <li><a class="dropdown-item" href="#">Reena</a></li><hr>
                        <li><a class="dropdown-item" href="#">LUXE GOLD</a></li>
                        <li><a class="dropdown-item" href="#">Elly</a></li>
                        <li><a class="dropdown-item" href="#">Joanna</a></li>
                        <li><a class="dropdown-item" href="#">Leyna</a></li>
                        <li><a class="dropdown-item" href="#">Amelia</a></li>
                        <li><a class="dropdown-item" href="#">Suzy</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown">Kids</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">BAJU MELAYU KIDS</a></li>
                        <li><a class="dropdown-item" href="#">Baju Melayu Kids</a></li><hr>
                        <li><a class="dropdown-item" href="#">GLAM KIDS</a></li>
                        <li><a class="dropdown-item" href="#">Adeline</a></li>
                        <li><a class="dropdown-item" href="#">Alyssa</a></li>
                        <li><a class="dropdown-item" href="#">Ariana</a></li>
                        <li><a class="dropdown-item" href="#">Camelia</a></li>
                        <li><a class="dropdown-item" href="#">Dayang</a></li>
                        <li><a class="dropdown-item" href="#">Dynas</a></li>
                        <li><a class="dropdown-item" href="#">Eleena</a></li>
                        <li><a class="dropdown-item" href="#">Emelda</a></li>
                        <li><a class="dropdown-item" href="#">Emma</a></li>
                        
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown">Warna Sedondon</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Colour</a></li><br>
                        <li><a class="dropdown-item" href="#">Black</a></li><br>
                        <li><a class="dropdown-item" href="#">Blue</a></li><br>
                        <li><a class="dropdown-item" href="#">Earth Tone</a></li><br>
                        <li><a class="dropdown-item" href="#">Green</a></li><br>
                        <li><a class="dropdown-item" href="#">Yellow</a></li><br>
                        <li><a class="dropdown-item" href="#">Orange</a></li><br>
                        <li><a class="dropdown-item" href="#">Purple</a></li><br>
                        <li><a class="dropdown-item" href="#">Red</a></li>
                    </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Blogs</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown">SALE</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">BRIDAL</a></li>
                        <li><a class="dropdown-item" href="#">Thea</a></li>
                        <li><a class="dropdown-item" href="#">Halley</a></li>
                        <li><a class="dropdown-item" href="#">Elara</a></li>
                        <li><a class="dropdown-item" href="#">Lilith</a></li>
                        <li><a class="dropdown-item" href="#">Aurora</a></li>
                        <li><a class="dropdown-item" href="#">Nova</a></li>
                        <li><a class="dropdown-item" href="#">Delilah</a></li>
                        <li><a class="dropdown-item" href="#">Zania</a></li>
                        <li><a class="dropdown-item" href="#">Ayra</a></li>
                        <li><a class="dropdown-item" href="#">Alya</a></li>
                        <li><a class="dropdown-item" href="#">Juliet</a></li>
                        <li><a class="dropdown-item" href="#">Freya</a></li>
                        <li><a class="dropdown-item" href="#">Bianca</a></li>
                        <li><a class="dropdown-item" href="#">Athena</a></li>
                        <li><a class="dropdown-item" href="#">Laryssa</a></li><hr>
                        <li><a class="dropdown-item" href="#">SISTERS</a></li>
                        <li><a class="dropdown-item" href="#">Zahra</a></li>
                        <li><a class="dropdown-item" href="#">Halima</a></li>
                        <li><a class="dropdown-item" href="#">Kenanga</a></li>
                        <li><a class="dropdown-item" href="#">Hana</a></li>
                        <li><a class="dropdown-item" href="#">Aina</a></li>
                        <li><a class="dropdown-item" href="#">Wardah</a></li>
                        <li><a class="dropdown-item" href="#">Lily</a></li>
                        <li><a class="dropdown-item" href="#">Suri</a></li>
                        <li><a class="dropdown-item" href="#">Laila</a></li>
                    </ul>
                    </li>   
                </ul>
            </div>

            

        
           
            <ul class="navbar-nav ml-auto">

                <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="Log Out">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        // User is logged in, show logout icon
                        echo '<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>';
                    }
                    ?>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                </li>
                <!-- <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="Shop">
                    <a class="nav-link" href="collection.php" id="shopping" style="<?php echo isset($_SESSION['user_id']) ? '' : 'display: none;'; ?>">
                        <i class="fas fa-shopping-bag"></i>
                    </a>
                </li> -->
                <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="Profile">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        // User is logged in, show user profile icon
                        echo '<a class="nav-link" href="profile.php"><i class="fas fa-user"></i></a>';
                    } else {
                        // User is not logged in, show login icon
                        echo '<a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i></a>';
                    }
                    ?>
                </li>


                <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="Cart">
                    <a class="nav-link" href="cart.php" id="cart" style="<?php echo isset($_SESSION['user_id']) ? '' : 'display: none;'; ?>">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
            </ul>
                </div>
    </nav>
                    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>