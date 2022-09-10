<?php 

$host = "localhost";  
$user = "root";  
$password = '';  

$db = "cyrusproject";


$con = mysqli_connect($host, $user, $password, $db);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

//Tables

$org="organization";
$div="division";
$site="site";
$orders="orders";

?>  