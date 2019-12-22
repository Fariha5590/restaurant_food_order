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
					<li><a href="#plans">Sign up</a></li>
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
				<h2>Login</h2>
            	<form class="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="col span-1-of-1" style="margin: 0">
	                    <input type="text" name="email" placeholder="Email">
	                    <input type="password" name="password" placeholder="Password">
	                    <input type="submit" name="btn-submit" value="Login">
					</div>
					<p>
						Don't have an account? <a href="signup.php">Sign up</a> here
					</p>
		        </form>

				<?php
                    require_once 'phpscripts/dbconnector.php';
					if( isset( $_POST['btn-submit'] ) ) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $sql = "SELECT * from users WHERE email='$email' AND password='$password'";
                        $query = $conn->query($sql);
                        $count = $query->num_rows;
                        $result = $query->fetch_row();
                        if( $count = 1 ) {
                            $_SESSION["customer_id"] = $result[0];
                            setcookie("customer_id", $result[0], time() + (86400 * 30), "/");
                            header('Location: order.php');
                        } else {
                            echo "Invalid Username/Password";
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
