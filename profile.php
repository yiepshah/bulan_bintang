
<?php
session_start(); // Start the session


$mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


?>



<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Profile</title>

    <?php
        $userId = $_SESSION['user_id']; // Get the user's ID from the session
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
     ?>

     <style>

        body,html{
            background-image: url('https://lh6.googleusercontent.com/proxy/PfqBs77OlpRjgytCHPXHLWBN1avDDXQxk9yJB10Gw2PrHpRd0aQAXNGdbzStMW_ewsSf4aY1aL8XDePZ7NzC1beWctZAYYf2yQelWA3lNQuIuUHJQBtA2IiQcXcJSKFE=w1200-h630-p-k-no-nu');
            
        }   
        .card{
            border-radius: 10px;
            color: #e6ddd8;
            background-color: darkslategrey;
            margin-top: 200px;
        }
     </style>
</head>
<body>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>User Profile</h2>
                    </div>
                    <div class="card-body">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="profile-info">
                                <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                                
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php        

    $stmt->close();

    $mysqli->close(); 

?>
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>