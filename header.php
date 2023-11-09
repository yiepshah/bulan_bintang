<?php

// Remove session_start() from this file.
// session_start();

if (isset($_SESSION['user_id'])) {
    $loginButtonStyle = 'display: none;';
    $logoutButtonStyle = 'display: inline-block;';
} else {
    $loginButtonStyle = 'display: inline-block';
    $logoutButtonStyle = 'display: none;';
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
        background-color: #f0f0f0; 
        padding: 10px; 
    }

    .logo {
        height: 62px;
    }

    .nav-item.dropdown:hover .dropdown-menu {
    display: block;
}

   
    .navbar .navbar-nav .nav-item a {
        color: #003366; 
        font-weight: 900; 
        margin-right: 20px;
        text-decoration: none; 
    }

    
    .navbar .navbar-nav .nav-item a:hover {
        color: #003366;
    }

    
    .navbar .navbar-nav .nav-item i {
        margin-right: 10px; 
    }

    .navbar-nav {
        font-weight: 0px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    #loginbutton{
        margin-right: 40px ;
        background-color:#033366 ;
    }

    #addbutton{
        margin-right: 40px ;
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
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown">Men</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Link</a></li>
                        <li><a class="dropdown-item" href="#">Another link</a></li>
                        <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown">Women</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Link</a></li>
                        <li><a class="dropdown-item" href="#">Another link</a></li>
                        <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"  href="#" role="button" data-bs-toggle="dropdown">Kids</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Link</a></li>
                        <li><a class="dropdown-item" href="#">Another link</a></li>
                        <li><a class="dropdown-item" href="#">A third link</a></li>
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
                        <li><a class="dropdown-item" href="#">Link</a></li>
                        <li><a class="dropdown-item" href="#">Another link</a></li>
                        <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                    </li>   
                </ul>
            </div>

            <a id="addbutton" class="btn btn-secondary" href="add_item.php" style="color: #f0f0f0;">Add Item</a>


            <a id="loginbutton" class="btn btn-secondary" href="login.php" style="<?php echo $loginButtonStyle; ?>">Login</a>


            <a id="logoutbtn" class="btn btn-secondary" href="logout.php" style="<?php echo $logoutButtonStyle; ?>">Logout</a>
            
            
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="collection.php" id="shopping">
                            <i class="fas fa-shopping-bag"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php" id="shopping">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" id="cart">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
            </ul>

        </div>
    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>