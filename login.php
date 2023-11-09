<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Log in</title>

    <?php
session_start(); // Start a PHP session

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection credentials
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bulan_bintang";

    // Create a database connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve user data from the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Verify the entered password with the hashed password in the database
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id']; // Store user ID in the session
                header("Location: index.php");
                
                 // Redirect to a welcome page
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>


    <style>

        
        body{
            background-image: url('https://media.giphy.com/media/qr4zmfngHHn0c/giphy.gif');
       
        }
        .container{
            background-color: darkslategrey;
            padding: 30px;
            border-radius: 20px 20px;
            margin-top: 200px;
            color: white;
        }

        .email{
            width: 290px;
            border-radius: 10px 10px;
        }

        .password{
            width: 290px;
            border-radius: 10px 10px;
        }

        #signuplink{
            color: black;
            margin-right: 30px;
            
        }

        #lesgo{
            color: lightgray;
            font-family: sans-serif;
            margin-top: 30px;
        }


    </style>

    

    <?php include('header.php');?>
</head>
<body>




<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    
                    <a class="btn btn-warning"  id="signuplink" href="signup.php">Signup</a>

                    <button type="submit" class="btn btn-dark">Submit</button>
                    <h1 id="lesgo">Let's Go !</h1>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

