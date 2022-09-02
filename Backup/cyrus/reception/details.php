
<?php 

include 'connection.php';
  //include 'session.php';
  //$EXEID=$_SESSION['userid'];
$ID = base64_decode($_GET['id']);
$Reference=$_GET['ref'];

if ($Reference=='Orders') {
  $sql = "SELECT * from orders where OrderID = '$ID'";  
  $result = mysqli_query($con, $sql);
  $row=mysqli_fetch_assoc($result);    
  $BranchCode = $row['BranchCode'];
  $EmployeeID = $row['EmployeeCode'];
  $AttendDate = $row['AttendDate'];
  $AssignDate = $row['AssignDate'];
  $Description=$row['Discription'];
  $OrderedBy=$row['OrderedBy'];
  $DateofInfo=$row['DateOfInformation'];
  $By='Ordered By';
}elseif ($Reference=='Complaints') {
  $sql = "SELECT * from complaints where ComplaintID = '$ID'";  
  $result = mysqli_query($con, $sql);
  $row=mysqli_fetch_assoc($result);    
  $BranchCode = $row['BranchCode'];
  $EmployeeID = $row['EmployeeCode'];
  $AttendDate = $row['AttendDate'];
  $AssignDate = $row['AssignDate'];
  $Description=$row['Discription'];
  $OrderedBy=$row['MadeBy'];
  $DateofInfo=$row['DateOfInformation'];
  $By='Made By';
}


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
  <title>Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>

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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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
      <span><strong style="float: right;">Date of information: <?php echo $DateofInfo; ?></strong></span>
      <div class="company-address">
        <strong>Branch: </strong> <?php echo $BranchName; ?><br>
        <strong>Bank: </strong> <?php echo $BankName; ?><br>
        <strong>District: </strong><?php echo $District; ?>
      </div>
      <br><br><br><br><br><br>
      <h4 align="center">Description</h4>
      <br>
      <p align="center">
        <?php echo $Description ?>
      </p>
      <br>
      <table class="table table-hover table-light table-bordered border-primary">
        <br><br><br>
        <tbody>
          <tr>
            <th scope="row">Employee Name</th>
            <td><?php echo $name ?></td>
          </tr>
          <tr>
            <th scope="row">Visit Date</th>
            <td><?php echo $AttendDate; ?></td>
          </tr>
          <tr>
            <th scope="row">Assign Date</th>
            <td><?php echo $AssignDate; ?></td>
          </tr>
          <tr>
            <tr>
              <th scope="row"><?php echo $Reference.' ID' ?></th>
              <td><?php echo $ID; ?></td>
            </tr>
            <tr>
              <tr>
                <th scope="row"><?php echo $By; ?></th>
                <td><?php echo $OrderedBy; ?></td>
              </tr>
              <tr>
              </tbody>
            </table>

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