<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "bulan_bintang";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $_POST["email"];
    $userPassword = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql); 

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($userPassword, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];

            if ($row['email'] === 'shahirayp@gmail.com') {
                header("Location: adminpage.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
 
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: login.php?showAlert=loginError");
            exit();
        }
    } else {

        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: login.php?showAlert=loginError");
        exit();
    }
  
    mysqli_close($conn);
}
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
	<title>Login</title>
	<style>

	</style>
	<?php include ('header.php') ?>

</head>

<body>

	<section class="vh-100" style="background-color: #202d45;">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col col-xl-10">
					<div class="card" style="border-radius: 1rem;">
						<div class="row g-0">
							<div class="col-md-6 col-lg-5 d-none d-md-block">
								<img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2022/01/170947095_130190345785670_5967843123006398473_n.jpg?resize=800%2C800&ssl=1"
									alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
								<img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2022/01/170947095_130190345785670_5967843123006398473_n.jpg?resize=800%2C800&ssl=1"
									alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
							</div>
							<div class="col-md-6 col-lg-7 d-flex align-items-center">
								<div class="card-body p-4 p-lg-5 text-black">

									<form id="loginForm" method="post"
										action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
										<?php if(isset($_GET['showAlert']) &&  $_GET['showAlert'] == "signupSuccess"){ ?>

											<div id="successAlert" class="alert alert-success alert-dismissible" role="alert">
												<h4 class="alert-heading">Welcome aboard!</h4>
												<p>Your account has been successfully created. Now.</p>
												<hr>
												<p class="mb-0">let's get you logged in and exploring!.</p>
											</div>


<!-- 
										<div id="successAlert" class="alert alert-success alert-dismissible">
											<strong>Success!</strong> Your registration was successful. Please Login.
										</div> -->
										<?php } ?> 

										<div id="login-error-alert" class="alert alert-danger" style="display: none;">
											<strong>Error!</strong>Invalid email or password.
										</div>



									
										<div class="d-flex align-items-center mb-3 pb-1">
											<img src="https://bulanbintanghq.com/wp-content/uploads/2022/01/bulanbintanglogo-1040x800.png"
												style="width: 80px; height: auto; margin-right: 10px;" alt="">
											<span class="h1 fw-bold mb-0">Login</span>
										</div>

										<h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
											account</h5>

										<div class="form-outline mb-4">
											<label class="form-label" for="form2Example17">Email address</label>
											<input type="email" name="email" id="form2Example17"
												class="form-control form-control-lg" required />
											
										</div>

										<div class="form-outline mb-4">
											<label class="form-label" for="form2Example27">Password</label>
											<input type="password" name="password" id="form2Example27"
												class="form-control form-control-lg" required />
										</div>

										<div id="Lbtn" class="pt-1 mb-4">
											<button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
										</div>

										<a class="small text-muted" href="#!">Forgot password?</a>
										<p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
												href="signup.php" style="color: #393f81;">Register here</a></p>
										<a href="#!" class="small text-muted">Terms of use.</a>
										<a href="#!" class="small text-muted">Privacy policy</a>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('footer.php') ?>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
	</script>

<script>
$(document).ready(function () {
    <?php
    if (isset($_GET['showAlert']) && $_GET['showAlert'] == "loginError") {
        echo "$('#login-error-alert').text('" . $_SESSION['login_error'] . "').show();";
        unset($_SESSION['login_error']);
    } 
    ?>
});
</script>
</body>
</html>