<?php
include('config.php');

// Function to fetch categories and subcategories
function getCategories($mysqli, $parent_id = NULL)
{
    $query = "SELECT * FROM categories WHERE parent_id " . ($parent_id === NULL ? "IS NULL" : "= $parent_id");
    $result = $mysqli->query($query);

    $categories = array();

    while ($row = $result->fetch_assoc()) {
        $category = array(
            'id' => $row['category_id'],
            'name' => $row['category_name'],
            'subcategories' => getCategories($mysqli, $row['category_id'])
        );

        $categories[] = $category;
    }

    return $categories;
}


$mysqli = connectDatabase(); 


$mainCategories = getCategories($mysqli);


$mysqli->close();

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

        .search--box{
            margin-top: 18px;
        }
    </style>
    
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
                
                foreach ($mainCategories as $mainCategory) {
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">' . $mainCategory['name'] . '</a>';
                    echo '<ul class="dropdown-menu">';
                    
                    foreach ($mainCategory['subcategories'] as $subcategory) {
                        echo '<li><a class="dropdown-item" href="collection.php?id=' . $subcategory['id'] . '">' . $subcategory['name'] . '</a></li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item" data-toggle="tooltip"   title="Log Out">
                <?php
                if (isset($_SESSION['user_id'])) {
                    
                    echo '<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>';
                }
                ?>
            </li> 

            <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="admin">
                <a class="nav-link" href="adminpage.php"><i class="fas fa-user-tie"></i></a>
            </li>

            <li class="nav-item" data-toggle="tooltip"  data-placement="bottom" title="search">
            <div class="search--box">
                <i id="search-icon" class="fa fa-solid fa-search"></i>
                <input id="search-input" type="text" placeholder="Search" style="display: none;">
            </div>
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
                    
                    echo '<a class="nav-link" data-placement="bottom" title="profile" href="profile.php"><i class="fas fa-user"></i></a>';
                } else {
                    
                    echo '<a class="nav-link" data-placement="bottom" title="login" href="login.php"><i class="fas fa-sign-in-alt"></i></a>';
                }
                ?>
            </li>

        </ul>
                    
    </div>
</nav>

   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('.category-link').on('click', function (e) {
            e.preventDefault();
            var categoryId = $(this).data('category-id');
            window.location.href = 'collection.php?id=' + categoryId;
        });
    });
</script>
     