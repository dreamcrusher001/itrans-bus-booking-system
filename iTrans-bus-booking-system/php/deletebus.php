<?php
require_once("database.php");

$busid=$_POST['deleteID'];

$sql="DELETE FROM bus WHERE busid='$busid'";
$database->query($sql);

$sql="DELETE FROM allocation WHERE busid='$busid'";
$database->query($sql);
?>