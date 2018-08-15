<?php
require_once("database.php");
require_once('bus.php');

$dfrom=$_POST['from'];
$dto=$_POST['to'];
$dtime=$_POST['time'];

$sql3 = "SELECT * FROM allocation WHERE stationA='$dfrom' and StationB='$dto' and startA='$dtime'";
$result3 = mysqli_query($db,$sql3);
$busid="";
while($row3=mysqli_fetch_assoc($result3))
{	
	$busid=$row3['busid'];
	$bus=new Bus();
	$bus->bus($busid);
	
		echo '<form method="post" action="PHP/busbooking.php" >';
			?>
			<html> 
			<input value="<?php echo $busid;?> " name="busid[]" hidden="hidden"/>
            <input value="<?php echo $row3['id'];?> " name="allocationid" hidden="hidden"/>
			</html>      
			<?php
		echo'<div id="partners_row">';
		
			echo'<div class="row" >';		
			echo'<div class="col-md-3">';
			echo"<div class='img-thumbnail' id='numberplatediv'>".$bus->plate_number."</div>";
			echo'</div>';						
			echo'<div class="col-md-6">';			 
			echo"<div class='row' >"."<b>Sacco : </b>"."&ensp; ".$bus->company_name."</div>";				
			echo"<div class='row' >"."<b>From : </b>"." &ensp;".$row3['stationA']."  &ensp;  "."<b>To : </b>"."  &ensp;  ".$row3['StationB']."</div>";		
			echo"<div class='row' >"."<b>Capacity : </b>"."&ensp; ".$bus->seats."</div>";
			echo"<div class='row' >"."<b>Time of departure : </b>"."&ensp; ".$row3['startA']. "hrs"."</div>";
			echo "<div class='row'>"."<b>Price : </b>"."&ensp; ".$bus->fare."</div>";
			echo'</div>';		
			echo'</div>';	
					
			echo"<div class='row' >"."<div class='col-8'>"."</div>" ."<div class='col-4'>"."<input type='submit' name='book' value='Book a ticket' class='btn btn-success' style='float:right'>"."</div>" ."</div>";				
			echo'</div>';
			
	    echo "</form>";	
}
?>