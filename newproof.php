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
p1 {
	color: orange;
	font-size: 25px;
	font-weight: bold;
	text-align: center;
	 
	}
input[type=submit]:hover {
    background-color: #45a049;
}
</style>
<body>
	<br><br>
	<div class="container">
  
  <div class="progress">
	  <div class="progress-bar progress-bar" role="progressbar" style="width:50%">
      Personal Details
    </div>
       <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" style="width:50%">
      Proofs
    
      
    </div>
  </div>
</div>
	</div>
	</div>
	<fieldset>
     <legend><center>Registration Form</center></legend>
	    <form action="" method="post" enctype="multipart/form-data">
	       <table align='center'>
		   <tr>
	          <td>Driving Licence</td><td> </td>
			  <td><input id="Licence" class="form control" type="text" name="Licence"  pattern=".{16,16}" maxlength="16" /></td>	 
		   </tr>
		   <tr>
	          <td>Voter ID</td><td> </td>
			  <td><input id="Voter" class="form control" type="text" name="Voter" pattern=".{12,12}" maxlength="12"/></td>	   
		   </tr>
		   <tr>
	          <td>Ration Card</td><td> </td>
			  <td><input id="Ration" class="form control" type="text" name="Ration" pattern=".{10,10}" maxlength="10"/></td>	   
		   </tr>
		   <tr>
	          <td>Pan Card</td><td> </td>
			  <td><input id="Pan" class="form control" type="text" name="Pan" pattern=".{10,10}" maxlength="10" >
			  </td>	   
		   </tr>
		   <tr>
	          <td>Passport</td><td> </td>
			  <td><input id="Passport" class="form control" type="text" name="Passport"  pattern=".{10,10}"  maxlength="10" /></td>	   
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
	    $licence=$_REQUEST["Licence"];
	    $aadhar=$_SESSION['Aadhar'];
	    $voter=$_REQUEST["Voter"];
	    $ration=$_REQUEST["Ration"];
	    $pan=$_REQUEST["Pan"];
	    $passport=$_REQUEST["Passport"];
		
	  	
		if(empty($licence)){
			$licence = 'NULL';
				}
			else{
			$licence = "'".$licence."'";
				}
		if(empty($voter)){
			$voter= 'NULL';
				}
			else{
			$voter = "'".$voter."'";
				}
		if(empty($ration)){
			$ration = 'NULL';
				}
			else{
			$ration = "'".$ration."'";
				}
		if(empty($pan)){
			$pan = 'NULL';
				}
			else{
			$pan = "'".$pan."'";
				}
		if(empty($passport)){
			$passport = 'NULL';
				}
			else{
			$passport = "'".$passport."'";
				}
				
		$query="Insert into proofs values('$aadhar',$licence,$voter,$ration,$pan,$passport)";
		$result=mysqli_query($con,$query) or die("<p1>Check for the etails Properly</p1>" . mysql_error());
		if($result>0)
		{
			
		 echo nl2br("<p1>Data feed success!!! </p1>");
		 echo '<script type="text/javascript">';
        echo 'window.location.href="login.php";';
        echo '</script>';
		}
			
	
}	
	 ?>
</body>
</html>
