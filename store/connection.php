<?php  
/*    
$host = "192.168.1.2:3306";  
$user = "Ashok";  
$password = 'Cyrus@123';  
*/
$host = "localhost";  
$user = "root";  
$password = '';  
$db_2 = "cyrusbackend";
$db_3 = "cyrusbilling";

$con = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con2 = mysqli_connect($host, $user, $password, $db_3);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

?>  