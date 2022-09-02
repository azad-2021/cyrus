<?php  
include('connection.php');   

$Address2='';

$Company='CYRUS ELECTRONICS PVT. LTD.';
$PAN='AACCC6555F';
$GSTIN='09AACCC6555F1ZM';


if (isset($_GET['ChallanNo'])) {
  $ChallanNo=$_GET['ChallanNo'];
 //echo $ChallanNo;
  $query = "SELECT * FROM cyrusbilling.deliverychallan
  join cyrusbackend.employees on deliverychallan.EmployeeCode=employees.EmployeeCode
  join cyrusbilling.states on deliverychallan.StateCode=states.StateCode
  WHERE `ChallanNo`='$ChallanNo' and Cancelled=0";
}else{
  $EmployeeID=$_GET['EmployeeID'];
  $SDate=$_GET['SDate'];
  $query = "SELECT ChallanNo FROM deliverychallan WHERE EmployeeCode=$EmployeeID and DeliveryDate='$SDate' and Cancelled=0";

  $result = $con2->query($query);
  if (mysqli_num_rows($result)>0){

    $data=mysqli_fetch_assoc($result);
    $ChallanNo=$data['ChallanNo'];

    $query = "SELECT * FROM cyrusbilling.deliverychallan
    join cyrusbackend.employees on deliverychallan.EmployeeCode=employees.EmployeeCode
    join cyrusbilling.states on deliverychallan.StateCode=states.StateCode
    WHERE `ChallanNo`='$ChallanNo'";

  }

}
$result2 = $con2->query($query);
if (mysqli_num_rows($result2)>0){
  $data2=mysqli_fetch_assoc($result2);
  $Date = $data2['DeliveryDate'];
  $Employee=$data2['Employee Name'];
  $State=$data2['State Name'];
  $StateCode=$data2['StateCode'];
  $Address=$data2['Address'];
  $Type=$data2['Type'];


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
    <title>Challan</title>
    <link rel="icon" href="assets/img/cyrus logo.png" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="Challanbootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="Challanbootstrap/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>



    <style type="text/css">
    body{
      color: black;
      font-size: 10px;
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



    th {
      text-align: center;
      font-size: 12px;
    }

    tr,td {
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
        <h3><img src="assets/img/cyrus logo.png" alt="Cyrus Electronics Pvt. Ltd." style="width:40px;height:70px; margin-top: 15px;"><span style="color: red; margin-top: -50px; margin-left: 5px;"><strong><?php echo $Company; ?></strong></span></h3>
        <p style="font-size:10px; margin-left: 50px; margin-top: -40px;">
         <strong>Registered Off: Cyrus House, B44/69 Sector Q, Aliganj, Lucknow-24</strong> <br>
         Phone (0522) 4026916, 2746916 Fax (0522) 4075916 E-mail-admin@cyruselectronics.co.in
         <br>

       </p>
     </div>

     <div class="col-3">
      <p style="font-size:10px; color: black; margin-top: 15px;">
        Serial No.: <strong><?php echo ' '.$ChallanNo ?></strong>
      </p>
      <p style="font-size:10px; color: black; margin-top: -12px;">
        Date: <strong><?php echo ' '.date('d-M-Y',strtotime($Date)); ?></strong>
      </p>
      <p style="font-size:10px; color: black; margin-top: -12px;">
        <strong>Released for : <?php echo $Type; ?></strong>
      </p>
    </div>
    <center>
      <strong>DUPLICATE FOR TRANSPORTER</strong>
      <br>
      <strong><?php echo $GSTIN; ?></strong> 
    </center>
  </div>

  <div class="container">
    <fieldset class="invoice-details">
      <h3 class="tax-header">Delivery Challan</h3>
      <div class="row">
        <div class="col-6">
          <p style="margin-bottom:-5px; font-size: 13px;">To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $Employee; ?></strong></p>
          <p style="margin-bottom:-5px; margin-top: 5px; font-size: 13px;">Address: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $Address; ?></strong></p>
          <p style="margin-bottom:-3px; margin-top: 5px; font-size: 13px;">GSTIN: &nbsp;&nbsp;&nbsp;&nbsp; <strong>&nbsp;&nbsp;<?php echo 'NA'; ?></strong></p>
        </div>
        <div class="col-6">
          <p style="margin-bottom:-5px; font-size: 13px;">State: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $State; ?></strong></p>
          <p style="margin-top: 5px; font-size: 13px;">State Code: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $StateCode; ?></strong></p>
        </div>
      </div>
    </fieldset>
  </div>

  <div class="container">
    <table class="table table-sm table-hover table-bordered border-primary" align="center">
      <thead>
        <tr>
          <th style="min-width: 20px;" scope="col">SI.No.</th>
          <th style="min-width: 200px;" scope="col">Description</th>
          <th style="min-width: 20px;" scope="col">HSN</th>
          <th style="min-width: 20px;" scope="col">GST</th>
          <th style="min-width: 20px;" scope="col">Qty</th>
          <th style="min-width: 20px;" scope="col">Bar Code</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count=0;
        if($Type=='Railways'){

          $sql = "SELECT count(deliverychallan.ItemName) as Qty, deliverychallan.ItemName, HSNCode, GST, Amount, Rate, StateCode, BarCode, Discount FROM cyrusbilling.deliverychallan
          WHERE ChallanNo='$ChallanNo' and Type='$Type' group by deliverychallan.ItemName 
          ORDER BY ItemName";

        }elseif($Type=='Service'){

          $sql = "SELECT count(deliverychallan.ItemID) as Qty, item.ItemName, HSNCode, GST, Amount, Rate, StateCode, BarCode, Discount, deliverychallan.ItemID FROM cyrusbilling.deliverychallan
          join cyrusbackend.item on deliverychallan.ItemID=item.ItemID
          WHERE ChallanNo='$ChallanNo' and Type='$Type' group by deliverychallan.ItemID 
          ORDER BY ItemName";
        }else{          
          $sql = "SELECT count(deliverychallan.ItemID) as Qty, item.ItemName, HSNCode, GST, Amount, Rate, StateCode, BarCode, Discount, deliverychallan.ItemID FROM cyrusbilling.deliverychallan
          join cyrusbackend.item on deliverychallan.ItemID=item.ItemID
          WHERE ChallanNo='$ChallanNo' group by deliverychallan.ItemID 
          ORDER BY ItemName";
        }
        $resultsql = $con2->query($sql);

        $Am=array();
        $SA=array();
        $DA=array();
        if (mysqli_num_rows($resultsql)>0){
          while($data3=mysqli_fetch_assoc($resultsql)){
            $count++;
            if ($Type!='Railways') {
              $ItemID=$data3['ItemID'];
            }


            if ($data3['Qty']>1) {
              $Barcode='';
              $sql = "SELECT BarCode FROM cyrusbilling.deliverychallan WHERE ItemID=$ItemID and ChallanNo='$ChallanNo'";
              $result2 = $con2->query($sql);
              while($data2=mysqli_fetch_assoc($result2)){
                $Barcode .=$data2['BarCode'].' &nbsp;&nbsp';

              }
            }else{
              $Barcode=$data3['BarCode'];
            }

          //echo $Barcode;


            ?>
            <tr>
              <th scope="row"><?php print $count; ?></th>
              <td style="min-width: 200px;" scope="row"><?php print $data3['ItemName'];  ?></td>
              <td scope="row"><?php print $data3['HSNCode'];  ?></td>
              <td scope="row"><?php print $data3['GST'];  ?></td>
              <td scope="row"><?php print $data3['Qty'];  ?></td>
              <td scope="row"><?php print $Barcode;  ?></td>
            </tr>
            <?php 

            $SA[]=$data3['Rate'];
            $DA[]=$data3['Discount'];
            $Am[]=$data3['Amount'];
            $sg=$data3['GST'];
            $StateCode=$data3['StateCode'];
            if ($Type!='Railways') {
              $ItemID2=$data3['ItemID'];
            }
          } 
          $SubAmount=sprintf('%0.2f', (array_sum($SA)-array_sum($DA)));
          $Total=sprintf('%0.2f', (array_sum($Am)));
          if ($StateCode==9) {
            $SGST=$SubAmount*(($sg/2)/100);
            $CGST=$SubAmount*(($sg/2)/100);
            $IGST=0;
          }else{
            $SGST=0;
            $CGST=0;
            $IGST=$SubAmount*($sg/100);
          }
        }else{
          $SubAmount=0;
          $SGST=0;
          $CGST=0;
          $IGST=0;
          $Total=0;
          $Am[]=0;
        }
        

        ?>
      </tbody>
    </table>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-9">
        <fieldset class="displayNum">
          <p>Amount in Words</p>
          <h6><?php echo 'Rupees '.numberTowords(array_sum($Am)).' ONLY'; ?></h6>
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
          <p style="font-size: 15px;">Engineer in Reference: <strong><?php echo $Employee; ?></strong></p>
        </fieldset>
      </div>
      <div class="col-7">

      </fieldset>
    </div>
    <div class="col-5" align="center">
      <fieldset>
        <br>
        <p style="font-size: 12px;"> FOR <?php echo $Company ?></p>
        <br>
        <p style="font-size: 12px;">Authorised Signature</p>
      </fieldset>
    </div>
  </div>

</div>

</div>
</body>
</html>
<?php 
}else{
  echo '<script>alert("No data found")</script>';
}
$con->close();
$con2->close();
?>