<html>
<head>
	<title>Bezoekers</title>
	
	<link href='http://fonts.googleapis.com/css?family=Cutive+Mono|Open+Sans:100,300,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.css" rel="stylesheet">
</head>
<body>
<?php 
// First we execute our common code to connection to the database and start the session 
require("common.php"); 
require("datalogin.php");
// At the top of the page we check to see whether the user is logged in or not 
if(empty($_SESSION['user'])) 
{ 
    // If they are not, we redirect them to the login page. 
    header("Location: ../account/login.php"); 
     
    // Remember that this die statement is absolutely critical.  Without it, 
    // people can view your members-only content without logging in. 
    die("Redirecting to ../account/login.php"); 
}

include("../topbar.php");

?>

<div class="container">
  <!-- THE PRICING PAGE -->
  <div class="row" id="price">
	  <div class="col-md-1">
	  
	  </div>
	  <div class="col-md-10">
		  
		<?php
		//loop through each username
		$users = mysqli_query($con, "SELECT * FROM users WHERE booked=1");
		while ($row_users = mysqli_fetch_array($users)) {  	
		  	
		  	echo '<div class="title" id="overview"> <h1>'.$row_users['username'].'</h1></div>';
					
			$day_1 = $row_users['day1'];
			$day_2 = $row_users['day2'];
			$day_3 = $row_users['day3'];
			$day_4 = $row_users['day4'];
		  	
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
		  	$desc .= '<div class="row pricing" id="pricing"><div class="col-md-8"></div><div class="col-md-2"><p class="high">Totaal</p></div><div class="col-md-2" id="prices"><hr class="black"> <h4>€ ' . number_format($totalPrice,2) . ' </h4> </div></div>';
		  	
			
			if ($row_users['payed']) {

				$desc .= "<div class='row pricing' ><div class='col-md-8'></div><div class='col-md-2'><p>Betaald</p></div>";
		  		$desc .= "<div class='col-md-2' id='prices'><p>€ " . $row_users['amount'] . "</p></div></div>";
		  		
		  		if (($totalPrice - $row_users['amount']) > 0) {
						$desc .= "<div class='row pricing' ><div class='col-md-8'></div><div class='col-md-2'><p class='high'>Nog te betalen</p></div>";
				}
				else {
						$desc .= "<div class='row pricing' ><div class='col-md-8'></div><div class='col-md-2'><p class='high'>Teruggave</p></div>";

					}
		  		
		  		$desc .= '<div class="col-md-2" id="prices"><hr class="black"><h5>€ ' .  number_format($totalPrice - $row_users['amount'],2) . '</h5></div></div>';

			}
		  	
		  	echo $desc;
		  	}
		  	?>
	  </div>
  </div>

</body> 