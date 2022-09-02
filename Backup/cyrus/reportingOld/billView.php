<?php  
include('connection.php');   
$Company='CYRUS ELECTRONICS PVT. LTD.';
$PAN='AACCC6555F';

$queryBankDetails = "SELECT * FROM `bank details` WHERE ID=2";
$resultDetails = $con2->query($queryBankDetails);
$Details=mysqli_fetch_assoc($resultDetails);
$BanKAcc=$Details['Bank Name'].' A/C No. '.$Details['AcNumber'].' IFSC-'.$Details['IFSC'];

//$BanKAcc='HDFC Bank A/C No. 50200023792220, IFSC-HDFC0000412';
$Address2='';

$BookNo=base64_decode($_GET['billno']);
$query = "SELECT * FROM billdetail WHERE `BillNo`='$BookNo'";
$result = $con2->query($query);
$data=mysqli_fetch_assoc($result);

$query2 = "SELECT * FROM billbook WHERE `BookNo`='$BookNo'";
$result2 = $con2->query($query2);
$data2=mysqli_fetch_assoc($result2);
$Date = $data2['BillDate'];
$BranchCode=$data2['BranchCode'];
$GSTINC=$data2['GSTNo'];
$CGST=$data2['CGST'];
$SGST=$data2['SGST'];
$IGST=$data2['IGST'];
$EmployeeID=$data2['EmployeeCode'];

$queryBank="SELECT * FROM branchs where BranchCode=$BranchCode";
$resultBank=mysqli_query($con,$queryBank);
$dataBank=mysqli_fetch_assoc($resultBank);
$BranchName = $dataBank['BranchName'];
$District = $dataBank['Address3'];
$Zone = $dataBank['ZoneRegionCode'];
//echo $Zone;

$queryzone="SELECT * FROM zoneregions where ZoneRegionCode=$Zone";
$resultzone=mysqli_query($con,$queryzone);
$datazone=mysqli_fetch_assoc($resultzone);
$BankCode = $datazone['BankCode'];
$ZoneName=$datazone['ZoneRegionName'];

$queryBankName="SELECT * FROM Bank where BankCode=$BankCode";
$resultBankName=mysqli_query($con,$queryBankName);
$dataBankName=mysqli_fetch_assoc($resultBankName);
$BankName = $dataBankName['BankName'];


$Code=substr($GSTINC, 0,2);
if ($SCode=substr($Code, 0,1)==0) {
  $SCode=substr($Code, 1,2);
}else{
  $SCode=$Code;
}

if(strpos($BookNo, 'CEUP') !== false){
    //echo "Word Found!";
  $GSTIN='09AACCC6555F1ZM';   
} elseif(strpos($BookNo, 'CEDL') !== false){
  $GSTIN='07AACCC6555F1ZQ';
  $Address2='Branch office: 3rd floor, 24-B, Garhi Main Market, East of Kailash, Delhi-110065';
} elseif(strpos($BookNo, 'CEBH') !== false){
  $GSTIN='10AACCC6555F1Z3';
  //$BanKAcc='Bank Of India, A/C No. 680020110000109, IFSC-BKID0006800';
  $Address2='Bhushan & Sandeep Niwas, Sahjanand, Rewa Road, Bhagwanpur, Muzaffarpur-824001';
} elseif(strpos($BookNo, 'CECH') !== false){
  $GSTIN='04AACCC6555F1ZW';
  //$BanKAcc='Bank Of India,  A/C No. 680020110000109, IFSC-BKID0006800';
  $Address2='2nd floor, House No. 1147, Vikas Nagar, Mouli Jagran, Chandigrah(U.T.)-160101';
}
elseif(strpos($BookNo, 'CIUP') !== false){
  $GSTIN='09AACC7970L1Z4';
  $PAN='AACCC7970L';
  //$BanKAcc='State Bank Of India, A/C No. 33893260944, IFSC-SBIN0008067';
  $Company='CYRUS INDIA SECURITIES PVT. LTD.';
  $queryBankDetails = "SELECT * FROM `bank details` WHERE ID=6";
  $resultDetails = $con2->query($queryBankDetails);
  $Details=mysqli_fetch_assoc($resultDetails);
  $BanKAcc=$Details['Bank Name'].' A/C No. '.$Details['AcNumber'].' IFSC-'.$Details['IFSC'];
}

$queryName="SELECT * FROM employees where EmployeeCode=$EmployeeID";
$resultName=mysqli_query($con,$queryName);
$dataName=mysqli_fetch_assoc($resultName);
$Employee = $dataName['Employee Name'];

    //echo $SCode;
$queryStates="SELECT * FROM states where StateCode=$SCode";
$resultState=mysqli_query($con2,$queryStates);
$dataState=mysqli_fetch_assoc($resultState);
$State = $dataState['State Name'];



function numberTowords($num)
{

  $ones = array(
    0 =>"ZERO",
    1 => "ONE",
    2 => "TWO",
    3 => "THREE",
    4 => "FOUR",
    5 => "FIVE",
    6 => "SIX",
    7 => "SEVEN",
    8 => "EIGHT",
    9 => "NINE",
    10 => "TEN",
    11 => "ELEVEN",
    12 => "TWELVE",
    13 => "THIRTEEN",
    14 => "FOURTEEN",
    15 => "FIFTEEN",
    16 => "SIXTEEN",
    17 => "SEVENTEEN",
    18 => "EIGHTEEN",
    19 => "NINETEEN",
    "014" => "FOURTEEN"
  );
  $tens = array( 
    0 => "ZERO",
    1 => "TEN",
    2 => "TWENTY",
    3 => "THIRTY", 
    4 => "FORTY", 
    5 => "FIFTY", 
    6 => "SIXTY", 
    7 => "SEVENTY", 
    8 => "EIGHTY", 
    9 => "NINETY" 
  ); 
  $hundreds = array( 
    "HUNDRED", 
    "THOUSAND", 
    "MILLION", 
    "BILLION", 
    "TRILLION", 
    "QUARDRILLION" 
  ); /*limit t quadrillion */
  $num = number_format($num,2,".",","); 
  $num_arr = explode(".",$num); 
  $wholenum = $num_arr[0]; 
  $decnum = $num_arr[1]; 
  $whole_arr = array_reverse(explode(",",$wholenum)); 
  krsort($whole_arr,1); 
  $rettxt = ""; 
  foreach($whole_arr as $key => $i){

    while(substr($i,0,1)=="0")
      $i=substr($i,1,5);
    if($i < 20){ 
      /* echo "getting:".$i; */
      $rettxt .= $ones[$i]; 
    }elseif($i < 100){ 
      if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
      if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
    }else{ 
      if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
      if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
      if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
      $rettxt .= " ".$hundreds[$key]." "; 
    }
  } 
  if($decnum > 0){
    $rettxt .= " and ";
    if($decnum < 20){
      $rettxt .= $ones[$decnum].' Paise ';
    }elseif($decnum < 100){
      $rettxt .= $tens[substr($decnum,0,1)];
      $rettxt .= " ".$ones[substr($decnum,1,1)].' Paise ';
    }
  }
  return $rettxt;
}

?>

<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Invoice</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>



  <style type="text/css">
  body{
    color: black;
  }

  .invoice {
    /*border:1px solid Black;*/
    padding:1px;
    height:900pt;
    width:700pt;
  }


  .displayNum {
    /*border:1px solid Black;*/
    border:2px solid #ccc;
    padding:1px;
    text-align: center;
  }


  .billed {
    /*border:1px solid #ccc;*/
    float:left;
  }

  .invoice-details {
    border:2px solid #ccc;
    padding: 3px;
    /*width:200pt;*/

  }

  .tax-header{
    border:2px solid black;
    text-align: center;
  }

  .amount-display {
    /*border:1px solid #ccc;*/
    float:right;
    width:200pt;
  }

  .customer-address {
    border:1px solid #ccc;
    float:right;
    margin-bottom:50px;
    margin-top:100px;
    width:200pt;
  }

  .clear-fix {
    clear:both;
    float:none;
  }

  .tablet {
    width:100%;
  }

  .th {
    text-align: center;
  }

  .td {
    text-align: center;
    margin: 5px;
  }

  .text-left {
    text-align:center;
  }

  .text-center {
    text-align:center;
  }

  .text-right {
    text-align:right;
  }



</style>
</head>  
<body> 

  <div  style="font-family: Arial;" class="container">
    <div class="row">

      <div class="col-9">
        <h3><img src="cyrus logo.png" alt="Cyrus Electronics Pvt. Ltd." style="width:40px;height:70px; margin-top: 15px;"><span style="color: red; margin-top: -50px; margin-left: 5px;"><strong><?php echo $Company; ?></strong></span></h3>
        <p style="font-size:10px; margin-left: 50px; margin-top: -40px;">
         <strong>Registered Off: Cyrus House, B44/69 Sector Q, Aliganj, Lucknow-24</strong> <br>
         Phone (0522) 4026916, 2746916 Fax (0522) 4075916 E-mail-admin@cyruselectronics.co.in
         <br>
         <strong><?php echo $Address2; ?></strong> 
       </p>
     </div>

     <div class="col-3">
      <p style="font-size:10px; color: black; margin-top: 15px;">
        Invoice No.: <strong><?php echo ' '.$BookNo ?></strong>
      </p>
      <p style="font-size:10px; color: black; margin-top: -12px;">
        Date: <strong><?php echo ' '.$Date ?></strong>
      </p>
    </div>

  </div>

  <div class="container">
    <fieldset class="invoice-details">
      <p style="margin-bottom: -1px; text-align: center; font-size:14px;">
        <strong>GSTIN <?php echo $GSTIN; ?></strong>
      </p>
      <h3 class="tax-header">Tax Invoice</h3>
      <div class="row">
        <div class="col-6">
          <p style="margin-bottom:-5px; font-size: 13px;">Billed To: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $BranchName; ?></strong></p>
          <p style="margin-bottom:-5px; font-size: 13px;">Address: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $BankName.' '.$ZoneName; ?></strong></p>
          <p style="margin-bottom:-3px; font-size: 13px;">GSTIN: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $GSTINC; ?></strong></p>
        </div>
        <div class="col-6">
          <p style="margin-bottom:-5px; font-size: 13px;">State: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $State; ?></strong></p>
          <p style="margin-bottom:-1px; font-size: 13px;">Code: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $Code; ?></strong></p>
        </div>
      </div>
    </fieldset>
  </div>

  <div class="container">
    <table class="table table-sm table-hover table-bordered border-primary" align="center">
      <thead>
        <tr>
          <th style="min-width: 20px;" scope="col">SI.No.</th>
          <th style="min-width: 200px;" scope="col">Discription</th>
          <th style="min-width: 20px;" scope="col">HSN</th>
          <th style="min-width: 20px;" scope="col">GST</th>
          <th style="min-width: 20px;" scope="col">Qty</th>
          <th style="min-width: 50px;" scope="col">Rate</th>
          <th style="min-width: 50px;" scope="col">Amount</th>
          <th style="min-width: 20px;" scope="col">Disc</th>
          <th style="min-width: 50px;" scope="col">Value</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count=0;
        $sql = "SELECT SUM(AValue), Description, HSNCode, GSTRate, Qty, Rate, Amount, AValue, Discount  FROM billdetail WHERE `BillNo`='$BookNo'";
        $resultsql = $con2->query($sql);
        $data4=mysqli_fetch_assoc($resultsql);
        $SubAmount=$data4['SUM(AValue)'];
        $queryBill = "SELECT * FROM billdetail WHERE `BillNo`='$BookNo'";
        $resultBill = $con2->query($queryBill);
        while($data3=mysqli_fetch_assoc($resultBill)){
          $count++;
          ?>
          <tr>
            <th scope="row"><?php print $count; ?></th>
            <td style="min-width: 200px;" scope="row"><?php print $data3['Description'];  ?></td>
            <td scope="row"><?php print $data3['HSNCode'];  ?></td>
            <td scope="row"><?php print $data3['GSTRate'];  ?></td>
            <td scope="row"><?php print $data3['Qty'];  ?></td>
            <td scope="row"><?php print $data3['Rate'];  ?></td>
            <td scope="row"><?php print $data3['Amount'];  ?></td>
            <td scope="row"><?php print $data3['Discount'];  ?></td>
            <td scope="row"><?php print $data3['AValue'];  ?></td>
          </tr>
          <?php 

        } 
        $Total=sprintf('%0.2f', ($SubAmount+$SGST+$IGST+$CGST));
        ?>
      </tbody>
    </table>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-9">
        <fieldset class="displayNum">
          <p>Amount in Words</p>
          <h6><?php echo 'Rupees '.numberTowords($SubAmount+$SGST+$IGST+$CGST).' ONLY'; ?></h6>
        </fieldset>
      </div>
      <div class="col-3">
        <fieldset>
          <p style="font-size: 13px; margin-bottom: -2px">Total Value: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&#x20B9 <?php echo (sprintf('%0.2f', $SubAmount)); ?></strong></p>
          <p style="font-size: 13px; margin-bottom: -4px">SGST: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&#x20B9 <?php print (sprintf('%0.2f', $SGST)); ?></strong></p>
          <p style="margin-bottom: -4px; font-size: 13px;">CGST: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&#x20B9 <?php print (sprintf('%0.2f', $CGST)); ?></strong></p>
          <p style="margin-bottom: -4px; font-size: 13px;">IGST: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&#x20B9 <?php print $IGST; ?></strong></p>
          <p style="font-size: 13px;">Amount: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&#x20B9 <?php echo $Total; ?></strong></p>
        </fieldset>
      </div>
      <div class="col-12">
        <fieldset>
          <p style="margin-bottom: -4px; font-size: 15px;">PAN No. : <strong><?php echo $PAN; ?></strong></p>
          <p style="margin-bottom: -4px; font-size: 15px;">Our Bank : <strong><?php echo $BanKAcc; ?></strong></p>
          <p style="font-size: 15px;">Service Engineer : <strong><?php echo $Employee; ?></strong></p>
        </fieldset>
      </div>
      <div class="col-7">
        <fieldset>
          <ul>
            <li style="margin-bottom: -4px; font-size: 13px;">
              Please make sure you have mentioned GSTIN in the bill if you need input credit 18% interest will be charged if payment is not made within 30 days from the date Please mention PAN If you are deducting TDS..
            </li>
            <li  style="margin-bottom: -4px; font-size: 13px;">
              All disputes will be settled to Lucknow jurisdiction.
            </li>
            <li  style="margin-bottom: -4px; font-size: 13px;">
              This is a computer generate invoice.
            </li>
            <li  style="margin-bottom: -4px; font-size: 13px;">
              IT IS MANDATORY w.e.f. 01-07-2021, TO DEDUCT TDS U/S 1940 ON BILL VALUE @ 0.1% AS PER GOI.
            </li>
          </ul>
        <!--
        <p style="margin-bottom: -4px; font-size: 13px;"></p>
        <p style="margin-bottom: -2px; font-size: 13px;"></p>
        <p style="margin-bottom: -2px; font-size: 13px;"></p>
        <p style="margin-bottom: -2px; font-size: 13px; "></p>
      -->
    </fieldset>
  </div>
  <div class="col-5" align="center">
    <fieldset>
      <br>
      <p style="font-size: 12px;"> FOR <?php echo $Company ?></p>
      <img src="cyrus sign.jpg">
      <p style="font-size: 12px;">Authorised Signature</p>
    </fieldset>
  </div>
</div>

</div>

</div>
</body>
</html>