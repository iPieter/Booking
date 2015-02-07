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
		
//loop through each username

$scorePraag = 0;
$scoreDubrovnik = 0;
$scoreRome = 0;
$scorePorto = 0;
$scoreMax = 0;


$user_votes = mysqli_query($con, "SELECT * FROM votes");
while ($row_votes = mysqli_fetch_array($user_votes)) {  	
  	    		
    $scorePraag += $row_votes['scorePraag'] * $row_votes['checkPraag'];
    $scoreDubrovnik += $row_votes['scoreDubrovnik'] * $row_votes['checkDubrovnik'];
    $scorePorto += $row_votes['scorePorto'] * $row_votes['checkPorto'];
    $scoreRome += $row_votes['scoreRome'] * $row_votes['checkRome'];
    $scoreMax +=4;
    
  	}
		  	
?>

<div class="container" id="page">
  <div class="row">
      <div class="col-md-6" id="dubrovnik">
      <div class="padfix">
      	  <img src="../images/destinations/dubrovnik.jpg" alt="dubrovnik" width="100%"/>
	      <h1>Duvrovnik</h1>
	      <h2>Kroatie</h2>
	      <hr>
	      <h3><b><?php echo($scoreDubrovnik . "</b>/" . $scoreMax);?></h3>
      </div>
      </div>
      <div class="col-md-6" id="praag">
      <div class="padfix">
      	  <img src="../images/destinations/praag.jpg" alt="praag" width="100%"/>
	      <h1>Praag &amp; Wenen</h1>
	      <h2>Tsjechi&euml; &amp; Oostenrijk</h2>
	      <hr>
	      <h3><b><?php echo($scorePraag . "</b>/" . $scoreMax);?></h3>
      </div>
      </div>
  </div>
  <div class="row"> 
      <div class="col-md-6" id="rome">
      <div class="padfix">
      	  <img src="../images/destinations/rome.jpg" alt="rome" width="100%"/>
	      <h1>Rome</h1>
	      <h2>Itali&euml;</h2>
	      <hr>
	      <h3><b><?php echo($scoreRome . "</b>/" . $scoreMax);?></h3>
      </div>
      </div>
      <div class="col-md-6" id="porto">
      <div class="padfix">
      	  <img src="../images/destinations/porto.jpg" alt="porto" width="100%"/>
	      <h1>Porto</h1>
	      <h2>Portugal</h2>
	      <hr>
	      <h3><b><?php echo($scorePorto . "</b>/" . $scoreMax);?></h3>
      </div>
      </div>     

  </div>
  </div>

</body> 