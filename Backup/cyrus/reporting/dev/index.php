<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
if (isset($_GET['userid'])) {

  $EXEID=$_GET['userid'];
  $Type=$_GET['type'];
  $user=$_GET['name'];
  $_SESSION['usertype2']=$Type;
  $_SESSION['userid2']=$EXEID;
  $_SESSION['user2']=$user;
}elseif (isset($_SESSION['usertype2'])) {
  $EXEID=$_SESSION['userid2'];
  $Type=$_SESSION['usertype2'];
  $user=$_SESSION['user'];
}else{
  $EXEID=$_SESSION['userid'];
  $Type=$_SESSION['usertype'];
  $user=$_SESSION['user'];
}

if ($Type=='Executive') {
  header('location:/cyrus/executive/index.php');
}elseif($Type=='Dataentry'){
  header('location:reporting.php');
}

$data3=array();
$data4=array();
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

  //unassigned work
if($Type=='Reporting'){

  $query="SELECT count(ApprovalID) FROM cyrusbackend.reporting 
  join approval on reporting.EmployeeID=approval.EmployeeID
  WHERE ExecutiveID=$EXEID and posted=0";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $PendingReporting=$row["count(ApprovalID)"];


  $query="SELECT count(OrderID) FROM cyrusbackend.reporting
  join vallordersd on reporting.EmployeeID=vallordersd.EmployeeCode
  WHERE ExecutiveID=$EXEID and AssignDate is null and Attended=0 and Discription like '%AMC%'";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $UnassignedAMC=$row["count(OrderID)"];

  $query="SELECT count(OrderID) FROM cyrusbackend.reporting
  join vallordersd on reporting.EmployeeID=vallordersd.EmployeeCode
  WHERE ExecutiveID=$EXEID and AssignDate is null and Attended=0 and Discription not like '%AMC%'";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $UnassignedOrder=$row["count(OrderID)"];

  $query="SELECT count(ComplaintID) FROM cyrusbackend.reporting 
  join vallcomplaintsd on reporting.EmployeeID=vallcomplaintsd.EmployeeCode
  WHERE ExecutiveID=$EXEID and AssignDate is null and Attended=0";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $UnassignedComplaints=$row["count(ComplaintID)"];

  $UnassignedWork=$UnassignedOrder+$UnassignedComplaints+$UnassignedAMC;

  $query="SELECT count(OrderID), `Employee Name` FROM cyrusbackend.reporting
  join allorders on reporting.EmployeeID=allorders.EmployeeCode
  WHERE ExecutiveID=$EXEID and AssignDate is not null and Attended=0 and Discription not like '%AMC%'";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $AssignedOrder=$row["count(OrderID)"];

  $query="SELECT count(OrderID), `Employee Name` FROM cyrusbackend.reporting
  join allorders on reporting.EmployeeID=allorders.EmployeeCode
  WHERE ExecutiveID=$EXEID and AssignDate is not null and Attended=0 and Discription like '%AMC%'";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $AssignedAMC=$row["count(OrderID)"];

  $query="SELECT count(ComplaintID), `Employee Name` FROM cyrusbackend.reporting 
  join allcomplaint on reporting.EmployeeID=allcomplaint.EmployeeCode
  WHERE ExecutiveID=$EXEID and AssignDate is not null and Attended=0";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $AssignedComplaints=$row["count(ComplaintID)"];

  $PendingWork=$AssignedOrder+$AssignedComplaints+$AssignedAMC;

  $queryTech= "SELECT * FROM reporting WHERE ExecutiveID=$EXEID";
  $resultTech=mysqli_query($con,$queryTech);

  while($rowE= mysqli_fetch_array($resultTech)){
    $EmployeeID=$rowE['EmployeeID'];
    
    $query="SELECT count(OrderID) , `Employee Name` as Employee FROM vallordersd
    WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";

    $result=mysqli_query($con,$query);
    $row1= mysqli_fetch_array($result);

    $query="SELECT count(ComplaintID) FROM vallcomplaintsd
    WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";

    $result=mysqli_query($con,$query);
    $row2= mysqli_fetch_array($result);

    $data1[]=array("unassigned"=>($row1['count(OrderID)']+$row2['count(ComplaintID)']), "Employee"=>$row1['Employee']);


    $query="SELECT count(OrderID), `Employee Name` as Employee FROM allorders
    WHERE EmployeeCode=$EmployeeID and AssignDate is not null and Attended=0";
    $result=mysqli_query($con,$query);
    $row3 = mysqli_fetch_array($result);

    $query="SELECT count(ComplaintID) FROM allcomplaint
    WHERE EmployeeCode=$EmployeeID and AssignDate is not null and Attended=0";
    $result=mysqli_query($con,$query);
    $row4 = mysqli_fetch_array($result);    
    $data2[]=array("assigned"=>($row3['count(OrderID)']+$row4['count(ComplaintID)']), "Employee"=>$row3['Employee']);
  }

  rsort($data1);
  rsort($data2);

  $query="SELECT Count(ApprovalID) as Accepted, VDate FROM cyrusbackend.approval WHERE Vby like '%$user%'
  and Vremark!='REJECTED' and year(VDate)=year(current_date()) and month(Vdate)=month(current_date())
  group by VDate Order By Vdate";
  $result=mysqli_query($con,$query);
  while($row= mysqli_fetch_array($result)){
    $data3[]=$row;
  }

  $query="SELECT Count(ApprovalID) as Rejected, VDate FROM cyrusbackend.approval WHERE Vby like '%$user%'
  and Vremark='REJECTED' and year(VDate)=year(current_date()) and month(Vdate)=month(current_date())
  group by VDate Order By Vdate";
  $result=mysqli_query($con,$query);
  while($row= mysqli_fetch_array($result)){
    $data4[]=$row;
  }

  $query="SELECT Count(ApprovalID) as Accepted, month(VDate) as VDateA FROM cyrusbackend.approval WHERE Vby like '%$user%'
  and Vremark!='REJECTED' and year(VDate)=year(current_date())
  group by month(VDate) Order By month(Vdate)";
  $result=mysqli_query($con,$query);
  while($row= mysqli_fetch_array($result)){
    $data5[]=$row;
  }

  $query="SELECT Count(ApprovalID) as Rejected, month(VDate) as VDateR FROM cyrusbackend.approval WHERE Vby like '%$user%'
  and Vremark='REJECTED' and year(VDate)=year(current_date())
  group by month(VDate) Order By month(Vdate)";
  $result=mysqli_query($con,$query);
  while($row= mysqli_fetch_array($result)){
    $data6[]=$row;
  }





}



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
          <li class="breadcrumb-item active">Dashboard / <?php echo $user; ?></li>
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
                  <h5 class="card-title">Total <span>| Pending Verification</span></h5>

                  <div class="d-flex align-items-center" style="margin-bottom:15px">
                    <div class="ps-3">
                      <h6><?php echo $PendingReporting; ?></h6>
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
                  <h5 class="card-title">Total <span>| Unassigned Orders + Complaints + AMC</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $UnassignedOrder.' + '.$UnassignedComplaints.' + '.$UnassignedAMC;?></h6>
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
                  <h5 class="card-title">Total <span>| Pending Orders + Complaints + AMC</span></h5>

                  <div class="d-flex align-items-center">
                    <!--
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                  -->
                  <div class="ps-3">
                    <h6><?php echo $AssignedOrder. '+ '.$AssignedComplaints.' + '.$AssignedAMC; ?></h6>
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
                <h5 class="card-title">Pending <span> Work <a style="float:right" href="Work.php" target="_blank">Show All</a></span></h5>

                <div id="PendingWork"></div>

              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Unassigned <span> Work <a style="float:right" href="Work.php" target="_blank">Show All</a></span></h5>

                <div id="unassigned"></div>

              </div>
            </div>
          </div>

          <!-- End Reports -->

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Accepted Verification<span> This Month</span></h5>
                <div id="ReportingAccepted"></div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Rejected Verification<span> This Month</span></h5>
                <div id="ReportingRejected"></div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Verification<span> This Year</span></h5>
                <div id="ReportingYear"></div>
              </div>
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
<script src="search.js"></script>
<script src="ajax-script.js"></script>

<script type="text/javascript">

  var colors = ["#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff"];
  var hoverBackground='rgba(200, 200, 200, 1)';
  var hoverBorder='rgba(200, 200, 200, 1)';
  var xcolor=["#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1", "#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1","#4154f1"];

  var months = [ " ", "January", "February", "March", "April", "May", "June", 
  "July", "August", "September", "October", "November", "December" ];


  var data2= <?php print_r(json_encode($data2)); ?>;

  var Employee = [];
  var PendingWork = [];


  for(var i = 0; i < 10; i++) {
    Employee.push(data2[i].Employee);
    PendingWork.push(data2[i].assigned);
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
      

      var data1= <?php print_r(json_encode($data1)); ?>;

      var EmployeeE = [];
      var unassigned = [];

      for(var i = 0; i < 10; i++) {
        EmployeeE.push(data1[i].Employee);
        unassigned.push(data1[i].unassigned);
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

      var Accepted = [];
      var VDate = [];

      for(var i = 0; i < data3.length; i++) {
        Accepted.push(data3[i].Accepted);
        VDate.push(data3[i].VDate);
      }

      var data4= <?php print_r(json_encode($data4)); ?>;

      var Rejected = [];
      var VDateR = [];

      for(var i = 0; i < data4.length; i++) {
        Rejected.push(data4[i].Rejected);
        VDateR.push(data4[i].VDate);
      }

      document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#ReportingAccepted"), {
          series: [{
            name: 'Accepted Jobcard',
            data: Accepted,
          }],
          chart: {
            height: 250,
            type: 'area',
            toolbar: {
              show: false
            },
          },
          markers: {
            size: 4
          },
          colors: ['#4154f1'],
          fill: {
            type: "gradient",
            gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.3,
              opacityTo: 0.4,
              stops: [0, 90, 100]
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2
          },
          xaxis: {
            type: 'datetime',
            categories: VDate
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          }
        }).render();
      });


      document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#ReportingRejected"), {
          series: [ {
            name: 'Rejected Jobcard',
            data: Rejected
          }],
          chart: {
            height: 250,
            type: 'area',
            toolbar: {
              show: false
            },
          },
          markers: {
            size: 4
          },
          colors: ['#2eca6a'],
          fill: {
            type: "gradient",
            gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.3,
              opacityTo: 0.4,
              stops: [0, 90, 100]
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2
          },
          xaxis: {
            type: 'datetime',
            categories: VDateR
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          }
        }).render();
      });


      var data5= <?php print_r(json_encode($data5)); ?>;

      var AcceptedM = [];
      var VDateM = [];

      for(var i = 0; i < data5.length; i++) {
        AcceptedM.push(data5[i].Accepted);
        VDateM.push( months[data5[i].VDateA]);
      }

      var data6= <?php print_r(json_encode($data6)); ?>;

      var RejectedM = [];
      var VDateRM = [];

      for(var i = 0; i < data6.length; i++) {
        RejectedM.push(data6[i].Rejected);
        VDateRM.push(data6[i].VDateR);
      }

      document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#ReportingYear"), {
          series: [{
            name: 'Accepted Jobcard',
            data: AcceptedM,
          }, {
            name: 'Rejected Jobcard',
            data: RejectedM
          }],
          chart: {
            height: 250,
            type: 'bar',
            toolbar: {
              show: false
            },
          },
          markers: {
            size: 4
          },
          colors: ['#4154f1', '#2eca6a', '#ff771d'],
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2
          },
          xaxis: {
            type: 'sate',
            categories: VDateM
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          }
        }).render();
      });

    </script>
  </body>

  </html>

  <?php 
  $con->close();
  $con2->close();
?>