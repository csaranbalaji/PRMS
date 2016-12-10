<?php
session_start();

?>
<html>
<head>
<title>Registration form</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script type="text/javascript">
        <!--

        function Showpass() {
            if (document.getElementById('check').checked) {
                document.getElementById('Password').type = 'text';
            } 
            else {
                document.getElementById('Password').type = 'password';
            }
        }

        //-->
        </script>
</head>
<style>
input[type=text],[type=password],[type=email],[type=address], select {
    width: 100%;
    padding: 6px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
body {
    background-color: lavender;
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
p1 {
	color: orange;
	font-size: 25px;
	font-weight: bold;
	 text-align: center;
	}

td {
    padding: 5px;
}
input[type=submit]:hover {
    background-color: #45a049;
}
</style>
<body>
	<br><br>
	<div class="container">
  
  <div class="progress">
    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" style="width:50%">
      Personal Details
    </div>
    <div class="progress-bar progress-bar" role="progressbar" style="width:50%">
      Proofs
    
      
    </div>
  </div>
</div>
	</div>
	</div>
<fieldset>
     <legend><center>Registration Form</center></legend>
	    <form action="" method="post" enctype="multipart/form-data">
	       <table align='center' >
		   <tr>
	          <td>Aadhar Number</td>
			  <td><input id="Aadhar" type="text" name="Aadhar"  pattern=".{12,12}" maxlength="12" required/></td>	   
		   </tr>
		   <tr> 
	          <td>Name</td>
			  <td><input id="Name" type="text" name="Name"  required maxlength="30" /></td>	   
		   </tr>
		   <tr>
	          <td>DOB</td>
			  <td><input id="DOB" type="text" name="DOB" required /></td>	   
		   </tr>
		   <tr>
	          <td>Gender</td>
			  <td><input type="radio"  required name="Gender"  value="F">Female
				<input type="radio" required name="Gender"  value="M">Male
			</td>
		   </tr>
		    <tr>
	          <td>Blood group</td>
			  <td> <select  required name="Blood">
				  <option value="">Select...</option>
					<option value="O+">O+</option>
					<option value="A+">A+</option>
					<option value="B+">B+</option>
					<option value="AB+">AB+</option>
					<option value="O-">O-</option>
					<option value="A-">A-</option>
					<option value="B-">B-</option>
					<option value="AB-">AB-</option>
				   </select></td>	   
		   </tr>
		   
		      <tr>
	          <td>Address</td>
			  <td><textarea name="Address" type="address" required id="Address" rows=3 cols=30 maxlength="200"></textarea></td>	   
		   </tr>
		   <tr>
	          <td>Mobile Number</td>
			  <td><input id="Mobile"  required type="text" name="Mobile" pattern="[789][0-9]{9}" pattern=".{10,10}" maxlength="10" >
			  </td>	   
		   </tr>
		   <tr>
	          <td>Emergency contact Number</td>
			  <td><input id="Emergency" required type="text" name="Emergency"  pattern="[789][0-9]{9}" pattern=".{10,10}" maxlength="10" /></td>	   
		   </tr>
		   <tr>
	          <td>Email</td>
			  <td><input id="Email" required type="email" name="Email"/></td>
			     
		   </tr>
		   <tr>
	          <td>Password</td>
			  <td><input id="Password"  required type="password" name="Password" maxlength="10"/></td>
			  
			  <td><label><input type="checkbox" id="check" name="check" value="on" onchange="Showpass();"> Show Password</label></td>
              	   
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
	    
	    $name=$_REQUEST["Name"];
	    $aadhar=$_REQUEST["Aadhar"];
	    $address=$_REQUEST["Address"];
		$mobile=$_REQUEST["Mobile"];
		$dob=$_REQUEST["DOB"];
		$gender=$_REQUEST["Gender"];
		$emergency=$_REQUEST["Emergency"];
		$blood=$_REQUEST["Blood"];
		$email=$_REQUEST["Email"];
		$pass=$_REQUEST["Password"];
		
		//$cipher=sha1($pass); 
		$myfile = fopen("/var/www/html/pass.txt", "r") or die("Unable to open file!");
		$password = fread($myfile,filesize("/var/www/html/pass.txt"));
		fclose($myfile);
	   
		$con = mysqli_connect("localhost","root",$password) or die("error in database connection" . mysql_error());
		mysqli_select_db($con ,"patient") or die("error to select the db" . mysql_error());
		
		
		
	   $equery = "SELECT * FROM personal WHERE email='$email'" ;

	   $eresult = mysqli_query($con,$equery) ;

	   if( mysqli_num_rows($eresult) > 0 ){
		die( "<p1><center>There is already a user with that email!</center></p1>" ) ;
	   }


			$query="Insert into personal values('$aadhar','$name','$address','$gender','$mobile','$emergency',STR_TO_DATE('$dob', '%d-%m-%Y'),'$blood','$email','$pass')";
		  $result=mysqli_query($con,$query) or die("<p1><center>error in inserting data in db</center></p1>" . mysql_error());
				
			
			
			if($result>0)
			{
				ob_clean();
			 echo nl2br("\n <p1>Registered succesfully!!! </p1>");
			 
			 $_SESSION['Aadhar']=$aadhar;
			 echo '<script type="text/javascript">';
			echo 'window.location.href="newproof.php";';
			echo '</script>';
			}
			
	
	}	
	 ?>
</body>
</html>

