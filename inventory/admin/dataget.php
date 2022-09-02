<?php 
include 'connection.php';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;

if (!empty($Data)){

 $obj = json_decode($Data);
 $OrderID=$obj->OrderID;
 $ZoneCode=$obj->ZoneCode;

 $query="SELECT * FROM rates WHERE Zone=$ZoneCode";
 $result=mysqli_query($con2,$query);
 if (mysqli_num_rows($result)>0)
 {
   echo '<option value="">Select</option><br>';
   while ($arr=mysqli_fetch_assoc($result))
   {

    echo "<option value='".$arr['ItemID']."'>".$arr['Description']."</option><br>";
  }
}
}


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
$ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';
if (!empty($ZoneCode))
{
  //echo $ZoneCode;
  $Sr=1;
  $Quarter=!empty($_POST['Quarter'])?$_POST['Quarter']:'';

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

        $StartDate=$row['StartDate'];
        $EndDate=$row['EndDate'];
        $GadgetID=$row['GadgetID'];
      //echo $StartDate.'<br>';
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
        }


        $BranchCode=$row2['BranchCode'];
        $Bank=$row2['BankName'];
        $Zone=$row2['ZoneRegionName'];
        $Branch=$row2['BranchName'];
        $query="SELECT `Job_Card_No`, Remark, VisitDate as LastVisit FROM cyrusbackend.jobcardmain
        WHERE VisitDate between '$S'  and '$E' and GadgetID=$GadgetID and BranchCode=$BranchCode and `Card Number` like '%AMC%'";

        $result3=mysqli_query($con,$query);
        if (mysqli_num_rows($result3)>0)
        {       
          $result4=$result3;
        }else{
          $query="SELECT max(VisitDate) as LastVisit FROM cyrusbackend.jobcardmain
          WHERE VisitDate between '$S'  and '$E' and GadgetID=$GadgetID and BranchCode=$BranchCode";

          $result4=mysqli_query($con,$query);
        }
        while ($row3=mysqli_fetch_assoc($result4))
        {
          $Gadget=$row['Gadget'];
          if (!empty($row3['LastVisit'])) {

            $visit=$row3['LastVisit'];
            $query="SELECT `Card Number`, Remark FROM cyrusbackend.jobcardmain
            WHERE VisitDate ='$visit' and GadgetID=$GadgetID and BranchCode=$BranchCode";
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
            <td><?php echo date('d-M-Y',strtotime($S)); ?></td>
            <td><?php echo date('d-M-Y',strtotime($E)); ?></td>
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

?>

