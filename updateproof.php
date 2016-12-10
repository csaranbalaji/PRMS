<?php
session_start();
?>
<html>
<head>
<title>Proof</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
body {
    background-color: lavender;
}
td {
    padding: 5px;
}
input[type=submit]:hover {
    background-color: #45a049;
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
	<fieldset>
     <legend><center>Additional Proofs</center></legend>
	    <form action="" method="post" enctype="multipart/form-data">
	       <table align="center" >
			<tr>
	          <td>Proof</td>
	         </tr>
	         <tr>
			  <td> <select name="Proof">
				  <option value="">Select...</option>
					<option value="licence">Licence</option>
					<option value="voter">Voter</option>
					<option value="ration">Ration</option>
					<option value="pan">Pan</option>
					<option value="passport">Passport</option>
				 </select></td>	   
				
			  <td><input id="NewProof" type="text" name="idnum" pattern=".{10,16}" maxlength="16" required /></td>	   
		   </tr>
		   <tr>
	          <td></td>
			  <td><input id="btnSubmit" type="submit" name="btnSubmit"  value="Submit"/></td>
			   
		   </tr>
		   </table>
		</form>
</fieldset>
<?php
	if(isset($_REQUEST["btnSubmit"]))
	 {
		$myfile = fopen("/var/www/html/pass.txt", "r") or die("Unable to open file!");
		$password = fread($myfile,filesize("/var/www/html/pass.txt"));
		fclose($myfile);
	   
		$con = mysqli_connect("localhost","root",$password) or die("error in database connection" . mysql_error());
        mysqli_select_db($con ,"patient") or die("error to select the db" . mysql_error());
	    $proof=$_REQUEST["Proof"];
	    $aadhar=$_SESSION['aadhar'];
	    $idnum=$_REQUEST["idnum"];
	    
	   
	    
		$query="update proofs set $proof=$idnum where aadhar='$aadhar'";
		$result=mysqli_query($con,$query) or die("error in inserting data in db" . mysql_error());
	  		
		
		
		if($result>0)
		{
		 echo nl2br("\n Data feed success!!! ");
		}
			
	
}	
	 ?>
</body>
</html>
