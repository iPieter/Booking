<?php
require("../scripts/datalogin.php"); 

//Set the variables
$descCol = '<div id="pricing"><div class="col-md-8">';
$priceCol = '<div class="col-md-4" id="prices">';

$totalPrice = 0;

//Get all the states of the dates
$day_1 = $_POST["day_1"];
$day_2 = $_POST["day_2"];
$day_3 = $_POST["day_3"];
$day_4 = $_POST["day_4"];

//CALCULATE PRICES
//day 1
if ($day_1 == "true") {
	$price = mysqli_query($con,"SELECT * FROM days WHERE day=1");
	$row_price = mysqli_fetch_array($price);
	$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP);
	
	//add the description
	$descCol .= "<p>Maandag 01/09, overnachting tot dinsdag</p>";
	$priceCol .= "<p>€ " . $sharedPrice . "</p>";
	$totalPrice += $sharedPrice;
}

//day 2
if($day_2 == "true") {
	$price = mysqli_query($con,"SELECT * FROM days WHERE day=2");
	$row_price = mysqli_fetch_array($price);
	$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP) ;
	
	//add the description
	$descCol .= "<p>Dinsdag 02/09, overnachting tot woensdag</p>";
	$priceCol .= "<p>€ " . $sharedPrice . "</p>";
	$totalPrice += $sharedPrice;
}

//day 3
if ($day_3 == "true") {
	$price = mysqli_query($con,"SELECT * FROM days WHERE day=3");
	$row_price = mysqli_fetch_array($price);
	$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP) ;
	
	//add the description
	$descCol .= "<p>Woensdag 03/09, overnachting tot donderdag</p>";
	$priceCol .= "<p>€ " . $sharedPrice . "</p>";
	$totalPrice += $sharedPrice;
}

//day 4
if ($day_4 == "true") {
	$price = mysqli_query($con,"SELECT * FROM days WHERE day=4");
	$row_price = mysqli_fetch_array($price);
	$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests'] + 1),2,PHP_ROUND_HALF_UP) ;
	
	//add the description
	$descCol .= "<p>Donderdag 04/09, overnachting tot vrijdag</p>";
	$priceCol .= "<p>€ " . $sharedPrice . "</p>";
	$totalPrice += $sharedPrice;
}

//return the two colums
echo($descCol . "</div>");
echo($priceCol . '<hr class="black"> <h4>€ ' . number_format($totalPrice,2) . ' </h4> <button type="button" class="btn btn-primary btn-block" name="order"> <span class="glyphicon glyphicon-ok"></span> Reserveren</button> </div>' . '<script>

function notify() {
		var day1 = $("#day1").is(".selected");
        var day2 = $("#day2").is(".selected");
        var day3 = $("#day3").is(".selected");
        var day4 = $("#day4").is(".selected");
        

        
        $.ajax({
	        url: "scripts/order.php", 
	        type: "POST",
	        data: {day_1: day1, day_2: day2, day_3: day3, day_4: day4},
	        dataType: "html",
	        success: function(data){
	        	window.location.href = "scripts/order.php?day_1=" + day1 + "&day_2=" + day2 + "&day_3=" + day3 + "&day_4=" + day4;
	        	
	        }
	    });
}

$( "button" ).on( "click", notify );


</script>');
?>