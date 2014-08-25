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

		
			$bookings = mysqli_query($con,"SELECT * FROM users WHERE `users`.`username` = '$username';");
			$row_bookings = mysqli_fetch_array($bookings);
			
			$day_1 = $row_bookings['day1'];
			$day_2 = $row_bookings['day2'];
			$day_3 = $row_bookings['day3'];
			$day_4 = $row_bookings['day4'];
		  	
		  	//Set the variables
		  	$descCol = '<div id="pricing"><div class="col-md-10">';
		  	$priceCol = '<div class="col-md-2" id="prices">';
		  	
		  	$totalPrice = 0;
		  			  	
		  	
		  	//CALCULATE PRICES
		  	//day 1
		  	if ($day_1) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=1");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2);
		  		
		  		//add the description
		  		$descCol .= "<p>Maandag 01 september, met overnachting tot dinsdag 02 september</p>";
		  		$priceCol .= "<p>€ " . $sharedPrice . "</p>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 2
		  	if($day_2) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=2");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2) ;
		  		
		  		//add the description
		  		$descCol .= "<p>Dinsdag 02 september, met overnachting tot woensdag 03 september</p>";
		  		$priceCol .= "<p>€ " . $sharedPrice . "</p>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 3
		  	if ($day_3) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=3");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2) ;
		  		
		  		//add the description
		  		$descCol .= "<p>Woensdag 03 september, met overnachting tot donderdag 04 september</p>";
		  		$priceCol .= "<p>€ " . $sharedPrice . "</p>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 4
		  	if ($day_4) {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=4");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2) ;
		  		
		  		//add the description
		  		$descCol .= "<p>Donderdag 04 september, met overnachting tot vrijdag 05 september</p>";
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
<?php include("scripts/order_data.php"); ?>

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