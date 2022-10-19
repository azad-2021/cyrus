<?php
include ('connection.php');
include ('session.php');
//$UserID=19;
$UserID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$Date =date('y-m-d H:i:s');
$date =date('y-m-d');
$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
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

$Data=!empty($_POST['Data'])?$_POST['Data']:'';
if (!empty($Data))
{


    $myfile = fopen("data.json", "w") or die("Unable to open file!");
    fwrite($myfile, $Data);
    fclose($myfile);

    $obj = json_decode($Data);

    $BranchCode= $obj->BranchCode;
    $BillID= $obj->BillID;
    $Description = $obj->Description;
    $NextReminderDate= $obj->NextReminderDate;
    $Action = $obj->Action;

    $sql = "INSERT INTO reminders (BranchCode, BillID, UserID, Description, ReminderDate, NextReminderDate, ActionRequired)
    VALUES ('$BranchCode', '$BillID', '$UserID', '$Description', '$Date', '$NextReminderDate', '$Action')";

    if ($con2->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}

$ReminderU=!empty($_POST['ReminderU'])?$_POST['ReminderU']:'';
$myfile = fopen("rmd.txt", "w") or die("Unable to open file!");
fwrite($myfile, $ReminderU);
fclose($myfile);
if (!empty($ReminderU))
{
    $Jobcard=!empty($_POST['Jobcard'])?$_POST['Jobcard']:'';

    $myfile = fopen("rmd.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $ReminderU.'.....'.$Jobcard);
    fclose($myfile);

    $query="SELECT * FROM `jobcard reminder` WHERE `Card Number`='$Jobcard'";
    $result2=mysqli_query($con,$query);
    if (mysqli_num_rows($result2)>0)
    {  
        $sql = "UPDATE `jobcard reminder` SET Description='$ReminderU' WHERE `Card Number`='$Jobcard'";
    }else{

        $sql = "INSERT INTO `jobcard reminder` (`Card Number`, Description, UserID)
        VALUES ('$Jobcard', '$ReminderU', $UserID)";

    }

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;

      $myfile = fopen("bankerr.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
  }
}


$Getmail=!empty($_POST['Getmail'])?$_POST['Getmail']:'';
$myfile = fopen("debug.txt", "w") or die("Unable to open file!");
fwrite($myfile, $Getmail);
fclose($myfile);
if (!empty($Getmail))
{   
    $BranchCode=!empty($_POST['BranchCodeM'])?$_POST['BranchCodeM']:'';

    $query="SELECT `Mobile Number`, MobileNumber1, MobileNumber2, Email, PhoneNo from cyrusbackend.branchs WHERE BranchCode=$BranchCode";
    $result = mysqli_query($con,$query);
    $Mobile1='';
    $Mobile2='';
    $Mobile3='';
    $Email='';
    $Phone='';
    if(mysqli_num_rows($result)>0)
    {   

        $arr=mysqli_fetch_assoc($result);

        if (!empty($arr['Mobile Number'])) {
            $Mobile1= $arr['Mobile Number'];

        }

        if (!empty($arr['MobileNumber1'])) {
           $Mobile1=$arr['MobileNumber1'];
       }

       if (!empty($arr['MobileNumber1'])) {
        $Mobile3=$arr['MobileNumber2'];
    }

    if (!empty($arr['Email'])) {
        $Email= $arr['Email'];
    }
    if (!empty($arr['PhoneNo'])) {
        $Phone= $arr['PhoneNo'];
    }
    $data = array("Mobile1"=>$Mobile1, "Mobile2"=>$Mobile2, "Mobile3"=>$Mobile3, "Phone"=>$Phone, "Email"=>$Email);

    echo json_encode($data);


}else{
    $data = array("Mobile1"=>$Mobile1, "Mobile2"=>$Mobile2, "Mobile3"=>$Mobile3, "Email"=>$Email);

    echo json_encode($data);
}

}

$con->close();
$con2->close();


