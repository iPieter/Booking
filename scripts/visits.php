<html>
<head>
	<title>Bezoekers</title>
	
	<link href='http://fonts.googleapis.com/css?family=Cutive+Mono|Open+Sans:100,300,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.css" rel="stylesheet">
</head>
<body>
<?php 
// First we execute our common code to connection to the database and start the session 
require("common.php"); 
require("datalogin.php");
// At the top of the page we check to see whether the user is logged in or not 
if(empty($_SESSION['user'])) 
{ 
    // If they are not, we redirect them to the login page. 
    header("Location: ../account/login.php"); 
     
    // Remember that this die statement is absolutely critical.  Without it, 
    // people can view your members-only content without logging in. 
    die("Redirecting to ../account/login.php"); 
}

include("../topbar.php");

?>

<div class="container" id="page">
  
  <div class="row">
      <div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading"><h1>Bezoekers</h1></div>

<table class="table table-striped">
<tr><th>#</th><th>Gebruikersnaam</th><th>Datum en tijd</th><th>Pagina</th></tr>

<?php

$visitors =  mysqli_query($con,"SELECT * FROM logins");

while ($row_visitors = mysqli_fetch_array($visitors)) {
	
	echo "<tr><td>" . $row_visitors['id'] . "</td><td>". $row_visitors['username'] . "</td><td>".$row_visitors['dtime'] . "</td><td> <a href='../".$row_visitors['page'] . "'>" . $row_visitors['page']. "</td></tr>";
}

?>


		</table>
      </div>
  </div>
  </div>
</div>
</body> 