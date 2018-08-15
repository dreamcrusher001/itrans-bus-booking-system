<?php
require_once("database.php");
require_once("session.php");

  $sql="SELECT id FROM companylogin WHERE username='$login_session'";
   $result=$database->query($sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $companyid=$row['id'];
   
   $plateno=$_POST['noplate'];
   $seats=$_POST['seatno'];
   $stationA=$_POST['stationA'];
   $stationB=$_POST['stationB'];
   $startA=$_POST['startA'];
   $startB=$_POST['startB'];
   $fare=$_POST['fare'];
   
   $sql="INSERT INTO bus(`plateno`,`companyid`,`seat`) VALUES('$plateno','$companyid','$seats')";
   $database->query($sql);
   
   $sql="SELECT  MAX(busid) AS latestid FROM bus";
   $result=$database->query($sql);
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   $busid=$row['latestid'];
   
   $sql="INSERT INTO allocation(`busid`,`stationA`,`StationB`,`startA`,`startB`,`fare`)VALUES('$busid','$stationA','$stationB','$startA','$startB','$fare')";
   $database->query($sql);
   
   $sql="INSERT INTO allocation(`busid`,`stationA`,`StationB`,`startA`,`startB`,`fare`)VALUES('$busid','$stationB','$stationA','$startB','$startA','$fare')";
   $database->query($sql);
   
            header("location:../CompanyIndex.php");
?>