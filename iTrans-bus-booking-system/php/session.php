<?php
   require_once('database.php');
   require_once("function.php");
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $login_session=$user_check;
   
   /*
   $ses_sql = mysqli_query($db,"select username from customerlogin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   */
   
   
?>