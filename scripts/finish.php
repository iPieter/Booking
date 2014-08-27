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

$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

//get the ip
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `ip`, `page`) VALUES ('$username', '$ip', 'scripts/finish.php');");


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
			$day1 = $row_days['guests'] + 1;
			if ($day_1 == 'true') {mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day1' WHERE `days`.`id` = 1;");}
			break;	
		case 2:
			$day2 = $row_days['guests'] + 1;
			if ($day_2 == 'true') {mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day2' WHERE `days`.`id` = 2;");}
			break;			
		case 3:
			$day3 = $row_days['guests'] + 1;
			if ($day_3 == 'true') {mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day3' WHERE `days`.`id` = 3;");}
			break;			
		case 4:	
			$day4 = $row_days['guests'] + 1;
			if ($day_4 == 'true') {mysqli_query($con,"UPDATE `Booking`.`days` SET `guests` = '$day4' WHERE `days`.`id` = 4;");}
			break;	

	}
	 
}


?>

<h1 class="center">Reservatie ontvangen</h1><img id="giraffe" src="../images/giraffe.png" alt="giraffe" />

</body>