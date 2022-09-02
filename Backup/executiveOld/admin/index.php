<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');
//echo $_SESSION['user'];


if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}


$query="SELECT count(orders.OrderID) as PendingMaterials
FROM cyrusbackend.orders join demandbase on orders.OrderID=demandbase.OrderID
join branchdetails on orders.BranchCode=branchdetails.BranchCode
join districts on branchdetails.Address3=districts.district
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE demandbase.StatusID=1 and ControlerID=$EXEID order by DateOfInformation";

$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$PendingMaterials=$row["PendingMaterials"];


$query="SELECT  sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
join cyrusbackend.districts on branchdetails.Address3=districts.District
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=$EXEID and BankName!='Cyrus'";

$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$PendingPayment=$row["TotalAmount"]-$row["ReceiveAMOUNT"];


$query="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.allgstbills
WHERE Address3 like '%Reserved%' and (TotalBilledValue-ReceivedAmount)>1";

$result=mysqli_query($con2,$query);
$row = mysqli_fetch_array($result);
$PendingPaymentReserved=$row["TotalAmount"]-$row["ReceiveAMOUNT"];


$query="SELECT DISTINCT EmployeeCode, `Employee Name` FROM employees
join cyrusbackend.districts on employees.EmployeeCode=districts.`Assign To`
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE Inservice=1 and ControlerID=$EXEID Order By `Employee Name`";
$resultTech=mysqli_query($con,$query);
$TotalPendingWork=0;
while($rowE=mysqli_fetch_assoc($resultTech)){
 $Employee=$rowE["Employee Name"];
 $EmployeeID=$rowE["EmployeeCode"];

 $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allcomplaint WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeID";
 $result=mysqli_query($con,$query);
 $row = mysqli_fetch_array($result);

 $query2="SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allorders WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$EmployeeID";
 $result2=mysqli_query($con,$query2);
 $row2 = mysqli_fetch_array($result2);
 $AMC=$row2["count(OrderID)"];

 $query3 = "SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM allorders WHERE EmployeeCode=$EmployeeID and AssignDate is not NULL and Attended=0 and Discription not like '%AMC%'";
 $result3 = mysqli_query($con, $query3);
 $row3 = mysqli_fetch_array($result3);
 $AO=$row3["count(OrderID)"];


 $PendingWork  = $AO+$row['count(ComplaintID)']+$AMC;
 $Employee = $rowE['Employee Name'];
 $data[]=array("Work"=>$PendingWork, "Employee"=>$Employee);

 $TotalPendingWork=$TotalPendingWork+$PendingWork;
}

rsort($data);


//unassigned work

$query="SELECT `Employee Name`, employees.EmployeeCode FROM cyrusbackend.employees
join districts on employees.EmployeeCode=districts.`Assign To`
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
where ControlerID=$EXEID
group by employees.EmployeeCode
order by `Employee Name`";

$resultTech=mysqli_query($con,$query);
while($rowE=mysqli_fetch_assoc($resultTech)){
  $Employee=$rowE["Employee Name"];
  $EmployeeID=$rowE["EmployeeCode"];
  $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.vallcomplaintsd WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);

  $query2="SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
  $result2=mysqli_query($con,$query2);
  $row2 = mysqli_fetch_array($result2);

  $query3 = "SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE AssignDate is null and Discription not like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
  $result3 = mysqli_query($con, $query3);
  $row3 = mysqli_fetch_array($result3);



  $PendingWorkE= $row3["count(vallordersd.OrderID)"] + $row["count(ComplaintID)"] + $row2["count(vallordersd.OrderID)"];            
  $data2[]=array("Unassigned"=>$PendingWorkE, "Employee"=>$Employee);
}
rsort($data2);
//print_r($data2);

$sql ="SELECT BankName, ZoneRegionName, EmployeeCode,  BranchName, BookNo, BankCode, ZoneRegionCode, BillDate, sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
join cyrusbackend.districts on branchdetails.Address3=districts.District
join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=$EXEID and BankName!='Cyrus'
group by BankCode, ZoneRegionCode
ORDER BY BankName";

$result = mysqli_query($con,$sql);

while ($row = mysqli_fetch_array($result)) { 

  $PendingBill  = $row['TotalAmount']-$row['ReceiveAMOUNT'];
  $Bankarr = $row['BankName'].' '.$row['ZoneRegionName'];
  $data3[]=array("Payment"=>sprintf('%0.2f', $PendingBill), "Bank"=>$Bankarr);
}
rsort($data3);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/sweetalert.min.js"></script>


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/cyrus logo.png" alt="">
        <span class="d-none d-lg-block">Cyrus</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";
    //include "modals.php";

    ?>

  </header><!-- End Header -->
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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title" style="margin-bottom: 30px;">Total <span>| Pending Material <br><center>Confirmation</center> </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $PendingMaterials; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- End Sales Card -->

            <!-- Revenue Card -->

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Pending Payment + Reserved</span><br></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6>&#x20B9 <?php echo number_format($PendingPayment,2).'&nbsp; + '.number_format($PendingPaymentReserved,2); ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- End Revenue Card -->

            <!-- Customers Card -->

            <div class="col-xxl-4 col-xl-4">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title" style="margin-bottom: 40px;">Total <span>| Pending Work</span></h5>

                  <div class="d-flex align-items-center">
                    <!--
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                  -->
                  <div class="ps-3">
                    <h6><?php echo $TotalPendingWork; ?></h6>
                  </div>
                </div>

              </div>
            </div>

          </div>

          <!-- End Customers Card -->

          <!-- Reports -->

          <div class="col-12">
            <div class="card">

              <div class="card-body">
                <h5 class="card-title">Pending <span> Work <a style="float:right" href="PendingWork.php" target="_blank">Show All</a></span></h5>

                <div id="PendingWork"></div>

              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Unassigned <span> Work <a style="float:right" href="UnassignedWork.php" target="_blank">Show All</a></span></h5>

                <div id="unassigned"></div>

              </div>
            </div>
          </div>

          <!-- End Reports -->

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pending <span> Payment <a style="float:right" href="PendingBills.php" target="_blank">Show All</a></span></h5>

                <div id="PendingPayment"></div>

              </div>
            </div>
          </div>

          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <div class="card-body">
                <h5 class="card-title">Recent  Received <span>| Orders</span></h5>

                <div class="table-responsive container">
                  <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                      <tr class="text-dark">
                        <th scope="col" style="min-width:200px">Bank</th>
                        <th scope="col" style="min-width:200px">Zone</th>
                        <th scope="col" style="min-width:200px">Branch</th>
                        <th scope="col" style="min-width:100px">Order ID</th>
                        <th scope="col" style="min-width:300px">Description</th>
                        <th scope="col" style="min-width:150px">Order Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql ="SELECT BankName, ZoneRegionName, BranchName, OrderID, Discription, DateOfInformation FROM cyrusbackend.orders
                      join branchdetails on orders.BranchCode=branchdetails.BranchCode
                      join districts on branchdetails.Address3=districts.District
                      join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                      WHERE ControlerID=$EXEID and AssignDate is null
                      Order by DateOfInformation desc limit 10";

                      $result = mysqli_query($con,$sql);
                      while ($row = mysqli_fetch_array($result)) { 
                       ?>
                       <tr>

                        <td><?php echo $row["BankName"]; ?></td>
                        <td><?php echo $row["ZoneRegionName"]; ?></td>
                        <td><?php echo $row["BranchName"]; ?></td>
                        <td><?php echo $row["OrderID"]; ?></td>
                        <td><?php echo $row["Discription"]; ?></td>
                        <td><?php echo $row["DateOfInformation"]; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent  Received <span>| Complaints</span></h5>

              <div class="table-responsive container">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                  <thead>
                    <tr class="text-dark">
                      <th scope="col" style="min-width:200px">Bank</th>
                      <th scope="col" style="min-width:200px">Zone</th>
                      <th scope="col" style="min-width:200px">Branch</th>
                      <th scope="col" style="min-width:120px">Complaint ID</th>
                      <th scope="col" style="min-width:300px">Description</th>
                      <th scope="col" style="min-width:150px">Complaint Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sql ="SELECT BankName, ZoneRegionName, BranchName, ComplaintID, Discription, DateOfInformation FROM cyrusbackend.complaints
                    join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                    join districts on branchdetails.Address3=districts.District
                    join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                    WHERE ControlerID=$EXEID and AssignDate is null
                    Order by DateOfInformation desc limit 10";

                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) { 
                     ?>
                     <tr>

                      <td><?php echo $row["BankName"]; ?></td>
                      <td><?php echo $row["ZoneRegionName"]; ?></td>
                      <td><?php echo $row["BranchName"]; ?></td>
                      <td><?php echo $row["ComplaintID"]; ?></td>
                      <td><?php echo $row["Discription"]; ?></td>
                      <td><?php echo $row["DateOfInformation"]; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- End Recent Sales -->
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
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>


<script type="text/javascript">

  var colors = ["#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff"];
  var hoverBackground='rgba(200, 200, 200, 1)';
  var hoverBorder='rgba(200, 200, 200, 1)';
  var xcolor=["#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1"];

  var data= <?php print_r(json_encode($data)); ?>;

  var Employee = [];
  var PendingWork = [];


  for(var i = 0; i < 10; i++) {
    Employee.push(data[i].Employee);
    PendingWork.push(data[i].Work);
  }


  var options = {
    series: [{
      data: PendingWork
    }],
    chart: {
      height: 350,
      type: 'bar',
      events: {
        click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: Employee,
          labels: {
            style: {
              colors: xcolor,
              fontSize: '12px'
            }
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#PendingWork"), options);
      chart.render();


      var data2= <?php print_r(json_encode($data2)); ?>;

      var EmployeeE = [];
      var unassigned = [];

      for(var i = 0; i < 10; i++) {
        EmployeeE.push(data2[i].Employee);
        unassigned.push(data2[i].Unassigned);
      }


      var options2 = {
        series: [{
          data: unassigned
        }],
        chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: EmployeeE,
          labels: {
            style: {
              colors: xcolor,
              fontSize: '12px'
            }
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#unassigned"), options2);
      chart.render();


      var data3= <?php print_r(json_encode($data3)); ?>;

      var Bankarr = [];
      var PendingBills = [];

      for(var i = 0; i < 10; i++) {
        Bankarr.push(data3[i].Bank);
        PendingBills.push(data3[i].Payment);
      }


      var options3 = {
        series: [{
          data: PendingBills
        }],
        chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              console.log(chart, w, e)
            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: Bankarr,
          labels: {
            style: {
              colors: xcolor,
              fontSize: '12px'
            }
          }
        }
      };

      var chart = new ApexCharts(document.querySelector("#PendingPayment"), options3);
      chart.render();


    </script>
  </body>

  </html>

  <?php 
  $con->close();
  $con2->close();
?>