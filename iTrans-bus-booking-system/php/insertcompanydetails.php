<?php
require_once('database.php');
require_once("function.php");
include('session.php');
$name=$login_session;

if(isset($_POST['sacco']) && isset($_POST['manager'])&& isset($_POST['phoneno'])&& isset($_POST['location']))
{
	$sql= "SELECT*FROM companylogin WHERE username='$login_session'";
		$result=$database->query($sql);
		while($row=mysqli_fetch_assoc($result))
		{
			$id=$row['id'];
		}
		
	$email=$_POST['email'];
	$phonenumber=$_POST['phoneno'];
	$sacco=$_POST['sacco'];
	$manager=$_POST['manager'];
	 $location=$_POST['location'];
	
	
	$sql="UPDATE company SET `Name`='$sacco',`Manager`='$manager',`Location`='$location' WHERE companyid='$id' ";
	$database->query($sql);
	
	$sql2="UPDATE companylogin SET `email`='$email',`phone`='$phonenumber' WHERE id='$id' ";
	$database->query($sql2);
	 msgnredirect("Details updated successfully","..\CompanyAccount.php","teal");

	 //redirect("..\CustomerAccount.php");
}

else if(!isset($_POST['sacco']) && !isset($_POST['manager'])&& !isset($_POST['phoneno'])&& !isset($_POST['location']))
	{ 
		echo"Some details are missing";
		
	   redirect("..\CompanyAccount.php");
   }

?>