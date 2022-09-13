<?php 
include 'connection.php';
include 'session.php';

$EmployeeCode=$_SESSION['empid'];
$UID=$_SESSION['empid'];
$shownav=1;
include"sheet.php";
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['Tuser'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['Tuser'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['Tuser'];
}

$sqlE ="SELECT TargetAmounts FROM employees where EmployeeCode=$EmployeeCode";

$resultsE = $con->query($sqlE);
$rowE=mysqli_fetch_array($resultsE,MYSQLI_ASSOC);
$Target=$rowE["TargetAmounts"];

$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
where EmployeeCode=$EmployeeCode and Cancelled=0 and BankCode not in (17,29,30,33,43,46,49,50,52) and month(BillDate)=month(current_date()) and year(BillDate)=year(current_date())";

$resultsB = $con2->query($sqlB);

if(mysqli_num_rows($resultsB)>0)
{
  $rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
  $BilledAmount=$rowB["sum(TotalBilledValue)"];

}else{
  $BilledAmount=0;

}


$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook where EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-1) and year(BillDate)=year(current_date())";
$resultsB = $con2->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount1=$rowB["sum(TotalBilledValue)"];

$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook where EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-2) and year(BillDate)=year(current_date())";
$resultsB = $con2->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount2=$rowB["sum(TotalBilledValue)"];

$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook where EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-3) and year(BillDate)=year(current_date())";
$resultsB = $con2->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount3=$rowB["sum(TotalBilledValue)"];

if ($Target>0) {

  $PendingTarget=$Target-$BilledAmount;
  $PendingTarget1=$Target-$BilledAmount1;
  $PendingTarget2=$Target-$BilledAmount2;
  $PendingTarget3=$Target-$BilledAmount3;
  if ($PendingTarget<0) {
    $PendingTarget=0;
  }

  if ($PendingTarget1<0) {
    $PendingTarget1=0;
  }

  if ($PendingTarget2<0) {
    $PendingTarget2=0;
  }

  if ($PendingTarget3<0) {
    $PendingTarget3=0;
  }

  $Billed=($BilledAmount/$Target)*100;
}




//Delayed Work

$query="SELECT count(ComplaintID) FROM cyrusbackend.complaints
join branchdetails on complaints.BranchCode=branchdetails.BranchCode
Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=1 and Address3 not like '%reserved%' and datediff(AttendDate, AssignDate)>2 and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
$result=mysqli_query($con,$query);
$row1C = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date()) and datediff(AttendDate, AssignDate)>7";
$result=mysqli_query($con,$query);
$row2C = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date()) and datediff(ExpectedCompletion, AttendDate)<0";
$result=mysqli_query($con,$query);
$row3C = mysqli_fetch_array($result);
$DelayedWork=$row1C["count(ComplaintID)"]+$row2C["count(OrderID)"]+$row3C["count(OrderID)"];


//Total Attended Work

$query="SELECT count(ComplaintID) FROM cyrusbackend.complaints
join branchdetails on complaints.BranchCode=branchdetails.BranchCode
Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=1 and Address3 not like '%reserved%' and month(AttendDate)= month(current_date()) and year(AttendDate)=year(current_date())";
$result=mysqli_query($con,$query);
$row1A = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
$result=mysqli_query($con,$query);
$row2A = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
$result=mysqli_query($con,$query);
$row3A = mysqli_fetch_array($result);


$TotalWork=$row1A["count(ComplaintID)"]+$row2A["count(OrderID)"]+$row3A["count(OrderID)"];
if ($TotalWork>0) {

  $PercentWork=(($TotalWork-$DelayedWork)/$TotalWork)*100;
}

//Total Pending Work

$query="SELECT count(ComplaintID) FROM cyrusbackend.complaints
join branchdetails on complaints.BranchCode=branchdetails.BranchCode
Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=0 and Address3 not like '%reserved%'";
$result=mysqli_query($con,$query);
$row1P = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
join branchdetails on orders.BranchCode=branchdetails.BranchCode
WHERE EmployeeCode=$EmployeeCode and Attended=0 and AssignDate is not null and Discription not like '%AMC%' and Address3 not like '%reserved%'";
$result=mysqli_query($con,$query);
$row2P = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
join branchdetails on orders.BranchCode=branchdetails.BranchCode
WHERE EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=0 and Discription like '%AMC%' and Address3 not like '%reserved%'";
$result=mysqli_query($con,$query);
$row3P = mysqli_fetch_array($result);

$PendingWork=$row1P["count(ComplaintID)"]+$row2P["count(OrderID)"]+$row3P["count(OrderID)"];


//Total Overdue Work

$query="SELECT count(ComplaintID) FROM cyrusbackend.complaints
join branchdetails on complaints.BranchCode=branchdetails.BranchCode
Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=0 and Address3 not like '%reserved%' and datediff(current_date(), AssignDate)>2";
$result=mysqli_query($con,$query);
$row1O = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
join branchdetails on orders.BranchCode=branchdetails.BranchCode
WHERE EmployeeCode=$EmployeeCode and Attended=0 and AssignDate is not null and Discription not like '%AMC%' and Address3 not like '%reserved%' and datediff(current_date(), AssignDate)>7";
$result=mysqli_query($con,$query);
$row2O = mysqli_fetch_array($result);

$query="SELECT count(OrderID) FROM cyrusbackend.orders
join branchdetails on orders.BranchCode=branchdetails.BranchCode
WHERE EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=0 and Discription like '%AMC%' and Address3 not like '%reserved%' and datediff(ExpectedCompletion, current_date())<0";
$result=mysqli_query($con,$query);
$row3O = mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Performance</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/cyrus logo.png" rel="icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <script src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  table, tr, th{
    font-size: 14px;
    align-items: center;
  }
  a {
    cursor: pointer;
    
  }


  .overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("assets/img/loader.gif") center no-repeat;
  }
  /* Turn off scrollbar when body element has the loading class */
  body.loading{
    overflow: hidden;   
  }
  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay{
    display: block;
  }

</style>
</head>
<body>
 <div class="overlay"></div>
 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="assets/img/cyrus logo.png" alt="">
      <span class="d-none d-lg-block">Cyrus</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar">
    <?php echo $wish; ?>
  </div>
  <?php 
  include "nav.php";
    //include "modals.php";
  ?>
</header>
<?php 
include "sidebar.php";
include "modals.php";
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">/ Performance</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">

        <center>
          <div class="pagetitle">
            <h1><?php echo date('M',strtotime($timestamp));;?></h1>
          </div>

        </center>
        <!--
        <div class="col-lg-12">
          <div id="piechart" align="center"></div>
        </div>
      -->

    </div>

    <!-- Left side columns -->
    <div class="col-lg-12">

      <div class="card info-card revenue-card">

        <div class="card-body">
          <h5 class="card-title">Your Performance Current Month<span>|</span><br></h5>

          <div class=" align-items-center">
            <center>
              <div class="pagetitle">
                <h1>Billing Target</h1>
              </div>
            </center>
            <table class="table table-hover table-bordered border-primary">

              <thead>
                <tr>
                  <th scope="col">Type</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Achieved</th>
                  <th scope="col">Performance</th>
                </tr>
              </thead>
              <br>
              <tbody>
                <tr>
                  <th scope="row">Target</th>
                  <td><?php echo $Target; ?></td>
                  <td><?php echo $BilledAmount; ?></td>
                  <td><?php
                  if ($Target>0) {
                   echo sprintf('%0.2f', (($BilledAmount)/$Target)*100).' %';
                 }else{
                  echo '100 %';
                } 
              ?></td>
            </tr>
          </tbody>
        </table>
        <center>
          <div class="pagetitle">
            <h1>Attended Work</h1>
          </div>
        </center>
        <table class="table table-hover table-bordered border-primary">
          <thead>
            <tr>
              <th scope="col">Type</th>
              <th scope="col">Total</th>
              <th scope="col">Delayed</th>
              <th scope="col">Performance</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Order</th>
              <td><?php echo $row2A["count(OrderID)"]; ?></td>
              <td><?php echo $row2C["count(OrderID)"]; ?></td>
              <td><?php

              if ($row2A["count(OrderID)"]>0) {

                echo sprintf('%0.2f', (($row2A["count(OrderID)"]-$row2C["count(OrderID)"])/$row2A["count(OrderID)"])*100 ).' %'; 
              }else{
                echo "100 %";
              }
              ?>

            </td>
          </tr>

          <tr>
            <th scope="row">Complaints</th>
            <td><?php echo $row1A["count(ComplaintID)"]; ?></td>
            <td><?php echo $row1C["count(ComplaintID)"]; ?></td>
            <td>

              <?php

              if ($row1A["count(ComplaintID)"]>0) {

                echo sprintf('%0.2f', (($row1A["count(ComplaintID)"]-$row1C["count(ComplaintID)"])/$row1A["count(ComplaintID)"])*100 ).' %'; 
              }else{
                echo "100 %";
              }
              ?>

            </td>
          </tr>
          <tr>
            <th scope="row">AMC</th>
            <td><?php echo $row3A["count(OrderID)"]; ?></td>
            <td><?php echo $row3C["count(OrderID)"]; ?></td>
            <td>

              <?php

              if ($row3A["count(OrderID)"]>0) {

                echo sprintf('%0.2f', (($row3A["count(OrderID)"]-$row3C["count(OrderID)"])/$row3A["count(OrderID)"])*100 ).' %'; 
              }else{
                echo "100 %";
              }
              ?>

            </td>
          </tr>
                <!--
                <tr>
                  <th scope="row">Overdue</th>
                  <td><?php echo $row2O["count(OrderID)"]; ?></td>
                  <td><?php echo $row1O["count(ComplaintID)"]; ?></td>
                  <td><?php echo $row3O["count(OrderID)"]; ?></td>
                  <td><?php echo sprintf('%0.2f', (($PendingWork-($row2O["count(OrderID)"]+ $row1O["count(ComplaintID)"]+$row3O["count(OrderID)"]))/$PendingWork)*100).' %' ?></td>
                </tr>
              -->
            </tr>
          </tbody>
        </table>
        <center>
          <div class="pagetitle">
            <h1>Pending Work <br> Performance will be calculated at the end of the month.</h1>
          </div>
        </center>
      </div>
    </div>
  </div>

</div>

<?php 

if ($Target>0) {
?>

<div class="row">

  <center>
    <div class="pagetitle">
      <h1>Traget History</h1>
    </div>
  </center>

  <div class="col-lg-4">
    <h5 align="center" style="margin:10px"><?php echo date('M', strtotime("-3 month"));?></h5>
    <div id="piechart4" align="center"></div>
  </div>
  <div class="col-lg-4">
    <h5 align="center" style="margin:10px"><?php echo date('M', strtotime("-2 month"));?></h5>
    <div id="piechart3" align="center"></div>
  </div>
  <div class="col-lg-4">
    <h5 align="center" style="margin:10px"><?php echo date('M', strtotime("-1 month"));?></h5>
    <div id="piechart2" align="center"></div>
  </div>
</div>
<?php } ?>
</div>
</div>
<!-- End Left side columns -->
</section>

</main>
<!-- End #main -->
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright 2022 <strong><span>Cyrus</span></strong>. All Rights Reserved
  </div>
</footer>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>




<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(drawChart2);
  google.charts.setOnLoadCallback(drawChart3);
  google.charts.setOnLoadCallback(drawChart4);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTarget?>, <?php echo $PendingTarget?>],
      ['Billed : '+<?php echo $BilledAmount?>, <?php echo $BilledAmount?>]
      ]);


    var options = {
      'title':'Billing Target : ' + <?php echo $Target?>,
      colors: ['red', 'green', ],
      fontSize: 15,
      chartArea: {
        left: "10%",
        top: "20%",
        bottom: "10%",
        height: "90%",
        width: "90%",

      }

    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
  function drawChart2() {
    var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTarget1?>, <?php echo $PendingTarget1?>],
      ['Billed : '+<?php echo $BilledAmount1?>, <?php echo $BilledAmount1?>]
      ]);

    var options = {
      legend: 'none',
      colors: ['red', 'green', ],
      fontSize: 15,
      chartArea: {
        left: "10%",
        top: "20%",
        bottom: "10%",
        height: "90%",
        width: "90%",
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
    chart.draw(data, options);
  }

  function drawChart3() {
    var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTarget2?>, <?php echo $PendingTarget2?>],
      ['Billed : '+<?php echo $BilledAmount2?>, <?php echo $BilledAmount2?>]
      ]);

    var options = {
      legend: 'none',
      colors: ['red', 'green', ],
      fontSize: 15,
      chartArea: {
        left: "10%",
        top: "20%",
        bottom: "10%",
        height: "90%",
        width: "90%",

      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
    chart.draw(data, options);
  }

  function drawChart4() {
    var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTarget3?>, <?php echo $PendingTarget3?>],
      ['Billed : '+<?php echo $BilledAmount3?>, <?php echo $BilledAmount3?>]
      ]);

    var options = {
      colors: ['red', 'green', ],
      fontSize: 15,
      legend: 'none',
      chartArea: {
        left: "10%",
        top: "20%",
        bottom: "10%",
        height: "90%",
        width: "90%",

      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
    chart.draw(data, options);
  }

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>