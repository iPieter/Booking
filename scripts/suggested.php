<html>
<head>
	<title>Giraffen Op Reis</title>
	
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
$destination = $_POST["destination"];
$concept = $_POST["concept"];

$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

//get the ip
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `ip`, `page`) VALUES ('$username', '$ip', 'scripts/suggested.php');");


//set the days in the database
mysqli_query($con,"INSERT INTO `destinations` (`destination`, `concept`, `user` ) VALUES ('$destination','$concept', '$username')");
mysqli_query($con,"UPDATE `users` SET `destinationID` = 1 WHERE `users`.`username` = '$username'");
?>

<h1 class="center">Suggestie ontvangen</h1><img id="giraffe" src="../images/giraffe.png" alt="giraffe" />

</body>