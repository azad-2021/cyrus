






































































































































































 
                        <td><?php echo $row["BankName"]; ?></td>
                        <td><?php echo $row["BranchName"]; ?></td>
                        <td><?php echo $row["DateOfInformation"]; ?></td>
                        <td><?php echo $row["Discription"]; ?></td>
                        <td><?php echo $row["OrderID"]; ?></td>
                        <td><?php echo $row["ZoneRegionName"]; ?></td>
                        <th scope="col" style="min-width:100px">Order ID</th>
                        <th scope="col" style="min-width:150px">Order Date</th>
                        <th scope="col" style="min-width:200px">Bank</th>
                        <th scope="col" style="min-width:200px">Branch</th>
                        <th scope="col" style="min-width:200px">Zone</th>
                        <th scope="col" style="min-width:300px">Description</th>
                       <tr>
                       ?>
                      $result = mysqli_query($con,$sql);
                      $sql ="SELECT BankName, ZoneRegionName, BranchName, OrderID, Discription, DateOfInformation FROM cyrusbackend.orders
                      </tr>
                      </tr>
                      <?php 
                      <h6><?php echo $TotalZones; ?></h6>
                      <h6><?php echo $VisitedZones; ?></h6>
                      <i class="bi bi-people"></i>
                      <td><?php echo $row["BankName"]; ?></td>
                      <td><?php echo $row["BranchName"]; ?></td>
                      <td><?php echo $row["ComplaintID"]; ?></td>
                      <td><?php echo $row["DateOfInformation"]; ?></td>
                      <td><?php echo $row["Discription"]; ?></td>
                      <td><?php echo $row["ZoneRegionName"]; ?></td>
                      <th scope="col" style="min-width:120px">Complaint ID</th>
                      <th scope="col" style="min-width:150px">Complaint Date</th>
                      <th scope="col" style="min-width:200px">Bank</th>
                      <th scope="col" style="min-width:200px">Branch</th>
                      <th scope="col" style="min-width:200px">Zone</th>
                      <th scope="col" style="min-width:300px">Description</th>
                      <tr class="text-dark">
                      join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                      join branchdetails on orders.BranchCode=branchdetails.BranchCode
                      join districts on branchdetails.Address3=districts.District
                      Order by DateOfInformation desc limit 10";
                      WHERE ControlerID=$EXEID and AssignDate is null
                      while ($row = mysqli_fetch_array($result)) { 
                     <tr>
                     ?>
                    $result = mysqli_query($con,$sql);
                    $sql ="SELECT BankName, ZoneRegionName, BranchName, ComplaintID, Discription, DateOfInformation FROM cyrusbackend.complaints
                    <!--
                    </div>
                    </div>
                    </div>
                    </thead>
                    </tr>
                    </tr>
                    <?php 
                    <?php } ?>
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <div class="ps-3">
                    <div class="ps-3">
                    <h6><?php echo ''; ?></h6>
                    <tbody>
                    <thead>
                    <tr class="text-dark">
                    join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                    join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                    join districts on branchdetails.Address3=districts.District
                    Order by DateOfInformation desc limit 10";
                    WHERE ControlerID=$EXEID and AssignDate is null
                    while ($row = mysqli_fetch_array($result)) { 
                  -->
                  </div>
                  </div>
                  </div>
                  </tbody>
                  </thead>
                  <?php } ?>
                  <div class="d-flex align-items-center">
                  <div class="d-flex align-items-center">
                  <div class="d-flex align-items-center">
                  <div class="ps-3">
                  <div id="piechart2" align="center" style="width: 180px;"></div>
                  <div id="piechart3" align="center" style="width: 180px;"></div>
                  <div id="piechart4" align="center" style="width: 180px;"></div>
                  <h5 class="card-title">Billing Target <span><?php echo date('M', strtotime("-1 month"));?><a style="float:right" href="employeetarget1.php" target="_blank">Show All</a></span></h5>
                  <h5 class="card-title">Billing Target <span><?php echo date('M', strtotime("-2 month"));?><a style="float:right" href="employeetarget2.php" target="_blank">Show All</a></span></h5>
                  <h5 class="card-title">Billing Target <span><?php echo date('M', strtotime("-3 month"));?><a style="float:right" href="employeetarget3.php" target="_blank">Show All</a></span></h5>
                  <h5 class="card-title">Completed <span>| Visits</h5>
                  <h5 class="card-title">Total <span>| Visits</h5>
                  <h5 class="card-title">Your <span>| Performance</span></h5>
                  <table class="table text-start align-middle table-bordered table-hover mb-0">
                  <tbody>
                  <thead>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </table>
                </tbody>
                <div class="card-body">
                <div class="card-body">
                <div class="card-body">
                <div class="card-body">
                <div class="card-body">
                <div class="card-body">
                <div class="table-responsive container">
                <div id="piechart" align="center"></div>
                <h5 class="card-title"> <span>| Orders</span></h5>
                <h5 class="card-title">Billing Target <span>  <?php echo date('M',strtotime($timestamp));;?><a style="float:right" href="employeetarget.php" target="_blank">Show All</a></span></h5>
                <table class="table text-start align-middle table-bordered table-hover mb-0">
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </table>
              <div class="card info-card customers-card">
              <div class="card info-card revenue-card">
              <div class="card info-card sales-card">
              <div class="card">
              <div class="card">
              <div class="card">
              <div class="card-body">
              <div class="card-body">
              <div class="table-responsive container">
              <h5 class="card-title">Recent  Received <span>| Complaints</span></h5>
            <!-- Customers Card -->
            <!-- End Revenue Card -->
            <!-- End Sales Card -->
            <!-- Revenue Card -->
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            <div class="card recent-sales overflow-auto">
            <div class="card">
            <div class="card-body">
            <div class="col-lg-4">
            <div class="col-lg-4">
            <div class="col-lg-4">
            <div class="col-xxl-4 col-md-4">
            <div class="col-xxl-4 col-md-4">
            <div class="col-xxl-4 col-xl-4">
          <!-- End Customers Card -->
          <!-- Recent Sales -->
          <!-- Reports -->
          </div>
          </div>
          </div>
          </div>
          <div class="col-12">
          <div class="col-12">
          <div class="row">
          <div class="row">
          <li class="breadcrumb-item active">Performance</li>
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <!-- Left side columns -->
        </div>
        </ol>
        <div class="col-lg-12">
        <img src="assets/img/cyrus logo.png" alt="">
        <ol class="breadcrumb">
        <span class="d-none d-lg-block">Cyrus</span>
        bottom: "10%",
        bottom: "10%",
        bottom: "10%",
        bottom: "10%",
        height: "90%",
        height: "90%",
        height: "90%",
        height: "90%",
        left: "10%",
        left: "10%",
        left: "10%",
        left: "10%",
        top: "20%",
        top: "20%",
        top: "20%",
        top: "20%",
        width: "90%",
        width: "90%",
        width: "90%",
        width: "90%",
      'title':'Billing Target : ' + <?php echo $Target?>,
      //echo $PendingTarget3.' <br>';
      //echo $Target.' <br>';
      <!-- End Recent Sales -->
      </a>
      </div>
      </nav>
      <?php echo $wish; ?>
      <a href="index.php" class="logo d-flex align-items-center">
      <div class="row">
      <h1>Dashboard</h1>
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <nav>
      ['Billed : '+<?php echo $AcheivedTarget1?>, <?php echo $AcheivedTarget1?>]
      ['Billed : '+<?php echo $AcheivedTarget2?>, <?php echo $AcheivedTarget2?>]
      ['Billed : '+<?php echo $AcheivedTarget3?>, <?php echo $AcheivedTarget3?>]
      ['Billed : '+<?php echo $AcheivedTarget?>, <?php echo $AcheivedTarget?>]
      ['Pending : '+ <?php echo $PendingTarget1?>, <?php echo $PendingTarget1?>],
      ['Pending : '+ <?php echo $PendingTarget2?>, <?php echo $PendingTarget2?>],
      ['Pending : '+ <?php echo $PendingTarget3?>, <?php echo $PendingTarget3?>],
      ['Pending : '+ <?php echo $PendingTarget?>, <?php echo $PendingTarget?>],
      ['Pending', 'Achieved'],
      ['Pending', 'Achieved'],
      ['Pending', 'Achieved'],
      ['Pending', 'Achieved'],
      ]);
      ]);
      ]);
      ]);
      chartArea: {
      chartArea: {
      chartArea: {
      chartArea: {
      colors: ['red', 'green', ],
      colors: ['red', 'green', ],
      colors: ['red', 'green', ],
      colors: ['red', 'green', ],
      fontSize: 15,
      fontSize: 15,
      fontSize: 15,
      fontSize: 15,
      legend: 'none',
      legend: 'none',
      legend: 'none',
      }
      }
      }
      }
    $row2 = mysqli_fetch_array($result2);
    &copy; Copyright 2022 <strong><span>Cyrus</span></strong>. All Rights Reserved
    //echo "New record created successfully";
    //include "modals.php";
    </div>
    </div>
    </div><!-- End Logo -->
    </div><!-- End Page Title -->
    <?php 
    <div class="d-flex align-items-center justify-content-between">
    <div class="pagetitle">
    <div class="search-bar">
    <section class="section dashboard">
    ?>
    chart.draw(data, options);
    chart2.draw(data2, options2);
    chart2.draw(data2, options2);
    chart2.draw(data2, options2);
    echo "Error: " . $sql . "<br>" . $con3->error;
    include "nav.php";
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
    var chart2 = new google.visualization.PieChart(document.getElementById('piechart3'));
    var chart2 = new google.visualization.PieChart(document.getElementById('piechart4'));
    var data = google.visualization.arrayToDataTable([
    var data2 = google.visualization.arrayToDataTable([
    var data2 = google.visualization.arrayToDataTable([
    var data2 = google.visualization.arrayToDataTable([
    var options = {
    var options2 = {
    var options2 = {
    var options2 = {
    };
    };
    };
    };
   $sql= "INSERT INTO cyrusbackend.banklogs (ExecutiveID, NoOfBanks, NoOfZones, NoOfBranchs)
   if ($con3->query($sql) === TRUE) {
   VALUES ($EXEID, $BankCount, $ZoneCount, $BranchCount)";
   } else {
  $_SESSION['query']=$EXEID;
  $AceivedArray1[]=$row5["sum(TotalBilledValue)"];
  $AceivedArray2[]=$row5["sum(TotalBilledValue)"];
  $AceivedArray3[]=$row5["sum(TotalBilledValue)"];
  $AceivedArray[]=$row4["sum(TotalBilledValue)"];
  $Bankarr = $row['BankName'].' '.$row['ZoneRegionName'];
  $BankCount=$row["BankCount"];
  $BranchCount=$row["BranchCount"];
  $data2[]=array("Unassigned"=>$PendingWorkE, "Employee"=>$Employee);
  $data3[]=array("Payment"=>sprintf('%0.2f', $PendingBill), "Bank"=>$Bankarr);
  $Employee=$rowE["Employee Name"];
  $EmployeeCode=$rowT["EmployeeCode"];
  $EmployeeID=$rowE["EmployeeCode"];
  $EXEID=$_GET['user'];
  $EXEID=$_SESSION['query'];
  $EXEID=$_SESSION['userid'];
  $PendingBill  = $row['TotalAmount']-$row['ReceiveAMOUNT'];
  $PendingTarget1=0;
  $PendingTarget2=0;
  $PendingTarget3=0;
  $PendingTarget=0;
  $PendingWorkE= $row3["count(vallordersd.OrderID)"] + $row["count(ComplaintID)"] + $row2["count(vallordersd.OrderID)"];            
  $query = "SELECT * FROM cyrusbackend.banklogs WHERE ExecutiveID=$EXEID and NoOfBanks=$BankCount and NoOfZones=$ZoneCount and  NoOfBranchs=$BranchCount and month(`TimeStamp`)=month(current_date())";
  $query2="SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
  $query3 = "SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE AssignDate is null and Discription not like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
  $query4="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  $query5="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  $query5="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  $query5="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.vallcomplaintsd WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";
  $result2=mysqli_query($con,$query2);
  $result2=mysqli_query($con3,$query);
  $result3 = mysqli_query($con, $query3);
  $result4=mysqli_query($con2,$query4);
  $result5=mysqli_query($con2,$query5);
  $result5=mysqli_query($con2,$query5);
  $result5=mysqli_query($con2,$query5);
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $row2 = mysqli_fetch_array($result2);
  $row3 = mysqli_fetch_array($result3);
  $row4 = mysqli_fetch_array($result4);
  $row5 = mysqli_fetch_array($result5);
  $row5 = mysqli_fetch_array($result5);
  $row5 = mysqli_fetch_array($result5);
  $TargetArray[]=$rowT["TargetAmounts"];
  $wish= "Good Afternoon ".$_SESSION['user'];
  $wish= "Good Evening ".$_SESSION['user'];
  $wish= "Good Morning ".$_SESSION['user'];
  $ZoneCount=$row["ZoneCount"];
  <!-- ======= Header ======= -->
  <!-- End Left side columns -->
  <!-- Favicons -->
  <!-- Google Fonts -->
  <!-- Template Main CSS File -->
  <!-- Vendor CSS Files -->
  </div>
  </div>
  </header><!-- End Header -->
  <?php 
  <div class="copyright">
  <header id="header" class="header fixed-top d-flex align-items-center">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/img/cyrus logo.png" rel="icon">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <main id="main" class="main">
  <meta charset="utf-8">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script src="assets/js/sweetalert.min.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <title>Performance</title>
  ?>
  function drawChart() {
  function drawChart2() {
  function drawChart3() {
  function drawChart4() {
  google.charts.load('current', {'packages':['corechart']});
  google.charts.load('current', {'packages':['corechart']});
  google.charts.load('current', {'packages':['corechart']});
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(drawChart2);
  google.charts.setOnLoadCallback(drawChart3);
  google.charts.setOnLoadCallback(drawChart4);
  if (mysqli_num_rows($result2)>0)
  include "modals.php";
  include "sidebar.php";
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-1) and year(BillDate)=year(current_date())";
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-2) and year(BillDate)=year(current_date())";
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-3) and year(BillDate)=year(current_date())";
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=month(current_date()) and year(BillDate)=year(current_date())";
  {
  }
  }
  }
  }
  }
  }else{
 $AMC=$row2["count(OrderID)"];
 $AO=$row3["count(OrderID)"];
 $data[]=array("Work"=>$PendingWork, "Employee"=>$Employee);
 $Employee = $rowE['Employee Name'];
 $Employee=$rowE["Employee Name"];
 $EmployeeID=$rowE["EmployeeCode"];
 $PendingWork  = $AO+$row['count(ComplaintID)']+$AMC;
 $query2="SELECT count(OrderID) FROM cyrusbackend.allorders
 $query3 = "SELECT count(OrderID) FROM allorders
 $query="SELECT count(ComplaintID) FROM cyrusbackend.allcomplaint 
 $result2=mysqli_query($con,$query2);
 $result3 = mysqli_query($con, $query3);
 $result=mysqli_query($con,$query);
 $row = mysqli_fetch_array($result);
 $row2 = mysqli_fetch_array($result2);
 $row3 = mysqli_fetch_array($result3);
 $TotalPendingWork=$TotalPendingWork+$PendingWork;
 join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
 join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
 join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
 join cyrusbackend.districts on allcomplaint.Address3=districts.District
 join cyrusbackend.districts on allorders.Address3=districts.District
 join cyrusbackend.districts on allorders.Address3=districts.District
 WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$EmployeeID and ControlerID=$EXEID";
 WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeID and ControlerID=$EXEID";
 WHERE EmployeeCode=$EmployeeID and AssignDate is not NULL and Attended=0 and Discription not like '%AMC%' and ControlerID=$EXEID";
$AceivedArray=array();
$AcheivedTarget1=array_sum($AceivedArray1);
$AcheivedTarget2=array_sum($AceivedArray2);
$AcheivedTarget3=array_sum($AceivedArray3);
$AcheivedTarget=array_sum($AceivedArray);
$con->close();
$con2->close();
$Date = date('Y-m-d',strtotime($timestamp));
$Hour = date('G');
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));
$PendingMaterials=$row["PendingMaterials"];
$PendingPayment=$row["TotalAmount"]-$row["ReceiveAMOUNT"];
$PendingPaymentReserved=$row["TotalAmount"]-$row["ReceiveAMOUNT"];
$PendingTarget1=$Target-$AcheivedTarget1;
$PendingTarget2=$Target-$AcheivedTarget2;
$PendingTarget3=$Target-$AcheivedTarget3;
$PendingTarget=$Target-$AcheivedTarget;
$query = "SELECT count(DISTINCT BankCode) as BankCount, count(DISTINCT ZoneRegionCode) as ZoneCount, count(DISTINCT BranchCode) as BranchCount FROM cyrusbackend.branchdetails
$query="SELECT  sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
$query="SELECT `Employee Name`, employees.EmployeeCode FROM cyrusbackend.employees
$query="SELECT count(orders.OrderID) as PendingMaterials
$query="SELECT DISTINCT EmployeeCode, `Employee Name` FROM employees
$query="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.allgstbills
$queryT="SELECT TargetAmounts, EmployeeCode FROM cyrusbackend.employees
$result = mysqli_query($con,$sql);
$result = mysqli_query($con3,$sql);
$result = mysqli_query($con3,$sql);
$result = mysqli_query($con3,$sql);
$result=mysqli_query($con,$query);
$result=mysqli_query($con,$query);
$result=mysqli_query($con,$query);
$result=mysqli_query($con2,$query);
$resultT=mysqli_query($con,$queryT);
$resultTech=mysqli_query($con,$query);
$resultTech=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$row = mysqli_fetch_array($result);
$row = mysqli_fetch_array($result);
$row = mysqli_fetch_array($result);
$row1 = mysqli_fetch_array($result);
$row2 = mysqli_fetch_array($result);
$row3 = mysqli_fetch_array($result);
$sql ="SELECT * FROM cyrusbackend.banklogs WHERE month(TimeStamp)=month(curdate()) and ExecutiveID=$EXEID Order By ID DESC LIMIT 1";
$sql ="SELECT BankName, ZoneRegionName, EmployeeCode,  BranchName, BookNo, BankCode, ZoneRegionCode, BillDate, sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
$sql ="SELECT count(DISTINCT ZoneRegionCode) as ZoneCount FROM cyrusbackend.bankvisits
$sql ="SELECT count(DISTINCT ZoneRegionCode) as ZoneCount FROM cyrusbackend.bankvisits
$Target=array_sum($TargetArray);
$TargetArray=array();
$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$timestamp =date('y-m-d H:i:s');
$TotalPendingWork=0;
$TotalZones=$row3["NoOfZones"];
$Type=$_SESSION['usertype'];
$VisitedZones=$row1["ZoneCount"] + $row2["ZoneCount"];
//echo $_SESSION['user'];
//print_r($data2);
//unassigned work
<!-- ======= Footer ======= -->
<!-- End #main -->
<!-- End Footer -->
<!-- Template Main JS File -->
<!-- Vendor JS Files -->
<!DOCTYPE html>
</body>
</footer>
</head>
</html>
</main>
</script>
</section>
<?php 
<?php 
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<body>
<footer id="footer" class="footer">
<head>
<html lang="en">
<script src="ajax.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
?>
?>
date_default_timezone_set('Asia/Calcutta');
FROM cyrusbackend.orders join demandbase on orders.OrderID=demandbase.OrderID
group by BankCode, ZoneRegionCode
group by EmployeeCode";
group by employees.EmployeeCode
if ( $Hour >= 1 && $Hour <= 11 ) {
if ($PendingTarget1<0) {
if ($PendingTarget2<0) {
if ($PendingTarget3<0) {
if ($PendingTarget<0) {
if ($row["BankCount"]>0) {
if (isset($_GET['user'])) {
include 'connection.php';
include 'session.php';
join `cyrus regions` on bankvisits.ExecutiveID=`cyrus regions`.SubControllerID
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
join branchdetails on orders.BranchCode=branchdetails.BranchCode
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
join cyrusbackend.districts on branchdetails.Address3=districts.District
join cyrusbackend.districts on branchdetails.Address3=districts.District
join cyrusbackend.districts on employees.EmployeeCode=districts.`Assign To`
join districts on branchdetails.Address3=districts.District
join districts on branchdetails.Address3=districts.district
join districts on employees.EmployeeCode=districts.`Assign To`
join districts on employees.EmployeeCode=districts.`Assign To`
order by `Employee Name`";
ORDER BY BankName";
rsort($data);
rsort($data2);
rsort($data3);
WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=$EXEID and BankName!='Cyrus'
WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=$EXEID and BankName!='Cyrus'";
WHERE Address3 like '%Reserved%' and (TotalBilledValue-ReceivedAmount)>1";
where ControlerID=$EXEID
WHERE ControlerID=$EXEID
WHERE ControlerID=$EXEID";
WHERE demandbase.StatusID=1 and ControlerID=$EXEID order by DateOfInformation";
WHERE Inservice=1 and ControlerID=$EXEID Order By `Employee Name`";
WHERE month(VisitDate)=month(curdate()) and ControlerID=$EXEID";
WHERE month(VisitDate)=month(curdate()) and ExecutiveID=$EXEID";
while ($row = mysqli_fetch_array($result)) { 
while ($rowT=mysqli_fetch_assoc($resultT)){
while($rowE=mysqli_fetch_assoc($resultTech)){
while($rowE=mysqli_fetch_assoc($resultTech)){
}
}
}
}
}
}
}
}
}
}
}
}
} else if ( $Hour >= 12 && $Hour <= 15 ) {
} else if ( $Hour >= 19 || $Hour <= 23 ) {
}else{
}if (isset($_SESSION['query'])) {