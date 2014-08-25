<html>
<head>
	<title>Giraffen Aan Zee</title>
	
	<link href='http://fonts.googleapis.com/css?family=Cutive+Mono|Open+Sans:200,300,500' rel='stylesheet' type='text/css'>
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

mysqli_query($con,"INSERT INTO `Booking`.`logins` (`username`, `page`) VALUES ('$username', 'index.php');");


//include the booking or changing page, based on booked=true or false
$booked = mysqli_query($con,"SELECT booked FROM users WHERE `users`.`username` = '$username';");
$row_booked = mysqli_fetch_array($booked);

if ($row_booked['booked'] == false) {
	include("scripts/index/booking.php");
} else {
	include("scripts/index/changing.php");
}

?>
</body> 