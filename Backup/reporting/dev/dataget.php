<?php
include ('data.php');
date_default_timezone_set('Asia/Kolkata');
$newtimestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($newtimestamp));
$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
if (!empty($BankCode))
{
    $BankData="SELECT ZoneRegionCode,ZoneRegionName from zoneregions WHERE BankCode=$BankCode order by ZoneRegionName";
    $result = mysqli_query($conn,$BankData);
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
    $result=mysqli_query($conn,$ZoneData);
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
 $result=mysqli_query($conn2,$query);
 if (mysqli_num_rows($result)>0)
 {
    while ($arr=mysqli_fetch_assoc($result))
    {

        echo "<option value='".$arr['RateID']."'>".$arr['Description']."</option><br>";
    }
}


}


$EmployeeCode=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
if (!empty($EmployeeCode))
{
    $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeCode";
    $result=mysqli_query($conn,$query);
    if (mysqli_num_rows($result)>0)
    {
     $a=mysqli_fetch_assoc($result);
     echo '<tr>
     <th scope="col" style="min-width: 150px;">'.$a['Phone'].'</th>
     <th scope="col" style="min-width: 150px;">'.$a['EmployeeCode'].'</th>

     </tr>';

 }
}


$ZoneCodeAMC=!empty($_POST['ZoneCodeAMC'])?$_POST['ZoneCodeAMC']:'';

if (!empty($ZoneCodeAMC))
{   
    $myfile = fopen("ZoneCodeAMC.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $ZoneCodeAMC);
    fclose($myfile);
    $ZoneAMC="SELECT * from amcs WHERE ZoneRegionCode=$ZoneCodeAMC";
    $result=mysqli_query($conn,$ZoneAMC);
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


$Jobcard=!empty($_POST['Jobcard'])?$_POST['Jobcard']:'';
if (!empty($Jobcard))
{
    $QID=!empty($_POST['QID'])?$_POST['QID']:'';
    $Type=!empty($_POST['GenType'])?$_POST['GenType']:'';
    $Remark=!empty($_POST['Remark'])?$_POST['Remark']:'';

    $input = preg_replace("/[^a-zA-Z0-9]+/", "", $Jobcard);
    $Jobcard=strtoupper($input);
    $sqlx = "SELECT * from `jobcardmain` where `Card Number` = '$Jobcard'";  
    $resultx = mysqli_query($conn, $sqlx);  
    if (mysqli_num_rows($resultx)>0)
    {
       echo 'Jobcard alredy exist';

   }else{

      if ($Type=='Order') {

        $query = "SELECT * FROM cyrusbackend.orders WHERE OrderID=$QID";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result); 

        if (!empty($row["Executive Remark"])) {

          $exRemark=$row["Executive Remark"];

          $Remark=$_SESSION['user'].' - '.$DateR.' - '.$Remark.' '.$exRemark;
      }
   // echo $Remark;

      $BranchCode=$row["BranchCode"];
      $GadgetID=$row["GadgetID"];
      $EmployeeCode=$row["EmployeeCode"];


      $sql = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `Remark`, `GadgetID`, `EmployeeCode`, ServiceDone, WorkPending) VALUES('$Jobcard', '$BranchCode', '$Date', 'Not Ok', '$GadgetID', '$EmployeeCode', 'Closed', 'Closed')";

      $sql2 = "INSERT INTO `reference table`( `Reference`, `Card Number`, `EmployeeCode`, `VisitDate`, `User`, `BranchCode`,  `ID`) VALUES ('$Type','$Jobcard','$EmployeeCode', '$Date', '$user', '$BranchCode', '$QID')";

      if ($conn->query($sql2) === TRUE) {
        echo 1;
    }else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;

  }

  if ($conn->query($sql) === TRUE) {

      $query1 = "SELECT * FROM cyrusbackend.demandbase WHERE OrderID=$QID";
      $result1 = mysqli_query($conn, $query1);
      if(mysqli_num_rows($result1)>0)
      {
        $row1 = mysqli_fetch_array($result1);

        if ($row1["StatusID"]<4) {
          $query1 = "DELETE FROM cyrusbackend.demandextended WHERE OrderID=$QID";
          $result1 = mysqli_query($conn, $query1);

          $query1 = "UPDATE cyrusbackend.demandbase SET StatusID=6 WHERE OrderID=$QID";
          $result1 = mysqli_query($conn, $query1);

      }
  }
  $sql = "UPDATE orders SET `Executive Remark`='$Remark', AttendDate='$Date', Attended=1 WHERE OrderID=$QID";

  if ($conn->query($sql) === TRUE) {
        //echo '<meta http-equiv="refresh" content="0">';
  }else {
    echo "Error: " . $sql . "<br>" . $conn->error;

}

}else {
  echo "Error: " . $sql . "<br>" . $conn->error;

}
}elseif ($Type=='Complaint'){

    $sql ="SELECT * FROM complaints WHERE ComplaintID=$QID";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result); 
    if (!empty($row["Executive Remark"])) {

      $exRemark=$row["Executive Remark"];

      $Remark=$_SESSION['user'].' - '.$DateR.' - '.$Remark.' '.$exRemark;
  }

  $BranchCode=$row["BranchCode"];
  $GadgetID=$row["GadgetID"];
  $EmployeeCode=$row["EmployeeCode"];
  $sql = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `Remark`, `GadgetID`, `EmployeeCode`, ServiceDone, WorkPending) VALUES('$Jobcard', '$BranchCode', '$Date', 'Not Ok', '$GadgetID', '$EmployeeCode', 'Closed', 'Closed')";

  $sql2 = "INSERT INTO `reference table`( `Reference`, `Card Number`, `EmployeeCode`, `VisitDate`, `User`, `BranchCode`,  `ID`) VALUES ('$Type','$Jobcard','$EmployeeCode', '$Date', '$user', '$BranchCode', '$QID')";

  if ($conn->query($sql2) === TRUE) {

  }else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;

  }

  if ($conn->query($sql) === TRUE) {

      $sql = "UPDATE complaints SET `Executive Remark`='$Remark', AttendDate='$Date', Attended=1 WHERE ComplaintID=$QID";
      if ($conn->query($sql) === TRUE) {
        echo 1;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }
}else {
  echo "Error: " . $sql . "<br>" . $conn->error;

}


}


}
}

$EmployeeCodeC=!empty($_POST['EmployeeCodeC'])?$_POST['EmployeeCodeC']:'';
if (!empty($EmployeeCodeC))
{

    $APID=$_POST['APID'];

    $sql = "UPDATE cyrusbackend.approval SET EmployeeID=$EmployeeCodeC WHERE ApprovalID=$APID";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }

}


?>