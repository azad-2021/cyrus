<?php 

ob_start();
  $UID = $_GET['eid'];
  include 'connection.php';

    $queryName="SELECT * FROM employees where EmployeeCode=$UID";
    $resultName=mysqli_query($con2,$queryName);
    $dataName=mysqli_fetch_assoc($resultName);
    $name = $dataName['Employee Name'];
    header("location:home.php?eid=$UID&name=$name");

  $con2 -> close();
  $con3 -> close();
  $con4 -> close();

    ?>