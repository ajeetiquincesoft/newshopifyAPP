<?php
  $host="localhost";
  $uname="root";
  $pass="";
  $database = "readcsvstore"; 
//$connection=mysql_connect($host,$uname,$pass); 
$connection=mysqli_connect("localhost","root","",$database)
// or die("Database Connection Failed");
//$selectdb=mysql_select_db($database) or die("Database could not be selected"); 
//$result=mysql_select_db($database)
//or die("database cannot be selected <br>");
?>
