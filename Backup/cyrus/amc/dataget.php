<?php 
include 'connection.php';

$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
if (!empty($BankCode))
{

  $BankData="SELECT amcs.ZoneRegionCode, ZoneRegionName FROM cyrusbackend.amcs
  join branchdetails on amcs.ZoneRegionCode=branchdetails.ZoneRegionCode
  WHERE BankCode=$BankCode Group by amcs.ZoneRegionCode order by ZoneRegionName";
  $result = mysqli_query($con,$BankData);
  if(mysqli_num_rows($result)>0)
  {
    echo "<option value=''>Select Zone</option>";
    while ($arr=mysqli_fetch_assoc($result))
    {
      $d = array("ZoneCode"=>$arr['ZoneRegionCode'], "ZoneName"=>$arr['ZoneRegionName']);

      $data2= json_encode($d);
      echo "<option value='".$data2."'>".$arr['ZoneRegionName']."</option><br>";
    }
  }

}

$BankCodeB=!empty($_POST['BankCodeB'])?$_POST['BankCodeB']:'';
if (!empty($BankCodeB))
{

  $BankData="SELECT ZoneRegionCode,ZoneRegionName from zoneregions WHERE BankCode=$BankCodeB order by ZoneRegionName";
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

$ZoneCodeB=!empty($_POST['ZoneCodeB'])?$_POST['ZoneCodeB']:'';
if (!empty($ZoneCodeB))
{
  $ZoneData="SELECT BranchCode,BranchName from branchs WHERE ZoneRegionCode=$ZoneCodeB order by BranchName";
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


$StartDate=!empty($_POST['StartDate'])?$_POST['StartDate']:'';
$EndDate=!empty($_POST['EndDate'])?$_POST['EndDate']:'';
if (!empty($EndDate) and !empty($StartDate))
{
  $Sr=1;

  $ZoneCode=!empty($_POST['ZoneCodeAMC'])?$_POST['ZoneCodeAMC']:'';

  $query="SELECT * FROM branchdetails WHERE ZoneRegionCode=$ZoneCode order by BranchName";

  $result2=mysqli_query($con,$query);
  while ($row2=mysqli_fetch_assoc($result2))
  {

    $ZoneData="SELECT * from amcs
    join gadget on amcs.Device=gadget.Gadget
    WHERE ZoneRegionCode=$ZoneCode";
    $result=mysqli_query($con,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {


      while ($row=mysqli_fetch_assoc($result))
      {

        $AMCStartDate=$row['StartDate'];
        $AMCEndDate=$row['EndDate'];
        $GadgetID=$row['GadgetID'];
      //echo $StartDate.'<br>';
        /*
        if ($Quarter==1) {
          $S=date('Y-m-d', strtotime($StartDate));
          $E=date('Y-m-d', strtotime($S. ' + 90 days'));
        }elseif($Quarter==2){
          $S=date('Y-m-d', strtotime($StartDate. ' + 90 days'));
          $E=date('Y-m-d', strtotime($S. ' + 90 days'));
        }elseif($Quarter==3){
          $S=date('Y-m-d', strtotime($StartDate. ' + 180 days'));
          $E=date('Y-m-d', strtotime($S. ' + 90 days'));
        }elseif($Quarter==4){
          $S=date('Y-m-d', strtotime($StartDate. ' + 270 days'));
          $E=$EndDate;
        }*/

        $BranchCode=$row2['BranchCode'];
        $Bank=$row2['BankName'];
        $Zone=$row2['ZoneRegionName'];
        $Branch=$row2['BranchName'];
        $query="SELECT `Job_Card_No`, Remark, VisitDate as LastVisit FROM cyrusbackend.jobcardmain
        WHERE VisitDate between '$StartDate'  and '$EndDate' and GadgetID=$GadgetID and BranchCode=$BranchCode and `Card Number` like '%AMC%' and `Card Number` not like '%X%' and `Card Number` not like '%Y%' order by Job_Card_No desc limit 1";

        $result3=mysqli_query($con,$query);
        if (mysqli_num_rows($result3)>0)
        {       
          $result4=$result3;
        }else{
          $query="SELECT max(VisitDate) as LastVisit FROM cyrusbackend.jobcardmain
          WHERE VisitDate between '$StartDate'  and '$EndDate' and GadgetID=$GadgetID and BranchCode=$BranchCode and `Card Number` not like '%X%' and `Card Number` not like '%Y%'";

          $result4=mysqli_query($con,$query);
        }
        while ($row3=mysqli_fetch_assoc($result4))
        {
          $Gadget=$row['Gadget'];
          if (!empty($row3['LastVisit'])) {

            $visit=$row3['LastVisit'];
            $query="SELECT `Card Number`, Remark FROM cyrusbackend.jobcardmain
            WHERE VisitDate ='$visit' and GadgetID=$GadgetID and BranchCode=$BranchCode and `Card Number` not like '%X%' and `Card Number` not like '%Y%'";
            $result5=mysqli_query($con,$query);
            $row5=mysqli_fetch_assoc($result5);
            $jobcard=$row5['Card Number'];

            $VisitDate=date('d-M-Y',strtotime($row3['LastVisit']));
            $Status=$row5['Remark'];


          }else{
            $VisitDate='Null';
            $Status='Null';
            $jobcard='Null';     
          }
          ?>
          <tr>
            <td ><?php echo $Sr; ?></td>
            <td ><?php echo $Branch; ?></td>
            <td ><?php echo $jobcard; ?></td>
            <td><?php echo date('d-M-Y',strtotime($StartDate)); ?></td>
            <td><?php echo date('d-M-Y',strtotime($EndDate)); ?></td>
            <td ><?php echo $VisitDate; ?></td>
            <td ><?php echo $Status; ?></td>
            <td><?php echo $Gadget; ?></td>
          </tr>
          <?php
          $Sr++;
        }
      }
    }
  }
}

$ZoneCodeAMC=!empty($_POST['AMCZone'])?$_POST['AMCZone']:'';
if (!empty($ZoneCodeAMC))
{
  $ZoneCodeAMC=!empty($_POST['AMCZone'])?$_POST['AMCZone']:'';
  $ZoneData="SELECT * from amcs
  join gadget on amcs.Device=gadget.Gadget
  WHERE ZoneRegionCode=$ZoneCodeAMC";
  $result=mysqli_query($con,$ZoneData);
  if (mysqli_num_rows($result)>0){
    $Sr=1;
    while ($row=mysqli_fetch_assoc($result)){
     ?>
     <tr>
      <td><?php echo $Sr ?></td>
      <td><?php echo date('d-M-Y',strtotime($row["StartDate"])); ?></td>
      <td><?php echo date('d-M-Y',strtotime($row["EndDate"])); ?></td>
      <td><?php echo $row["Gadget"] ?></td>
    </tr>
    <?php $Sr++;
  }
}
}
$_POST['ZoneCodeAMC']='';

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


$EmployeeCodeP=!empty($_POST['EmployeeCodeP'])?$_POST['EmployeeCodeP']:'';
if (!empty($EmployeeCodeP))
{

  $SDate=!empty($_POST['SDate'])?$_POST['SDate']:'';
  $EDate=!empty($_POST['EDate'])?$_POST['EDate']:'';
  $sr=0;

  $query="SELECT jobcardmain.VisitDate, BankName, ZoneRegionName, BranchName, `jobcardmain`.`Card Number`, Remark, ServiceDone, WorkPending, `Reference`, ID, `Employee Name`, TargetAmounts FROM cyrusbackend.jobcardmain
  left join `reference table` on jobcardmain.`Card Number`=`reference table`.`Card Number`
  join employees on jobcardmain.EmployeeCode=employees.EmployeeCode
  join branchdetails on jobcardmain.BranchCode=branchdetails.BranchCode WHERE jobcardmain.EmployeeCode=$EmployeeCodeP and jobcardmain.VisitDate between '$SDate' and '$EDate' and `jobcardmain`.`Card Number` not like '%X%' and `jobcardmain`.`Card Number` not like '%Y%' order by VisitDate";

  $result=mysqli_query($con,$query);
  $ExVisitDate='';
  $exBranchName='';
  while($row = mysqli_fetch_array($result)){

    $Reference=$row["Reference"];
    $ID=$row["ID"];
    if ($ExVisitDate==$row["VisitDate"]) {
      $VisitDate='';
    }else{

      $VisitDate=date('d-M-Y',strtotime($row["VisitDate"]));
    }

    if ($exBranchName==$row["BranchName"]) {
      $BranchName='';
      $Zone='';
      $Bank='';
      $s='';
      $VisitDate='';
    }else{
      $sr++;
      $s=$sr;
      $BranchName=$row["BranchName"];
      $Bank=$row["BankName"];
      $Zone=$row["ZoneRegionName"];
      $VisitDate=date('d-M-Y',strtotime($row["VisitDate"]));
    }
    /*
    $query4="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
    WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and BillDate between '$SDate' and '$EDate'";
    $result4=mysqli_query($con2,$query4);
    $row4 = mysqli_fetch_array($result4);

    $row12 = mysqli_fetch_array($result12);

*/
    if ($Reference=='Order') {

      $query2="SELECT datediff(AssignDate, AttendDate) as days, AssignDate FROM cyrusbackend.orders WHERE OrderID=$ID";
    }elseif($Reference=='Complaint'){
      $query2="SELECT datediff(AssignDate, AttendDate) as days, AssignDate FROM cyrusbackend.complaints WHERE ComplaintID=$ID";
    }
    $result2=mysqli_query($con,$query2);
    $row2 = mysqli_fetch_array($result2);
    $FComplaint=0;
    $FOrder=0;
    if ($row2["days"]<0 and $Reference=='Order') {
      $FOrder=-10*$row2["days"];
    }elseif ($row2["days"]<0 and $Reference=='Complaint') {
      $FComplaint=-10*$row2["days"];
    }

    
    ?>
    <tr>
      <td><?php echo $s; ?></td>
      <td><?php echo $VisitDate; ?></td>
      <td><?php echo $Bank; ?></td>
      <td><?php echo $Zone; ?></td>
      <td><?php echo $BranchName; ?></td>
      <td><?php echo $row["Card Number"]; ?></td>
      <td><?php echo date('d-M-Y',strtotime($row2["AssignDate"])); ?></td>
      <td><?php echo $row["ServiceDone"]; ?></td>
      <td><?php echo $row["WorkPending"]; ?></td>
      <td><?php echo $row["Remark"]; ?></td>
      <td><?php echo $FOrder; ?></td>
      <td><?php echo $FComplaint; ?></td>
    </tr>
    <?php 
    $ExVisitDate=$row["VisitDate"];
    $exBranchName=$row["BranchName"];
  }
}

$EmployeeCodePP=!empty($_POST['EmployeeCodePP'])?$_POST['EmployeeCodePP']:'';
if (!empty($EmployeeCodePP))
{

  $SDate=!empty($_POST['SDate'])?$_POST['SDate']:'';
  $EDate=!empty($_POST['EDate'])?$_POST['EDate']:'';

  $query4="SELECT sum(TotalBilledValue), `Employee Name`, TargetAmounts FROM cyrusbilling.billbook
  join cyrusbackend.employees on billbook.EmployeeCode=employees.EmployeeCode
  join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
  WHERE billbook.EmployeeCode=$EmployeeCodePP and BankCode not in (17,29,30,33,43,46,49,50,52) and Cancelled=0 and BillDate between '$SDate' and '$EDate'";
  $result4=mysqli_query($con2,$query4);
  $row = mysqli_fetch_array($result4);

  $query="SELECT count(OrderID) as PendingOrder FROM cyrusbackend.allorders WHERE EmployeeCode=$EmployeeCodePP and AssignDate is not null and AttendDate is null and Attended=0 and Discription not like '%AMC%'";
  $result=mysqli_query($con,$query);
  $row1 = mysqli_fetch_array($result);

  $query="SELECT count(OrderID) as PendingAMC FROM cyrusbackend.allorders WHERE EmployeeCode=$EmployeeCodePP and AssignDate is not null and AttendDate is null and Attended=0 and Discription like '%AMC%'";
  $result=mysqli_query($con,$query);
  $row2 = mysqli_fetch_array($result);

  $query="SELECT count(ComplaintID) as PendingComplaint FROM cyrusbackend.allcomplaint WHERE EmployeeCode=$EmployeeCodePP and AssignDate is not null and AttendDate is null and Attended=0";
  $result=mysqli_query($con,$query);
  $row3 = mysqli_fetch_array($result);

  ?>
  <tr>
    <td><?php echo $row["Employee Name"]; ?></td>
    <td><?php echo $row1["PendingOrder"]; ?></td>
    <td><?php echo $row3["PendingComplaint"]; ?></td>
    <td><?php echo $row2["PendingAMC"]; ?></td>
    <td><?php echo $row["TargetAmounts"]; ?></td>
    <td><?php echo $row["sum(TotalBilledValue)"]; ?></td>
  </tr>
  <?php 

}

?>
