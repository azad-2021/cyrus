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
      echo "Error: " . $sql . "<br>" . $con2->error;
  }
}

$Bank1=!empty($_POST['Bank1'])?$_POST['Bank1']:'';
if (!empty($Bank1))
{
    $ini=!empty($_POST['ini'])?$_POST['ini']:'';

    $Data="SELECT * from cyrusbackend.bank WHERE BankName='$Bank1'";
    $result=mysqli_query($con,$Data);
    if (mysqli_num_rows($result)>0)
    {
        echo $Bank1.' already exist';
        $err=1;
    }else{
        $sql = "INSERT INTO  cyrusbackend.bank (BankName, BankInitial)
        VALUES ('$Bank1', '$ini')";

        if ($con->query($sql) === TRUE) {
          echo 1;
      } else {
          echo "Error: " . $sql . "<br>" . $con->error;
      }
  }
}

$Bank2=!empty($_POST['BankCodeZ'])?$_POST['BankCodeZ']:'';
if (!empty($Bank2))
{
    $Zone=!empty($_POST['Zone'])?$_POST['Zone']:'';

    $err=0;

    $Data="SELECT * from zoneregions WHERE ZoneRegionName='$Zone' and BankCode=$Bank2";
    $result=mysqli_query($con,$Data);
    if (mysqli_num_rows($result)>0)
    {
        echo $Zone.' already exist';
        $err=1;
    }

    if ($err==0) {

        $sql = "INSERT INTO  cyrusbackend.zoneregions (BankCode, ZoneRegionName)
        VALUES ($Bank2, '$Zone')";

        if ($con->query($sql) === TRUE) {
          echo 1;
      } else {
          echo "Error: " . $sql . "<br>" . $con->error;
      }
  }
}       

$BranchName=!empty($_POST['BranchName'])?$_POST['BranchName']:'';
if (!empty($BranchName))
{
    $DistrictName=!empty($_POST['DistrictName'])?$_POST['DistrictName']:'';
    $ZoneCodeB=!empty($_POST['ZoneCodeB'])?$_POST['ZoneCodeB']:'';
    $err=0;
    for ($i=0; $i < count($BranchName); $i++) { 

        $Data="SELECT * from branchs WHERE BranchName='$BranchName[$i]' and ZoneRegionCode=$ZoneCodeB";
        $result=mysqli_query($con,$Data);
        if (mysqli_num_rows($result)>0)
        {
            echo $BranchName[$i].' already exist';
            $err=1;
            break;
        }
    }

    if ($err==0) {

        for ($i=0; $i < count($BranchName); $i++) { 
        //echo $BranchName[$i].' . '.$DistrictName[$i].'<br>';

            $sql = "INSERT INTO  cyrusbackend.branchs (ZoneRegionCode, BranchName, Address3)
            VALUES ($ZoneCodeB ,'$BranchName[$i]', '$DistrictName[$i]')";

            if ($con->query($sql) === TRUE) {
              
          } else {
          //echo "Error: " . $sql . "<br>" . $con->error;
          }


      }
      echo 1;

  }
}

$ZoneCodeData=!empty($_POST['ZoneCodeData'])?$_POST['ZoneCodeData']:'';

if (!empty($ZoneCodeData))
{   
    $BankData=!empty($_POST['BankData'])?$_POST['BankData']:'';
    $Zone="SELECT * from branchs WHERE ZoneRegionCode=$ZoneCodeData order by BranchName";
    $result=mysqli_query($con,$Zone);
    if (mysqli_num_rows($result)>0)
    {
        $sr=0;
        while ($row=mysqli_fetch_assoc($result))
        {   
            $sr++;
            print "<tr>";
            print '<td style="min-width: 150px;">'.$sr."</td>";
            print '<td style="min-width: 150px;">'.$row["BranchName"]."</td>";
            print '<td style="min-width: 150px;">'.$row["Address3"]."</td>";

            print '<td style="min-width: 150px;">'?>
            <select class="form-control rounded-corner" id="ZoneU" id2="<?php echo $row["BranchCode"] ?>">
               <option value="">Select</option>        
               <?php
               $query="SELECT * FROM zoneregions Where BankCode=$BankData order by ZoneRegionName"; 
               $resultZone=mysqli_query($con,$query);
               while($data=mysqli_fetch_assoc($resultZone)){
                echo "<option value=".$data["ZoneRegionCode"].">".$data['ZoneRegionName']."</option>";
            }
            ?>
        </select>
        <?php "</td>";

        print '<td style="min-width: 150px;">'?>
        <select class="form-control rounded-corner" id="DistrictU" id2="<?php echo $row["BranchCode"] ?>">
           <option value="">Select</option>        
           <?php
           $query="SELECT * FROM districts order by District"; 
           $resultsDistrict=mysqli_query($con,$query);
           while($data=mysqli_fetch_assoc($resultsDistrict)){
            echo "<option value=".$data["District"].">".$data['District']."</option>";
        }
        ?>
    </select>
    <?php "</td>";
    print '</tr>';
}

}
}


$DistrictU=!empty($_POST['DistrictU'])?$_POST['DistrictU']:'';
if (!empty($DistrictU))
{
    $BranchCodeU=!empty($_POST['BranchCodeU'])?$_POST['BranchCodeU']:'';

    $sql = "UPDATE branchs SET Address3='$DistrictU' WHERE BranchCode=$BranchCodeU";

    if ($con->query($sql) === TRUE) {
      echo 1;
  } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
} 

$ZoneCodeU=!empty($_POST['ZoneCodeU'])?$_POST['ZoneCodeU']:'';
if (!empty($ZoneCodeU))
{
    $BranchCodeU=!empty($_POST['BranchCodeU'])?$_POST['BranchCodeU']:'';

    $sql = "UPDATE branchs SET ZoneRegionCode=$ZoneCodeU WHERE BranchCode=$BranchCodeU";

    if ($con->query($sql) === TRUE) {
      echo 1;
  } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
} 

$BillIDAction=!empty($_POST['BillIDAction'])?$_POST['BillIDAction']:'';
if (!empty($BillIDAction))
{
    $ActionTaken=!empty($_POST['ActionTaken'])?$_POST['ActionTaken']:'';
    $Resolved=!empty($_POST['Resolved'])?$_POST['Resolved']:'';


    $Data="SELECT ID from reminders WHERE BillID=$BillIDAction and ActionRequired=1 and Action is null";
    $result=mysqli_query($con2,$Data);
    $data=mysqli_fetch_assoc($result);
    $ID=$data["ID"];

    $sql = "UPDATE reminders SET Action='$ActionTaken', Resolved=$Resolved WHERE ID=$ID";

    if ($con2->query($sql) === TRUE) {
      echo 1;
  } else {
    $myfile = fopen("actionerr.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $con->error);
    fclose($myfile);
    echo "Error: " . $sql . "<br>" . $con->error;
}
} 
$con->close();
$con2->close();


