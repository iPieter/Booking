<div id="topbar">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/booking/">Giraffen Aan Zee</a>
    </div>



      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php 	
			$username = htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
			echo($username);
			
			$booked = mysqli_query($con,"SELECT booked FROM users WHERE `users`.`username` = '$username';");
			$row_booked = mysqli_fetch_array($booked);

			
	
		?>
 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php 
            if ($username == 'Pieter Delobelle') { echo '<li><a href="/booking/scripts/visits.php">Bezoekers</a></li>';} 
            if ($row_booked['booked'] == true) { echo '<li><a href="/booking/order.php">Bekijk reservatie</a></li><li class="divider"></li>';} 
            
            ?>
            <li><a href="/booking/account/logout.php">Uitloggen</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

</div>
