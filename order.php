<html>
<head>
	<title>Giraffen Aan Zee</title>
	
	<link href='http://fonts.googleapis.com/css?family=Cutive+Mono|Open+Sans:200,300,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>

<?php
require("scripts/datalogin.php"); 
require("scripts/common.php"); 

include("topbar.php");
?>

<div class="container">
  <!-- THE PRICING PAGE -->
  <div class="row" id="price">
	  <div class="col-md-1">
	  
	  </div>
	  <div class="col-md-10">
		  <div class="title" id="overview"> <h1>Overzicht</h1></div>
		  	<?php
		  	//get the booking information of each day
		  	$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

			mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `page`) VALUES ('$username', 'order.php');");

		
			$bookings = mysqli_query($con,"SELECT * FROM users WHERE `users`.`username` = '$username';");
			$row_bookings = mysqli_fetch_array($bookings);
			
			$day_1 = $row_bookings['day1'];
			$day_2 = $row_bookings['day2'];
			$day_3 = $row_bookings['day3'];
			$day_4 = $row_bookings['day4'];
		  	
		  	//Set the variables
		  	$desc = "";
		  	
		  	$totalPrice = 0;
		  			  	
		  	
		  	//CALCULATE PRICES
		  	//day 1
		  	if ($day_1) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=1");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2);
		  		
		  		//add the description
		  		$desc .= "<div class='row pricing'><div class='col-md-10'><p>Maandag 01 september, met overnachting tot dinsdag 02 september</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $sharedPrice . "</p></div></div>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 2
		  	if($day_2) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=2");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2) ;
		  		
		  		//add the description
		  		$desc .= "<div class='row pricing'><div class='col-md-10'><p>Dinsdag 02 september, met overnachting tot woensdag 03 september</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $sharedPrice . "</p></div></div>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 3
		  	if ($day_3) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=3");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2) ;
		  		
		  		//add the description
		  		$desc .= "<div class='row pricing'><div class='col-md-10'><p>Woensdag 03 september, met overnachting tot donderdag 04 september</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $sharedPrice . "</p></div></div>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 4
		  	if ($day_4) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=4");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2) ;
		  		
		  		//add the description
		  		$desc .= "<div class='row pricing' ><div class='col-md-10'><p>Donderdag 04 september, met overnachting tot vrijdag 05 september</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $sharedPrice . "</p></div></div>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//return the two colums
		  	echo($desc . "");
		  	echo('<div class="row" id="pricing"><div class="col-md-10"></div><div class="col-md-2" id="prices"><hr class="black"> <h4>€ ' . number_format($totalPrice,2) . ' </h4> </div></div>');
		  	?>
	  </div>
  </div>

<?php include("scripts/order_data.php"); ?>

</body>