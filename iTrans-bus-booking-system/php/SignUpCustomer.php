<?php
require_once("database.php");
require_once("function.php");
session_start();
global $database;
 
$_POST['email'];
$_POST['phonenumber'];
$_POST['username'];
$_POST['password'];
$_POST['password2'];

if(isset($_POST['email']) && isset($_POST['phonenumber']) && isset($_POST['username']) & isset($_POST['password']) &isset($_POST['password2'])){
	
	$email=$_POST['email'];
	$phonenumber=$_POST['phonenumber'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	
	
	
	if($password!=$password2)
	{
		
		msgnredirect("Password dont match","../login.html","red");
	}
	
	else
	{
		/*
		//check validity of phone number
			$Airtel="^(?:254|\+254|0)?(7(?:(?:[3][0-9])|(?:5[0-6])|(8[5-9]))[0-9]{6})$";
			$Orange="^(?:254|\+254|0)?(77[0-6][0-9]{6})$";
			$Equitel="^(?:254|\+254|0)?(76[34][0-9]{6})$";		
			$Safaricom ="^(?:254|\+254|0)?(7(?:(?:[129][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$";
		
		if (!preg_match($Safaricom,$phonenumber) || !preg_match($Airtel,$phonenumber)|| !preg_match($Orange,$phonenumber)|| !preg_match($Equitel,$phonenumber)){
		msgnredirect("Invalid phone format use airtel,orange,equitel or safaricom number","../login.html","red");
		die("");
	}
	else
	*/
		//check to ensure username does not exist
		 $sql = "SELECT id FROM customerlogin WHERE username = '$username'";
		 $result=$database->query($sql);
	     //gets the number of rows found from $result		
		 $count = mysqli_num_rows($result);
		  // If result matched $myusername, table row must be 1 row	
      if($count >= 1) {
        
		msgnredirect("Username exists ($username), please choose another one","../login.html","red");
		
      }
	  else{
    $sql="INSERT INTO customerlogin (`username`, `email`, `phone`, `password`) VALUES ('$username','$email','$phonenumber','$password')";
	$database->query($sql);	
	
	$sql2= "SELECT*FROM customerlogin WHERE username='$username'";
		$result2=$database->query($sql2);
		while($row=mysqli_fetch_assoc($result2))
		{
			$id=$row['id'];
		}
	
	
    $sql3="INSERT INTO customer (`customerid`) VALUES ('$id')";
	$database->query($sql3);	
	
	//start session to give signed user permission
	
	  $_SESSION['login_user'] = $username;
	 header("location: http:../bookabus.php");
	}
	}

}
?>