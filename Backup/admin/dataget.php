<?php
include ('connection.php');
include ('session.php');
$userid=$_SESSION['userid'];
//ECHO $userid;
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


$ItemZone=!empty($_POST['ItemZone'])?$_POST['ItemZone']:'';
if (!empty($ItemZone))
{

   $query="SELECT * FROM rates WHERE Zone=$ItemZone";
   $result=mysqli_query($con2,$query);
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
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {
       $a=mysqli_fetch_assoc($result);
       echo '<tr>
       <th scope="col" style="min-width: 150px;">'.$a['Phone'].'</th>
       <th scope="col" style="min-width: 150px;">'.$a['EmployeeCode'].'</th>

       </tr>';

   }
}

$View=!empty($_POST['view'])?$_POST['view']:'';
if (!empty($View))
{
    $query="SELECT * FROM employees WHERE Inservice=1 order by `Employee Name`";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {

        while($a=mysqli_fetch_assoc($result)){
            $EmployeeID=$a['EmployeeCode'];
            $query="SELECT * FROM reporting
            join pass on reporting.ExecutiveID=pass.ID WHERE EmployeeID=$EmployeeID";
            $result2=mysqli_query($con,$query);
            if (mysqli_num_rows($result2)>0)
            {   
                $row=mysqli_fetch_assoc($result2);
                $AssignTo=$row['UserName'];
            }else{
                $AssignTo='';
            }

            $query="SELECT count(District)  FROM cyrusbackend.districts WHERE `Assign To`=$EmployeeID";
            $result2=mysqli_query($con,$query);
            if (mysqli_num_rows($result2)>0)
            {   
                $row=mysqli_fetch_assoc($result2);
                $DistrictCount=$row['count(District)'];
            }

            $query="SELECT * FROM dataentry
            join pass on dataentry.ExecutiveID=pass.ID WHERE EmployeeCode=$EmployeeID";
            $result2=mysqli_query($con,$query);
            if (mysqli_num_rows($result2)>0)
            {   
                $row=mysqli_fetch_assoc($result2);
                $DataEntry=$row['UserName'];
            }else{
                $DataEntry='';
            }

            if ($a['Inservice']==1) {
                $tr='<tr class="table-success">';
                
            }else{
                $tr='<tr class="table-danger">';
                
            }

            echo $tr.'
            <td scope="col" style="min-width: 150px;">'.$a['Employee Name'].'</td>
            <td scope="col" style="min-width: 150px;">'.$a['Phone'].'</td>
            <td scope="col" style="min-width: 150px;">'.$a['TargetAmounts'].'</td>
            <td scope="col" style="min-width: 150px;">'.$AssignTo.'</td>';
            $query="SELECT * FROM pass WHERE UserName is not null and UserType='Reporting' Order by UserName";
            $result3=mysqli_query($con,$query);
            ?>
            <td scope="col" style="min-width: 150px;">
                <select class="form-control rounded-corner" id="ChangeReporting" id2="<?php echo $EmployeeID ?>">
                    <option value="">Select</option>
                    <?php 
                    while($row=mysqli_fetch_assoc($result3)){
                        echo "<option value='".$row['ID']."'>".$row['UserName']."</option><br>";
                    }
                    ?>
                </select>
            </td>
            <?php 

            echo '
            <td scope="col" style="min-width: 150px;">'.$DataEntry.'</td>';
            $query="SELECT * FROM pass WHERE UserName is not null and UserType='Dataentry' Order by UserName";
            $result3=mysqli_query($con,$query);
            ?>
            <td scope="col" style="min-width: 150px;">
                <select class="form-control rounded-corner" id="ChangeDataentry" id2="<?php echo $EmployeeID ?>">
                    <option value="">Select</option>
                    <?php 
                    while($row=mysqli_fetch_assoc($result3)){
                        echo "<option value='".$row['ID']."'>".$row['UserName']."</option><br>";
                    }
                    ?>
                </select>
            </td>
            <?php 
            echo '
            <td scope="col" style="min-width: 150px;">'.$DistrictCount.'</td>'
            ?>
            <td scope="col" style="min-width: 150px;">
                <select class="form-control rounded-corner" id="Inservice" id2="<?php echo $EmployeeID ?>">
                    <option value="">Select</option>
                    <option value="1">Active</option>
                    <option value="2">Deactive</option>
                </select>
            </td>
            <td scope="col" style="min-width: 150px;">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item UEmployee" id="<?php echo 'id="'.$EmployeeID.'" id2="'.$a['Employee Name'].'" id3="'.$a['Qualification'].'" id4="'.$a['Address3'].'" id5="'.$a['Phone'].'" id6="'.$a['TargetAmounts'].'"' ?>">
                            Edit Details</a>
                        </li>
                        <li>
                            <a class="dropdown-item ResetPass" id="<?php echo $EmployeeID ?>">
                            Reset Password</a>
                        </li>
                        <li>
                            <a class="dropdown-item Resetdataentry" id="<?php echo $EmployeeID ?>">
                                Reset Jobcard Entry
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php        

    }
}
}

$viewDataEntry=!empty($_POST['viewDataEntry'])?$_POST['viewDataEntry']:'';
if (!empty($viewDataEntry))
{
    $query="SELECT * FROM employees WHERE Inservice=1 order by `Employee Name`";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {
        $Sr=1;
        
        while($a=mysqli_fetch_assoc($result)){
            $EmployeeID=$a['EmployeeCode'];
            $query="SELECT * FROM dataentry
            join pass on dataentry.ExecutiveID=pass.ID WHERE EmployeeCode=$EmployeeID";
            $result2=mysqli_query($con,$query);
            if (mysqli_num_rows($result2)>0)
            {   
                $row=mysqli_fetch_assoc($result2);
                $AssignTo=$row['UserName'];
            }else{
                $AssignTo='';
            }
            echo '<tr>
            <td scope="col" style="min-width: 50px;">'.$Sr.'</th>
            <td scope="col" style="min-width: 150px;">'.$a['Employee Name'].'</td>
            <td scope="col" style="min-width: 150px;">'.$AssignTo.'</td>';
            $query="SELECT * FROM pass WHERE UserName is not null and UserType='Dataentry' Order by UserName";
            $result3=mysqli_query($con,$query);
            ?>
            <th scope="col" style="min-width: 150px;">
                <select class="form-control rounded-corner" id="ChangeDataentry" id2="<?php echo $EmployeeID ?>">
                    <option value="">Select</option>
                    <?php 
                    while($row=mysqli_fetch_assoc($result3)){
                        echo "<option value='".$row['ID']."'>".$row['UserName']."</option><br>";
                    }
                    ?>
                </select>
            </th>
            <?php 
            echo '<td scope="col" style="min-width: 150px;"><button class="btn btn-primary Resetdataentry" id="'.$EmployeeID.'">Reset Assigning</button></td>
            </tr>';
            $Sr++;

        }
    }
}


$NewUser=!empty($_POST['NewUser'])?$_POST['NewUser']:'';
if (!empty($NewUser)){
    $UserType=!empty($_POST['UserType'])?$_POST['UserType']:'';
    $sql = "INSERT INTO pass (UserName, Password, UserType)
    VALUES ('$NewUser', 'cyrus@123', '$UserType')";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$NewEmployeeName=!empty($_POST['NewEmployeeName'])?$_POST['NewEmployeeName']:'';
if (!empty($NewEmployeeName)){
    $EmployeeQulaification=!empty($_POST['EmployeeQulaification'])?$_POST['EmployeeQulaification']:'';
    $EmployeeDistrict=!empty($_POST['EmployeeDistrict'])?$_POST['EmployeeDistrict']:'';
    $EmployeeMobile=!empty($_POST['EmployeeMobile'])?$_POST['EmployeeMobile']:'';

    $sql = "INSERT INTO employees (`Employee Name`, Qualification, Address3, Phone, Inservice, UserPassword)
    VALUES ('$NewEmployeeName', '$EmployeeQulaification', '$EmployeeDistrict', '$EmployeeMobile', 1, 'cyrus@123')";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;

      $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
  }
}


$EmployeeNameU=!empty($_POST['EmployeeNameU'])?$_POST['EmployeeNameU']:'';
if (!empty($EmployeeNameU)){
    $EmployeeCodeU=!empty($_POST['EmployeeCodeU'])?$_POST['EmployeeCodeU']:'';
    $EmployeeQulaification=!empty($_POST['EmployeeQulaificationU'])?$_POST['EmployeeQulaificationU']:'';
    $EmployeeDistrict=!empty($_POST['EmployeeDistrictU'])?$_POST['EmployeeDistrictU']:'';
    $EmployeeMobile=!empty($_POST['EmployeeMobileU'])?$_POST['EmployeeMobileU']:'';
    $Target=!empty($_POST['EmployeeTargetU'])?$_POST['EmployeeTargetU']:'';

    $sql = "UPDATE employees SET `Employee Name`='$EmployeeNameU', Qualification='$EmployeeQulaification', Address3='$EmployeeDistrict', Phone='$EmployeeMobile', TargetAmounts=$Target WHERE EmployeeCode=$EmployeeCodeU";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;

      $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
  }
}


$NewReporting=!empty($_POST['NewReporting'])?$_POST['NewReporting']:'';
if (!empty($NewReporting))
{
    $EmployeeCodeC=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
    $sql = "UPDATE reporting SET ExecutiveID=$NewReporting WHERE EmployeeID=$EmployeeCodeC";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$NewDataentry=!empty($_POST['NewDataentry'])?$_POST['NewDataentry']:'';
if (!empty($NewDataentry))
{
    $EmployeeCodeD=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';

    $query="SELECT * FROM dataentry WHERE EmployeeCode=$EmployeeCodeD";
    $result2=mysqli_query($con,$query);
    if (mysqli_num_rows($result2)>0)
    {  

        $sql = "UPDATE dataentry SET ExecutiveID=$NewDataentry WHERE EmployeeCode=$EmployeeCodeD";
    }else{


        $sql = "INSERT INTO dataentry (ExecutiveID, EmployeeCode)
        VALUES ($NewDataentry, $EmployeeCodeD)";

    }

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;

      $myfile = fopen("newfile2.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
  }
}



$ResetdataentryID=!empty($_POST['Resetdataentry'])?$_POST['Resetdataentry']:'';
if (!empty($ResetdataentryID))
{
    $sql = "UPDATE dataentry SET ExecutiveID= 0 WHERE EmployeeCode=$ResetdataentryID";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$ResetPassID=!empty($_POST['ResetPass'])?$_POST['ResetPass']:'';
if (!empty($ResetPassID))
{
    $sql = "UPDATE employees SET UserPassword= 'cyrus@123' WHERE EmployeeCode=$ResetPassID";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$RegionCode=!empty($_POST['RegionCode'])?$_POST['RegionCode']:'';
if (!empty($RegionCode))
{
    $query="SELECT DistrictID, District, districts.SubControllerID, UserName FROM cyrusbackend.districts join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode 
    join pass on `cyrus regions`.ControlerID=pass.ID
    where districts.RegionCode=$RegionCode Order By District";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {
        $Sr=1;
        
        while($a=mysqli_fetch_assoc($result)){

            $SubControllerID=$a['SubControllerID'];

            if ($SubControllerID>0) {

                $query="SELECT * FROM cyrusbackend.pass WHERE ID=$SubControllerID";
                $result2=mysqli_query($con,$query);

                $row=mysqli_fetch_assoc($result2);
                $Supervisor=$row['UserName'];
            }else{
                $Supervisor='N/A';
            }


            echo '<tr>
            <td scope="col" style="min-width: 50px;">'.$Sr.'</th>
            <td scope="col" style="min-width: 150px;">'.$a['District'].'</td>
            <td scope="col" style="min-width: 150px;">'.$a['UserName'].'</td>
            <td scope="col" style="min-width: 150px;">'.$Supervisor.'</td>';
            ?>

            <th scope="col" style="min-width: 150px;">
                <select class="form-control rounded-corner" id="Supervisor" id2="<?php echo $a['DistrictID'] ?>">
                    <option value="">Select</option>
                    <?php 
                    $query="SELECT * FROM pass WHERE UserName is not null and UserType='Supervisor' Order by UserName";
                    $result3=mysqli_query($con,$query);

                    while($row=mysqli_fetch_assoc($result3)){
                        echo "<option value='".$row['ID']."'>".$row['UserName']."</option><br>";
                    }
                    ?>
                </select>
            </th>
            <?php 
            echo '</tr>';
            $Sr++;

        }
    }
}

$SupervisorID=!empty($_POST['SupervisorID'])?$_POST['SupervisorID']:'';
if (!empty($SupervisorID))
{
    $DistrictID=!empty($_POST['DistrictID'])?$_POST['DistrictID']:'';
    $sql = "UPDATE districts SET SubControllerID=$SupervisorID WHERE DistrictID=$DistrictID";
    $SupervisorID=!empty($_POST['SupervisorID'])?$_POST['SupervisorID']:'';
    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}

/*
$ExecutiveID=!empty($_POST['ExecutiveID'])?$_POST['ExecutiveID']:'';
if (!empty($ExecutiveID))
{

    $sql = "UPDATE districts SET SubControllerID=$SupervisorID ";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}*/

$Inservice=!empty($_POST['Inservice'])?$_POST['Inservice']:'';
if (!empty($Inservice))
{
    if ($Inservice==2) {
        $Inservice=0;
    }

    $EmployeeCodeC=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
    $sql = "UPDATE employees SET Inservice=$Inservice WHERE EmployeeCode=$EmployeeCodeC";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$viewExecutive=!empty($_POST['viewExecutive'])?$_POST['viewExecutive']:'';
if (!empty($viewExecutive))
{
    $query="SELECT * FROM pass WHERE UserName is not null order by `UserName`";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {
        
        while($a=mysqli_fetch_assoc($result)){
            $ExecutiveID=$a['ID'];

            if ($a['UserType']=='Reporting') {
             $query="SELECT count(EmployeeID) as TotalEmployee FROM reporting WHERE ExecutiveID=$ExecutiveID";
         }elseif($a['UserType']=='Executive'){

            $query="SELECT count(`Assign To`) as TotalEmployee FROM districts
            join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode WHERE ControlerID=$ExecutiveID";
        }else{
            $query="SELECT count(EmployeeCode) as TotalEmployee FROM dataentry WHERE ExecutiveID=$ExecutiveID";
        }
        $result2=mysqli_query($con,$query);
        if (mysqli_num_rows($result2)>0)
        {   
            $row=mysqli_fetch_assoc($result2);
            $SRE=$row['TotalEmployee'];
        }

        $query="SELECT count(DistrictID) FROM districts
        join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode WHERE ControlerID=$ExecutiveID";
        $result2=mysqli_query($con,$query);
        if (mysqli_num_rows($result2)>0)
        {   
            $row=mysqli_fetch_assoc($result2);
            $CDistrict=$row['count(DistrictID)'];
            $Regions='';
            $query="SELECT RegionName FROM `cyrus regions` WHERE ControlerID=$ExecutiveID";
            $result2=mysqli_query($con,$query);
            while($row=mysqli_fetch_assoc($result2)){
                $Regions.=$row['RegionName'].' &nbsp;&nbsp';
            }
        }

        echo '<tr>
        <td scope="col" style="min-width: 160px;">'.$a['UserName'].'</td>
        <td scope="col" style="min-width: 180px;">'.$SRE.'</td>
        <td scope="col" style="min-width: 100px;">'.$CDistrict.'</td>
        <td scope="col" style="min-width: 110px;">'.$Regions.'</td>
        <td scope="col" style="min-width: 120px;">'.$a['UserType'].'</td>
        <td scope="col" style="min-width: 150px;"><button class="btn btn-primary ResetExecutivePass" id="'.$ExecutiveID.'">Reset Password</button></td>
        </tr>';

    }
}
}

//<td scope="col" style="min-width: 150px;"><button class="btn btn-primary ExecutiveU" id="'.$ExecutiveID.'">See Detail</button></td>

$ResetExecutivePassID=!empty($_POST['ResetExecutivePass'])?$_POST['ResetExecutivePass']:'';
if (!empty($ResetExecutivePassID))
{
    $sql = "UPDATE pass SET Password= 'cyrus@123' WHERE ID=$ResetExecutivePassID";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}

$CRegionExecutive=!empty($_POST['CRegionExecutive'])?$_POST['CRegionExecutive']:'';
if (!empty($CRegionExecutive))
{
    $CRegion=!empty($_POST['RegionCodeC'])?$_POST['RegionCodeC']:'';
    $sql = "UPDATE `cyrus regions` SET ControlerID= $CRegionExecutive WHERE RegionCode=$CRegion";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
  }
}


$BankReminders=!empty($_POST['BankReminders'])?$_POST['BankReminders']:'';
if (!empty($BankReminders))
{
    $query="SELECT * FROM bank join zoneregions on bank.BankCode=zoneregions.BankCode order by `BankName`";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    {
        $Sr=1;
        
        while($a=mysqli_fetch_assoc($result)){
            $ZoneCode=$a['ZoneRegionCode'];
            $query="SELECT * FROM `reminder bank`
            join pass on `reminder bank`.ExecutiveID=pass.ID WHERE ZoneRegionCode=$ZoneCode";
            $result2=mysqli_query($con,$query);
            if (mysqli_num_rows($result2)>0)
            {   
                $row=mysqli_fetch_assoc($result2);
                $AssignTo=$row['UserName'];
            }else{
                $AssignTo='';
            }
            echo '<tr>
            <td scope="col" style="min-width: 50px;">'.$Sr.'</th>
            <td scope="col" style="min-width: 150px;">'.$a['BankName'].'</td>
            <td scope="col" style="min-width: 150px;">'.$a['ZoneRegionName'].'</td>
            <td scope="col" style="min-width: 150px;">'.$AssignTo.'</td>';
            $query="SELECT * FROM pass WHERE UserName is not null and UserType='Reminders' Order by UserName";
            $result3=mysqli_query($con,$query);
            ?>
            <th scope="col" style="min-width: 150px;">
                <select class="form-control rounded-corner" id="ChangeReminder" id2="<?php echo $ZoneCode?>">
                    <option value="">Select</option>
                    <?php 
                    while($row=mysqli_fetch_assoc($result3)){
                        echo "<option value='".$row['ID']."'>".$row['UserName']."</option><br>";
                    }
                    ?>
                </select>
            </th>
            <?php 
            //echo '<td scope="col" style="min-width: 150px;"><button class="btn btn-primary ResetReminder" id="'.$BankCode.'">Reset Assigning</button></td>
            '</tr>';
            $Sr++;

        }
    }
}


$NewReminder=!empty($_POST['NewReminder'])?$_POST['NewReminder']:'';
if (!empty($NewReminder))
{
    $ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';

    $query="SELECT * FROM `reminder bank` WHERE ZoneRegionCode=$ZoneCode";
    $result2=mysqli_query($con,$query);
    if (mysqli_num_rows($result2)>0)
    {  

        $sql = "UPDATE `reminder bank` SET ExecutiveID=$NewReminder WHERE ZoneRegionCode=$ZoneCode";
    }else{


        $sql = "INSERT INTO `reminder bank` (ExecutiveID, ZoneRegionCode)
        VALUES ($NewReminder, $ZoneCode)";

    }

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;

      $myfile = fopen("bankerr.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
  }
}


$ReminderU=!empty($_POST['ReminderU'])?$_POST['ReminderU']:'';
if (!empty($ReminderU))
{
    $Jobcard=!empty($_POST['Jobcard'])?$_POST['Jobcard']:'';

    $query="SELECT * FROM `jobcard reminder` WHERE `Card Number`='$Jobcard'";
    $result2=mysqli_query($con3,$query);
    if (mysqli_num_rows($result2)>0)
    {  
        $sql = "UPDATE `jobcard reminder` SET Description='$ReminderU' WHERE `Card Number`='$Jobcard'";
    }else{

        $sql = "INSERT INTO `jobcard reminder` (`Card Number`, Description, UserID)
        VALUES ('$Jobcard', '$ReminderU', $userid)";

    }

    if ($con3->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con3->error;

      $myfile = fopen("bankerr.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con3->error);
      fclose($myfile);
  }
}

$EmployeeCodeP=!empty($_POST['EmployeeCodeP'])?$_POST['EmployeeCodeP']:'';
if (!empty($EmployeeCodeP))
{

    $SDate=!empty($_POST['SDate'])?$_POST['SDate']:'';
    $EDate=!empty($_POST['EDate'])?$_POST['EDate']:'';

    $query="SELECT EmployeeCode, `Employee Name` from cyrusbackend.employees WHERE Inservice=1 ORDER BY `Employee Name`";

    $result=mysqli_query($con,$query);

    while($row = mysqli_fetch_array($result)){

      $EmployeeCode=$row["EmployeeCode"];

      $query1="SELECT count(OrderID) as AttendedOrders FROM cyrusbackend.orders
      WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
      AttendDate between '$SDate' and '$EDate'";
      $result1=mysqli_query($con2,$query1);
      $row1 = mysqli_fetch_array($result1);



      $query2="SELECT count(OrderID) as AttendedAMC FROM cyrusbackend.orders
      WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
      AttendDate between '$SDate' and '$EDate'";
      $result2=mysqli_query($con2,$query2);
      $row2 = mysqli_fetch_array($result2);

      $query3="SELECT count(ComplaintID) as AttendedComplaints FROM cyrusbackend.allcomplaint
      WHERE EmployeeCode=$EmployeeCode and Attended=1 and AttendDate between '$SDate' and '$EDate'";
      $result3=mysqli_query($con2,$query3);
      $row3 = mysqli_fetch_array($result3);

      $query4="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
      WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and BillDate between '$SDate' and '$EDate'";
      $result4=mysqli_query($con2,$query4);
      $row4 = mysqli_fetch_array($result4);

      $query5="SELECT count(Distinct VisitDate) as WorkingDays FROM cyrusbackend.jobcardmain WHERE EmployeeCode=$EmployeeCode and VisitDate between '$SDate' and '$EDate'";
      $result5=mysqli_query($con2,$query5);
      $row5 = mysqli_fetch_array($result5);


      $query9="SELECT count(ComplaintID) FROM cyrusbackend.complaints
      join branchdetails on complaints.BranchCode=branchdetails.BranchCode
      Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=1 and Address3 not like '%reserved%' and datediff(AttendDate, AssignDate)>2 and AttendDate between '$SDate' and '$EDate'";
      $result9=mysqli_query($con,$query9);
      $row9 = mysqli_fetch_array($result9);

      $query10="SELECT count(ComplaintID) FROM cyrusbackend.complaints
      join branchdetails on complaints.BranchCode=branchdetails.BranchCode
      Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=1 and Address3 not like '%reserved%' and datediff(AttendDate, AssignDate)<=2 and AttendDate between '$SDate' and '$EDate'";
      $result10=mysqli_query($con,$query10);
      $row10 = mysqli_fetch_array($result10);



      $query11="SELECT count(OrderID) FROM cyrusbackend.orders
      WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
      AttendDate between '$SDate' and '$EDate' and datediff(AttendDate, AssignDate)<=10";
      $result11=mysqli_query($con,$query11);
      $row11 = mysqli_fetch_array($result11);

      $query12="SELECT count(OrderID) FROM cyrusbackend.orders
      WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
      AttendDate between '$SDate' and '$EDate' and datediff(AttendDate, AssignDate)>10";
      $result12=mysqli_query($con,$query12);
      $row12 = mysqli_fetch_array($result12);



      $query13="SELECT count(OrderID) FROM cyrusbackend.orders
      WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
      AttendDate between '$SDate' and '$EDate' and datediff(AttendDate, AssignDate)<=60";
      $result13=mysqli_query($con,$query13);
      $row13 = mysqli_fetch_array($result13);

      $query14="SELECT count(OrderID) FROM cyrusbackend.orders
      WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
      AttendDate between '$SDate' and '$EDate' and datediff(AttendDate, AssignDate)>60";
      $result14=mysqli_query($con,$query14);
      $row14 = mysqli_fetch_array($result14);


      if ($row1["AttendedOrders"]!=0 or $row2["AttendedAMC"]!=0 or $row3["AttendedComplaints"]!=0) {
        ?>
        <tr>
          <td><?php echo $row["Employee Name"]; ?></td>
          <td> <a class="view_WorkReportOP" id="<?php print $EmployeeCode ?>" data-bs-target="#WorkReport"><?php echo $row1["AttendedOrders"]; ?></a></td>
          <td> <a class="view_WorkReportCP" id="<?php print $EmployeeCode ?>" data-bs-target="#ReportC"><?php echo $row3["AttendedComplaints"]; ?></a></td>
          <td> <a class="view_WorkReportAP" id="<?php print $EmployeeCode ?>" data-bs-target="#ReportAMC"><?php echo $row2["AttendedAMC"]; ?></a></td>
          <td><?php echo $row5["WorkingDays"]; ?></td>
          <td><?php echo $row10["count(ComplaintID)"]+$row11["count(OrderID)"]+$row13["count(OrderID)"]; ?></td>
          <td><?php echo $row9["count(ComplaintID)"]+$row12["count(OrderID)"]+$row14["count(OrderID)"]; ?></td>
          <td> <a class="view_WorkReportBP" id="<?php print $EmployeeCode ?>" data-bs-target="#ReportAMC"><?php echo number_format($row4["sum(TotalBilledValue)"],2); ?></a></td>


      </tr>
      <?php 
  }
}
}

$con->close();
$con2->close();
?>