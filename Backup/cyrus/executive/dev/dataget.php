<?php 
include 'connection.php';
include "session.php";

date_default_timezone_set('Asia/Kolkata');
$newtimestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($newtimestamp));

if (isset($_SESSION['query'])) {
  $EXEID=$_SESSION['query'];
}else{
  $EXEID=$_SESSION['userid'];
}

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

$DesignationIDVisit=!empty($_POST['DesignationIDVisit'])?$_POST['DesignationIDVisit']:'';
if (!empty($DesignationIDVisit))
{
  $ZoneCodeVisit=!empty($_POST['ZoneCodeVisit'])?$_POST['ZoneCodeVisit']:'';

  $DataVisit="SELECT * FROM `bank employee` WHERE ZoneRegionCode=$ZoneCodeVisit and DesignationID=$DesignationIDVisit order by BankEmployeeName";
  $result = mysqli_query($con3,$DataVisit);
  if(mysqli_num_rows($result)>0)
  {
    echo "<option value=''>Select Bank Employee</option>";
    while ($arr=mysqli_fetch_assoc($result))
    {
      echo "<option value='".$arr['BankEmployeeID']."'>".$arr['BankEmployeeName']."</option><br>";
    }
  }else{
    echo "<option value=''>Select Bank Employee</option>";
  }

}
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;

if (!empty($Data)){

 $obj = json_decode($Data);
 $OrderID=$obj->OrderID;
 $ZoneCode=$obj->ZoneCode;
 $myfile = fopen("DataZone.json", "w") or die("Unable to open file!");
 fwrite($myfile, $Data);
 fclose($myfile);
 $query="SELECT * FROM rates WHERE Zone=$ZoneCode order by Description";
 $result=mysqli_query($con2,$query);
 if (mysqli_num_rows($result)>0)
 {
   echo '<option value="">Select</option><br>';
   while ($arr=mysqli_fetch_assoc($result))
   {

    $d = array("RateID"=>$arr['RateID'], "ItemID"=>$arr['ItemID']);
    $data = json_encode($d);
    echo "<option value='".$data."'>".$arr['Description']."</option><br>";
  }
}
}

$ZoneCodeAMC=!empty($_POST['ZoneCodeAMC'])?$_POST['ZoneCodeAMC']:'';

if (!empty($ZoneCodeAMC))
{   
  $myfile = fopen("ZoneCodeAMC.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $ZoneCodeAMC);
  fclose($myfile);
  $ZoneAMC="SELECT * from amcs WHERE ZoneRegionCode=$ZoneCodeAMC";
  $result=mysqli_query($con,$ZoneAMC);
  if (mysqli_num_rows($result)>0)
  {

    while ($row=mysqli_fetch_assoc($result))
    {
      print "<tr>";
      print '<td style="min-width: 150px;">'.$row["Device"]."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["StartDate"]))."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["EndDate"]))."</td>";
      print '<td style="min-width: 150px;">'.$row["Visits"]."</td>";
      print '<td style="min-width: 150px;">'.$row["Rate"]."</td>";
      print '</tr>';
    }

  }
}

$Regiondata=!empty($_POST['Regiondata'])?$_POST['Regiondata']:'';

if (!empty($Regiondata))
{   

  $Region="SELECT * FROM cyrusbackend.districts
  join `cyrus regions`on districts.RegionCode=`cyrus regions`.RegionCode
  WHERE ControlerID=$EXEID 
  order by RegionName";
  $result=mysqli_query($con,$Region);
  if (mysqli_num_rows($result)>0)
  {

    while ($row=mysqli_fetch_assoc($result))
    {
      print "<tr>";
      print '<td>'.$row["RegionName"]."</td>";
      print '<td>'.$row["District"]."</td>";
      print '</tr>';
    }

  }
}

$DesignationIDVEntry=!empty($_POST['DesignationIDVEntry'])?$_POST['DesignationIDVEntry']:'';
if (!empty($DesignationIDVEntry))
{

  $BEmployeeVisit=!empty($_POST['BEmployeeVisit'])?$_POST['BEmployeeVisit']:'';
  $ZoneCodeVEntry=!empty($_POST['ZoneCodeVEntry'])?$_POST['ZoneCodeVEntry']:'';
  $VisitDate=!empty($_POST['VisitDate'])?$_POST['VisitDate']:'';
  $Description=!empty($_POST['Description'])?$_POST['Description']:'';
  $NextVisitDate=!empty($_POST['NextVisitDate'])?$_POST['NextVisitDate']:'';

  $Data="SELECT * from `visit details` WHERE VisitDate='$VisitDate' and ExecutiveID=$EXEID and ZoneRegionCode=$ZoneCodeVEntry and  BankEmployeeID=$DesignationIDVEntry";
  $result=mysqli_query($con3,$Data);
  if (mysqli_num_rows($result)>0)
  {
    echo "Details already exist";
  }elseif($VisitDate>=$NextVisitDate){
    echo 'Next visit date must be greater than visit date';
  }else{
    $sql = "INSERT INTO `visit details` (ExecutiveID, ZoneRegionCode, BankEmployeeID, VisitDate, VisitRemark, NextVisitDate)
    VALUES ($EXEID, $ZoneCodeVEntry, $BEmployeeVisit, '$VisitDate', '$Description', '$NextVisitDate')";

    if ($con3->query($sql) === TRUE) {
      echo 1;
    }else {
      echo "Error: " . $sql . "<br>" . $con3->error;
    }

  }
}

$BankVisit=!empty($_POST['BankVisit'])?$_POST['BankVisit']:'';

if (!empty($BankVisit))
{   

  $query="SELECT * FROM dsr.`visit details`
  join cyrusbackend.pass on `visit details`.ExecutiveID=pass.ID
  join `bank employee` on `visit details`.BankEmployeeID = `bank employee`.BankEmployeeID
  join designation on `bank employee`.DesignationID= designation.DesignationID
  join cyrusbackend.zoneregions on `visit details`.ZoneRegionCode=zoneregions.ZoneRegionCode
  join cyrusbackend.bank on zoneregions.BankCode=bank.BankCode
  join cyrusbackend.`cyrus regions` on `visit details`.ExecutiveID=`cyrus regions`.ControlerID
  WHERE month(VisitDate)=month(current_date()) and ControlerID=$EXEID
  group by VisitDate";
  $result=mysqli_query($con3,$query);
  if (mysqli_num_rows($result)>0)
  {

    while ($row=mysqli_fetch_assoc($result))
    {
      print "<tr>";
      print '<td style="min-width: 150px;">'.$row["BankName"]."</td>";
      print '<td style="min-width: 150px;">'.$row["ZoneRegionName"]."</td>";
      print '<td style="min-width: 150px;">'.$row["DesignationName"]."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["VisitDate"]))."</td>";
      print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["NextVisitDate"]))."</td>";
      print '<td style="min-width: 150px;">'.$row["VisitRemark"]."</td>";
      print '<td style="min-width: 150px;">'.$row["UserName"]."</td>";
      print '</tr>';
    }

  }

  $query="SELECT * FROM dsr.`visit details`
  join cyrusbackend.pass on `visit details`.ExecutiveID=pass.ID
  join `bank employee` on `visit details`.BankEmployeeID = `bank employee`.BankEmployeeID
  join designation on `bank employee`.DesignationID=designation.DesignationID
  join cyrusbackend.branchdetails on `visit details`.ZoneRegionCode=branchdetails.ZoneRegionCode
  join cyrusbackend.`cyrus regions` on `visit details`.ExecutiveID=`cyrus regions`.SubControllerID
  WHERE ControlerID=$EXEID and month(VisitDate)=month(current_date())
  group by VisitDate";
  $result=mysqli_query($con3,$query);
  if (mysqli_num_rows($result)>0)
  {

    while ($row=mysqli_fetch_assoc($result))
    {
     print "<tr>";
     print '<td style="min-width: 150px;">'.$row["BankName"]."</td>";
     print '<td style="min-width: 150px;">'.$row["ZoneRegionName"]."</td>";
     print '<td style="min-width: 150px;">'.$row["DesignationName"]."</td>";
     print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["VisitDate"]))."</td>";
     print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["NextVisitDate"]))."</td>";
     print '<td style="min-width: 150px;">'.$row["VisitRemark"]."</td>";
     print '<td style="min-width: 150px;">'.$row["UserName"]."</td>";
     print '</tr>';
   }

 }
}

$DName=!empty($_POST['DName'])?$_POST['DName']:'';
if (!empty($DName))
{

  $Designation=!empty($_POST['DesignationID'])?$_POST['DesignationID']:'';
  $ZoneCodeD=!empty($_POST['ZoneCodeD'])?$_POST['ZoneCodeD']:'';
  $DMobile=!empty($_POST['DMobile'])?$_POST['DMobile']:'';
  $DMobile='+91'.$DMobile;
  //echo  $Designation;
  $Data="SELECT * FROM `bank employee` WHERE BankEmployeeName='$DName' and ZoneRegionCode=$ZoneCodeD and DesignationID=$Designation";
  $result=mysqli_query($con,$Data);
  if (mysqli_num_rows($result)>0)
  {
    echo "Bank Employee ".$DName."  already exist";
  }else{
    $sql = "INSERT INTO `bank employee` (BankEmployeeName, DesignationID, ZoneRegionCode, MobileNumber)
    VALUES ('$DName', $Designation, $ZoneCodeD, '$DMobile')";

    if ($con3->query($sql) === TRUE) {
      echo 1;
    }else {
      echo "Error: " . $sql . "<br>" . $con3->error;
    }

  }
}

$TotalVisits=!empty($_POST['TotalVisits'])?$_POST['TotalVisits']:'';

if (!empty($TotalVisits))
{   

  $query="SELECT * FROM cyrusbackend.branchdetails
  join districts on branchdetails.Address3=districts.District
  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
  WHERE ControlerID=$EXEID and BankCode not in (17,29,30,33,43,46,49,50,52) group by ZoneRegionCode order by BankName";
  $result=mysqli_query($con,$query);
  if (mysqli_num_rows($result)>0)
  {
    $sr=0;
    while ($row=mysqli_fetch_assoc($result))
    {
      $sr++;
      print "<tr>";
      print '<td style="min-width: 150px;">'.$sr."</td>";
      print '<td style="min-width: 150px;">'.$row["BankName"]."</td>";
      print '<td style="min-width: 150px;">'.$row["ZoneRegionName"]."</td>";
      print '</tr>';
    }

  }

}


$PendingVisit=!empty($_POST['PendingVisit'])?$_POST['PendingVisit']:'';

if (!empty($PendingVisit))
{   

  //echo $PendingVisit;

  $query="SELECT * FROM cyrusbackend.branchdetails
  join districts on branchdetails.Address3=districts.District
  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
  WHERE not exists (
  SELECT ZoneRegionCode FROM dsr.`visit details` WHERE branchdetails.ZoneRegionCode=`visit details`.ZoneRegionCode and  month(VisitDate)=month(current_date())
) and ControlerID=$EXEID and BankCode not in (17,29,30,33,43,46,49,50,52) group by ZoneRegionCode order by BankName";
$result=mysqli_query($con,$query);
if (mysqli_num_rows($result)>0)
{
  $sr=0;
  while ($row=mysqli_fetch_assoc($result))
  {
    $sr++;
    print "<tr>";
    print '<td style="min-width: 150px;">'.$sr."</td>";
    print '<td style="min-width: 150px;">'.$row["BankName"]."</td>";
    print '<td style="min-width: 150px;">'.$row["ZoneRegionName"]."</td>";
    print '</tr>';
  }

}

}

/*

$query="SELECT * FROM cyrusbackend.bankvisits
join pass on bankvisits.ExecutiveID=pass.ID
join `bank employee` on bankvisits.BankEmployeeID = `bank employee`.BankEmployeeID
join `bank designation` on `bank employee`.DesignationID=`bank designation`.DesignationID
join zoneregions on bankvisits.ZoneRegionCode=zoneregions.ZoneRegionCode
join bank on zoneregions.BankCode=bank.BankCode
join `cyrus regions` on bankvisits.ExecutiveID=`cyrus regions`.ControlerID
WHERE month(VisitDate)=(month(current_date())-3)
group by VisitDate";
$result=mysqli_query($con3,$query);
if (mysqli_num_rows($result)>0)
{

  while ($row=mysqli_fetch_assoc($result))
  {
    print "<tr>";
    print '<td style="min-width: 150px;">'.$row["BankName"]."</td>";
    print '<td style="min-width: 150px;">'.$row["ZoneRegionName"]."</td>";
    print '<td style="min-width: 150px;">'.$row["DesignationName"]."</td>";
    print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["VisitDate"]))."</td>";
    print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["NextVisitDate"]))."</td>";
    print '<td style="min-width: 150px;">'.$row["VisitRemark"]."</td>";
    print '<td style="min-width: 150px;">'.$row["UserName"]."</td>";
    print '</tr>';
  }

}

$query="SELECT * FROM cyrusbackend.bankvisits
join pass on bankvisits.ExecutiveID=pass.ID
join `bank employee` on bankvisits.BankEmployeeID = `bank employee`.BankEmployeeID
join `bank designation` on `bank employee`.DesignationID=`bank designation`.DesignationID
join branchdetails on bankvisits.ZoneRegionCode=branchdetails.ZoneRegionCode
join `cyrus regions` on bankvisits.ExecutiveID=`cyrus regions`.SubControllerID
WHERE ControlerID=$EXEID and month(VisitDate)=(month(current_date())-3)
group by VisitDate";
$result=mysqli_query($con3,$query);
if (mysqli_num_rows($result)>0)
{

  while ($row=mysqli_fetch_assoc($result))
  {
   print "<tr>";
   print '<td style="min-width: 150px;">'.$row["BankName"]."</td>";
   print '<td style="min-width: 150px;">'.$row["ZoneRegionName"]."</td>";
   print '<td style="min-width: 150px;">'.$row["DesignationName"]."</td>";
   print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["VisitDate"]))."</td>";
   print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["NextVisitDate"]))."</td>";
   print '<td style="min-width: 150px;">'.$row["VisitRemark"]."</td>";
   print '<td style="min-width: 150px;">'.$row["UserName"]."</td>";
   print '</tr>';
 }

}*/



?>

