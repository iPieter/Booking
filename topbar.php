<div id="topbar">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

      <a class="navbar-brand" href="/booking/">Giraffen Op Reis</a>
    </div>



      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php 	
			$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
			echo($username);
			
	
		?>
 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php 
            if ($username == 'Pieter Delobelle') { echo '<li><a href="/booking/scripts/visits.php">Bezoekers</a></li><li><a href="/booking/scripts/overview.php">Bestemmingen</a></li><li><a href="/booking/scripts/view_votes.php">Stemmen</a></li><li class="divider"></li>';} 
            //if ($row_booked['destinationID'] != 0) { echo '<li><a href="/booking/order.php">Bekijk suggestie</a></li><li class="divider"></li>';} 
            
            ?>
            <li><a href="/booking/account/logout.php">Uitloggen</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

</div>
