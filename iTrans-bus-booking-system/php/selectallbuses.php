<?php
require_once("database.php");
require_once("bus.php");
global $database;

$sql="SELECT *FROM allocation ";
		$result=$database->query($sql);
		foreach($result as $row)
		{
	
			$busid=$row['busid'];
			$bus=new Bus();
			$bus->bus($busid);
			echo '<form method="post" action="php/busbooking.php" >';
		?>
        
			<html> 
			<input value="<?php echo $busid;?> " name="busid[]" hidden="hidden"/>
            <input value="<?php echo $row['id'];?> " name="allocationid" hidden="hidden"/>
			</html>      
			<?php
		echo'<div id="partners_row">';
		
			echo'<div class="row" >';		
			echo'<div class="col-md-3">';
			echo"<div class='img-thumbnail' id='numberplatediv'>".$bus->plate_number."</div>";
			echo'</div>';						
			echo'<div class="col-md-6">';			 
			echo"<div class='row' >"."<b>Sacco : </b>"."&ensp; ".$bus->company_name."</div>";				
			echo"<div class='row' >"."<b>From : </b>"." &ensp;".$row['stationA']."  &ensp;  "."<b>To : </b>"."  &ensp;  ".$row['StationB']."</div>";		
			echo"<div class='row' >"."<b>Capacity : </b>"."&ensp; ".$bus->seats."</div>";
			echo"<div class='row' >"."<b>Time of departure : </b>"."&ensp; ".$row['startA']. "hrs"."</div>";
			echo "<div class='row'>"."<b>Price : </b>"."&ensp; ".$bus->fare."</div>";
			echo'</div>';		
			echo'</div>';	
					
			echo"<div class='row' >"."<div class='col-8'>"."</div>" ."<div class='col-4'>"."<input type='submit' name='book' value='Book a ticket' class='btn btn-success' style='float:right'>"."</div>" ."</div>";				
			echo'</div>';
			
	    echo "</form>";	
}
?>