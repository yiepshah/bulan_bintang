<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Signup</title>

    <?php 

    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bulan_bintang";

    // Create a database connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $username = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        // Validate username
        if (strlen($username) < 6) {
            // Redirect to signup page with showAlert parameter for password mismatch
            header("Location: signup.php?showAlert=username");
            exit();
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Redirect to signup page with showAlert parameter for password mismatch
            header("Location: signup.php?showAlert=wrongformatemail");
            exit();
        }

        // Validate password length
        if (strlen($password) < 6) {
            // Redirect to signup page with showAlert parameter for password mismatch
            header("Location: signup.php?showAlert=passwordless6");
            exit();
        }

        // Validate if passwords match
        if ($password != $confirmPassword) {
            // Redirect to signup page with showAlert parameter for password mismatch
            header("Location: signup.php?showAlert=passwordMismatch");
            exit();
        }

        // Hash the password (recommended for security)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the database
        $sql = "INSERT INTO users (user_id ,name, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to signup page with showAlert parameter for success
            header("Location: login.php?showAlert=signupSuccess");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <style>
        body {
            background-image: url('https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/02/USP-BMK-1-1.jpg?resize=2000%2C2000&ssl=1');
        }

        .container {
            background-color: rgba(211, 211, 211, 0.5);
            margin-top: 50px;
            border-radius: 30px 30px;
        }

        #loginlink {
            margin-right: 20px;
        }

        #inputErrorAlert {
            margin-top: 10px;
            width: 100%;
            background-color: #dc3545;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: none;
        }

        #Sbtn {
            border-radius: 20px 20px;
            background-color: #12122f;
        }
    </style>
</head>

<body>
    <?php include('header.php') ?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h2>Sign Up</h2>

                <form action="signup.php" method="post">
         

                    <div id="errorAlert" class="alert alert-danger" style="display: none;">
                        <strong>Error!</strong> There was an issue with your input. Please check and try again.
                    </div>

                    <div id="inputErrorAlert">
                        <strong>Error!</strong> Please fill in all the form fields.
                    </div>

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
                        <div  class="alert alert-primary" role="alert" style="display: none;" id="password-strength-status"></div>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            required>
                    </div>
                    <div id="password-match-alert" class="alert alert-success" style="display: none;">
                        <strong>Success!</strong> Passwords match.
                    </div>
                    <p style="font-family: cursive;">Already Have An Account? <a id="loginlink" href="login.php">Login
                            Now!</a></p>
                    <button type="submit" id="Sbtn" class="btn btn-dark">Submit</button><br><br>
                    <a href="">Terms of use. Privacy policy</a>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
 c
    <script>
        // console.log("Script is running");

        $(document).ready(function () {

            $(document).on('change keyup', '#password', function () {
                checkPasswordStrength($(this).val().trim())
            })

            $(document).on('change keyup', '#confirmPassword', function () {

                checkPasswordMatch();
            });

            function checkPasswordMatch(){

                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();

                if (password !== confirmPassword) {

                    $('#password-match-alert').hide();
                    $('#Sbtn').prop('disabled', true);

                } else {
                    
                    $('#password-match-alert').show();
                    $('#Sbtn').prop('disabled', false);
                }
            }

        });

        function checkPasswordStrength(password) {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            $('#password-strength-status').show()

            // var icon1 = "<i class='fa-solid fa-face-flushed'></i>";
            // var icon2 = "<box-icon name='smile' ></box-icon>";
            // var icon3 = "<box-icon name='happy-beaming'></box-icon>";

            if (password.length < 6) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').removeAttr('class');
                $('#password-strength-status').addClass('alert alert-danger');
                $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
                $('#Sbtn').prop('disabled', true)
            } else {
                if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').removeAttr('class');
                    $('#password-strength-status').addClass('alert alert-success');
                    $('#password-strength-status').html( "Strong");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').removeAttr('class');
                    $('#password-strength-status').addClass('alert alert-warning');
                    $('#password-strength-status').html(
                       "Medium (should include alphabets, numbers and special characters.)");
                }
                $('#Sbtn').prop('disabled', false)
            }
        }
    </script>


</body>

</html>