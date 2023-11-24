<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            justify-content: center;
            min-height: 100vh;
            background-image: url('https://i.pinimg.com/564x/e3/99/8e/e3998ee5fcf07113e5144f44cd3e5225.jpg');
            /* background-position: center; */
            /* background-size: cover; */
            
            
        }

        .container {
           padding: 70px;
            border: 2px solid rgba(255, 255, 255, 2);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            background: transparent;
            color:lightgray;
            border-color: #2E2B11;
            width: 420px;
            backdrop-filter: blur(5px);     
            border-radius: 20px 20px;
            /* border: none; */
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            font-family: fantasy;

        }

        label {
            font-weight: bold;
        }

        input[type="file"],
        input[type="text"],
        input[type="number"] {
            border: none;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            margin-bottom: 15px;

        }

        #addbtn {
            color: #ADA090;
            background-color: #556b2f;
            border: none;
            justify-content: center;
            align-items: center;      
            margin-top: 10px;
            width: 500px;
            border-radius: 20px 20px;
        }

        #addbtn:hover {
            background-color: #ADA090;
        }
    </style>
</head>

<body>
    <?php include('adminsidebar.php');?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Add New Item</h1>
                <form action="add_item.php" method="post" enctype="multipart/form-data" class="justify-content-center">
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input class="form-control" type="file" name="image" id="image" required accept="image/*">
                    </div><br>

                    <div class="form-group">
                        <label for="item_name">Name:</label>
                        <input type="text" class="form-control" name="item_name" id="item_name" required>
                    </div><br>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_information">Product Information:</label>
                        <input type="text" class="form-control" name="product_information" id="product_information">
                    </div><br>

                    <div class="form-group">
                        <label for="material">Material:</label>
                        <input type="text" class="form-control" name="material" id="material" required>
                    </div><br>

                    <div class="form-group">
                        <label for="inside_box">What's Inside the Box:</label>
                        <input type="text" class="form-control" name="inside_box" id="inside_box" required>
                    </div><br><br>

                    
                </form>
                <button id="addbtn" class="btn mx-auto" type="submit">Add</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
