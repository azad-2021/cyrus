<?php 

$host = "192.168.1.2:3306";  
$user = "Ashok";  
$password = 'Cyrus@123';  

$host1 = "localhost";  
$user1 = "root";
$password1 = '';


$db_2 = "cyrusbackend";
$db_3 = "cyrusbilling";
$db_3 = "saas";  

$con = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con2 = mysqli_connect($host, $user, $password, $db_3);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con3 = mysqli_connect($host, $user, $password, $db_3);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}
?>  