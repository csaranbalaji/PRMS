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
      <a class="navbar-brand" href="#">WebSiteName</a>
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

$query = "SELECT * FROM personal WHERE aadhar='$aadhar'"; 
$result = mysql_query($query) or die("error in selecting data in db" . mysql_error());
$dquery = "select date_format(dob,'%d-%m-%Y') as dob from personal WHERE aadhar='$aadhar'"; 
$dresult = mysql_query($dquery) or die("error in selecting data in db" . mysql_error());
		$name=mysql_result($result,0,"name");
		$aadhar=mysql_result($result,0,"aadhar");
	    $address=mysql_result($result,0,"address");
		$mobile=mysql_result($result,0,"phone");
		$dob=mysql_result($dresult,0,"dob");
		$gender=mysql_result($result,0,"gender");
		$emergency=mysql_result($result,0,"emergency");
		$blood=mysql_result($result,0,"blood");


		
		echo "<center><u><b>Personal data</b></u><br><br></center>";
		echo '<table cellpadding="5" cellspacing="10" align="center" class="db-table">';
		
		echo "<tr><td>Name </td><td>: $name</td></tr>";
		echo "<tr><td>Aadhar </td><td>: $aadhar</td></tr>";
		echo "<tr><td>Address </td><td>: $address</td></tr>";
		echo "<tr><td>Mobile </td><td>: $mobile</td></tr>";
		echo "<tr><td>DOB </td><td>: $dob</td></tr>";
		echo "<tr><td>Gender </td><td>: $gender</td></tr>";
		echo "<tr><td>Emergency no </td><td>: $emergency</td></tr>";
		echo "<tr><td>Blood group <td>: $blood</td></tr>";
		
		echo '</table><br />';
?>

</body>
</html>
