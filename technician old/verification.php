<?php
session_start();
include"connection.php";
if (isset($_GET['UPassword']) and isset($_GET['UName'])){
    $name=$_GET['UName'];
    $password=$_GET['UPassword'];
}else{
    $password = filter_input(INPUT_POST,"UPassword");
    $name = filter_input(INPUT_POST, "UName");
}
$query = "SELECT * FROM employees WHERE `Employee Name` = '$name' and Inservice=1";
$results = mysqli_query($con2, $query);
$row=mysqli_fetch_assoc($results);
$UID = $row["EmployeeCode"];


/*print "$rows['Sl']";*/
if (is_null($row['EmployeeCode'])){
    echo "<script language='javascript'>";
    echo 'alert("Incorrect Username !")';
    echo "</script>";
    echo "<script>window.location = 'index.html';</script>";
}
elseif ($row['UserPassword']!=$password){
    echo "<script language='javascript'>";
    echo 'alert("Incorrect Password !")';
    echo "</script>";
    echo "<script>window.location = 'index.html';</script>";
}
else{
   $_SESSION['user']=$row['Employee Name'];
   $_SESSION['empid']=$row['EmployeeCode'];
   $_SESSION['pass']=$row['UserPassword'];
//    header("location:home.php?eid=$UID&name=$name");
   include 'home.php';
}
?>