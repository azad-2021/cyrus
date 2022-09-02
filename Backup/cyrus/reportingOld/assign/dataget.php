<?php
include ('connection.php');

$Employee='';
$Gadget='';
$AssignDate='';
$AttendDate= '';
$BankCode=!empty($_POST['Bank'])?$_POST['Bank']:'';
if (!empty($BankCode))
{
    $BankData="SELECT ZoneRegionCode,ZoneRegionName from zoneregions WHERE BankCode=$BankCode order by ZoneRegionName";
    $result = mysqli_query($con,$BankData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Zone</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['ZoneRegionCode']."'>".$arr['ZoneRegionName']."</option><br>";
        }
    }
    
}

$ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';
if (!empty($ZoneCode))
{
    $ZoneData="SELECT BranchCode,BranchName from branchs WHERE ZoneRegionCode=$ZoneCode order by BranchName";
    $result=mysqli_query($con,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Branch</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {

            echo "<option value='".$arr['BranchCode']."'>".$arr['BranchName']."</option><br>";
        }
    }


}

$ItemZone=!empty($_POST['ItemZone'])?$_POST['ItemZone']:'';
if (!empty($ItemZone))
{

 $query="SELECT * FROM rates WHERE Zone=$ItemZone";
 $result=mysqli_query($con4,$query);
 if (mysqli_num_rows($result)>0)
 {
    while ($arr=mysqli_fetch_assoc($result))
    {

        echo "<option value='".$arr['RateID']."'>".$arr['Description']."</option><br>";
    }
}


}


?>

