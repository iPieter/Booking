<html>
<head>
	<title>Giraffen Aan Zee</title>
	
	<link href='http://fonts.googleapis.com/css?family=Cutive+Mono|Open+Sans:200,300,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.css" rel="stylesheet">
</head>
<body>

<?php
require("../scripts/datalogin.php"); 
require("../scripts/common.php"); 

include("../topbar.php");
?>

<div class="container">
  <!-- THE PRICING PAGE -->
  <div class="row" id="price">
	  <div class="col-md-1">
	  
	  </div>
	  <div class="col-md-10">
		  <div class="title" id="overview"> <h1>Overzicht</h1></div>
		  	<?php
		  	
		  	//Get all the states of the dates
		  	$day_1 = $_GET["day_1"];
		  	$day_2 = $_GET["day_2"];
		  	$day_3 = $_GET["day_3"];
		  	$day_4 = $_GET["day_4"];
		  	
		  	//Set the variables
		  	$descCol = '<div id="pricing"><div class="col-md-10">';
		  	$priceCol = '<div class="col-md-2" id="prices">';
		  	
		  	$totalPrice = 0;
		  	
		  	//get the booking information of each day
		  	$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
		  	
		  	$bookings = mysqli_query($con,"SELECT * FROM users WHERE `users`.`username` = '$username';");
		  	$row_bookings = mysqli_fetch_array($bookings);
		  	
		  	$day1_booked = $row_bookings['day1'];
		  	$day2_booked = $row_bookings['day2'];
		  	$day3_booked = $row_bookings['day3'];
		  	$day4_booked = $row_bookings['day4'];
		  	
		  	
		  	//CALCULATE PRICES
		  	//day 1
		  	if ($day_1 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=1");
		  		$row_price = mysqli_fetch_array($price);
		  		
		  		//check if this day is already booked or if it should reduce the price by 1 guest
		  		if ($day1_booked) {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP);
		  			$descCol .= "<p>Maandag 01/09, overnachting tot dinsdag</p>";
		  		} else {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP);
		  			$descCol .= '<p><span class="glyphicon glyphicon-plus-sign"></span> Maandag 01/09, overnachting tot dinsdag</p>';		
		  			
		  		}
		  		
		  		//add the description
		  		$priceCol .= "<p>€ " . $sharedPrice . "</p>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 2
		  	if($day_2 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=2");
		  		$row_price = mysqli_fetch_array($price);
		  	
		  		//check if this day is already booked or if it should reduce the price by 1 guest	
		  		if ($day2_booked) {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP);
		  			$descCol .= "<p>Dinsdag 02/09, overnachting tot woensdag</p>";
		  		} else {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP);
		  			$descCol .= '<p><span class="glyphicon glyphicon-plus-sign"></span> Dinsdag 02/09, overnachting tot woensdag</p>';		
		  			
		  		}
		  		
		  		//add the description
		  		$priceCol .= "<p>€ " . $sharedPrice . "</p>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 3
		  	if ($day_3 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=3");
		  		$row_price = mysqli_fetch_array($price);
		  		
		  		//check if this day is already booked or if it should reduce the price by 1 guest	
		  		if ($day3_booked) {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP);
		  			$descCol .= "<p>Woensdag 03/09, overnachting tot donderdag</p>";
		  		} else {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP);
		  			$descCol .= '<p><span class="glyphicon glyphicon-plus-sign"></span> Woensdag 03/09, overnachting tot donderdag</p>';		
		  		}
		  		
		  		//add the description
		  		$priceCol .= "<p>€ " . $sharedPrice . "</p>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 4
		  	if ($day_4 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=4");
		  		$row_price = mysqli_fetch_array($price);
		  	
		  		//check if this day is already booked or if it should reduce the price by 1 guest	
		  		if ($day4_booked) {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP);
		  			$descCol .= "<p>Donderdag 04/09, overnachting tot vrijdag</p>";
		  		} else {
		  			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP);
		  			$descCol .= '<p><span class="glyphicon glyphicon-plus-sign"></span> Donderdag 04/09, overnachting tot vrijdag</p>';		
		  			
		  		}
		  		
		  		//add the description
		  		$priceCol .= "<p>€ " . $sharedPrice . "</p>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//return the two colums
		  	echo($descCol . "</div>");
		  	echo($priceCol . '<hr class="black"> <h4>€ ' . number_format($totalPrice,2) . ' </h4> ');
		  	?>
	  </div>
  </div>
</div>
</div>
<div class="row" id="information">
	<div class="col-md-1">
	  
	</div>
	  
	<div class="col-md-10">
		<div class="title" id="info"> <h1>Algemene informatie</h1></div>
		  
		  <div class="col-md-2"><b>Uur van aankomst:</b></div><div class="col-md-10"><div href="#" data-toggle="tooltip" title="Enkel van toepassing indien de volgende dag volledig volzet is" id="arival">Na 11:00</div></div>


		  <div class="col-md-2"><b>Uur van vertrek:</b></div><div class="col-md-10">Voor 11:00 (Enkel van toepassing indien de volgende dag volledig volzet is)</div>
		  <div class="col-md-2"><b>Bedlinnen en handdoeken:</b></div><div class="col-md-10">Bedlinnen en handdoeken dienen zelf meegebracht te worden. Hoeslakens voor de matrassen, overtrekken voor de donsdekens en kussenslopen vallen hier onder.</div>
	
	<div class="col-md-2"><b>Kamers:</b></div><div class="col-md-10">1x 2-persoonsbed, 4x 1-persoonsbed, 2x 1-persoonsboxpring die tegen elkaar kunnen worden geplaatst.</div>
	</div>

</div>
</div>
<!--
<div class="row" id="terms">
	<div class="col-md-1">
	  
	</div>
	  

	<div class="col-md-10">
		<div class="title" id="info"> <h1>Voorwaarden</h1></div>
		  
			
	</div>
</div>

-->

<div class="row" id="order">
	<div class="col-md-9">
	  
	</div>
	  
	<div class="col-md-2">
		
<button type="button" class="btn btn-primary btn-block" name="order"> 
	<span class="glyphicon glyphicon-ok"></span> Reservatie bevestigen</button> </div>


</div>
</div>
<script>
//$('#arival').tooltip('show');
function notify() {
	var day1 = <?php echo $day_1; ?>;
	var day2 = <?php echo $day_2; ?>;
	var day3 = <?php echo $day_3; ?>;
	var day4 = <?php echo $day_4; ?>;
	
	
	
	$.ajax({
	    url: "finish_booked.php", 
	    type: "POST",
	    data: {day_1: day1, day_2: day2, day_3: day3, day_4: day4},
	    dataType: "html",
	    success: function(data){
	    	window.location.href = "finish_booked.php?day_1=" + day1 + "&day_2=" + day2 + "&day_3=" + day3 + "&day_4=" + day4;
	        	
	        }
	    });
}

$( "button" ).on( "click", notify );
		  	
		  	

</script>
</body>