<?php
require("../scripts/datalogin.php"); 
require("../scripts/common.php"); 

//Set the variables
$descCol = '<div id="pricing"><div class="col-md-8">';
$priceCol = '<div class="col-md-4" id="prices">';

$totalPrice = 0;

//Get all the states of the dates
$day_1 = $_POST["day_1"];
$day_2 = $_POST["day_2"];
$day_3 = $_POST["day_3"];
$day_4 = $_POST["day_4"];

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
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2);
		$descCol .= "<p>Maandag 01/09, overnachting tot dinsdag</p>";
	} else {
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP),2);
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
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2);
		$descCol .= "<p>Dinsdag 02/09, overnachting tot woensdag</p>";
	} else {
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP),2);
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
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2);
		$descCol .= "<p>Woensdag 03/09, overnachting tot donderdag</p>";
	} else {
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP),2);
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
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP),2);
		$descCol .= "<p>Donderdag 04/09, overnachting tot vrijdag</p>";
	} else {
		$sharedPrice = number_format(round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP),2);
		$descCol .= '<p><span class="glyphicon glyphicon-plus-sign"></span> Donderdag 04/09, overnachting tot vrijdag</p>';		
		
	}
	
	//add the description
	$priceCol .= "<p>€ " . $sharedPrice . "</p>";
	$totalPrice += $sharedPrice;
}

//RETURN PRICES AND ORDER BTN

if ($day_1 == 'false' && $day_2 == 'false' && $day_3 == 'false' && $day_4 == 'false') {

	echo('<div id="pricing"><div class="col-md-4"></div>');
	echo($priceCol . '<button type="button" class="btn btn-danger btn-block" name="order"> <span class="glyphicon glyphicon-remove"></span> Verwijder reservatie</button> </div>' . '<script>

function notify() {
		var day1 = $("#day1").is(".selected");
        var day2 = $("#day2").is(".selected");
        var day3 = $("#day3").is(".selected");
        var day4 = $("#day4").is(".selected");
        

        
        $.ajax({
	        url: "scripts/cancel.php", 
	        type: "POST",
	        data: {day_1: day1, day_2: day2, day_3: day3, day_4: day4},
	        dataType: "html",
	        success: function(data){
	        	window.location.href = "scripts/cancel.php?day_1=" + day1 + "&day_2=" + day2 + "&day_3=" + day3 + "&day_4=" + day4;
	        	
	        }
	    });
}

$( "button" ).on( "click", notify );


</script>'); 


} elseif ($day_1 == ($day1_booked? 'true' : 'false') && $day_2 == ($day2_booked? 'true' : 'false') && $day_3 == ($day3_booked? 'true' : 'false') && $day_4 == ($day4_booked? 'true' : 'false')) {
	echo($descCol . "</div>");
	echo($priceCol . '<hr class="black"> <h4>€ ' . number_format($totalPrice,2) . ' </h4></div>'); 
} else {
	echo($descCol . "</div>");
	echo($priceCol . '<hr class="black"> <h4>€ ' . number_format($totalPrice,2) . ' </h4> <button type="button" class="btn btn-primary btn-block" name="order"> <span class="glyphicon glyphicon-pencil"></span> Wijzig reservatie</button> </div>' . '<script>

function notify() {
		var day1 = $("#day1").is(".selected");
        var day2 = $("#day2").is(".selected");
        var day3 = $("#day3").is(".selected");
        var day4 = $("#day4").is(".selected");
        

        
        $.ajax({
	        url: "scripts/order_booked.php", 
	        type: "POST",
	        data: {day_1: day1, day_2: day2, day_3: day3, day_4: day4},
	        dataType: "html",
	        success: function(data){
	        	window.location.href = "scripts/order_booked.php?day_1=" + day1 + "&day_2=" + day2 + "&day_3=" + day3 + "&day_4=" + day4;
	        	
	        }
	    });
}

$( "button" ).on( "click", notify );


</script>'); 
}
?>