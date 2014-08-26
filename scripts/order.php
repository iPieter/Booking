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
	  <div class="col-md-1"></div>
	  <div class="col-md-10">
		  <div class="title" id="overview"> <h1>Overzicht</h1></div>
		  	
		  	<?php
		  	
		  	//Get all the states of the dates
		  	$day_1 = $_GET["day_1"];
		  	$day_2 = $_GET["day_2"];
		  	$day_3 = $_GET["day_3"];
		  	$day_4 = $_GET["day_4"];
		  	
		  	//Set the variables
		  	$desc = "";
		  	
		  	$totalPrice = 0;
		  	
		  	$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

		  	
		  	mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `page`) VALUES ('$username', 'scripts/order.php');");

		  	
		  	//CALCULATE PRICES
		  	//day 1
		  	if ($day_1 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=1");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP);
		  		
		  		//add the description
		  		$desc .= "<div class='row pricing'><div class='col-md-10'><p>Maandag 01 september, met overnachting tot dinsdag 02 september</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $sharedPrice . "</p></div></div>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 2
		  	if($day_2 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=2");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP) ;
		  		
		  		//add the description
		  		$desc .= "<div class='row pricing'><div class='col-md-10'><p>Dinsdag 02 september, met overnachting tot woensdag 03 september</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $sharedPrice . "</p></div></div>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 3
		  	if ($day_3 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=3");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP) ;
		  		
		  		//add the description
		  		$desc .= "<div class='row pricing'><div class='col-md-10'><p>Woensdag 03 september, met overnachting tot donderdag 04 september</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $sharedPrice . "</p></div></div>";
		  		$totalPrice += $sharedPrice;
		  	}
		  	
		  	//day 4
		  	if ($day_4 == "true") {
		  		$price = mysqli_query($con,"SELECT * FROM days WHERE day=4");
		  		$row_price = mysqli_fetch_array($price);
		  		$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP) ;
		  		
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


<?php include("order_data.php"); ?>

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
	    url: "finish.php", 
	    type: "POST",
	    data: {day_1: day1, day_2: day2, day_3: day3, day_4: day4},
	    dataType: "html",
	    success: function(data){
	    	window.location.href = "finish.php?day_1=" + day1 + "&day_2=" + day2 + "&day_3=" + day3 + "&day_4=" + day4;
	        	
	        }
	    });
}

$( "button" ).on( "click", notify );
		  	
		  	

</script>
</body>