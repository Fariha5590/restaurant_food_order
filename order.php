<?php
    session_start();
    if( !isset($_SESSION["customer_id"]) || !isset($_COOKIE["customer_id"]) ) {
        header('Location: login.php');
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

				<ul class="main-nav js--main-nav">
					<li><a href="#features">Food delivery</a></li>
					<li><a href="#works">How it works</a></li>
					<li><a href="#cities">Our Coverage</a></li>
					<li>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" class="contact-form">
                            <input type="submit" name="logout" value="Logout">
                        </form>
                    </li>
                    <?php 
				        if( isset($_POST['logout']) ){
				            unset($_COOKIE['customer_id']);
				            unset($_SESSION['customer_id']);
				            ob_end_flush();
				            session_destroy();
				            exit;
				        }
				         ?>
				</ul>
				<a class="mobile-nav-icon js--nav-icon"><i class="ion-navicon-round"></i></a>
			</div>
		</nav>
		<div class="hero-text-box">
			<h1>Order Now</h1>
		</div>
	</header>

	<section class="section-order-form">
		<div class="row">
			<h2>Enter Order Information Below</h2>
		</div>

		<div class="row">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="contact-form">
				<div class="row">
					<div class="col span-2-of-2">
                    <input type="text" name="full_address" id="full_address" placeholder="Full Address" required>
                  </div>
                </div>
				<div class="row">
					<div class="col span-1-of-2">
						<input type="text" name="food_set_id" id="food_set_id" placeholder="Food Set Id" required>
                    </div>
					<div class="col span-1-of-2">
						<input type="text" name="quantity" id="quantity" placeholder="Quantity" required>
                  </div>
                </div>
				<div class="row">
					<div class="col span-2-of-2">
						<input type="submit" name="submit" value="Place Order">
				    </div>
				</div>
			</form>

      <?php

        require_once 'phpscripts/dbconnector.php';

        if( isset($_POST['submit']) ) {

          $result = mysqli_fetch_array($conn->query('SELECT MAX(order_id) FROM orders'));
          ( is_numeric($result[0]) )?($order_id = $result[0] + 1):( $order_id = 101 ) ;

          if( isset($_SESSION["customer_id"]) ) {
              $customer_id = $_SESSION["customer_id"];
          } else if( isset($_COOKIE["customer_id"]) ) {
              $customer_id = $_COOKIE["customer_id"];
          }
          $customer_address = $_POST['full_address'];
          $food_id = $_POST['food_set_id'];
          $order_date = date('Y-m-d');
          $quantity = $_POST['quantity'];
          $pay_amount = 99*$quantity;

          $sql = "INSERT INTO orders VALUES('$order_id', '$customer_id', '$customer_address', '$food_id', '$order_date', '$quantity', '$pay_amount')";
          if($conn->query($sql)) {
              echo "Order Placed";
          }
        }
       ?>


      <style media="screen">
        input {
            padding: 0 20px !important;
            line-height: 36px;
            font-size: 18px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        input:not([type="submit"]) {
            width: 100%; }
      </style>

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
