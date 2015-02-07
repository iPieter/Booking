<html>
<head>
	<title>Bestemmingen</title>
	
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

<div class="container">
  <!-- THE PRICING PAGE -->
  <div class="row" id="price">
	  <div class="col-md-1">
	  
	  </div>
	  <div class="col-md-10">
		  
		<?php
		//loop through each username
		$users = mysqli_query($con, "SELECT * FROM destinations");
		while ($row_users = mysqli_fetch_array($users)) {  	
		  	
		  	echo '<div class="title" id="overview"> <h1>'.$row_users['user'].'</h1></div>';
					
			$destination = $row_users['destination'];
			$concept = $row_users['concept'];

		  	echo '<div class="row">
    <label for="inputDestination"  class="col-sm-2 control-label">Bestemming</label>
    <div class="col-sm-10">
      ' . $destination . '
    </div>
  </div>
  <div class="row">
    <label for="inputConcept"  class="col-sm-2 control-label">Concept</label>
    <div class="col-sm-10">
      ' . $concept . '
    </div>
  </div>';
			
		  	}
		  	?>
	  </div>
  </div>

</body> 