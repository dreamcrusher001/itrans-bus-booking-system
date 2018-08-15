<?php 
require_once("database.php");
$allocationid=$_POST['allocationid'];
$date=$_POST['date'];

$sql="SELECT seatsremaining FROM booking WHERE allocationid='$allocationid' and date='$date'";
$result=$database->query($sql);

if(mysqli_num_rows($result)>0){
$row=mysqli_fetch_assoc($result);
echo $row['seatsremaining'];
 
}
//if seat is not yet booked
else{
	$sql = "SELECT busid FROM allocation WHERE id='$allocationid'";
	$result=$database->query($sql);
	$row=mysqli_fetch_assoc($result);
	$busid=$row['busid'];
	
	require_once("bus.php");
	$busid=$row['busid'];
	$bus=new Bus();
	$bus->bus($busid);
	
	echo $bus->seats;
}
	

?>