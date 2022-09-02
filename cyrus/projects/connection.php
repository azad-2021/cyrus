<?php 
$host = "192.168.1.1:9916";  
$user = "Ashok";  
$password = 'cyrus@123';

$host1 = "localhost";  
$user1 = "root";  
$password1 = '';

$db_2 = "projects";

$con = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

?>  