<?php

include_once("init.php");

$page = "index.php";
mysql_connect("localhost",$mysql_user,$mysql_pass) or die(mysql_error());
mysql_select_db($mysql_db) or die(mysql_error());


$result=mysql_query("SELECT * FROM users WHERE username='". $_POST["username"]."' and password= md5('". $_POST["password"] ."')");

$row = mysql_fetch_array($result);

if ($row["user_id"]!=NULL){
   session_start();
   $_SESSION["username"]=$_POST["username"];
   header('Location: '.$page);
   exit;


}
else
{
   header('Location: login.php?login_error=1');
   exit;
}

?> 
