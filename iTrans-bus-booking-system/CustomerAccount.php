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
   <div class="row">
   <div class="col-sm-8" style="float:left">
 <nav class= "navbar navbar-toggleable-md navbar-light " >
<button class= "navbar-toggler navbar-toggler-right" type= "button" data-toggle= "collapse" data-target= "#navbarSupportedContent" aria-controls= "navbarSupportedContent" aria-expanded= "false" aria-label= "Toggle navigation" >
<span class= "navbar-toggler-icon" ></span>
</button>

<div class= "collapse navbar-collapse " id= "navbarSupportedContent" >
<ul class= "navbar-nav mr-auto " >
<li class= "nav-item " >
<a class= "nav-link" href= "bookabus.php" > Book a bus</a>
</li>
<li class= "nav-item " >
<a class= "nav-link" href="viewbookings.php">View Bookings </a>
</li>
<li class= "nav-item active" >
<a class= "nav-link " href="">Account </a>
</li>
</ul>
</div>
</nav>
</div>
<div class="col-sm-4">
<span style="float:right">Account balance:&nbsp;<?php  echo $customer->balance; ?> <br/><a href="php/wallet.php#popup2">Manage wallet</a></span>
</div>
</div>

<form class="form-horizontal" role="form" method="post" action="php/insertcustomerdetails.php">

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">First Name</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="firstname" name="firstname"value="<?php echo($customer->first_name);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Second Name</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="second" name="secondname"value="<?php echo($customer->second_name);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Email</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="email" name="email"value="<?php echo $customer->email;?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Phone number</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="phoneno" name="phoneno"value="<?php echo $phonenumber?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">id/passport:</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="idnumber" name="idnumber" value="<?php echo($customer->nationalid);?>" ></input>
</div>
</div>

<div class="row">
<label for="gender" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Gender</label>
<div class="col-sm-6">
<select type="text" class="form-control" id="gender" name="gender">
<option value="male" <?php if($customer->gender=="male"){echo"selected";} ?> >Male</option>
<option value="female" <?php if($customer->gender=="female"){echo"selected";} ?> >Female</option>
<option value="unspecified" <?php if($customer->gender=="unspecified"){echo"selected";} ?> >Unspecified</option>
</select>
</div>
</div>

<div class="row">
<label for="dateofbirth" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Date of birth</label>
<div class="col-sm-6">
<input type="date" class="form-control" id="dob" name="dob" value="<?php echo($customer->date_of_birth);?>" ></input>
</div>
</div>

<div class="row">
<label for="city" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">City</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="city" name="city" value="<?php echo($customer->city);?>" ></input>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" style="margin-left:10%" class="btn btn-success">Update</button>
</div>
</div>
</form>





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

