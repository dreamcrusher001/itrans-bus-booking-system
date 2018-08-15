<?php
$busid=$_POST['busid'];
$allocationid=$_POST['allocationid'];
$date=$_POST['date'];
$adults=$_POST['adults'];
$children=$_POST['children'];

require_once("session.php");
require_once("customer.php");

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



<div id="wholebody" >
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
<form class="form-horizontal" role="form" method="post" action="bookerfinal.php">

<?php
require_once("bus.php");
$bus =new Bus();
$bus->bus($busid)
?>

<h4>Bus details</h4>
<div class="row">
<div class="col-3"><label   class="control-label"><?php echo $bus->company_name?></label></div>
<div class="col-3"><label  class=" control-label"><?php echo $bus->stationA ." - ". $bus->stationB?></label></div>
<div class="col-3"><label  class=" control-label"><?php echo $bus->startA." - ".$bus->startB;?></label></div>
<div class="col-3"><label   class=" control-label"><?php echo $_POST['date']; if(empty($_POST['date'])){echo "<div style='color:#F00'>Please select date</div>";}?></label></div>
<input name="busid" hidden="hidden" value="<?php echo $bus->busid ?>"/>
<input name="allocationid" hidden="hidden" value="<?php echo $allocationid?>"/>
<input name="adults" hidden="hidden" value="<?php echo $adults ?>"/>
<input name="date" hidden="hidden" value="<?php echo $date ?>"/>
</div>
<div class="row">
<div class="col-3"><label   class="control-label"><?php echo"Total fare: ". $adults*($bus->fare)?></label></div>
<div class="col-3"><label   class="control-label"><?php echo"Account balance: ". $customer->balance?></label></div>
<div class="col-3"><label  style="color:#F00" id="insufficient" class="control-label"><?php if($customer->balance<$adults*($bus->fare)){echo"Balance insufficient";}?></label></div>
<input name="amount" hidden="hidden" value="<?php echo $adults*($bus->fare) ?>"/>
</div>

<h4>Adult passenger details</h4>
<div class="row">
<div class="col-3"><label   class="col-sm-3 control-label">Name</label></div>
<div class="col-3"><label  class="col-sm-3 control-label">Gender</label></div>
<div class="col-3"><label  class="col-sm-3 control-label">Age</label></div>
</div>
<?php
$i=0;
while($i<$adults)
{
echo "<div class='row'>";
echo "<div class='col-3'><input type='text' class='form-control' name='adultnames[]'/></div>";
echo "<div class='col-3'><select type='text' class='form-control' name='adultgender[]'/>
<option value='male'>Male</option>
<option value='female'/>Female</option>
<option value='unspecified'/>Unspecified</option>
</select>
</div>";
echo "<div class='col-3'><input type='number' min='10' class='form-control' name='adultage[]'/></div>";
echo"</div>";
$i++;	
}
?>



<h4>Children passenger details</h4>
<div class="row">
<div class="col-3"><label   class="col-sm-3 control-label">Name</label></div>
<div class="col-3"><label  class="col-sm-3 control-label">Gender</label></div>
<div class="col-3"><label  class="col-sm-3 control-label">Age</label></div>
</div>
<?php
$i=0;
while($i<$children)
{
echo "<div class='row'>";
echo "<div class='col-3'><input type='text' class='form-control' name='childnames[]'/></div>";
echo "<div class='col-3'><select type='text' class='form-control' name='childgender[]'/>
<option value='male'>Male</option>
<option value='female'/>Female</option>
<option value='unspecified'/>Unspecified</option>
</select>
</div>";
echo "<div class='col-3'><input type='number' max='9' class='form-control' name='childage[]'/></div>";
echo"</div>";
$i++;	
}
?>



<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" style="margin-top:20px" id="confirmbtn" class="btn btn-success">Confirm details and payment</button>
<span id="notice" style="color:red;font-size:10px">**When you press this button you confirm booking of ticket.**<br/></span>
<div id="accountnotices">
<?php echo "<span style='color:red;font-size:32px'>Ksh.". $adults*($bus->fare)."</span>&nbsp;Will be substracted from your wallet"?><br/>
<?php 
$totalfare=$adults*($bus->fare);
$balance=$customer->balance ;
$newbalance=$balance - $totalfare;
 echo"New balance will be: &nbsp;". "<span style='color:green;font-size:32px'>Ksh.".$newbalance?><br/>
 </div>
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

<script src="../jscript/jquery-3.3.1.js"></script>
<script>
 $(document).ready(function () {
    // $('#confirmbtn').on('click', function () {
            
  
	 var insufficient=$("#insufficient").text();
	 if(insufficient=="Balance insufficient"){
		
		 $('#confirmbtn').attr("disabled","disabled");
		 $('#notice').replaceWith('<span id="newnotice" style="color:red;font-size:10px">**This button is disabled because balance is insufficient.**<br/></span>');
		 $('#newnotice').append('<a style="color:blue;font-size:18px" href="wallet.php#popup2" class="">Click to add money in wallet.<br/></a>');
		 $('#accountnotices').css("visibility","hidden");
	 }
 });
</script>


</body>
</html>

