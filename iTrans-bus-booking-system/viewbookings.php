<?php
   include('php/session.php');
   
      if(!isset($_SESSION['login_user'])){
	   redirect("login.html");
   }
   $name=$login_session;
   require_once('php/customer.php');
?>

<!doctype html>
<html>
<head>

<link rel="icon" href="images/logo.bmp"/>
<title>iTrans</title>


<link rel="stylesheet" href="css/stylesheet.css"/>
 <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css" />


</head>

<body style="width:inherit;background-image:url(images/background.jpg);width:100%;height:100%);background-attachment:fixed;background-repeat:no-repeat" >



<div id="wholebody">
<div id="header" >
<!--<img src="images/rada kenya.png" /> -->

<div id="container">
<img src="images/logo2.png"  id="logo"/>

<b style="font-size:13px;position:absolute;margin-top:106px;float:left ">Book a bus with us</b>
<div id="main_menu">

          
 <nav class= "navbar navbar-toggleable-md navbar-inverse" >
<button class= "navbar-toggler navbar-toggler-right" type= "button" data-toggle= "collapse" data-target= "#navbarSupportedContent" aria-controls= "navbarSupportedContent" aria-expanded= "false" aria-label= "Toggle navigation" >
<span class= "navbar-toggler-icon" ></span>
</button>

<div class= "collapse navbar-collapse" id= "navbarSupportedContent" >
<ul class= "navbar-nav mr-auto " >
<li class= "nav-item " >
<a class= "nav-link" href= "index.html" > Home</a>
</li>
<li class= "nav-item " >
<a class= "nav-link" href="ourpartners.html">Our Partners </a>
</li>
<li class= "nav-item" >
<a class= "nav-link " href="aboutus.html">About Us </a>
</li>
<li class= "nav-item" >
<a class= "nav-link " href="contactus.html">Contacts Us </a>
</li>
<li class= "nav-item" >
<a class= "nav-link " href = "php/logout.php" >Sign Out </a>
</li>
</ul>
</div>
</nav>

        
</div>
	
<div class="row" style="margin-left:60%;">
<div class="col-7">
Welcome <?php echo $login_session; ?>
</div>
<div class="col-5">
<a href = "php/logout.php" style="color:#F00">Sign Out</a>
</div>

</div>
</div>
</div>

   <div id="body" >
   
 <nav class= "navbar navbar-toggleable-md navbar-light " >
<button class= "navbar-toggler navbar-toggler-right" type= "button" data-toggle= "collapse" data-target= "#navbarSupportedContent" aria-controls= "navbarSupportedContent" aria-expanded= "false" aria-label= "Toggle navigation" >
<span class= "navbar-toggler-icon" ></span>
</button>

<div class= "collapse navbar-collapse " id= "navbarSupportedContent" >
<ul class= "navbar-nav mr-auto " >
<li class= "nav-item " >
<a class= "nav-link" href= "bookabus.php" > Book a bus</a>
</li>
<li class= "nav-item active" >
<a class= "nav-link" href="#">View Bookings </a>
</li>
<li class= "nav-item " >
<a class= "nav-link " href="CustomerAccount.php">Account </a>
</li>
</ul>
</div>
</nav>
<br/>

<?php
require_once("php/database.php");
require_once("php/customer.php");
require_once("php/bus.php");
global $database;

foreach($customer->mybooks as $item)
{				
	if(mysqli_num_rows($result)>0)
	{
		$allocationid=$item['allocationid'];
		$ticketcode=$item['ticketcode'];
		$date=$item['date'];
		$seatsbooked=$item['seats'];
		$transactionid=$item['id'];
		
		$sql="SELECT *FROM allocation WHERE id='$allocationid' ";
		$result=$database->query($sql);
		foreach($result as $row)
		{
			$busid=$row['busid'];
			$bus=new Bus();
			$bus->bus($busid);
			
			echo '<form method="post" action="PHP/cancelbooking.php" >';

			?>
			<html> 
            <input value="<?php echo $busid;?> " name="busid" hidden="hidden"/>
            <input value="<?php echo $ticketcode;?> " name="ticketno" hidden="hidden"/>
			<input value="<?php echo $transactionid;?> " name="transactionid" hidden="hidden"/>
			</html>      
			<?php
			echo'<div id="partners_row">';
			
			echo'<div class="row" >';
			
			echo'<div class="col-md-3">';
			echo"<div class='img-thumbnail' id='numberplatediv'>".$bus->plate_number."</div>";
			echo'</div>';	
								
			echo'<div class="col-md-6">';			 
			echo"<div class='row' >"."<b>Sacco : </b>"."&ensp; ".$bus->company_name."</div>";				
			echo"<div class='row' >"."<b>From : </b>"." &ensp;".$bus->stationA."  &ensp;  "."<b>To : </b>"."  &ensp;  ".$bus->stationB."</div>";		
			echo"<div class='row' >"."<b>Capacity : </b>"."&ensp; ".$bus->seats."</div>";
			echo"<div class='row' >"."<b>Time of departure : </b>"."&ensp; ".$bus->startA. "hrs"."</div>";
			echo "<div class='row'>"."<b>Price : </b>"."&ensp; ".$bus->fare."</div>";
			echo'</div>';
			
			echo'<div class="col-md-3">';
			echo"<div class='row' >"."<b>Ticket no: </b>"."&ensp; ".$ticketcode."</div>";	
			echo"<div class='row' >"."<b>Date booked: </b>"."&ensp; ".$date."</div>";	
			echo"<div class='row' >"."<b>Seats : </b>"."&ensp; ".$seatsbooked."</div>";			
			echo'</div>';
			
			echo'</div>';
			
			echo"<div class='row' style='margin-top:5px'>".
			"<div class='col-sm-4'>".
			"<input type='submit' name='generate' value='Generate ticket' class='btn btn-success' style='float:left'>"."</div>" .
			"<div class='col-sm-4'>"."</div>" .
			"<div class='col-sm-4'>".
			"<input type='submit' name='cancel' value='Cancel booking' class='btn btn-danger' style='float:right'>".
			"</div>" 
			."</div>";
							
			echo'</div>';
			echo "</form>";
				
			}
		}
	
}

mysqli_close($db);
?>

</div>
</div>

<div id="footer">
    <div class="container">
<div class="row">
<div class="col-3">
<b>About us</b><br/>
  	 <p> The website was designed by</p>
 	     James Ikubi<br/>
  		 Amos Korir<br/>
  		 Stanley Kogi<br/>
</div>
<div class="col-3"><b>Browse</b></div>
<div class="col-3"><b>Connect with us</b><br/>
   	 <section id="div">
		<a href="#"> <img id="img" src="images/socialsites/facebook_icon.png"/> </a>
	</section>
    
    <section id="div">
		<a href="#"> <img id="img" src="images/socialsites/pinterest_icon.png"/> </a>
	</section>
  
     <section id="div">
		<a href="#"> <img id="img" src="images/socialsites/dribbble_icon.png"/> </a>
	</section><br/>

    <section id="div">
		<a href="#"> <img id="img" src="images/socialsites/skype_icon.png"/> </a>
	</section>
    <section id="div">
		<a href="#"> <img id="img" src="images/socialsites/linkedin_icon.png"/> </a>
	</section>  
     <section id="div">
		<a href="#"> <img id="" src="images/socialsites/twitter.png" width="45px" height="45px" style="padding-left:5px;margin-top:3px"/> </a>
	</section>
 </div>
 
<div class="col-3"><b>Contacts</b></div>

</div>

<img src="images/strip.png" style="width:100%;height:2px; background-repeat:repeat"/>

<div class="row">
<div class="col-9">
&copy; 2018 - iTrans. All rights reserved.
</div>
<div class="col-3">
<img src="images/logo2.png"/>
</div>
</div>

</div>
</div>

</body>
</html>

