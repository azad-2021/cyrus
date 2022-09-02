<?php
include ('connection.php');
include "session.php";
$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Address='';


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


$StateCode=!empty($_POST['StateCode'])?$_POST['StateCode']:'';
if (!empty($StateCode))
{
    $Data="Select EmployeeCode, `Employee Name` from employees WHERE Inservice=1 order by `Employee Name`";
    $result = mysqli_query($con,$Data);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['EmployeeCode']."'>".$arr['Employee Name']."</option><br>";
        }
    }
    
}

$RItemID=!empty($_POST['RItemID'])?$_POST['RItemID']:'';
if (!empty($RItemID))
{

    $query="SELECT * FROM cyrusbilling.servicecenter WHERE ItemID=$RItemID";
    $result=mysqli_query($con2,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Serial No</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['SerialNo']."'>".$arr['SerialNo']."</option><br>";
        }
    }

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




$SDate=!empty($_POST['SDate'])?$_POST['SDate']:'';
if (!empty($SDate))
{
    $EmployeeCodeW=!empty($_POST['EmployeeCodeW'])?$_POST['EmployeeCodeW']:'';

    $Data="SELECT Address from deliverychallan WHERE EmployeeCode=$EmployeeCodeW and DeliveryDate='$SDate' and Address is not null";
    

    $result = mysqli_query($con2,$Data);
    if(mysqli_num_rows($result)>0)
    {
        echo 1;
    }else{
        echo 0;
    }
    
}

$SDateCh=!empty($_POST['SDateCh'])?$_POST['SDateCh']:'';
if (!empty($SDateCh))
{
    $EmployeeCodeCh=!empty($_POST['EmployeeCodeCh'])?$_POST['EmployeeCodeCh']:'';

    $Data="SELECT * from deliverychallan WHERE EmployeeCode=$EmployeeCodeCh and DeliveryDate='$SDateCh' and Cancelled=0 Group by ChallanNo";
    

    $result = mysqli_query($con2,$Data);
    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($arr=mysqli_fetch_assoc($result)){

            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td ><?php echo $arr['ChallanNo'] ?></td>
                <td><?php echo $arr['Type'] ?></td>
                <td><?php echo $arr['Address'] ?></td>
                <td><button class="btn btn-primary PrintChallan" id="<?php echo $arr['ChallanNo'] ?>" id2="<?php echo $arr['Type'] ?>">Print Challan</button></td>
                <td><button class="btn btn-danger CancelChallan" id="<?php echo $arr['ChallanNo'] ?>">Cancel Challan</button></td>
            </tr>

            <?php
            $i++;
        }
    }

}


$EmployeeID=!empty($_POST['EmployeeID'])?$_POST['EmployeeID']:'';
//$OrderID=195836;
if (!empty($EmployeeID))
{   
    $i=1;
    $j=1;
    $i1=1;
    $i2=2000;
    $i3=3000;
    $i4=4000;
    $i5=5000;
    $i6=6000;
    $i8=8000;
    //$i9=9000;



    $Query="SELECT demandextended.OrderID, ItemName, demandextended.ItemID, ItemQty, demandextended.ID FROM cyrusbackend.demandextended
    join orders on demandextended.OrderID=orders.OrderID
    join item on demandextended.ItemID=item.ItemID
    WHERE EmployeeCode=$EmployeeID and Status=1 and year(DateOfInformation)=year(current_date())
    order by demandextended.OrderID";

    $result = mysqli_query($con,$Query);
    if(mysqli_num_rows($result)>0)
    {   
        while($arr=mysqli_fetch_assoc($result)){

            if ($arr['ItemQty']>=1) {
                $i7=$arr['ItemQty'];
                while($i7>=1){
                    echo '<input type="text" class="d-none" id="'.$j.'" value="'.$arr['ItemID'].'">';
                    echo '<input type="text" class="d-none" id="'.$i8.'" value="'.$arr['ID'].'">';
                    //echo '<input type="text" class="d-none" id="'.$i9.'" value="'.$arr['ItemQty'].'">';
                    ?>
                    <tr>
                        <td><?php echo $i1 ?></td>
                        <input type="text" class="d-none" id="<?php echo $i6 ?>" value="<?php echo $arr['OrderID']?>" disabled>
                        <td ><?php echo $arr['OrderID'] ?></td>
                        <td><?php echo $arr['ItemName'] ?></td>

                        <td><input type="text" class="form-control rounded-corner" placeholder="Bar Code" id="<?php echo $i2 ?>" name=""></td>
                        <td><input type="number" class="form-control rounded-corner" placeholder="Rate" id="<?php echo $i3 ?>" name=""></td>
                        <td><input type="number" class="form-control rounded-corner" placeholder="Discount" id="<?php echo $i5 ?>" name="" value=""></td>
                        <td>
                          <select class="form-control rounded-corner category" id="<?php echo $i4 ?>">
                              <option value="">Select</option>
                              <?php
                              $Query="SELECT * FROM `gst rates` order by CatagoryName";
                              $resultG=mysqli_query($con2,$Query);
                              while ($rowG=mysqli_fetch_assoc($resultG)){

                                  $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate']);
                                  $data = json_encode($d);
                                  echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
                              }
                              ?>

                          </select>

                      </td>
                  </tr>

                  <?php
                  $i7--;

                  $i1++;  
                  $j++;
                  $i2++;
                  $i3++;
                  $i4++;
                  $i5++;
                  $i6++;
                  $i8++;
                  //$i9++;
              }
              $i++;



          }

      }

      echo '<input type="text" class="d-none" id="count" value="'.($j-1).'">';
  }
}



$Rows=!empty($_POST['Rows'])?$_POST['Rows']:'';
if (!empty($Rows))
    {   $i1=1;
        $i2=2000;
        $i3=3000;
        $i4=4000;
        $i5=5000;
        $i6=6000;
        $Type=!empty($_POST['Type'])?$_POST['Type']:'';
        while($Rows>0){
            ?>
            <tr>
                <td><?php echo $i1 ?></td>
                <td>
                    <?php
                    if($Type=='Railways'){
                        ?>
                        <input type="text" class="form-control rounded-corner" placeholder="Item Name" id="<?php echo $i1 ?>" name="">
                        <?php 
                    }else{
                        ?>
                        <select class="form-control rounded-corner category" id="<?php echo $i1 ?>">
                          <option value="">Select</option>
                          <?php
                          $Query="SELECT * FROM `item` order by ItemName";
                          $result=mysqli_query($con,$Query);
                          while ($row=mysqli_fetch_assoc($result)){
                              echo "<option value='".$row['ItemID']."''>".$row['ItemName'].'</option>';
                          }
                      }
                      ?>

                  </select>
              </td>
              <td><input type="text" class="form-control rounded-corner" placeholder="Bar Code" id="<?php echo $i2 ?>" name=""></td>
              <?php
              if($Type=='Service Center'){
                  ?>
                  <td>
                      <input type="text" class="form-control rounded-corner" placeholder="Serial No" id="<?php echo $i6 ?>" name="">
                  </td>
                  <?php 
              }
              ?>              
              <td><input type="number" class="form-control rounded-corner" placeholder="Rate" id="<?php echo $i3 ?>" name=""></td>
              <td><input type="number" class="form-control rounded-corner" placeholder="Discount" id="<?php echo $i5 ?>" name="" value=""></td>
              <td>
                  <select class="form-control rounded-corner category" id="<?php echo $i4 ?>">
                      <option value="">Select</option>
                      <?php
                      $Query="SELECT * FROM `gst rates` order by CatagoryName";
                      $resultG=mysqli_query($con2,$Query);
                      while ($rowG=mysqli_fetch_assoc($resultG)){

                          $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate'], "ItemID"=>$rowG['ItemID']);
                          $data = json_encode($d);
                          echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
                      }
                      ?>

                  </select>

              </td>
          </tr>

          <?php
          $i1++;
          $i2++;
          $i3++;
          $i4++;
          $i5++;
          $i6++;
          $Rows--;
      }

  }

  $ItemID=!empty($_POST['ItemID'])?$_POST['ItemID']:'';
  if (!empty($ItemID))
  {  

    $EmployeeID=!empty($_POST['EmployeeCode2'])?$_POST['EmployeeCode2']:'';
    $Statecode=!empty($_POST['Statecode'])?$_POST['Statecode']:'';
    $Barcode=!empty($_POST['BarCode2'])?$_POST['BarCode2']:'';
    $hsn=!empty($_POST['HSN2'])?$_POST['HSN2']:'';
    $gst=!empty($_POST['GST2'])?$_POST['GST2']:'';
    $rate=!empty($_POST['rate'])?$_POST['rate']:'';
    $OrderID2=!empty($_POST['OrderID2'])?$_POST['OrderID2']:'';
    $Discount=!empty($_POST['Discount'])?$_POST['Discount']:'';
    $Type=!empty($_POST['Type'])?$_POST['Type']:'';
    $Address=!empty($_POST['Address'])?$_POST['Address']:'';
    $ExtendedID=!empty($_POST['ExtendedID'])?$_POST['ExtendedID']:'';
    $ReleaseTo=!empty($_POST['ReleaseTo'])?$_POST['ReleaseTo']:'';
    $SerialNo=!empty($_POST['SerialNo'])?$_POST['SerialNo']:'';

   /* print_r($Desc).'<br>';
    print_r($BarCode).'<br>';
    print_r($HSN).'<br>';
    print_r($GST).'<br>';
    print_r($Rate).'<br>';
    print_r($Rate).'<br>';
    print_r($Category);
*/
    //echo count($Desc);


    $m=date('m',strtotime($timestamp));
    $y=date('y',strtotime($timestamp));

    if ($m<=3) {
        $FY=($y-1).$y;

    }else{
        $FY=$y.($y+1);
    }
    $err=0;
    for ($m=0; $m < count($Barcode); $m++) { 

        $Bar=$Barcode[$m];
        $sql = "SELECT BarCode from deliverychallan WHERE Barcode='$Bar' and BarCode not like '%na%'";
        $result = mysqli_query($con2,$sql);
        if(mysqli_num_rows($result)>0){ 

            echo 'Bar Code '.$Barcode[$m].' already exist"';
            $err=1;
            break;
            
        }

    }
    
    if ($err==0) {

        $Query="SELECT ID FROM deliverychallan order by ID desc LIMIT 1";
        $result = mysqli_query($con2,$Query);
        if(mysqli_num_rows($result)>0){ 

            $arr=mysqli_fetch_assoc($result);

            $arrID=$arr['ID'];
            if ($Type=='Railways') {
                $ChallanNo=$FY.'CEUPR-'.$arrID+1;
            }elseif ($Type=='Bank') {
                $ChallanNo=$FY.'CEUPB-'.$arrID+1;
            }else{
                $ChallanNo=$FY.'CEUP-'.$arrID+1;
            }
        }else{
            $arrID=0;
            if ($Type=='Railways') {
                $ChallanNo=$FY.'CEUPR-'.$arrID+1;
            }elseif ($Type=='Bank') {
                $ChallanNo=$FY.'CEUPB-'.$arrID+1;
            }else{
                $ChallanNo=$FY.'CEUP-'.$arrID+1;
            }
        }


        for ($k=0; $k < count($ItemID); $k++) { 
            $inid=0;

            $SubAmount=((($rate[$k]-$Discount[$k])*$gst[$k])/100)+($rate[$k]-$Discount[$k]);
            $Amount=$SubAmount;

            if($Type=='Railways'){

                $Item='ItemName';
            }else{
                $Item='ItemID';
            }

            if(!empty($ExtendedID)){

                $sql = "INSERT INTO deliverychallan (EmployeeCode, StateCode, $Item, BarCode, HSNCode, GST, Rate, Amount, DeliveryDate, DeliveryByID, ChallanNo, Address, Discount, Type, DemandExtendedID, ReleaseTo)
                VALUES ($EmployeeID, $Statecode, '$ItemID[$k]', '$Barcode[$k]', $hsn[$k], $gst[$k],  '$rate[$k]', $Amount, '$Date', $EXEID, '$ChallanNo', '$Address', $Discount[$k], '$Type', $ExtendedID[$k], '$ReleaseTo')";
            }else{
               $sql = "INSERT INTO deliverychallan (EmployeeCode, StateCode, $Item, BarCode, HSNCode, GST, Rate, Amount, DeliveryDate, DeliveryByID, ChallanNo, Address, Discount, Type, ReleaseTo)
               VALUES ($EmployeeID, $Statecode, '$ItemID[$k]', '$Barcode[$k]', $hsn[$k], $gst[$k],  '$rate[$k]', $Amount, '$Date', $EXEID, '$ChallanNo', '$Address', $Discount[$k], '$Type', '$ReleaseTo')";
           }

           if ($con2->query($sql) === TRUE) {
            $inid=$con2->insert_id;
            if (!empty($OrderID2)) {

                $sql = "UPDATE demandextended SET StatusID=2 WHERE OrderID=$OrderID2[$k] and ItemID=$ItemID[$k]";
                if ($con->query($sql) === TRUE) {

                    $sql="SELECT * FROM demandextended WHERE OrderID=$OrderID2[$k] and StatusID=1";
                    $rs = mysqli_query($con,$sql);
                    if(mysqli_num_rows($rs)>0){ 

                    }else{
                        $sql = "UPDATE demandbase SET StatusID=6 WHERE OrderID=$OrderID2[$k]";
                        if ($con->query($sql) === TRUE) {

                        }else{
                            echo "Error: " . $sql . "<br>" . $con->error;
                        }

                    }

                }


            }

            if ($SerialNo!='NA') {

             $sql = "INSERT INTO servicecenter (ItemID, SerialNo, ChallanNo)
             VALUES ('$ItemID[$k]', '$SerialNo[$k]', '$ChallanNo')";
             if ($con2->query($sql) === TRUE) {

             }else{
                $myfile = fopen("errorx.txt", "w") or die("Unable to open file!");
                fwrite($myfile, $con2->error);
                fclose($myfile);
            }

        }

    }

}

if ($inid>0) {
        //echo '<input type="number" id="inid" value="'.$inid.'">';
    $myfile = fopen("id.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $inid);
    fclose($myfile);
    echo $inid;
}else{
    echo 'Please enter all fields';
}
}
}  


$SDateE=!empty($_POST['SDateE'])?$_POST['SDateE']:'';
if (!empty($SDateE)){
    $i=1;
    $i2=2000;
    $EmployeeIDE=!empty($_POST['EmployeeCodeE'])?$_POST['EmployeeCodeE']:'';

    $sql="SELECT * FROM cyrusbilling.deliverychallan 
    join cyrusbackend.item on deliverychallan.ItemID=item.ItemID
    WHERE EmployeeCode=$EmployeeIDE and DeliveryDate='$SDateE' and ApprovalID=0 and ConsumedDate is null";
    $result = mysqli_query($con2,$sql);
    if(mysqli_num_rows($result)>0){ 
        echo '<input type="text" class="form-control rounded-corner d-none" placeholder="Bar Code" id="chno" name="">';
        while($arr=mysqli_fetch_assoc($result)){

            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td> <?php echo $arr['ItemName'];   ?></td>

                <td><a href="" data-bs-toggle="modal" class="editbar"  id2="<?php echo $arr['ID']?>"
                    id="<?php echo $arr['ChallanNo']?>" data-bs-target="#EditBarCode"><?php echo $arr['BarCode'];   ?></a>
                </td>

            </tr>

            <?php
            $i++;
        }
    }
}



$ChallanCancel=!empty($_POST['ChallanCancel'])?$_POST['ChallanCancel']:'';
if (!empty($ChallanCancel))
{  

    $sql = "SELECT DemandExtendedID from deliverychallan WHERE ChallanNo='$ChallanCancel' and DemandExtendedID is not null";
    $result = mysqli_query($con2,$sql);
    if(mysqli_num_rows($result)>0){ 
        while($row=mysqli_fetch_assoc($result)){

            $ExtendedID=$row['DemandExtendedID'];
            $sql = "UPDATE demandextended SET StatusID=1 WHERE ID=$ExtendedID";
            if ($con->query($sql) === TRUE) {

            }else{
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }

    $sql = "UPDATE deliverychallan SET Cancelled=1 WHERE ChallanNo='$ChallanCancel'";
    if ($con2->query($sql) === TRUE) {

    }else{
        echo "Error: " . $sql . "<br>" . $con2->error;
    }


}

$ServiceCenter=!empty($_POST['ServiceCenter'])?$_POST['ServiceCenter']:'';
if (!empty($ServiceCenter))
{  
    $sql = "SELECT * FROM item";
    $resultI = mysqli_query($con,$sql);
    $i=1;
    while($rowI=mysqli_fetch_assoc($resultI)){

        $ItemID=$rowI['ItemID'];

        $sql = "SELECT count(ItemID) FROM cyrusbilling.servicecenter
        WHERE ItemID=$ItemID";
        $result = mysqli_query($con2,$sql);
        $row1=mysqli_fetch_assoc($result);
        //print_r($result);

        $sql = "SELECT count(ItemID) FROM cyrusbilling.servicecenter
        WHERE Returned=1 and ItemID=$ItemID";
        $result = mysqli_query($con2,$sql);
        $row2=mysqli_fetch_assoc($result);
        //print_r($result);

        $sql = "SELECT count(ItemID) FROM cyrusbilling.servicecenter
        WHERE Returned=1 and Used=1 and ItemID=$ItemID";
        $result = mysqli_query($con2,$sql);
        $row3=mysqli_fetch_assoc($result);
        
        if ($row1['count(ItemID)']>0 or $row2['count(ItemID)']>0 or $row3['count(ItemID)']>0) {
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td> <?php echo $rowI['ItemName'];?></td>
                <td><?php echo $row1['count(ItemID)'];?></td>
                <td><?php echo $row2['count(ItemID)'];?></td>
                <td><?php echo $row3['count(ItemID)'];?></td>
            </tr>

            <?php
            $i++;
        }

        
    }
}


$ServiceItemID=!empty($_POST['ServiceItemID'])?$_POST['ServiceItemID']:'';
if (!empty($ServiceItemID))
{  

    $ServiceType=!empty($_POST['TypeService'])?$_POST['TypeService']:'';

    if ($ServiceType=='Total') {
        $sql = "SELECT servicecenter.ItemID, item.ItemName, Returned, Used, servicecenter.ChallanNo FROM cyrusbilling.servicecenter
        join deliverychallan on servicecenter.ChallanNo=deliverychallan.ChallanNo
        Join cyrusbackend.item on servicecenter.ItemID=item.ItemID 
        WHERE servicecenter.ItemID=$ServiceItemID";

    }elseif($ServiceType=='Returned'){

        $sql = "SELECT DISTINCT servicecenter.ItemID, item.ItemName, Returned, Used, servicecenter.ChallanNo FROM cyrusbilling.servicecenter
        join deliverychallan on servicecenter.ChallanNo=deliverychallan.ChallanNo
        Join cyrusbackend.item on servicecenter.ItemID=item.ItemID 
        WHERE servicecenter.ItemID=$ServiceItemID and Returned=1";        
    }else{

        $sql = "SELECT DISTINCT servicecenter.ItemID, item.ItemName, Returned, Used, servicecenter.ChallanNo FROM cyrusbilling.servicecenter
        join deliverychallan on servicecenter.ChallanNo=deliverychallan.ChallanNo
        Join cyrusbackend.item on servicecenter.ItemID=item.ItemID 
        WHERE servicecenter.ItemID=$ServiceItemID and Returned=1 and Used=1"; 

    }

    $result = mysqli_query($con2,$sql);
    $i=1;
    while($row=mysqli_fetch_assoc($result)){

        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td> <?php echo $row['ItemName'];   ?></td>

            <td><?php echo $row['ChallanNo'];   ?></td>
            <td><button data-bs-toggle="modal" id="<?php echo $ServiceItemID;   ?>" class="ServiceReturned btn btn-primary" data-bs-target="#ServiceReturned" id2="<?php echo $row['ChallanNo'];?>">Returned</button>
            </td>
        </tr>

        <?php
        $i++;
        
    }
}



$ReturnedItemID=!empty($_POST['ReturnedItemID'])?$_POST['ReturnedItemID']:'';
if (!empty($ReturnedItemID))
{   
    $OldSrNo=!empty($_POST['OldSrNo'])?$_POST['OldSrNo']:'';
    $ReturnDate=!empty($_POST['ReturnDate'])?$_POST['ReturnDate']:'';
    $NewSrNo=!empty($_POST['NewSrNo'])?$_POST['NewSrNo']:'';

    if ($NewSrNo=='NA') {

        $sql = "UPDATE servicecenter SET Returned=1, ReturnDate='$ReturnDate' WHERE ItemID=$ReturnedItemID and SerialNo='$OldSrNo'";
    }else{

     $sql = "UPDATE servicecenter SET Returned=1, ReturnDate='$ReturnDate', NewSrNo='$NewSrNo' WHERE ItemID=$ReturnedItemID and SerialNo='$OldSrNo'"; 
 }

 if ($con2->query($sql) === TRUE) {

 }else{
    echo "Error: " . $sql . "<br>" . $con2->error;
}


}

if (isset($_GET['bar'])) {

    $Barcode="%".$_GET['bar']."%";
    //echo $Barcode;
    $sql = "SELECT DISTINCT BarCode FROM cyrusbilling.deliverychallan
    join servicecenter on deliverychallan.ChallanNo=servicecenter.ChallanNo
    WHERE Returned=1 and Used=0 and BarCode like '$Barcode'";
    $result = mysqli_query($con2,$sql);
    //print_r($result);
    if(mysqli_num_rows($result)>0){ 
        while($row=mysqli_fetch_assoc($result)){

           echo $row['BarCode'].'<br>';
        }
    }
    
}

?>

