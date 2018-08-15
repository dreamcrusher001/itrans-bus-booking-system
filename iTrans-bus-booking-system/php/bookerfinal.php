<?php
$busid=$_POST['busid'];
$allocationid=$_POST['allocationid'];
$date=$_POST['date'];
$adults=$_POST['adults'];
$amount=$_POST['amount'];

require_once("function.php");
require_once("session.php");
require_once("database.php");
require_once("bus.php");
$bus=new Bus();
$bus->bus($busid);
require_once("customer.php");


//check in table booking whether the bus to be booked has available seats on the specific date
//check if a row of the busid and date exists
$sql="SELECT * FROM booking WHERE allocationid='$allocationid' and date='$date'";
$result=$database->query($sql);
$seatsremaining="";
if(mysqli_num_rows($result)>0){
		foreach($result as $row)
		{
			$seatsremaining=$row['seatsremaining'];
		}
}
//if the row of the bus doesnt exist,create a new one
 else
 {
		$sql="INSERT INTO booking(`allocationid`,`seatsremaining`,`date`)VALUES('$allocationid','$bus->seats','$date')";
		$database->query($sql);
		$seatsremaining=$bus->seats;
 }
 
 
 //get latest ticketcode from table transaction
$sql="SELECT ticketcode FROM transaction ";
$result=$database->query($sql);
if(mysqli_num_rows($result)>0){
		foreach($result as $row)
		{
			$latestticket=$row['ticketcode'];			
		}
}
else{$latestticket=0;}
$newticketcode=$latestticket+1;
 
//if the seats available are more than seats needed enable one to insert into transaction table
if($adults<$seatsremaining)

{
	
	//get companyid
		$sql="SELECT * FROM bus WHERE busid='$busid'";
		$result=$database->query($sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$companyid=$row['companyid'];

		$sql="INSERT INTO transaction(`ticketcode`,`allocationid`,`customerid`,`companyid`,`amount`,`date`,`seats`)VALUES
		('$newticketcode','$allocationid','$customer->customerid','$companyid','$amount','$date','$adults')
		";
		$database->query($sql);
		
		$newseatsremaining=$seatsremaining-$adults;
		$sql="UPDATE booking SET `seatsremaining`='$newseatsremaining' WHERE allocationid='$allocationid' and date='$date'";
		$database->query($sql);
}
else{echo "bus is full! try later date";}


//insert the adult passengers details into a table passenger with relation to ticketcode
$i=0;
if(!empty($_POST['adultnames'])&&!empty($_POST['adultgender'])&&!empty($_POST['adultage']))
{
while($i<count($_POST['adultnames']))
{
	$name= $_POST['adultnames'][$i];
	$gender=$_POST['adultgender'][$i];
	$age=$_POST['adultage'][$i];
	
	$sql="INSERT INTO passenger(`ticketcode`,`name`,`gender`,`age`)VALUES('$newticketcode','$name','$gender','$age')";
	$database->query($sql);
	
$i++;
}
}

else {echo "please input adult details";}

//insert the child passengers details into a table passenger with relation to ticketcode
$i=0;
if(!empty($_POST['childnames'])&&!empty($_POST['childgender'])&&!empty($_POST['childage']))
{
while($i<count($_POST['childnames']))
{
	$name= $_POST['childnames'][$i];
	$gender=$_POST['childgender'][$i];
	$age=$_POST['childage'][$i];
	
	$sql="INSERT INTO passenger(`ticketcode`,`name`,`gender`,`age`)VALUES('$newticketcode','$name','$gender','$age')";
	$database->query($sql);
	
$i++;
}
}

else {echo "please input child details";}

//update customers wallet\
$walletnew=$customer->balance-$amount;
$sql="UPDATE customer SET `wallet`='$walletnew' WHERE customerid='$customer->customerid'";
$database->query($sql);
?>


<!doctype html>
<html>
<head>

<link rel="icon" href="images/logo.bmp"/>
<title>iTrans</title>


<link rel="stylesheet" href="../css/stylesheet.css"/>
 <link rel="stylesheet" href="../bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css" />
 <link rel="stylesheet" href="../css/ticket.css"/>


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


<div id="ticket">
<div class="container">
<div class="row">

<div class="col-sm-1 busticket borderright">
<h6>
BUS TICKET
</h6>
</div>

<div class="col-sm-7 borderright busticket">

<div class="row">
<div class="col-sm-8 text-center borderbottom ">
i-Trans Bus online ticketing <br/>
in association with:<br/>
<?php echo $bus->company_name?>&nbsp; limited
</div>
<div class="col-sm-4">
<div class="row borderbottom texttocenter borderleft">ORIGINAL</div>
<div class="row borderbottom borderleft">
CUSTOMER ID:<?php echo $customer->customerid?> <br/>
BUS ID: <?php echo $busid?>
</div>
</div>
</div>

<div class="row borderbottom texttocenter" >CUSTOMER INFORMATION</div>

<div class="row borderbottom">
<div class="col-4">
Name:&nbsp<?php echo $customer->first_name."&nbsp".$customer->second_name;?> <br/>
Email:&nbsp<?php echo $customer->email;?> <br/>
Mobile:&nbsp<?php echo $customer->phone_number;?>
</div>

<div class="col-4">
DOB:&nbsp<?php echo $customer->date_of_birth?> <br/>
Gender:&nbsp<?php echo $customer->gender?> <br/>
ID:&nbsp<?php echo $customer->nationalid?>
</div>

<div class="col-4">
City:&nbsp<?php echo $customer->city?> <br/>
</div>

</div>

<div class="row borderbottom texttocenter">PASSENGER DETAILS</div>

<div class="card-block borderbottom">
<b>Adult passenger details</b>
<div class="row">
<div class="col-sm-4"><label   class="control-label">Name</label></div>
<div class="col-sm-4"><label  class=" control-label">Gender</label></div>
<div class="col-sm-4"><label  class=" control-label">Age<br/></label></div>
</div>
<?php
//display adult details
$i=0;
while($i<count($_POST['adultnames']))
{
	$name= $_POST['adultnames'][$i];
	$gender=$_POST['adultgender'][$i];
	$age=$_POST['adultage'][$i];
	
	echo "<div class='row'>";
echo "<div class='col-4'>$name</div>";
echo "<div class='col-4'>$gender</div>";
echo "<div class='col-4'>$age"."<br/>"."</div>";
echo"</div>";
    	
$i++;
}

?>
<br/>
<b>child passenger details</b>
<div class="row">
<div class="col-4"><label   class=" control-label">Name</label></div>
<div class="col-4"><label  class=" control-label">Gender</label></div>
<div class="col-4"><label  class=" control-label">Age</label></div>

</div>
<?php
//display child details
$i=0;
while($i<count($_POST['childnames']))
{
	$name= $_POST['childnames'][$i];
	$gender=$_POST['childgender'][$i];
	$age=$_POST['childage'][$i];
	
	echo "<div class='row'>";
echo "<div class='col-4'>$name</div>";
echo "<div class='col-4'>$gender</div>";
echo "<div class='col-4'>$age</div>";
echo"</div>";
    
	
$i++;
}

?>
</div>

<div class="row borderbottom texttocenter">BUS DETAILS</div>

<div class="row borderbottom">
<div class="col-4">
Plates:&nbsp;<?php echo $bus->plate_number?> <br/>
Sacco:&nbsp;<?php echo $bus->company_name?> <br/>
Seats:&nbsp;<?php echo $bus->seats?> <br/>
</div>
<div class="col-4">
Manager:&nbsp;<?php echo $bus->company_manager?> <br/>
Phone:&nbsp;<?php echo $bus->company_phone?> <br/>
Location:&nbsp;<?php echo $bus->company_location?> <br/>
</div>
</div>

<div class="row borderbottom "><b>PICKUP DETAIL</b>:&nbsp;time <?php echo $bus->startA?> 
location &nbsp <?php echo $bus->stationA?> 
</div>
<div class="row borderbottom texttocenter">This is a computer generated bus ticket </div>
<div class="row  ">BOOK YOUR TICKETS : itrans.co.ke &copy;2018 </div>

</div>

<div class="col-sm-4">

<div class="row borderbottom">
JOURNEY DATE:<?php echo $date?> <br/>
TICKET NUMBER:<?php echo $newticketcode?>
</div>

<div class="row borderbottom texttocenter">FARE DETAILS</div>

<div class="row borderbottom">
<div class="col-sm-6">Description</div>
<div class="col-sm-6">Amount(Ksh.)</div>
</div>

<div class="row borderbottom">
<div class="col-sm-2 "></div>
<div class="col-sm-3 borderright">QTY</div>
<div class="col-sm-3 borderright">FARE</div>
<div class="col-sm-4 borderright">TOTAL</div>
</div>

<div class="row borderbottom">
<div class="col-sm-3 borderright">SEATS</div>
<div class="col-sm-2 borderright"><?php echo $adults?></div>
<div class="col-sm-3 borderright"><?php echo $bus->fare?></div>
<div class="col-sm-4 borderright"><?php echo $amount?></div>
</div>

<div class="row">TOTAL BUS FARE : <?php echo $amount?></div>

</div>

</div>
</div>
</div>

<form action="generatePDF.php" method="post" style="margin-bottom:50px">
<input value="<?php echo $busid?>" name="busid" hidden="hidden"/>
<input value="<?php echo $newticketcode?>" name="ticketno" hidden="hidden"/>
<input value="<?php echo $busid?>" name="busid" hidden="hidden"/>
<input style="float:right; margin-right:40px;margin-top:5px" type="submit" class="btn btn-success" value="Generate pdf"/>
</form>
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

</body>
</html>



