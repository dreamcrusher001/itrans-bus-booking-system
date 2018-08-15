<?php
require_once('database.php');
require_once("function.php");
include('session.php');
$name=$login_session;

if(isset($_POST['secondname']) && isset($_POST['idnumber'])&& isset($_POST['dob'])&& isset($_POST['city']))
{
	$sql= "SELECT*FROM customerlogin WHERE username='$name'";
		$result=$database->query($sql);
		while($row=mysqli_fetch_assoc($result))
		{
			$id=$row['id'];
		}
		
	$email=$_POST['email'];
	$phonenumber=$_POST['phoneno'];
	$firstname=$_POST['firstname'];
	$secondname=$_POST['secondname'];
	$identification=$_POST['idnumber'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];
	$city=$_POST['city'];
	
	$sql="UPDATE customer SET `firstname`='$firstname',`secondname`='$secondname',`nationalid`='$identification', `gender`='$gender',`dob`='$dob',`city`='$city' WHERE `customerid`='$id' ";
	$database->query($sql);
	
	$sql2="UPDATE customerlogin SET `email`='$email',`phone`='$phonenumber' WHERE id='$id' ";
	$database->query($sql2);
	 msgnredirect("Details updated successfully","..\CustomerAccount.php","teal");

	 //redirect("..\CustomerAccount.php");
}

else if(!isset($_POST['secondname']) && !isset($_POST['idnumber'])&& !isset($_POST['dob'])&& !isset($_POST['city']))
	{ 
		echo"Some details are missing";
		
	   redirect("..\CustomerAccount.php");
   }

?>