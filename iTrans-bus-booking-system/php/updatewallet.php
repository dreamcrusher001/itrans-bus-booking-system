<?php
require_once("database.php");
require_once("function.php");
require_once("customer.php");

if(isset($_POST['depositbtn'])){
	$amount= $_POST['amount'];
	$name=$login_session;
	
	$balance=$customer->balance;
		
	$amount=$amount+$balance;
	$sql="UPDATE customer SET `wallet`='$amount' WHERE customerid='$id'";
	$database->query($sql);
	msgnredirect("Wallet updated successfully<br/>New balance: Ksh.$amount","../CustomerAccount.php","teal");
	//redirect("../CustomerAccount.php");
	
	}
	else echo"You cannot refresh this page";
	?>