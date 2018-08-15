<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/stylesheet.css"/>
 <link rel="stylesheet" href="../bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css" />
 <link rel="stylesheet" href="../css/PopUp.css">

</head>

<body>
 <?php require_once('customer.php'); ?>

<div id="popup2" class="overlay">
	<div class="popup">
    <center><h2 >Deposit money</h2></center>
    <a class="close" href="javascript:history.back()">&times;</a>
		<div class="content">

<div class="login_forms" >
  
<div class="row">
<div class="col-sm-4">&nbsp; &nbsp; Current balance: </div>
<div class="col-sm-4"><?php echo $customer->balance;?></div>
<div class="col-sm-4"></div>
</div>  
<form class="form-horizontal" role="form" action="updatewallet.php" method="post">

<div class="form-group">
<label for="firstname" class="col-sm-2 control-label">Amount</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="firstname" name="amount" placeholder="Enter amount">
</div>
</div>

<div class="form-group">
<label for="password" class="col-sm-2 control-label">Code</label>
<div class="col-sm-10">
<input type="text" style="font-weight:bold" class="form-control" id="password" name="code"placeholder="Enter code">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="depositbtn" class="btn btn-success">Deposit</button>
</div>
</div>

</form>
</div>
</div>
</div>
</div> 



</body>
</html>