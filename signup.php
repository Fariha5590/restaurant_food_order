<?php
    session_start();
    if( isset($_SESSION["customer_id"]) || isset($_COOKIE["customer_id"]) ) {
        header('Location: order.php');
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" type="image/png" sizes="32x32" href="resources/favicons/favicon-32x32.png">

	<title>SALT Online Ordering Restaurant</title>

	<link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
	<link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
	<link rel="stylesheet" type="text/css" href="resources/css/style.css">
	<link rel="stylesheet" type="text/css" href="resources/css/responsive.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="vendors/css/animate.css">

</head>

<body>

	<header>
		<nav>
			<!--To Make The Navigation Center-->
			<div class="row">
				<a href="index.php"><img src="resources/images/logo1-white.png" alt="SALT Logo" class="logo"></a>
				<img src="resources/images/logo1.png" alt="SALT Logo" class="logo-black">
				<!-- Navigation List -->
				<ul class="main-nav js--main-nav">
					<li><a href="#features">Food delivery</a></li>
					<li><a href="#works">How it works</a></li>
					<li><a href="#cities">Our Coverage</a></li>
					<li><a href="login.php">Login</a></li>
				</ul>
				<a class="mobile-nav-icon js--nav-icon"><i class="ion-navicon-round"></i></a>
			</div>
		</nav>
		<div class="hero-text-box">
			<h1>Signup Now</h1>
		</div>
	</header>

	<section class="section-features js--section-features" id="features">
		<div class="row">
            <div class="col span-1-of-4">
            </div>
			<div class="col span-1-of-2">
				<h2>Signup in our awesome plans</h2>
            	<form class="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="col span-1-of-2" style="margin-bottom: 0">
	                    <input type="text" name="first_name" placeholder="First Name">
					</div>
					<div class="col span-1-of-2" style="margin-bottom: 0">
	                    <input type="text" name="last_name" placeholder="Last Name">
					</div>
					<div class="col span-1-of-1" style="margin: 0">
	                    <input type="tel" name="phone_no" placeholder="Phone No.">
	                    <input type="email" name="email" placeholder="Email">
	                    <input type="password" name="password" placeholder="Password">
	                    <input type="password" name="password_repeat" placeholder="Repeat Password">
	                    <input type="submit" name="btn-submit" value="Sign Up">
					</div>
					<p>
						Already have an account? <a href="login.php">Login</a> here
					</p>
		        </form>

				<?php
					require_once 'phpscripts/dbconnector.php';

					if( isset( $_POST['btn-submit'] ) ) {
						$result = mysqli_fetch_array($conn->query('SELECT MAX(customer_id) FROM users'));
						( is_numeric($result[0]) )?($customer_id = $result[0] + 1):( $customer_id = 101 ) ;

						$first_name = $_POST['first_name'];
						$last_name = $_POST['last_name'];
						$phone_no = $_POST['phone_no'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$password_repeat = $_POST['password_repeat'];

						if( $password != $password_repeat ) {
							echo "Paswwords didn't match";
						} else {
							$query = $conn->query( "INSERT INTO users VALUES('$customer_id','$first_name', '$last_name', '$phone_no', '$email', '$password')" );
							echo "Signup Successful. Please login.";
						}
					}
				 ?>

			</div>
		</div>
	</section>

	<footer>
		<div class="row">
			<div class="col span-1-of-2">
				<ul class="footer-nav">
					<li><a href="#">About us</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Press</a></li>
					<li><a href="#">iOS App</a></li>
					<li><a href="#">Android App</a></li>
				</ul>
			</div>
			<div class="col span-1-of-2">
				<ul class="social-links">
					<li><a href="#"><i class="ion-social-facebook"></i></a></li>
					<li><a href="#"><i class="ion-social-twitter"></i></a></li>
					<li><a href="#"><i class="ion-social-googleplus"></i></a></li>
					<li><a href="#"><i class="ion-social-instagram"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
				<p>
					Copyright &copy; 2018 by SALT Restaurant. All right reserved.
				</p>
			</div>
	</footer>



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="vendors/js/jquery.waypoints.min.js"></script>
	<script type="text/javascript" src="resources/js/script.js"></script>

</body>
</html>
