
// Check if the user is logged in, and if not, redirect to the login page
// Replace 'login.php' with the actual URL of your login page
// if (isset($_SESSION['user_id'])) {
//     header('Location: profile.php');
//     exit;
// }


<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <div class="col-3 md-4"></div>
        <div class="col-6 md-4">
            <h2>User Profile</h2>
            <p>Username: <?php echo $_SESSION['name']; ?></p>
            <p>Email: <?php echo $_SESSION['email']; ?></p>
            <!-- You can display more user information here -->
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>