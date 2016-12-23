<!DOCTYPE html>
<html lang="en">
<head>
  <title>Personal Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<style>
td {
    padding: 15px;
}
</style>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">PRMS</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
        
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
		session_start();
		$myfile = fopen("/var/www/html/pass.txt", "r") or die("Unable to open file!");
		$password = fread($myfile,filesize("/var/www/html/pass.txt"));
		fclose($myfile);
	   
		$con = mysql_connect("localhost","root",$password) or die("error in database connection" . mysql_error());
        @mysql_select_db(patient) or die( "Unable to select database");
		$aadhar=$_SESSION['aadhar'];

		$query = "SELECT * FROM proofs WHERE aadhar='$aadhar'"; 
		$result = mysql_query($query) or die("error in selecting data in db" . mysql_error());
		$licence=mysql_result($result,0,"licence");
		$voter=mysql_result($result,0,"voter");
	    $ration=mysql_result($result,0,"ration");
		$pan=mysql_result($result,0,"pan");
		$passport=mysql_result($result,0,"passport");
		


		
		echo "<center><u><b>Proofs</b></u></center><br><br>";
		echo '<table align="center" class="table table-striped table-bordered db-table">';
		
		echo "<tr><td>licence </td><td> $licence</td></tr>";
		echo "<tr><td>voter id </td><td> $voter</td></tr>";
		echo "<tr><td>ration card </td><td> $ration</td></tr>";
		echo "<tr><td>pan card </td><td> $pan</td></tr>";
		echo "<tr><td>passport number </td><td> $passport</td></tr>";
		
		echo '</table><br />';
		
?>
</body>
</html>
