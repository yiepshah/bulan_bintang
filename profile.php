<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} 

$mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$userId = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $mysqli->prepare($query);

if ($stmt === false) {
    die('Error preparing statement: ' . $mysqli->error);
}

$stmt->bind_param("i", $userId);

if (!$stmt->execute()) {
    die('Error executing statement: ' . $stmt->error);
}

$result = $stmt->get_result();

if (!$result) {
    die('Error getting result: ' . $stmt->error);
}

$stmt->close(); 

if ($result) {
    $result->close(); 
}

if ($mysqli->ping()) {
    $mysqli->close(); 
}

include('header.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Profile</title>


     <style>
        body {
            /* background-image: url('https://lh6.googleusercontent.com/proxy/PfqBs77OlpRjgytCHPXHLWBN1avDDXQxk9yJB10Gw2PrHpRd0aQAXNGdbzStMW_ewsSf4aY1aL8XDePZ7NzC1beWctZAYYf2yQelWA3lNQuIuUHJQBtA2IiQcXcJSKFE=w1200-h630-p-k-no-nu'); */
        }   
        .card{
            border-radius: 10px;
            color: #e6ddd8;
            background-color: black;
            
        }

        #profileImg{
            width: 300px;
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
                    <img id="profileImg" src="https://th.bing.com/th/id/OIP.rLve_Yze-hD3DIOwtjDrBgHaKW?rs=1&pid=ImgDetMain" alt="dv">
                    <div class="card-body">
                    <div class="profile-info">
                    
                            <div>            
                                <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                                <p><strong>Status:</strong> <?php echo $row['email']; ?></p>
                                <p><strong>Register Date:</strong> <?php echo $row['email']; ?></p>

                                
                            </div>
                        
                        <?php while ($row = $result->fetch_assoc()): ?>

                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('footer.php');
   
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
