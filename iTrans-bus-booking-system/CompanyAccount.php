<?php
   include('php/session.php');
   require_once("php/database.php");
   
      if(!isset($_SESSION['login_user'])){
	   redirect("login.html");
   }
   require_once("php/Company.php");
   
   $sql="SELECT id FROM companylogin WHERE username='$login_session'";
   $result=$database->query($sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $companyid=$row['id'];
  
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
<a class= "nav-link" href= "CompanyIndex.php" > Our Buses</a>
</li>
<li class= "nav-item " >
<a class= "nav-link" href="RegisterBus.php">Register Bus </a>
</li>
<li class= "nav-item active" >
<a class= "nav-link " href="#">Account </a>
</li>
<li class= "nav-item " >
<a class= "nav-link " href="itransapi/Analytic/initit/<?php echo $companyid?>">Analysis </a>
</li>
</ul>
</div>
</nav>
</div>

</div>

<form class="form-horizontal" role="form" method="post" action="php/insertcompanydetails.php">

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Sacco Name</label>
<div class="col-sm-6">
<input type="text" class="form-control"  name="sacco"value="<?php echo($company->company_name);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Company manager</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="manager"value="<?php echo($company->company_manager);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Phone number</label>
<div class="col-sm-6">
<input type="tel" class="form-control" id="firstname" name="phoneno" value="<?php echo($company->company_phone);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Email address</label>
<div class="col-sm-6">
<input type="email" class="form-control" id="firstname" name="email"value="<?php echo($company->company_email);?>" ></input>
</div>
</div>

<div class="row">
<label for="firstname" style="padding-top:10px; padding-left:10%" class="col-sm-3 control-label">Company location</label>
<div class="col-sm-6">
<input type="text" class="form-control" id="firstname" name="location"value="<?php echo($company->company_location);?>" ></input>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" style="margin-left:10%" class="btn btn-success">Update details</button>
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

