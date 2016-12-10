<?php
	
	session_start();
	session_unset();
	$myfile = fopen("/var/www/html/pass.txt", "r") or die("Unable to open file!");
	$password = fread($myfile,filesize("/var/www/html/pass.txt"));
	fclose($myfile);
	$db = mysqli_connect("localhost","root",$password);
	mysqli_select_db($db ,"patient") or die("error to select the db" . mysql_error());
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 
      
      $sql = "SELECT * FROM personal WHERE email = '$myusername' and pass= '$mypassword'";
      $result = mysqli_query($db,$sql) or die("error in inserting data in db" . mysql_error());
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
		  $aadhar=$row['aadhar'];
		  $_SESSION['aadhar']=$aadhar;
         $_SESSION['login_user'] = $myusername;
         header("location: home.html");  
         exit;
      }else {
		  
         $error = '<div class="alert alert-danger"> Your Email or Password is invalid';
      }
   }
   
?>
<html>
   
   <head>
      <title>Login Page</title>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      
      
   </head>
   
   <body >
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
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="reg.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <h2>Login</h2>
	 <form class="form-horizontal" action = "" method = "post" role="form">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="username" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
      </div>
    </div>
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" value=" Submit " class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>
     
               
  <center><?php echo $error; ?></center>
</div>
 </body>
</html>
