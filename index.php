<html>
<head>
	<title>Giraffen Op Reis</title>
	
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display|Open+Sans:100,300,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>

<?php 
// First we execute our common code to connection to the database and start the session 
require("scripts/common.php"); 
require("scripts/datalogin.php");
// At the top of the page we check to see whether the user is logged in or not 
if(empty($_SESSION['user'])) 
{ 
    // If they are not, we redirect them to the login page. 
    header("Location: account/login.php"); 
     
    // Remember that this die statement is absolutely critical.  Without it, 
    // people can view your members-only content without logging in. 
    die("Redirecting to account/login.php"); 
}

include("topbar.php");

//get the ip
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `ip`, `page`) VALUES ('$username', '$ip', 'index.php');");


//include the booking or changing page, based on booked=true or false
$booked = mysqli_query($con,"SELECT * FROM votes WHERE `votes`.`name` = '$username';");


if (mysqli_fetch_array($booked) == false) {
	include("scripts/index/vote.php");
} else {
	include("scripts/index/voted.php");
}

?>

</body> 