<?php
//THE DATA FOR THE FOUR DATES
//Get all the days and the number of persons
$days = mysqli_query($con,"SELECT * FROM days");

//go trought this list
while ($row_days = mysqli_fetch_array($days)) {
									
	//loop throught all four dates, check them and assign the correct number of people for that day
	switch($row_days['day']) {
		case 1:
			$day1 = $row_days['guests'];
			break;	
		case 2:
			$day2 = $row_days['guests'];
			break;			
		case 3:
			$day3 = $row_days['guests'];
			break;			
		case 4:	
			$day4 = $row_days['guests'];
			break;	

	}
	 
}

//get the booking information of each day
$bookings = mysqli_query($con,"SELECT * FROM users WHERE `users`.`username` = '$username';");
$row_bookings = mysqli_fetch_array($bookings);


?>
	

<div class="container" id="page">
  
	<!-- THE DAY SELECTION PAGE -->  
  <div class="row">
      <div class="col-md-3 <?php if ($row_bookings['day1']) {echo("booked selected");} ?> " id="day1">
	      <h1>Ma-Di</h1>
	      <h2>01 sept</h2>
	      <hr>
	      <h3><b><?php echo($day1); ?></b>/8</h3>
      </div>
      <div class="col-md-3 <?php if ($row_bookings['day2']) {echo("booked selected");} ?> " id="day2">
	      <h1>Di-Wo</h1>
	      <h2>02 sept</h2>
	      <hr>
	      <h3><b><?php echo($day2); ?></b>/8</h3>
      </div>
      <div class="col-md-3 <?php if ($row_bookings['day3']) {echo("booked selected");} ?> " id="day3">
	      <h1>Wo-Do</h1>
	      <h2>03 sept</h2>
	      <hr>
	      <h3><b><?php echo($day3); ?></b>/8</h3>
	  </div>
      <div class="col-md-3 <?php if ($row_bookings['day4']) {echo("booked selected");} ?> " id="day4">
	      <h1>Do-Vr</h1>
	      <h2>04 sept</h2>
	      <hr>
	      <h3><b><?php echo($day4); ?></b>/8</h3>
	  </div>
  </div>
  
  <!-- THE PRICING PAGE -->
  <div class="row" id="price">
	  <div class="col-md-1">
	  
	  </div>
	  <div id="pricing" class="col-md-10">
	  	<?php
		
		//Set the variables
		$descCol = '<div id="pricing"><div class="col-md-8">';
		$priceCol = '<div class="col-md-4" id="prices">';
		
		$totalPrice = 0;
		
		//Get all the states of the dates
		$day_1 = $row_bookings['day1'];
		$day_2 = $row_bookings['day2'];
		$day_3 = $row_bookings['day3'];
		$day_4 = $row_bookings['day4'];
		
		//CALCULATE PRICES
		//day 1
		if ($day_1) {
			$price = mysqli_query($con,"SELECT * FROM days WHERE day=1");
			$row_price = mysqli_fetch_array($price);
			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP);
			
			//add the description
			$descCol .= "<p>Maandag 01/09, overnachting tot dinsdag</p>";
			$priceCol .= "<p>€ " . $sharedPrice . "</p>";
			$totalPrice += $sharedPrice;
		}
		
		//day 2
		if($day_2) {
			$price = mysqli_query($con,"SELECT * FROM days WHERE day=2");
			$row_price = mysqli_fetch_array($price);
			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP) ;
			
			//add the description
			$descCol .= "<p>Dinsdag 02/09, overnachting tot woensdag</p>";
			$priceCol .= "<p>€ " . $sharedPrice . "</p>";
			$totalPrice += $sharedPrice;
		}
		
		//day 3
		if ($day_3) {
			$price = mysqli_query($con,"SELECT * FROM days WHERE day=3");
			$row_price = mysqli_fetch_array($price);
			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP) ;
			
			//add the description
			$descCol .= "<p>Woensdag 03/09, overnachting tot donderdag</p>";
			$priceCol .= "<p>€ " . $sharedPrice . "</p>";
			$totalPrice += $sharedPrice;
		}
		
		//day 4
		if ($day_4) {
			$price = mysqli_query($con,"SELECT * FROM days WHERE day=4");
			$row_price = mysqli_fetch_array($price);
			$sharedPrice = round($row_price['totalPrice'] / ($row_price['guests']),2,PHP_ROUND_HALF_UP) ;
			
			//add the description
			$descCol .= "<p>Donderdag 04/09, overnachting tot vrijdag</p>";
			$priceCol .= "<p>€ " . $sharedPrice . "</p>";
			$totalPrice += $sharedPrice;
		}
		
		//return the two colums
		echo($descCol . "</div>");
		echo($priceCol . '<hr class="black"> <h4>€ ' . number_format($totalPrice,2) . ' </h4> </div>');
		?>
	  </div>
</div>

<script>

$(document).ready(function() {
    $(".dropdown-toggle").dropdown();

    $(".col-md-3").click(function(event) {
        var id = jQuery(this).attr("id");
        
        //Set the layout of the clicked id
        if ($("#" + id).is(".selected") && !($("#" + id).is(".full"))) { 
	        $("#" + id).removeClass( "selected" );
        }
        else {
        	if (!($("#" + id).is(".full"))) {
        		$("#" + id).addClass( "selected");
        }}
        
        //send an updated list of all the selected days to the server for a updated pricing
        var day1 = $("#day1").is(".selected");
        var day2 = $("#day2").is(".selected");
        var day3 = $("#day3").is(".selected");
        var day4 = $("#day4").is(".selected");
        
        $.ajax({
	        url: "scripts/pricing_booked.php", 
	        type: "POST",
	        data: {day_1: day1, day_2: day2, day_3: day3, day_4: day4},
	        dataType: 'html',
	        success: function(data){
	        	$('#pricing').html(data);
	        	
	        	if (day1 == false && day2 == false && day3 == false && day4 == false) {
		        }
	        
	        }
	    });
	     	     

    });
});
</script>
