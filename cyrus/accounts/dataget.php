<?php
include ('connection.php');
include ('session.php');
date_default_timezone_set('Asia/Kolkata');
$Date =date('y-m-d H:i:s');

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


$Billno=!empty($_POST['Billno'])?$_POST['Billno']:'';
if (!empty($Billno))
{

    $Data=!empty($_POST['Data'])?$_POST['Data']:'';
    $myfile = fopen("data.json", "w") or die("Unable to open file!");
    fwrite($myfile, $Data);
    fclose($myfile);
    
    $ReceiveAmount=$_POST['ReceiveAmount'];
    $ReceiveDate=$_POST['ReceiveDate'];
    $SecurityAmount=$_POST['SecurityAmount'];
    $SReceiveAmount=$_POST['SReceiveAmount'];
    $SReceiveDate=$_POST['SReceiveDate'];
    $Sreleasedate=$_POST['Sreleasedate'];
    $DD=$_POST['DD'];
    $Remark=$_POST['Remark'];

    $BillData="SELECT * from cyrusbilling.billbook WHERE BookNo='$Billno'";
    $result=mysqli_query($con2,$BillData);
    $arr=mysqli_fetch_assoc($result);
    $BillID=$arr['BillID'];

    $date=date_create($ReceiveDate);
    $ReceiveDate=date_format($date,"Y/m/d");

    if ((empty($Sreleasedate)==true) and (empty($Sreleasedate)==true)) {

        $sql = "UPDATE cyrusbilling.billbook SET ReceivedAmount=$ReceiveAmount, ReceivedDate='$ReceiveDate', `DD/Online`='$DD', Remark='$Remark' WHERE BillID=$BillID";

    }elseif (empty($Sreleasedate)==true) {

        $sql = "UPDATE cyrusbilling.billbook SET ReceivedAmount=$ReceiveAmount, ReceivedDate='$ReceiveDate', `DD/Online`='$DD', Remark='$Remark', SecurityRcdAmt=$SReceiveAmount, SecurityRcdDt='$SReceiveDate' WHERE BillID=$BillID";

    }elseif (empty($SReceiveDate)==true) {

        $sql = "UPDATE cyrusbilling.billbook SET ReceivedAmount=$ReceiveAmount, ReceivedDate='$ReceiveDate', `DD/Online`='$DD', Remark='$Remark', SecurityAmt=$SecurityAmount, SecurityDt='$Sreleasedate' WHERE BillID=$BillID";
    }else{

        $sql = "UPDATE cyrusbilling.billbook SET ReceivedAmount=$ReceiveAmount, ReceivedDate='$ReceiveDate', `DD/Online`='$DD', Remark='$Remark', SecurityAmt=$SecurityAmount, SecurityDt='$Sreleasedate', SecurityRcdAmt=$SReceiveAmount, SecurityRcdDt='$SReceiveDate' WHERE BillID=$BillID";
    }

    

    if ($con2->query($sql) === TRUE) {

        $BillData="SELECT * from cyrusbilling.reminders WHERE BillID=$BillID";
        $result=mysqli_query($con2,$BillData);
        if (mysqli_num_rows($result)>0)
        {


            $BillData="SELECT * from cyrusbilling.`reminder lock` WHERE BillID=$BillID";
            $result=mysqli_query($con2,$BillData);
            if (mysqli_num_rows($result)>0)
            {

            }else{

                $sql = "INSERT INTO `reminder lock` (BillID, GenDate, Amount)
                VALUES ($BillID, '$ReceiveDate', $ReceiveAmount)";

                if ($con2->query($sql) === TRUE) {

                } else {
                  echo "Error: " . $sql . "<br>" . $con2->error;
              }
          }

      }


  } else {
      $myfile = fopen("debugerr.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con2->error);
      fclose($myfile);
  }

}

