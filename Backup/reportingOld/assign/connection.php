<?php      
$host = "localhost";  
$user = "root";  
$password = '';  
$db_2 = "backend";
$db_3 = "billing";
$db ="test";  

$con2 = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
   die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con3 = mysqli_connect($host, $user, $password, $db_3);  
if(mysqli_connect_errno()) {  
   die("Failed to connect with MySQL: ". mysqli_connect_error());  
}
$con = mysqli_connect("192.168.1.1:9916", "Ashok", "cyrus@123", "cyrusbackend");  
if(mysqli_connect_errno()) {  
   die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con4 = mysqli_connect("192.168.1.1:9916", "Ashok", "cyrus@123", "cyrusbilling");  
if(mysqli_connect_errno()) {  
   die("Failed to connect with MySQL: ". mysqli_connect_error());  
}
/*
$con4 = mysqli_connect($host, $user, $password, $db);  
if(mysqli_connect_errno()) {  
   die("Failed to connect with MySQL: ". mysqli_connect_error());  
}*/

?>  
