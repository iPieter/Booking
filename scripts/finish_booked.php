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

//MAKE THE BOOKING
//Get all the states of the dates
$day_1 = $_GET["day_1"];
$day_2 = $_GET["day_2"];
$day_3 = $_GET["day_3"];
$day_4 = $_GET["day_4"];

//get the booking information of each day
$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `page`) VALUES ('$username', 'finish_booking.php');");


$bookings = mysqli_query($con,"SELECT * FROM users WHERE `users`.`username` = '$username';");
$row_bookings = mysqli_fetch_array($bookings);

$day1_booked = $row_bookings['day1'];
$day2_booked = $row_bookings['day2'];
$day3_booked = $row_bookings['day3'];
$day4_booked = $row_bookings['day4'];

//set the days in the database
mysqli_query($con,"UPDATE `Booking`.`users` SET `day1` = $day_1, `day2` = $day_2, `day3` = $day_3, `day4` = $day_4, `booked` = '1' WHERE `users`.`username` = '$username';");

//SET THE DAY PROPERTIES
//THE DATA FOR THE FOUR DATES
//Get all the days and the number of persons
$days = mysqli_query($con,"SELECT * FROM days");

//go trought this list
while ($row_days = mysqli_fetch_array($days)) {
									
	//loop throught all four dates, check them and assign the correct number of people for that day
	switch($row_days['day']) {
		case 1:
			if ($day_1 == 'true' && !$day1_booked) {
			
				$day1 = $row_days['guests'] + 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day1' WHERE `days`.`id` = 1;");
			
			} elseif ($day_1 == 'false' && $day1_booked) {
			
				$day1 = $row_days['guests'] - 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day1' WHERE `days`.`id` = 1;");
			
			}
			break;	
		case 2:
			if ($day_2 == 'true' && !$day2_booked) {
			
				$day2 = $row_days['guests'] + 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day2' WHERE `days`.`id` = 2;");
			
			} elseif ($day_2 == 'false' && $day2_booked) {
			
				$day2 = $row_days['guests'] - 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day2' WHERE `days`.`id` = 2;");
			
			}			
			break;			
		case 3:
			if ($day_3 == 'true' && !$day3_booked) {
			
				$day3 = $row_days['guests'] + 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day3' WHERE `days`.`id` = 3;");
			
			} elseif ($day_3 == 'false' && $day3_booked) {
			
				$day3 = $row_days['guests'] - 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day3' WHERE `days`.`id` = 3;");
			
			}			
			break;	
		case 4:	
			if ($day_4 == 'true' && !$day4_booked) {
			
				$day4 = $row_days['guests'] + 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day4' WHERE `days`.`id` = 4;");
			
			} elseif ($day_4 == 'false' && $day4_booked) {
			
				$day4 = $row_days['guests'] - 1;
				mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day4' WHERE `days`.`id` = 4;");
			
			}			
			break;		

	}
	 
}


?>

<h1 class="center">Reservatie ontvangen</h1><img id="giraffe" src="../images/giraffe.png" alt="giraffe" />
</body>