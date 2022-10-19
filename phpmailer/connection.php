<?php 

$host = "192.168.1.2:3306";  
$user = "Ashok";  
$password = 'Cyrus@123';  

$host1 = "localhost";  
$user1 = "root";
$password1 = '';


$db = "cyrusbackend";
$db2 = "cyrusbilling";  

$con = mysqli_connect($host, $user, $password, $db);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con2 = mysqli_connect($host, $user, $password, $db);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}
?>  