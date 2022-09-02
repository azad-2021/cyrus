<?php
include 'connection.php';
$queryA= "SELECT COUNT(approvalID) FROM approval WHERE EmployeeID=70 and posted=0";
$resultA=mysqli_query($con,$queryA);
$row = mysqli_fetch_array($resultA);
$Total=$row['COUNT(approvalID)'];
echo $Total;

?>