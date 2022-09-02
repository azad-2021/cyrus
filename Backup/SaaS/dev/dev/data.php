<?php
$conn = new mysqli("192.168.1.1:9916","Ashok","cyrus@123",'cyrusbackend');
if($conn->connect_error){die("Connection Failed:".$conn->connect_error);}
?>
