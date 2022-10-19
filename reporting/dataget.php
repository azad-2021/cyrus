<?php
include ('data.php');
include "session.php";
$user=$_SESSION['user'];
$EXEID=$_SESSION['userid'];
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

   $query="SELECT * FROM rates WHERE Zone=$ItemZone and ItemID!=1654 and Enable=1";
   $result=mysqli_query($conn2,$query);
   echo "<option value=''>Select Material</option>";
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



$ServiceDone=!empty($_POST['ServiceDone'])?$_POST['ServiceDone']:'';
if (!empty($ServiceDone)){

    $Jobcard=!empty($_POST['Jobcard'])?$_POST['Jobcard']:'';

    $sql = "UPDATE cyrusbackend.jobcardmain SET `ServiceDone`='$ServiceDone' WHERE `Card Number`='$Jobcard'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }

}


$PendingWork=!empty($_POST['PendingWork'])?$_POST['PendingWork']:'';
if (!empty($PendingWork)){

    $Jobcard=!empty($_POST['Jobcard'])?$_POST['Jobcard']:'';

    $sql = "UPDATE cyrusbackend.jobcardmain SET `WorkPending`='$PendingWork' WHERE `Card Number`='$Jobcard'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }

}



$ChangeGadget=!empty($_POST['ChangeGadget'])?$_POST['ChangeGadget']:'';
if (!empty($ChangeGadget)){

    $Jobcard=!empty($_POST['Jobcard'])?$_POST['Jobcard']:'';

    $sql = "UPDATE cyrusbackend.jobcardmain SET `GadgetID`=$ChangeGadget WHERE `Card Number`='$Jobcard'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $myfile = fopen("errgadget.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $conn->error);
        fclose($myfile);


    }

    $sql = "UPDATE cyrusbackend.approval SET `GadgetID`=$ChangeGadget WHERE `JobCardNo`='$Jobcard'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }


}




$BranchCodeJ=!empty($_POST['BranchCodeJ'])?$_POST['BranchCodeJ']:'';
if (!empty($BranchCodeJ))
{

    $VisitDate=!empty($_POST['VisitDate'])?$_POST['VisitDate']:'';
    $EmployeeCodeJ=!empty($_POST['EmployeeCodeJ'])?$_POST['EmployeeCodeJ']:'';
    $Reference=!empty($_POST['Reference'])?$_POST['Reference']:'';

    if ($Reference=='Order') {
        $query="SELECT orders.OrderID as ID from cyrusbackend.orders
        WHERE AttendDate='$VisitDate' and EmployeeCode=$EmployeeCodeJ and BranchCode=$BranchCodeJ";
    }else{
        $query="SELECT complaints.ComplaintID as ID from cyrusbackend.complaints
        WHERE AttendDate='$VisitDate' and EmployeeCode=$EmployeeCodeJ and BranchCode=$BranchCodeJ";
    }

    $result=mysqli_query($conn,$query);
    echo "<option value=''>select</option><br>";
    if (mysqli_num_rows($result)>0)
    {    
        while ($arr=mysqli_fetch_assoc($result))
        {

            echo "<option value='".$arr['ID']."'>".$arr['ID']."</option><br>";
        }
    }


}



$ChangeEmployee=!empty($_POST['ChangeEmployee'])?$_POST['ChangeEmployee']:'';
if (!empty($ChangeEmployee)){

    $Jobcard=!empty($_POST['Jobcard'])?$_POST['Jobcard']:'';

    $sql = "UPDATE cyrusbackend.approval SET `EmployeeID`=$ChangeEmployee WHERE `JobCardNo`='$Jobcard'";
    if ($conn->query($sql) === TRUE) {
        echo 1;
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }


}


$EstimateRateID=!empty($_POST['EstimateRateID'])?$_POST['EstimateRateID']:'';

if (!empty($EstimateRateID))
{   
    $EstBranch=!empty($_POST['EstBranch'])?$_POST['EstBranch']:'';
    $EstQty=!empty($_POST['EstQty'])?$_POST['EstQty']:'';
    $query="SELECT * FROM cyrusbilling.add_estimate WHERE peRateID=$EstimateRateID and BranchCode=$EstBranch";
    $result=mysqli_query($conn2,$query);
    if (mysqli_num_rows($result)>0)
    {
        echo 'Material alredy exist';
    }else{

        $sql = "INSERT INTO cyrusbilling.add_estimate (peRateID, ExecutiveID, BranchCode, peqty) VALUES ($EstimateRateID, $EXEID, $EstBranch, $EstQty)";


        if ($conn2->query($sql) === TRUE) {
            echo 1;
        }else {
            echo "Error: " . $sql . "<br>" . $conn2->error;

        }



    }

}


$BranchEst=!empty($_POST['BranchEst'])?$_POST['BranchEst']:'';

if (!empty($BranchEst))
{   
    $query="SELECT RateID, Description, Rate, peqty, Rate*peqty as Amount FROM cyrusbilling.add_estimate
    inner join rates on add_estimate.peRateID=rates.RateID WHERE BranchCode=$BranchEst";
    $result=mysqli_query($conn2,$query);
    if (mysqli_num_rows($result)>0)
    {

        $sr=0;
        while ($row=mysqli_fetch_assoc($result))
            {   $sr++;
                print "<tr>";
                print '<td style="min-width: 150px;">'.$sr."</td>";
                print '<td style="min-width: 150px;">'.$row["Description"]."</td>";
                print '<td style="min-width: 150px;">'.$row["Rate"]."</td>";
                print '<td style="min-width: 150px;">'.$row["peqty"]."</td>";
                print '<td style="min-width: 150px;">'.$row["Amount"]."</td>";
                print '<td style="min-width: 150px;"><button class="btn btn-danger DelEst" id="'.$row["RateID"].'">Delete</button></td>';
                print '</tr>';
            }


        }
    }


    $DelEst=!empty($_POST['DelEst'])?$_POST['DelEst']:'';

    if (!empty($DelEst))
    {   
        $BranchCodeDel=!empty($_POST['BranchCodeDel'])?$_POST['BranchCodeDel']:'';
        $sql = "DELETE FROM cyrusbilling.add_estimate WHERE peRateID=$DelEst and BranchCode=$BranchCodeDel";


        if ($conn2->query($sql) === TRUE) {
            echo 1;
        }else {
            echo "Error: " . $sql . "<br>" . $conn2->error;

        }



        

    }


    $GenEstimate=!empty($_POST['GenEstimate'])?$_POST['GenEstimate']:'';
    if (!empty($GenEstimate))
    {

        $sql = "INSERT INTO cyrusbackend.approval (BranchCode, VisitDate, VDate, Vby, posted) VALUES ($GenEstimate, '$Date', '$Date', '$user', 1)";


        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;

        }

        if (isset($last_id)) {

            $query="SELECT * FROM cyrusbilling.add_estimate
            join rates on add_estimate.peRateID=rates.RateID
            WHERE BranchCode=$GenEstimate and ExecutiveID=$EXEID";
            $result=mysqli_query($conn2,$query);
            if (mysqli_num_rows($result)>0)
            {

                while ($row=mysqli_fetch_assoc($result))
                {

                    $RateID=$row["RateID"];
                    $Qty=$row["peqty"];
                    $Rate=$row["Rate"];

                    $sql = "INSERT INTO cyrusbilling.estimates (ApprovalID, RateID, Qty, ExecutiveID, Rates) VALUES ($last_id, $RateID, $Qty, $EXEID, $Rate)";


                    if ($conn2->query($sql) === TRUE) {

                    }else {
                        echo "Error: " . $sql . "<br>" . $conn2->error;

                    }


                }


                $sql = "DELETE FROM cyrusbilling.add_estimate WHERE BranchCode=$GenEstimate and ExecutiveID=$EXEID";


                if ($conn2->query($sql) === TRUE) {
   
                }else {
                    echo "Error: " . $sql . "<br>" . $conn2->error;

                }



                echo $last_id;

            }

        }

    }


?>