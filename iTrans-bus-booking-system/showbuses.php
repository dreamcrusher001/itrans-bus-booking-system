<?php
   include('php/session.php');
   
         if(!isset($_SESSION['login_user'])){
	   redirect("login.html");
   }
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



<div id="wholebody" >
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

<div class="row" style="margin-left:60%">
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
<li class= "nav-item active" >
<a class= "nav-link " style="color:#F00" href= "bookabus.php" > Display all buses</a>
</li>
<li class= "nav-item " >
<a class= "nav-link" href="viewbookings.php">View Bookings </a>
</li>
<li class= "nav-item" >
<a class= "nav-link " href="CustomerAccount.php">Account </a>
</li>
</ul>
</div>
</nav>
	
<div class="container">

<div class="row"  id="filter" >

<form action="showbuses.php" method="post">

<tr>
<?php include_once("php/filtershower.php"); 
?>
<td class="col-md-3">
from:
<select name="from" >
<?php 
require_once("php/database.php");

$sql="SELECT DISTINCT stationA FROM allocation ORDER BY stationA ASC";
if($is_query_run=mysqli_query($db,$sql))
{
	while($row=mysqli_fetch_assoc($is_query_run))
	{
		$departure=$row['stationA'];
		
		if($selecteddepart==$departure)	
		{
			$selected="selected";
		}		
		else
		{
			$selected="";
		}
		
		echo "<option value='$departure' ".$selected.">".$departure."</option>";
	}
}
?>
</select>
</td>

<td class="col-3">
to:
<select name="to">
<?php 
require_once("php/database.php");

$sql="SELECT DISTINCT StationB FROM allocation ORDER BY StationB ASC";
if($is_query_run=mysqli_query($db,$sql))
{
	while($row=mysqli_fetch_assoc($is_query_run))
	{
		$destination=$row['StationB'];
		
		if($selecteddestination==$destination)	
		{
			$selected="selected";
		}		
		else
		{
			$selected="";
		}
		echo "<option value='$destination' ".$selected.">".$destination."</option>";
	}
}
?>
</select>
</td>
<td class="col-3">
time of departure:
<select name="time">
<?php 
require_once("php/database.php");

$sql="SELECT DISTINCT startA FROM allocation ORDER BY startA ASC";
if($is_query_run=mysqli_query($db,$sql))
{
	while($row=mysqli_fetch_assoc($is_query_run))
	{
		$time=$row['startA'];
		
		if($selectedtime==$time)	
		{
			$selected="selected";
		}		
		else
		{
			$selected="";
		}
		echo "<option value='$time' ".$selected.">".$time."</option>";
	}
}
?>
</select>
</td>
<td class="col-3">
<button type="submit" class="btn btn-info">Search buses</button>
 </td>

</tr>
</form>
</div>

<?php include("php/filter.php");?>

</div>
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

