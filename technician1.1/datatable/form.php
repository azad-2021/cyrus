<?php
session_start();
$con = new mysqli("localhost","root","","backend");
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Print host information
// echo "Connect Successfully. Host info: " . mysqli_get_host_info($con);
$password = filter_input(INPUT_POST,"UPassword");
$name = filter_input(INPUT_POST, "UName");
$sql = "SELECT * FROM Employees WHERE `Employee Name` = '$name'";
$results = $con->query($sql);
$row=$results->fetch_assoc();
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
    header("location:home.php?eid=$UID&name=$name");
}
