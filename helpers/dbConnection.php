<?php 
   session_start();

# Create DB CONNECTION ...... 

$server = "localhost";    // 127.0.0.1 
$dbName = "nti_todolist"; 
$dbUser = "root"; 
$dbPassword = "";

 $con =   mysqli_connect($server,$dbUser,$dbPassword,$dbName);

   if(!$con){
       echo 'Error , '.mysqli_connect_error();
   }
?>