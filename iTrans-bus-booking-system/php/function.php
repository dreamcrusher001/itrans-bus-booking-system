<?php
function redirect($url,$permanent=false){
    header('Location:'.$url,true,$permanent? 301:302);
    exit();
}

function msgnredirect($msg,$redirecturl,$color)
{
	if(!isset($color)){
		$color="teal";
	}
	
	echo'
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<body class="w3-container">

<div id="id01" style="display:block" class="w3-modal">
  <div class="w3-modal-content  w3-animate-zoom">
    <header class="w3-container w3-'.$color.'"> 
      <a href="'.$redirecturl.'" onclick="document.getElementById("id01").style.display="none"" 
      class="w3-closebtn">&times;</a>
      <h2>Message</h2>
    </header>
    <div class="w3-container">
     <center> <p>'.$msg.'</p></center>
    </div>
    <footer class="w3-container w3-'.$color.'">
      <p>iTrans &copy; </p>
    </footer>
  </div>
</div>
            
</body>

</html> 
	';	
}
	?>
