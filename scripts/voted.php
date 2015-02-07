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
$scoreDubrovnik = $_GET["scoreDubrovnik"];
$scorePraag = $_GET["scorePraag"];
$scoreRome = $_GET["scoreRome"];
$scorePorto = $_GET["scorePorto"];

if (isset($_GET["checkDubrovnik"])) 
$checkDubrovnik = 1;
else 
$checkDubrovnik = 0;

if (isset($_GET["checkPraag"]))
$checkPraag = 1;
else 
$checkPraag = 0;

if (isset($_GET["checkRome"]))
$checkRome = 1;
else 
$checkRome = 0;

if (isset($_GET["checkPorto"]))
$checkPorto = 1;
else 
$checkPorto = 0;

$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');

//get the ip
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `ip`, `page`) VALUES ('$username', '$ip', 'scripts/voted.php');");

//set the days in the database
mysqli_query($con,"INSERT INTO `votes`(`name`, `checkDubrovnik`, `checkPraag`, `checkRome`, `checkPorto`, `scoreDubrovnik`, `scorePraag`, `scoreRome`, `scorePorto`) VALUES ('$username', $checkDubrovnik,$checkPraag,$checkRome,$checkPorto,$scoreDubrovnik,$scorePraag,$scoreRome,$scorePorto);");



?>

<h1 class="center">Stem ontvangen</h1><img id="giraffe" src="../images/giraffe.png" alt="giraffe" />

</body>