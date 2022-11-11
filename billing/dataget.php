<?php
include ('connection.php');
include ('session.php');
$userid=$_SESSION['userid'];


date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$m=date('m',strtotime($timestamp));
$y=date('y',strtotime($timestamp));

if ($m<=3) {
    $FY=($y-1).$y;

}else{
    $FY=$y.($y+1);
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

$ZoneCodeM=!empty($_POST['ZoneCodeM'])?$_POST['ZoneCodeM']:'';
if (!empty($ZoneCodeM))
{
    $query="SELECT * from rates WHERE Zone=$ZoneCodeM and ItemID!=1654 and Enable=1 order by Description";
    $result=mysqli_query($con2,$query);
    if (mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            $d = array("RateID"=>$arr['RateID'], "Rate"=>$arr['Rate'], "Description"=>$arr['Description']);
            $data = json_encode($d);
            echo "<option value='".$data."'>".$arr['Description']."</option><br>";
        }
    }
}



$BranchCode=!empty($_POST['BranchCode'])?$_POST['BranchCode']:'';
if (!empty($BranchCode))
{

 $Query="SELECT ApprovalID, OrderID, ComplaintID, approval.BranchCode, approval.VisitDate  FROM cyrusbackend.approval
 WHERE Vremark not like '%Rejected%' and Billed=0 and BillDate is null and VisitDate>'2022-01-01' and BranchCode=$BranchCode group by OrderID, ComplaintID order by VisitDate";

 $result=mysqli_query($con,$Query);
 if (mysqli_num_rows($result)>0)
 {

    while ($arr=mysqli_fetch_assoc($result))
    {

        $ApprovalID=$arr['ApprovalID'];
        $OrderID=$arr["OrderID"];
        $ComplaintID=$arr["ComplaintID"];
            //echo $ComplaintID;
        if ($arr["OrderID"]>0) {   
            $Query3="SELECT Discription, `Employee Name`, orders.EmployeeCode FROM orders
            join employees on orders.EmployeeCode=employees.EmployeeCode
            WHERE OrderID=$OrderID";
        }elseif($arr["ComplaintID"]>0){
            $Query3="SELECT Discription, `Employee Name`, complaints.EmployeeCode FROM complaints
            join employees on complaints.EmployeeCode=employees.EmployeeCode
            WHERE ComplaintID=$ComplaintID";

        }

        $result3=mysqli_query($con,$Query3);
        if (mysqli_num_rows($result3)>0)
        {

            $arr3=mysqli_fetch_assoc($result3);

            ?>

            <tr>
                <td><?php echo $arr3['Employee Name']; ?></td>
                <!--<td><?php echo $ApprovalID; ?></td>-->
                <td><?php echo $arr['OrderID']; ?></td>
                <td><?php echo $arr['ComplaintID']; ?></td>
                <td><?php echo $arr3['Discription']; ?></td>
                <td> <span class="d-none"><?php echo $arr['VisitDate']; ?></span> <?php echo date('d-M-Y',strtotime($arr['VisitDate'])); ?></td>
                <td>
                    <input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $arr["ApprovalID"]; ?>">
                </td>

            </tr>

            <?php 

        }
    }
}

}


$BranchCodeD=!empty($_POST['BranchCodeD'])?$_POST['BranchCodeD']:'';
if (!empty($BranchCodeD))
{
    //'$EmployeeCode=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
    $Query="SELECT Branch_code, GSTNo, Email from branchs WHERE BranchCode=$BranchCodeD";

    $result=mysqli_query($con,$Query);
    if (mysqli_num_rows($result)>0)
    {
        $arr=mysqli_fetch_assoc($result);

        $d = array("Branch_Code"=>$arr['Branch_code'], "GST"=>$arr['GSTNo'], "Email"=>$arr['Email']);
        $data = json_encode($d);

        echo $data;
    }

}



$ApprovalID=!empty($_POST['APIDArr'])?$_POST['APIDArr']:'';
if (!empty($ApprovalID))
{
 $sr=1;
 for ($i=0; $i < count($ApprovalID); $i++) { 

    $Query="SELECT OrderID, ComplaintID from approval WHERE ApprovalID=$ApprovalID[$i]";
    $result=mysqli_query($con,$Query);
    $data=mysqli_fetch_assoc($result);
    $ComplaintID=$data['ComplaintID'];
    $OrderID=$data['OrderID'];


    $Query="SELECT BillingID, Description, rates.RateID, rates.Rate as ItemRate, Qty, (rates.Rate * Qty) as Value FROM cyrusbilling.pbills
    join cyrusbackend.approval on pbills.ApprovalID=approval.ApprovalID
    join cyrusbilling.rates on pbills.RateID=rates.RateID WHERE BillNo is null and Billed=0 and UsedAs='Billing' and pbills.ApprovalID=$ApprovalID[$i] and Qty>0";

    $result=mysqli_query($con2,$Query);
    if (mysqli_num_rows($result)>0)
    {

        while ($arr=mysqli_fetch_assoc($result))
        {


            $d1 = array("ApprovalID"=>$ApprovalID[$i], "BillingID"=>$arr['BillingID']);
            $data1 = json_encode($d1);

            $d2 = array("Value"=>$arr['Value'], "BillingID"=>$arr['BillingID']);
            $data2 = json_encode($d2);
            ?>

            <tr>
                <td><input class="form-check-input checkb" name="BillingSelect" id3="<?php echo $arr['Value']; ?>" id2="<?php echo $sr; ?>" id="BillingSelect" type="checkbox" value="<?php echo $arr["BillingID"]; ?>"> &nbsp; <?php echo $sr; ?></td>
                <td ><?php echo $arr['Description']; ?></td>
                <td><textarea class="form-control rounded-corner" id="<?php echo 'Bar'.$arr["BillingID"]; ?>" name="BarCodeArray[]" rows="1"></textarea></td>
                <td ><?php echo $arr['ItemRate']; ?></td>
                <td><?php echo $arr['Qty']; ?></td>
                <td><?php echo $arr['Value']; ?></td>
                <td><input class="form-control rounded-corner" type="number" name="Discount[]" id="<?php echo 'Disc'.$arr["BillingID"]; ?>" id="Discount" value="0" min="0"></td>

                <td><input class="form-control rounded-corner" type="text" name="GSTRate" id="<?php echo $arr['BillingID']; ?>" disabled></td>
                <td><input class="form-control rounded-corner" type="text" name="HSN[]" id="<?php echo $sr; ?>" disabled></td>
                <td>
                    <select class="form-control rounded-corner" id="GstRates">
                        <option value="">Select</option>
                        <?php
                        $Query="SELECT * FROM `gst rates` order by CatagoryName";
                        $resultG=mysqli_query($con2,$Query);
                        while ($rowG=mysqli_fetch_assoc($resultG)){

                            $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate'], "BillingID"=>$arr['BillingID'], "ID"=>$sr);
                            $data = json_encode($d);
                            echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
                        }
                        ?>

                    </select>

                </td>
                <td><button class="btn btn-danger delete" id='<?php echo $data1; ?>'>Delete</button></td>
            </tr>

            <?php 
            $sr++;
        }
    }

}
}



$BranchAddShow=!empty($_POST['BranchAddShow'])?$_POST['BranchAddShow']:'';
if (!empty($BranchAddShow))
{

    $EmployeeCodeAdddShow=!empty($_POST['EmployeeCodeAdddShow'])?$_POST['EmployeeCodeAdddShow']:'';
    $Query="SELECT ID, ItemName, BarCode, AValue, tempbilling.Rate, Qty, (tempbilling.Rate*Qty) as Amount, Discount, CatagoryName, HSNCode, `gst rates`.Rate as GST FROM cyrusbilling.tempbilling
    join cyrusbilling.`gst rates` on tempbilling.CategoryID=`gst rates`.ItemID WHERE BranchCode=$BranchAddShow and EmployeeCode=$EmployeeCodeAdddShow";

    $result=mysqli_query($con2,$Query);
    if (mysqli_num_rows($result)>0)
    {   

        while ($arr=mysqli_fetch_assoc($result))
        {



            ?>

            <tr>

                <td ><?php echo $arr['ItemName']. ' ( '.$arr['BarCode'].' )'; ?></td>
                <td ><?php echo $arr['Rate']; ?></td>
                <td><?php echo $arr['Qty']; ?></td>
                <td><?php echo $arr['Amount']; ?></td>
                <td><?php echo $arr['Discount']; ?></td>
                <td><?php echo number_format((float)$arr['AValue'], 2, '.', ''); ?></td>
                <td><?php echo $arr['GST']; ?></td>
                <td><?php echo $arr['HSNCode']; ?></td>
                <td><?php echo $arr['CatagoryName']; ?></td>
                <td><button class="btn btn-danger deleteAdd" id='<?php echo $arr['ID']; ?>'>Delete</button></td>
            </tr>

            <?php 
        }
    }
}



$DeleteAdd=!empty($_POST['DeleteAdd'])?$_POST['DeleteAdd']:'';
if (!empty($DeleteAdd))
{

    $Query="DELETE FROM cyrusbilling.tempbilling WHERE ID=$DeleteAdd";
    
    if ($con2->query($Query) === TRUE) {
        echo 1;
    }else {
      echo "Error: " . $Query . "<br>" . $con2->error;

  }
}



$RateID=!empty($_POST['Add'])?$_POST['Add']:'';

if (!empty($RateID))
{


    $Err=0;
    $ApprovalID=!empty($_POST['Approval'])?$_POST['Approval']:'';
    $Qty=!empty($_POST['Qty'])?$_POST['Qty']:'';

    $myfile = fopen("RateID.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $ApprovalID[0]);
    fclose($myfile);

    for ($i=0; $i < count($ApprovalID); $i++) { 

        $query="SELECT * from pbills WHERE ApprovalID=$ApprovalID[$i] and RateID=$RateID";
        $resultErr=mysqli_query($con2,$query);
        if (mysqli_num_rows($resultErr)>0)
        {
            echo "Material alredy exist";
            $Err=1;
            break;
        }
    }

    if ($Err==0){


        $sql = "INSERT INTO pbills (`ApprovalID`, `RateID`, `UsedAs`, `Qty`)
        VALUES ($ApprovalID[0], $RateID, 'Billing', $Qty)";

        if ($con2->query($sql) === TRUE) {
            echo 1;

        }else {
          echo "Error: " . $sql . "<br>" . $con2->error;


      }
  }
}


$CheckConsumed=!empty($_POST['CheckConsumed'])?$_POST['CheckConsumed']:'';

if (!empty($CheckConsumed))
{

    $query="SELECT * from tempbilling WHERE BranchCode=$CheckConsumed";
    $result=mysqli_query($con2,$query);
    if (mysqli_num_rows($result)>0)
    {
        echo 1;
    }

}





$AddAmount=!empty($_POST['AddAmount'])?$_POST['AddAmount']:'';
if (!empty($AddAmount))
{


    $Query="SELECT sum((tempbilling.Rate*Qty)-(((tempbilling.Rate*Qty)*Discount)/100)) As Avalue, `gst rates`.Rate  As GSTRate FROM cyrusbilling.tempbilling
    join cyrusbilling.`gst rates` on tempbilling.CategoryID=`gst rates`.ItemID WHERE BranchCode=$AddAmount;";

    $result=mysqli_query($con2,$Query);
    if (mysqli_num_rows($result)>0)
    {   

        $arr=mysqli_fetch_assoc($result);
        $AValue=$arr['Avalue']+(($arr['Avalue']*$arr['GSTRate'])/100);
        echo number_format((float)$AValue, 2, '.', '');


    }

}

$CInvoiceNo=!empty($_POST['CInvoiceNo'])?$_POST['CInvoiceNo']:'';
if (!empty($CInvoiceNo))
{
    $Query="SELECT BookNo from cyrusbilling.billbook WHERE BranchCode=$CInvoiceNo and CreditNote=0 order by BillDate desc";
    $result=mysqli_query($con2,$Query);
    echo "<option value=''>Select </option>";
    if (mysqli_num_rows($result)>0)
    {

        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['BookNo']."'>".$arr['BookNo']."</option><br>";
        }
    }
}


$GenerateCreditNote=!empty($_POST['GenerateCreditNote'])?$_POST['GenerateCreditNote']:'';
if (!empty($GenerateCreditNote))
{
    //echo $GenerateCreditNote;

    $Query="SELECT BillID FROM cyrusbilling.billBook WHERE BookNo='$GenerateCreditNote'";

    $result=mysqli_query($con2,$Query);
    if (mysqli_num_rows($result)>0)
    {   

        $arr=mysqli_fetch_assoc($result);
        $BillID=$arr['BillID'];

        $Note=substr($GenerateCreditNote, 0, 8);
        $CN='%'.substr($GenerateCreditNote, 0, 8).'CN%';
        $Query="SELECT CreditNoteNo FROM cyrusbilling.creditnote WHERE CreditNoteNo like '$CN' order by ID desc limit 1";

        $result=mysqli_query($con2,$Query);
        if (mysqli_num_rows($result)>0)
        {
            $arr=mysqli_fetch_assoc($result);
            $LastCN=$arr['CreditNoteNo'];
            $NewCN=substr($LastCN, 10)+1;
            
            $num_length = strlen((string)$NewCN);
            if($num_length == 2) {
                $NewCN = sprintf('%03d', $NewCN);
            }
            
            $NewCN=$Note.'CN'.$NewCN;
        }else if($Note=='2223CEUP'){
            $NewCN='2223CEUPCN031';
        }else if($Note=='2223CEBH'){
            $NewCN='2223CEBHCN002';
        }else if($Note=='2223CECH'){
            $NewCN='2223CECHCN010';
        }else{
            $NewCN=$Note.'CN001';
        }
        
        $sql = "INSERT INTO cyrusbilling.creditnote (BillID, CreditNoteNo, `Date`, GenByID)
        VALUES ($BillID, '$NewCN', '$Date', $userid)";

        if ($con2->query($sql) === TRUE) {

            $_SESSION['CNNo']=$NewCN;

            $sql2="UPDATE cyrusbilling.billbook SET CreditNote=1 WHERE BillID=$BillID";

            if ($con2->query($sql2) === TRUE) {
                $_SESSION['CNNo']=$NewCN;
                echo 1;
            } else {
                echo "Error: " . $sql2 .