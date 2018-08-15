<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="../jscript/alertifyjs/alertify.min.js"></script>
<link rel="stylesheet" href="../jscript/alertifyjs/alertify.min.css"/>
<link rel="stylesheet" href="../jscript/alertifyjs/default.min.css"/>
</head>

<body>
<input type="button" value="pop" onClick="pop()"/>

<script>
function pop(){
	alertify.confirm("Are you sure").set('onok',
	function(){
		alertify.success('Ok');
		alert("
<?php
   session_start();
   
   if(session_destroy()) {
      header("location:../login.html");
   }
?>
");
	});
}
</script>
</body>
</html>
