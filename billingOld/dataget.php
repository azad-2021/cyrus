<?php
include ('connection.php');

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

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


$ZoneCodeM=!empty($_POST['ZoneCodeM'])?$_POST['ZoneCodeM']:'';
if (!empty($ZoneCodeM))
{
    $ZoneData="SELECT * from rates WHERE Zone=$ZoneCodeM and ItemID!=1654 order by Description";
    $result=mysqli_query($con2,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            $d = array("RateID"=>$arr['RateID'], "ItemID"=>$arr['ItemID']);
            $data = json_encode($d);
            echo "<option value='".$data."'>".$arr['Description']."</option><br>";
        }
    }
}



$DelData=!empty($_POST['Delete'])?$_POST['Delete']:'';
if (!empty($DelData))
{

    $obj = json_decode($DelData);
    $ApprovalID = $obj->ApprovalID;
    $RateID=$obj->RateID;
    $Query="UPDATE pbills Set Qty=0 WHERE ApprovalID=$ApprovalID and RateID=$RateID";
    
    if ($con2->query($Query) === TRUE) {

    }else {
      echo "Error: " . $Query . "<br>" . $con2->error;

  }
}


$RateID=!empty($_POST['Add'])?$_POST['Add']:'';

if (!empty($RateID))
{



  $ApprovalID=!empty($_POST['Approval'])?$_POST['Approval']:'';
  $Qty=!empty($_POST['Qty'])?$_POST['Qty']:'';
  $myfile = fopen("RateID.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $ApprovalID);
  fclose($myfile);


  $Err="SELECT * from pbills WHERE ApprovalID=$ApprovalID and RateID=$RateID";
  $resultErr=mysqli_query($con2,$Err);
  if (mysqli_num_rows($resultErr)>0)
  {
    echo 1;
}else{


  $sql = "INSERT INTO pbills (`ApprovalID`, `RateID`, `UsedAs`, `Qty`)
  VALUES ($ApprovalID, $RateID, 'Billing', $Qty)";

  if ($con2->query($sql) === TRUE) {

  }else {
      echo "Error: " . $Query . "<br>" . $con2->error;
      $myfile = fopen("error.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con2->error);
      fclose($myfile);

  }
}
}




$BranchCode=!empty($_POST['BranchCode'])?$_POST['BranchCode']:'';
if (!empty($BranchCode))
{

    $Query="SELECT * FROM cyrusbackend.approval
    join employees on approval.EmployeeID=employees.EmployeeCode
    WHERE vopen=0 and BranchCode=$BranchCode and Vremark!='REJECTED' Group By OrderID, ComplaintID order by VisitDate ";

    $result=mysqli_query($con,$Query);
    if (mysqli_num_rows($result)>0)
    {

        while ($arr=mysqli_fetch_assoc($result))
        {

            $ApprovalID=$arr['ApprovalID'];
            $OrderID=$arr["OrderID"];
            $ComplaintID=$arr["ComplaintID"];

            if ($arr["OrderID"]>0) {   
                $Query3="SELECT * FROM orders WHERE OrderID=$OrderID";
            }elseif($arr["ComplaintID"]>0){
                $Query3="SELECT * FROM complaints WHERE ComplaintID=$ComplaintID";
                
            }
            $result3=mysqli_query($con,$Query3);
            $arr3=mysqli_fetch_assoc($result3);


            $Query2="SELECT * FROM cyrusbilling.pbills
            join cyrusbackend.approval on pbills.ApprovalID=approval.ApprovalID
            WHERE OrderID=$OrderID and ComplaintID=$ComplaintID";

            $result2=mysqli_query($con2,$Query2);
            
            if (mysqli_num_rows($result2)>0)
            {
                $arr2=mysqli_fetch_assoc($result2);
                $ApprovalID=$arr2['ApprovalID'];
                $Material='<td style="color: blue;" class="viewMaterial" id="'.$arr2['ApprovalID'].'">View Materials</td>';
            }else{
                $Material='<td style="color: blue;" class="viewMaterial" id="'.$arr['ApprovalID'].'">Add Materials</td>';
                

            }
/*
            $Query="SELECT * FROM estimates join cyrusbackend.approval on estimates.ApprovalID=approval.ApprovalID
            WHERE BranchCode=$BranchCode and OrderID=$OrderID and ComplaintID=$ComplaintID";
            $result2=mysqli_query($con2,$Query);
            if (mysqli_num_rows($result2)>0)
            {
                $Estimate='<a href="/cyrus/reporting/viewe.php?apid='.$ApprovalID.'" target="_blank">View Estimate</a>';

            }else{
                $Estimate='No Estimate Given';
            }
*/
            $InstPaper='<a href="/cyrus/technician/view.php?apid='.$ApprovalID.'" target="_blank">Installation Paper</a>';

            if ($arr['Status']==1) {
                $Status='OK';
            }else{
                $Status='Not OK';
            }



            ?>

            <tr>
                <td><?php echo $arr['Employee Name']; ?></td>
                <!--<td><?php echo $ApprovalID; ?></td>-->
                <td><?php echo $arr['OrderID']; ?></td>
                <td><?php echo $arr['ComplaintID']; ?></td>
                <td><?php echo $arr3['Discription']; ?></td>
                <td><?php echo $arr['VisitDate']; ?></td>
                <td><?php echo $Status; ?></td>
                <td><?php echo $arr['JobCardNo']; ?></td>
                <td><?php echo $InstPaper; ?></td>
                <?php echo $Material; ?>

            </tr>

            <?php 
            
        }
    }

}



$ApprovalID=!empty($_POST['ApprovalID'])?$_POST['ApprovalID']:'';
if (!empty($ApprovalID))
{


    $Query="SELECT OrderID, ComplaintID from approval WHERE ApprovalID=$ApprovalID";
    $result=mysqli_query($con,$Query);
    $data=mysqli_fetch_assoc($result);
    $ComplaintID=$data['ComplaintID'];
    $OrderID=$data['OrderID'];


    $Query="SELECT  ItemName, Description, rates.RateID, rates.Rate as ItemRate, Qty, (rates.Rate * Qty) as Value FROM cyrusbilling.pbills
    Join cyrusbilling.rates on pbills.RateID=rates.RateID
    join cyrusbackend.item on rates.ItemID=item.ItemID
    join cyrusbackend.approval on pbills.ApprovalID=approval.ApprovalID
    WHERE OrderID=$OrderID and ComplaintID=$ComplaintID Group by pbills.RateID";

/*
    $Query="SELECT ItemName, Description, rates.RateID, rates.Rate as ItemRate, Qty, (rates.Rate * Qty) as Value FROM cyrusbilling.pbills Join cyrusbilling.rates on pbills.RateID=rates.RateID
    join cyrusbackend.item on rates.ItemID=item.ItemID WHERE ApprovalID=$ApprovalID order by ItemName";
    */
    $result=mysqli_query($con2,$Query);
    if (mysqli_num_rows($result)>0)
    {
        $ID=1000;
        $ID2=0;

        while ($arr=mysqli_fetch_assoc($result))
        {
            $ID++;
            $ID2++;
            $Query="SELECT * FROM `gst rates` order by CatagoryName";
            $resultG=mysqli_query($con2,$Query);

            $d1 = array("ApprovalID"=>$ApprovalID, "RateID"=>$arr['RateID']);
            $data1 = json_encode($d1);


            ?>

            <tr>
                <td><?php echo $ID2; ?></td>
                <td ><?php echo $arr['ItemName']; ?></td>
                <td ><?php echo $arr['Description']; ?></td>
                <td ><?php echo $arr['ItemRate']; ?></td>
                <td><input class="form-control my-select3" type="text" name="GSTRate" id="<?php echo $arr['RateID']; ?>" disabled></td>
                <td><input class="form-control my-select3" type="text" name="HSN" id="<?php echo $ID; ?>" disabled></td>
                <td><?php echo $arr['Qty']; ?></td>
                <td><?php echo $arr['Value']; ?></td>
                <td>
                    <select class="form-control my-select3" id="GstRates">
                        <option value="">Select</option>
                        <?php
                        while ($rowG=mysqli_fetch_assoc($resultG)){

                            $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate'], "RateID"=>$arr['RateID'], "ID"=>$ID);
                            $data = json_encode($d);
                            echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
                        }
                        ?>

                    </select>

                </td>
                <td><button class="btn btn-danger delete" id='<?php echo $data1; ?>'>Delete</button></td>
            </tr>

            <?php 
        }
    }

}


$ZoneCodeR=!empty($_POST['ZoneCodeR'])?$_POST['ZoneCodeR']:'';
if (!empty($ZoneCodeR))
{

    $Query="SELECT * FROM cyrusbilling.rates
    join cyrusbackend.item on rates.ItemID=item.ItemID WHERE Zone=$ZoneCodeR order by ItemName";

    $result=mysqli_query($con2,$Query);
    if (mysqli_num_rows($result)>0)
    {
        $sr=0;
        while ($arr=mysqli_fetch_assoc($result))
        {
            $sr++;

            ?>

            <tr>
                <td><?php echo $sr; ?></td>
                <td><?php echo $arr['ItemName']; ?></td>
                <td><?php echo $arr['Description']; ?></td>
                <td style="color: blue;" class="addDesc" id="<?php echo $arr['Description']; ?>" id2="<?php echo $arr['RateID']; ?>" data-bs-toggle="modal" data-bs-target="#UpdateRates"><?php echo $arr['Rate']; ?></td>
                <td><?php echo $arr['UpdateON']; ?></td>
                <td>
                    
                    <input type="number" class="d-none" name="" id="<?php echo $sr; ?>" value="<?php echo $arr['RateID']; ?>">
                    <select class="form-control my-select3" id="ChangeItem" id2="<?php echo $sr; ?>">
                        <option value="">Select</option>
                        <?php 
                        $Query="SELECT * FROM item order by ItemName";

                        $result2=mysqli_query($con,$Query);
                        if (mysqli_num_rows($result2)>0)
                        {

                            while ($arr2=mysqli_fetch_assoc($result2))
                            {

                                echo "<option value='".$arr2['ItemID']."'>".$arr2['ItemName']."</option><br>";


                                ?>
                                <?php 
                            }
                        } 
                        ?>
                    </select>
                </td>
            </tr>

            <?php 

        }
    }

}

$Rate=!empty($_POST['Rate'])?$_POST['Rate']:'';

if (!empty($Rate))
{

    $RateID=!empty($_POST['RateID'])?$_POST['RateID']:'';

    $sql = "UPDATE rates set Rate=$Rate, UpdateON='$Date' WHERE RateID=$RateID";
/*
    if ($con2->query($sql) === TRUE) {

    }else {
      echo "Error: " . $sql . "<br>" . $con2->error;
      $myfile = fopen("error.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con2->error);
      fclose($myfile);

  }*/

}

$ItemID=!empty($_POST['ItemID'])?$_POST['ItemID']:'';

if (!empty($ItemID))
{

    $RateID=!empty($_POST['RateID'])?$_POST['RateID']:'';

    $sql = "UPDATE rates set ItemID=$ItemID, UpdateON='$Date' WHERE RateID=$RateID";
/*
    if ($con2->query($sql) === TRUE) {

    }else {
      echo "Error: " . $sql . "<br>" . $con2->error;
      $myfile = fopen("error.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con2->error);
      fclose($myfile);

  }*/

}
