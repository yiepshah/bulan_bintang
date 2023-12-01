<?php


include('config.php');


if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];


    $mysqli = connectDatabase(); 
    echo "SELECT * FROM posts WHERE category_id = $categoryId";
    $result = $mysqli->query("SELECT * FROM posts WHERE category_id = $categoryId");

    if (!$result) {
        echo "Error: " . $mysqli->error;
    }

    $stmt = $mysqli->prepare("SELECT * FROM posts WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();


    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<h2>' . $row['item_name'] . '</h2>';

        echo '</div>';
    }

    $mysqli->close();
} else {
  
    ;
}
?>


    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 10px;
        }

        .logo {
            height: 62px;
        }

        .navbar .navbar-nav .nav-item a {
            color: #000033;
            font-weight: 500;
            margin: 10px;
            text-decoration: none;
        }

        .navbar .navbar-nav .nav-item a:hover {
            color: #000033;
        }

        .navbar .navbar-nav .nav-item i {
            margin-right: 10px;
            transition: transform 0.2s ease-in-out;
        }

        .navbar .navbar-nav .nav-item i:hover{
            transform: scale(1.4);
        }

        #loginbutton {
            margin-right: 40px;
            background-color: #033366;
        }

        #logoutbtn {
            margin-right: 10px;
        }

        @media (max-width: 991px) {
            .navbar .navbar-nav {
                flex-direction: row;
            }

            .navbar .navbar-nav .nav-item {
                margin-right: 10px;
            }

            .navbar .navbar-nav .nav-item:last-child {
                margin-right: 0;
            }

            .navbar .navbar-nav .nav-item i {
                margin-right: 5px;
            }
        }
    </style>
    
<nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="https://th.bing.com/th/id/OIP.IV6E-NjlfboqXML32zgvtAHaFs?w=247&h=190&c=7&r=0&o=5&pid=1.7" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" title="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    
                <?php
                   
                    $mysqli = connectDatabase(); 
                    $result = $mysqli->query("SELECT * FROM categories"); 

                    while ($row = $result->fetch_assoc()) {
                        $categoryId = $row['category_id'];
                        $categoryName = $row['category_name'];
                        
                        if (isset($_SESSION['role'])) {
                            // Display category navigation items for non-admin users
                            if ($_SESSION['role'] != 'admin') {
                                echo '<li class="nav-item"><a class="nav-link" href="category.php?id=' . $categoryId . '">' . $categoryName . '</a></li>';
                            }
                        } else {
                            // Handle the case when 'role' index is not set (user not logged in)
                            // You might want to redirect to a login page or handle it differently
                            echo '<li class="nav-item"><a class="nav-link" href="#">Login</a></li>';
                        }
                    }

                    $mysqli->close();

                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                        echo '<li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="admin">';
                        echo '<a class="nav-link" href="adminpage.php"><i class="fas fa-user-tie"></i></a>';
                        echo '</li>';
                    }
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

                <li class="nav-item" data-toggle="tooltip"   title="Log Out">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        // User is logged in, show logout icon
                        echo '<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>';
                    }
                    ?>
                </li> 

                <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="admin">
                    <a class="nav-link" href="adminpage.php"><i class="fas fa-user-tie"></i></a>
                </li>
                
                <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="search">
                    <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                </li>

                <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="cart">
                    <?php
                    $cartCount = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
                    ?>
                    <a href="cart.php" class="nav-link">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-pill badge-primary"><?php echo $cartCount; ?></span>
                    </a>
                </li>


                <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="shop">
                    <a class="nav-link" href="collection.php" id="cart" style="<?php echo isset($_SESSION['user_id']) ? '' : 'display: none;'; ?>">
                    <i class="fas fa-store"></i>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" title="login"  >
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        // User is logged in, show user profile icon
                        echo '<a class="nav-link" data-placement="bottom" title="profile" href="profile.php"><i class="fas fa-user"></i></a>';
                    } else {
                        // User is not logged in, show login icon
                        echo '<a class="nav-link" data-placement="bottom" title="login" href="login.php"><i class="fas fa-sign-in-alt"></i></a>';
                    }
                    ?>
                </li>

            </ul>            
    </nav>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $("").click(function(){
            $("").slideToggle();
        });
    });
</script>
     