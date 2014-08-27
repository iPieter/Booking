<tr><th>#</th><th>Gebruikersnaam</th><th>Datum en tijd</th><th>Pagina</th><th>IP-adres</th></tr>

<?php

// First we execute our common code to connection to the database and start the session 
require("common.php"); 
require("datalogin.php");

$visitors =  mysqli_query($con,"SELECT * FROM logins ORDER  BY id DESC LIMIT 30");

while ($row_visitors = mysqli_fetch_array($visitors)) {
	
	echo "<tr><td>" . $row_visitors['id'] . "</td><td>". $row_visitors['username'] . "</td><td>".$row_visitors['dtime'] . "</td><td> <a href='../".$row_visitors['page'] . "'>" . $row_visitors['page']."</td><td>". $row_visitors['ip'] . "</td></tr>";
}

?>


