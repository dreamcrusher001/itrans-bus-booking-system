
<?php
require_once('database.php');
require_once('function.php');
require_once("customer.php");

if(isset($_POST['generate']))
{
	$bus=$_POST['busid'];
    $ticketcode=$_POST['ticketno'];
	require_once("generatePDF.php");	
}

else if(isset($_POST['cancel']))
{
	
	$transactionid=$_POST['transactionid'];
	
	$sql="SELECT * FROM transaction WHERE id='$transactionid'";
	$result=$database->query($sql);
	
	foreach($result as $row)
	{
		$date=$row['date'];
		$converteddate=date('Y-m-d H:i:s', strtotime($date));
		$amount=$row['amount'];
		$ticketcode=$row['ticketcode'];
		$seats=$row['seats'];
		$allocationid=$row['allocationid'];
	}
	
	if($converteddate<date('Y-m-d H:i:s'))
	{
		msgnredirect("Sorry, You cannot cancel a ticket from today or past days.","../viewbookings.php","yellow");
		
	}
	
	else
	{
		//cancel transaction
		//cancel transaction from table transactions
		$sql="DELETE FROM  transaction WHERE id='$transactionid'";
		$database->query($sql);
		
		//delete passenger details for ticket
		$sql="DELETE FROM  passenger WHERE ticketcode='$ticketcode'";
		$database->query($sql);
		
		//add seats remaining to booking table
		//1.get seats remaining
		$sql="SELECT seatsremaining FROM booking WHERE allocationid='$allocationid' and date='$date'";
		$result=$database->query($sql);
		foreach($result as $row)
		{
		  $seatsremaining=$row['seatsremaining'];
		}
		//2.now add seats and update available seats
		$updatedseatsremaining=$seats+$seatsremaining;
		$sql="UPDATE booking SET `seatsremaining`='$updatedseatsremaining' WHERE allocationid='$allocationid' and date='$date' ";
		$database->query($sql);
		
		//return money to wallet
		//get balance from wallet
		$sql="SELECT wallet FROM customer WHERE customerid='$customer->customerid'";
		$result=$database->query($sql);
		foreach($result as $row)
		{
		  $balance=$row['wallet'];
		}
		//add balance to amount and update wallet
		 $newbalance=$balance+$amount;
		 $sql="UPDATE customer SET `wallet`='$newbalance' WHERE customerid='$customer->customerid' ";
		 $database->query($sql);
		 
		 	msgnredirect("Ticket $ticketcode for $customer->first_name deleted successfully<br/>Ksh. $amount returned to wallet<br/> New balance: $newbalance","../viewbookings.php","teal");
		
		
	}

}
?>