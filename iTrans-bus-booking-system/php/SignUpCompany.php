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
		//echo("password dont match");
		msgnredirect("Password dont match","../login.html","red");
	}
	
	else
	{
		//check to ensure username does not exist
		 $sql = "SELECT id FROM companylogin WHERE username = '$username'";
		 $result=$database->query($sql);
	     //gets the number of rows found from $result		
		 $count = mysqli_num_rows($result);
		  // If result matched $myusername, table row must be 1 row	
      if($count >= 1) {
       
		 msgnredirect("Username exists ($username), please choose another one","../login.html","red");
      }
	  else{
    $sql="INSERT INTO companylogin (`username`, `email`, `phone`, `password`) VALUES ('$username','$email','$phonenumber','$password')";
	$database->query($sql);	
	
	$sql2= "SELECT*FROM companylogin WHERE username='$username'";
		$result2=$database->query($sql2);
		while($row=mysqli_fetch_assoc($result2))
		{
			$id=$row['id'];
		}
	
	
    $sql3="INSERT INTO company (`companyid`) VALUES ('$id')";
	$database->query($sql3);	
	
	//start session to give signed user permission
	
	  $_SESSION['login_user'] = $username;
	 header("location: http:../CompanyAccount.php");
	}
	}

}
?>