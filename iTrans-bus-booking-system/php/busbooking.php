<?php
   require_once("database.php");
   require_once('session.php');
   require_once("bus.php");
   
      if(!isset($_SESSION['login_user'])){
	   redirect("../login.html");
   }
   $name=$login_session;
   require_once('customer.php');
   
$allocationid=$_POST['allocationid'];
 
   if(isset( $_POST['busid']))
{	

    for($i=0;$i<count($_POST['busid']);$i++)
	{
		$busid=$_POST['busid'][$i];				
	}
$bus=new Bus();
$bus->bus($busid);
// echo json_encode($bus);
}
?>

<!doctype html>
<html>
<head>

<link rel="icon" href="images/logo.bmp"/>
<title>iTrans</title>


<link rel="stylesheet" href="../css/stylesheet.css"/>
 <link rel="stylesheet" href="../bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css" />


</head>

<body style="width:inherit;background-image:url(../images/background.jpg);width:100%;height:100%);background-attachment:fixed;background-repeat:no-repeat" >



<div id="wholebody">
<div id="header" >
<!--<img src="images/rada kenya.png" /> -->

<div id="container">
<img src="../images/logo2.png"  id="logo"/>

<b style="font-size:13px;position:absolute;margin-top:106px;float:left ">Book a bus with us</b>
<div id="main_menu">

          
 <nav class= "navbar navbar-toggleable-md navbar-inverse" >
<button class= "navbar-toggler navbar-toggler-right" type= "button" data-toggle= "collapse" data-target= "#navbarSupportedContent" aria-controls= "navbarSupportedContent" aria-expanded= "false" aria-label= "Toggle navigation" >
<span class= "navbar-toggler-icon" ></span>
</button>

<div class= "collapse navbar-collapse" id= "navbarSupportedContent" >
<ul class= "navbar-nav mr-auto " >
<li class= "nav-item " >
<a class= "nav-link" href= "../index.html" > Home</a>
</li>
<li class= "nav-item " >
<a class= "nav-link" href="../ourpartners.html">Our Partners </a>
</li>
<li class= "nav-item" >
<a class= "nav-link " href="../aboutus.html">About Us </a>
</li>
<li class= "nav-item" >
<a class= "nav-link " href="../contactus.html">Contacts Us </a>
</li>
<li class= "nav-item" >
<a class= "nav-link " href = "logout.php" >Sign Out </a>
</li>
</ul>
</div>
</nav>
	
        
</div>

<div class="row" style="margin-left:60%">
<div class="col-7">
ACCOUNT: <?php echo $login_session; ?>
</div>
<div class="col-5">
<a href = "logout.php" style="color:#F00">Sign Out</a>
</div>

</div>
</div>
</div>

   <div id="body" >
   
 

<div class="container">
<form class="form-horizontal" role="form" method="post" action="booker.php">

<div class="row" ><h4><p>Book your ticket</p></h4>&nbsp;&nbsp;&nbsp;&nbsp;<br> Account balance:&nbsp;<?php  echo $customer->balance; ?> <br/></div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Number plate</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="firstname" disabled name="firstname"value="<?php echo($bus->plate_number);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Sacco</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="second" disabled name="secondname"value="<?php echo($bus->company_name);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Price per ticket</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="email" disabled name="email"value="<?php echo $bus->fare;?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Route</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="phoneno" disabled name="phoneno"value="<?php echo $bus->stationA ." to ". $bus->stationB?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Time</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="idnumber" disabled name="idnumber" value="<?php echo "from ".$bus->startA." to ".$bus->startB;?>" ></input>
</div>
</div>

<input name="busid" hidden="hidden" value="<?php echo $bus->busid ?>"/>
<input name="allocationid" id="allocationid" hidden="hidden" value="<?php echo $allocationid?>"/>

<div class="row required-input">
<label  style="padding-top:10px; padding-left:10%"  class="col-sm-3 control-label ">Date </label>
<div class="col-sm-6">      
<input class="form-control"  name="date" id="datepicker" required onChange="seatrem()"></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Available seats</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="remseats" disabled name="remseats" placeholder="Select date first" ></input>
</div>
</div>

<div class="row required-input">
<label for="gender" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Passenger(s)</label>
<div class="col-sm-3">
<select type="text" class="form-control"  name="adults" >
<option >Seats</option>
<option value="1"  >1</option>
<option value="2"  >2</option>
<option value="3"  >3</option>
<option value="4"  >4</option>
<option value="5"  >5</option>

</select>
</div>
<div class="col-sm-3">
<select type="text" class="form-control"  name="children">
<option  >Infants</option>
<option value="1"  >1</option>
<option value="2"  >2</option>
<option value="3"  >3</option>
</select>
<span style="color:red;font-size:12px">Infants not assigned seats</span>

</div>

</div>


<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" style="margin-left:10%" class="btn btn-success explain-infants">Proceed</button>
</div>
</div>
</form>
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
		<a href="#"> <img id="img" src="../images/socialsites/facebook_icon.png"/> </a>
	</section>
    
    <section id="div">
		<a href="#"> <img id="img" src="../images/socialsites/pinterest_icon.png"/> </a>
	</section>
  
     <section id="div">
		<a href="#"> <img id="img" src="../images/socialsites/dribbble_icon.png"/> </a>
	</section><br/>

    <section id="div">
		<a href="#"> <img id="img" src="../images/socialsites/skype_icon.png"/> </a>
	</section>
    <section id="div">
		<a href="#"> <img id="img" src="../images/socialsites/linkedin_icon.png"/> </a>
	</section>  
     <section id="div">
		<a href="#"> <img id="" src="../images/socialsites/twitter.png" width="45px" height="45px" style="padding-left:5px;margin-top:3px"/> </a>
	</section>
 </div>
 
<div class="col-3"><b>Contacts</b></div>

</div>

<img src="../images/strip.png" style="width:100%;height:2px; background-repeat:repeat"/>

<div class="row">
<div class="col-9">
&copy; 2018 - iTrans. All rights reserved.
</div>
<div class="col-3">
<img src="../images/logo2.png"/>
</div>
</div>

</div>
</div>

<script src="../jscript/jquery-1.11.2.js"></script>
<script src="../jscript/jquery.datetimepicker.full.js"></script>
<link type="text/css" rel="stylesheet" href="../css/jquery.datetimepicker.min.css"/>

<script>
$("#datepicker").datetimepicker({
	minDate : 'today',
	timepicker: false,
	format: 'Y-m-d'
});

 function seatrem(){
	   $(document).ready(function(e) {
	   var date=$("#datepicker").val();
	   var allocationid=$("#allocationid").val();
	   var dataString='date='+date+'&allocationid='+allocationid;
	   
	   	$.ajax({
				type: "POST",
				url: "seatsremaining.php",
				data: dataString,
				cache: false,
				beforeSend: function(html){
					//can use loader	
				},
				
				success: function(data){
					//display remaining seats	
					$("#remseats").val(data);			
				}

		});
	   
	   
		
		});
	}
</script>

</body>
</html>

