<?php 
include 'connection.php';
//include 'session.php';
$Billno='2122CEUP12180';
$ZoneData="SELECT * from cyrusbilling.billbook WHERE BookNo='$Billno";
$result=mysqli_query($con2,$ZoneData);
$arr=mysqli_fetch_assoc($result);
$BillID=$arr['BillID'];


?>

?>