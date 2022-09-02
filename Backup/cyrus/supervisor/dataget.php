<?php 
include 'connection.php';

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

?>

