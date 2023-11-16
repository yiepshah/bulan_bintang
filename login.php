<?php session_start();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Log in</title>

    <?php


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

// Check if there are any rows in the result
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Verify the entered password with the hashed password in the database
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id']; // Store user ID in the session

        // Check the role of the user
        if ($row['role'] === 'admin') {
            header("Location: adminpage.php"); // Redirect to the admin page
        } else {
            header("Location: index.php"); // Redirect to a regular user page
        }

        // Redirect to a welcome page
        exit();
    } else {
        $error = "Invalid email or password.";
    }
} else {
    $error = "Invalid email or password.";
}

// Close the database connection
mysqli_close($conn);

}
?>


    <style>

        
        body{
            /* background-image: url('https://media.giphy.com/media/qr4zmfngHHn0c/giphy.gif'); */
            /* background-image: url('https://lh6.googleusercontent.com/proxy/PfqBs77OlpRjgytCHPXHLWBN1avDDXQxk9yJB10Gw2PrHpRd0aQAXNGdbzStMW_ewsSf4aY1aL8XDePZ7NzC1beWctZAYYf2yQelWA3lNQuIuUHJQBtA2IiQcXcJSKFE=w1200-h630-p-k-no-nu'); */
            background-image: url('https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/02/USP-BMK-1-1.jpg?resize=2000%2C2000&ssl=1');
            background-size: cover;
       
        }
        .container {
            background-color: rgba(211, 211, 211, 0.5); /* Adjust the alpha value (0.8) as needed */
            padding: 30px;
            border-radius: 20px 20px;
            margin-top: 200px;
            
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
            margin-right: 30px;
            
        }

        #lesgo{
            
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
                    
                    <p style="font-family: cursive;">New to Bulan Bintang?</p>
                    <a class="btn btn-dark"  id="signuplink" href="signup.php">Signup</a>

                    <button type="submit" class="btn btn-warning">Enter</button>
                    <h1 id="lesgo">Let's Go !</h1>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

