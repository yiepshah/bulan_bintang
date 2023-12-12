
<?php


// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);
// ini_set('error_log', 'error.log');

session_start();

// var_dump($_SESSION['user_id']);

$userId = $_SESSION['user_id'];

// var_dump($userId);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} 

$query = "SELECT * FROM users WHERE id = ?";
// echo $query; // Now $query is defined
$mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$stmt = $mysqli->prepare($query);

if ($stmt === false) {
    die('Error preparing statement: ' . $mysqli->error);
}

$stmt->bind_param("i", $userId);

if (!$stmt->execute()) {
    // var_dump($stmt->error);
    die('Error executing statement: ' . $stmt->error);
}

$result = $stmt->get_result();
if ($result === false) {
    die('Error executing query: ' . $mysqli->error);
}

$row = $result->fetch_assoc();
// echo 'Reached this point';
// var_dump($row);


$result->close();


$stmt->close();


$mysqli->close();

include('header.php');
include('adminsidebar.php');

// ob_flush();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
     
    <title>My profile</title>


     <style>
        body {
            
            background-color:#0F0E0E;
        }   
        .card{
            border-radius: 10px ;
            color: #FEF7DC;
            background-color: #2C3333;
            width: auto;
            text-align: left;           
        }

        #profileImg {
            width: 180px;
            height: auto;
            border-radius: 30px 30px;
            display: block; /* Ensure that the image is treated as a block element */
            margin-left: auto;
            margin-right: auto;
        }

        #userprofile{
            font-family: poppins, sans-serif;
        }

        #profileBtn{
            border-radius: 20px;
            font-family: poppins, sans-serif;
            transition: transform 0.3s ease-in-out;
        }

        #profileBtn:hover{
            transform: scale(1.2);
            background-color: #2C3333;
        }

        
     </style>
</head>
<body>

<div class="container mt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 id="userprofile">User Profile</h2>
                    </div>
                    <img id="profileImg" src="https://th.bing.com/th/id/OIP.rLve_Yze-hD3DIOwtjDrBgHaKW?rs=1&pid=ImgDetMain" alt="dv">
                    <div class="card-body">
                        <div class="profile-info">
                            <?php
                            // var_dump($row);

                            if ($row !== NULL) {
                                echo '<div>';
                                echo '<p><strong>Name:</strong> ' . $row['name'] . '</p>';
                                echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';

                                if (isset($row['role'])) {
                                    echo '<p><strong>Status:</strong> ' . $row['role'] . '</p>';
                                } else {
                                    echo '<p><strong>Status:</strong> Not available</p>';
                                }

                                if (isset($row['register_date'])) {
                                    echo '<p><strong>Register Date:</strong> ' . $row['register_date'] . '</p>';
                                } else {
                                    echo '<p><strong>Register Date:</strong> Not available</p>';
                                }

                                echo '</div>';
                            } else {
                                echo 'No user data found.';
                            }
                            ?><form action="edit.php">
                                <button id="profileBtn" class="btn btn-dark">Edit Profile</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


