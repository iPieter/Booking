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


?>
	

<div class="container" id="page">
  
	<!-- THE DAY SELECTION PAGE -->  
  <div class="row">
      <div class="col-md-3 <?php if ($day1 >= 8) {echo("full");} ?> " id="day1">
	      <h1>Ma-Di</h1>
	      <h2>01 sept</h2>
	      <hr>
	      <h3><b><?php echo($day1); ?></b>/8</h3>
	      <hr>
	      <div class="weather"><div class="icon">F</div> 19&deg <div class="min"> 12&deg</div></div>	      
      </div>
      <div class="col-md-3 <?php if ($day2 >= 8) {echo("full");} ?> " id="day2">
	      <h1>Di-Wo</h1>
	      <h2>02 sept</h2>
	      <hr>
	      <h3><b><?php echo($day2); ?></b>/8</h3>
	      <hr>
	      <div class="weather"><div class="icon">C</div> 19&deg <div class="min"> 13&deg</div></div>
      </div>
      <div class="col-md-3 <?php if ($day3 >= 8) {echo("full");} ?> " id="day3">
	      <h1>Wo-Do</h1>
	      <h2>03 sept</h2>
	      <hr>
	      <h3><b><?php echo($day3); ?></b>/8</h3>
	      <hr>
	      <div class="weather"><div class="icon">A</div> 20&deg <div class="min"> 15&deg</div></div>
	  </div>
      <div class="col-md-3 <?php if ($day4 >= 8) {echo("full");} ?> " id="day4">
	      <h1>Do-Vr</h1>
	      <h2>04 sept</h2>
	      <hr>
	      <h3><b><?php echo($day4); ?></b>/8</h3>
	      <hr>
	      <div class="weather"><div class="icon">A</div> 21&deg <div class="min"> 16&deg</div></div>
	  </div>
  </div>
  
  <!-- THE PRICING PAGE -->
  <div class="row" id="price">
	  <div class="col-md-1">
	  
	  </div>
	  <div id="pricing" class="col-md-10">
	  	<p class="center">Je hebt nog geen enkele dag geselecteerd; klik op een datum om deze te reserveren.</p>
	  	<img id="sad_giraffe" src="images/sad_giraffe.png" alt="sad_giraffe" />
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
	        url: "scripts/pricing.php", 
	        type: "POST",
	        data: {day_1: day1, day_2: day2, day_3: day3, day_4: day4},
	        dataType: 'html',
	        success: function(data){
	        	$('#pricing').html(data);
	        	
	        	if (day1 == false && day2 == false && day3 == false && day4 == false) {
		        	$('#pricing').html('<p class="center">Je hebt nog geen enkele dag geselecteerd; klik op een datum om deze te reserveren.</p><img id="sad_giraffe" src="images/sad_giraffe.png" alt="sad_giraffe" />');		     
		        }
	        
	        }
	    });
	     	     

    });
});
</script>
