
<?php 

include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
$ApprovalID = $_GET['apid'];

$sql = "SELECT * from estimates where ApprovalID = '$ApprovalID' and Qty != 0";  
$resultB = mysqli_query($con2, $sql);

$sql2 = "SELECT * from approval where ApprovalID = '$ApprovalID'";  
$result2 = mysqli_query($con, $sql2);
$row=mysqli_fetch_assoc($result2);    
$BranchCode = $row['BranchCode'];
$BranchCode = $row['BranchCode']; 
$EmployeeID = $row['EmployeeID'];
$Date = $row['VisitDate'];

$queryName="SELECT * FROM employees where EmployeeCode=$EmployeeID";
$resultName=mysqli_query($con,$queryName);
$dataName=mysqli_fetch_assoc($resultName);
$name = $dataName['Employee Name'];  



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

$queryBankName="SELECT * FROM Bank where BankCode=$BankCode";
$resultBankName=mysqli_query($con,$queryBankName);
$dataBankName=mysqli_fetch_assoc($resultBankName);
$BankName = $dataBankName['BankName'];


$Sub=0;

?>




<html>

<head>
  <title>Estimate</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap core CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
  body {
    padding: 50px;    
    font-family: Verdana;
    font-size: 16px;
  }

  div.invoice {
    /*border:1px solid Black;*/
    padding:1px;
    height:900pt;
    width:700pt;
  }

  div.company-address {
    /*border:1px solid #ccc;*/
    float:left;
    width:800pt;
  }

  div.invoice-details {
    border:1px solid #ccc;
    float:right;
    width:200pt;
  }

  div.customer-address {
    border:1px solid #ccc;
    float:right;
    margin-bottom:50px;
    margin-top:100px;
    width:200pt;
  }

  div.clear-fix {
    clear:both;
    float:none;
  }

  table {
    width:100%;
  }

  th {
    text-align: center;
  }

  td {
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

<script>
  function printContent(el){
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
  }
</script>

</head>
<div id="invoice">

  <div class="container" align="center">
    <h1><img src="cyrus logo.png" alt="Cyrus Electronics Pvt. Ltd." style="width:50px;height:60px;">
      <strong>Cyrus Electronics Pvt. Ltd.</strong></h1>
    </div>
    <br>

    <div class="container">
      <span><strong style="float: right;">Date: <?php echo $Date; ?></strong></span>
      <div class="company-address">
        <strong>The Branch Manager</strong><br>
        <strong>Branch: </strong> <?php echo $BranchName; ?><br>
        <strong>Bank: </strong> <?php echo $BankName; ?><br>
        <strong>District: </strong><?php echo $District; ?>
      </div>
      <br><br><br><br><br><br>
      <h4 align="center">Sub: Estimate for items in Security / Surveillance System</h4>
      <br>
      <p>Dear Sir,
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        After checking the security / Surveillance system, it was found that the undermentioned items are required to be installed for smooth functioning of the equipment. So, we are hereby presenting you the estimate for the same. 
      </p>

      <br>

      <div class="clear-fix"></div>
      <table border='1' cellspacing='0' class="table table-hover table-border border-primary">
        <thead>
          <tr>
            <th width=20>S.No.</th>
            <th width=250>Description</th>
            <th width=80>Unit Price</th>
            <th width=100>Quantity</th>
            <th width=100>Total price</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $count = 1;
          $Sub = 0;
          while($data=mysqli_fetch_assoc($resultB)){
            $RateID = $data['RateID'];
            $QTY = $data['Qty'];
        //$Discription = $data['peDiscription'];
            $query= "SELECT * FROM rates WHERE RateID=$RateID";
            $result=mysqli_query($con2,$query);
            $dataMaterial=mysqli_fetch_assoc($result);
            $Description = $dataMaterial['Description'];
            $Rate = $dataMaterial['Rate'];

            ?>

            <tr>
              <td >
                <?php echo $count; ?>
              </td>                         
              <td >
                <?php echo $Description; ?>
              </td>
              <td >
               ₹<?php echo $Rate; ?>
             </td>
             <td >
              <?php echo $QTY; ?>
            </td>
            <td >
              ₹<?php echo $SubTotal =  $QTY* $Rate; ?>
            </td>


          </tr>
          <?php
          $count++;
          $Sub = $Sub + $SubTotal;
        }

        ?>
      </tbody>
    </table>
    <br>
    <label><strong>Total : ₹<?php echo $Sub;?></strong></label><br>
    <strong>Note:</strong>
    <p>
      <ol>
        <li>
          Wiring (if mentioned) is an approximation and it will be charged on actual consumption basis.
        </li>
        <li>100% payment at the time of installation.</li>
        <li>GST shall be charged as per prevailing rates. (if applicable)</li>
      </ol>
      Hope you find the estimate satisfactory as per your requirement. We request you to kindly approve the estimates as soon as possible so that security / surveillance system can be made functional in the branch at the earliest.
      <br><br>
      With Warm Regards<p align="right">Name of Field Staff: <?php echo $name; ?></p>
      For Cyrus ELectronics Pvt. Ltd.
    </p>
  </div>
  <center>
    <br><br>
    <p style="font-size: 10px;"><strong>Cyrus house, B 44/69 Sector Q, Aliganj, Lucknow-24 Ph. (0522)274916, 2374190</strong></p>
  </center>
</div>
</div>
</div>
<div align="center">
 <button id="print" onclick="printContent('invoice'); " class=" btn btn-primary">Print</button>
</div>
</fieldset>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


</script>
<form method="post" action="" name="Home"></form>
</body>


</html>


