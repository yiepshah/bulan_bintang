<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Signup</title>

    <?php 
    //database configuration
        $host= "localhost";
        $username = "root";
        $password = "";
        $database = "bulan_bintang";

    //create a database connection
        $conn = mysqli_connect($host, $username, $password, $database);

    // check the connection
        if(!$conn){
            die("Conection failed :" . mysqli_connect_error());
        }

    // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $username = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Hash the password (recommended for security)
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data into the database
            $sql = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$hashedPassword')";


            if (mysqli_query($conn, $sql)) {
                
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

         //close the database conenction
        mysqli_close($conn);
    ?>

    <style>

        body{
            /* background-image: url('https://lh6.googleusercontent.com/proxy/PfqBs77OlpRjgytCHPXHLWBN1avDDXQxk9yJB10Gw2PrHpRd0aQAXNGdbzStMW_ewsSf4aY1aL8XDePZ7NzC1beWctZAYYf2yQelWA3lNQuIuUHJQBtA2IiQcXcJSKFE=w1200-h630-p-k-no-nu'); */
            background-image: url('https://bulanbintang.onpay.my/media/uploads/majestic%20black2.jpg');
            background-size: cover;
            
            
        }
        .container{
            background-color: rgba(211, 211, 211, 0.5);
            margin-top: 150px;
            border-radius: 30px 30px;
            
            
        }

        #loginlink{
            margin-right: 20px;
            
            
        }

        

    </style>
</head>
<body>
<?php include('header.php') ?>


<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h2>Sign Up</h2>
                <?php if (isset($successMessage)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $successMessage; ?>
                    </div>
                <?php endif; ?>
                <form action="signup.php" method="post">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <a class="btn btn-warning" id="loginlink" href="login.php">Login</a>
                    <button type="submit" class="btn btn-dark">Submit</button><br><br>
                </form>
            </div>
        </div>
        
    <?php include('footer.php') ?>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>