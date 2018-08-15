<?php
   include('php/session.php');
   require_once("php/database.php");
   require_once("php/bus.php");
   
      if(!isset($_SESSION['login_user'])){
	   redirect("login.html");
   }
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
<li class= "nav-item active" >
<a class= "nav-link" href= "#" > Our Buses</a>
</li>
<li class= "nav-item " >
<a class= "nav-link" href="RegisterBus.php">Register Bus </a>
</li>
<li class= "nav-item " >
<a class= "nav-link " href="CompanyAccount.php">Account </a>
</li>
<li class= "nav-item " >
<a class= "nav-link " href="itransapi/Analytic/initit/<?php echo $companyid?>">Analysis </a>
</li>
</ul>
</div>
</nav>
</div>

</div>


<section>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Number plate</th>
        <th>Station A</th>
        <th>Station B</th>
        <th>Start A</th>
        <th>Start B</th>
        <th>Seats</th>
      </tr></thead>
      <tbody>
<?php
	
	$sql="SELECT busid FROM bus WHERE companyid='$companyid'";
   $result= $database->query($sql);
   foreach($result as $row){
	   
			$busid= $row['busid'];			
			$bus=new Bus();
			$bus->bus($busid);		
			
			
			echo '<form method="post" action="PHP/deletebus.php" >';
			
			?>
			<html> 
            
           
              <tr id="<?php echo $bus->busid;?>">
        <td><?php echo $bus->plate_number?></td>
        <td><?php echo $bus->stationA?></td>
        <td><?php echo $bus->stationB?></td>
        <td><?php echo $bus->startA?></td>
        <td><?php echo $bus->startB?></td>
        <td><?php echo $bus->seats?></td>
        <td><input type="button" value="delete" name="<?php echo $bus->busid;?> "  class="btn-danger btn deletebus"/></td>
      </tr>
			</html>  
            
            <?php 
			echo'</form>';
   }
   
?>
           
    </tbody>
  </table>

</section>



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
<script src="jscript/jquery-3.3.1.js"></script>
<script>
$(document).ready(function(e) {
	
    $('.deletebus').on('click',function(){
		
		if(confirm("Are you sure you want to delete?")){
			var deleteID=$(this).attr('name');
			var dataString='deleteID='+deleteID;
			
			$.ajax({
					type: "POST",
					url: "php/deletebus.php",
					data: dataString,
					cache: false,
					beforeSend: function(html){
						setTimeout(function(){
								$('#'+deleteID).fadeOut('slow');	
							},100);
					},
					
					success: function(html){
																		
						setTimeout(function(){
								$('#'+deleteID).html("Deleting.............");	
							},1);
					
					}
			});
		
		}
		return false;
		
		
	});
});
</script>
</body>
</html>

