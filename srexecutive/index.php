<?php 

include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}


$query="SELECT TargetAmount FROM cyrusbackend.payment_reminder_target WHERE ExecutiveID=19 and month(Date)=month(current_date()) and year(Date)=year(current_date())";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$TargetAmountSakshi=$row["TargetAmount"];

$query="SELECT TargetAmount FROM cyrusbackend.payment_reminder_target WHERE ExecutiveID=32 and month(Date)=month(current_date()) and year(Date)=year(current_date())";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$TargetAmountVersha=$row["TargetAmount"];

$query="SELECT TargetAmount FROM cyrusbackend.payment_reminder_target WHERE ExecutiveID=41 and month(Date)=month(current_date()) and year(Date)=year(current_date())";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$TargetAmountSonika=$row["TargetAmount"];

$queryT="SELECT sum(ReceivedAmount) as Acheived  FROM cyrusbilling.billbook
join cyrusbackend.branchs on billbook.BranchCode=branchs.BranchCode
join cyrusbilling.`reminder lock` on billbook.BillID=`reminder lock`.BillID
join cyrusbackend.`reminder bank` on branchs.ZoneRegionCode=`reminder bank`.ZoneRegionCode WHERE ExecutiveID=19 and Cancelled=0 and month(BillDate)<month(current_date()) and month(ReceivedDate)=month(current_date()) and year(ReceivedDate)=year(current_date())";
$resultT=mysqli_query($con2,$queryT);
$rowT=mysqli_fetch_assoc($resultT);
  $AcheivedSakshi=$rowT["Acheived"];

  $queryT="SELECT sum(ReceivedAmount) as Acheived  FROM cyrusbilling.billbook
  join cyrusbackend.branchs on billbook.BranchCode=branchs.BranchCode
  join cyrusbilling.`reminder lock` on billbook.BillID=`reminder lock`.BillID
  join cyrusbackend.`reminder bank` on branchs.ZoneRegionCode=`reminder bank`.ZoneRegionCode WHERE ExecutiveID=32 and Cancelled=0 and month(BillDate)<month(current_date()) and month(ReceivedDate)=month(current_date()) and year(ReceivedDate)=year(current_date())";
  $resultT=mysqli_query($con2,$queryT);
  $rowT=mysqli_fetch_assoc($resultT);
  $AcheivedVersha=$rowT["Acheived"];

  $queryT="SELECT sum(ReceivedAmount) as Acheived  FROM cyrusbilling.billbook
  join cyrusbackend.branchs on billbook.BranchCode=branchs.BranchCode
  join cyrusbilling.`reminder lock` on billbook.BillID=`reminder lock`.BillID
  join cyrusbackend.`reminder bank` on branchs.ZoneRegionCode=`reminder bank`.ZoneRegionCode WHERE ExecutiveID=41 and Cancelled=0 and month(BillDate)<month(current_date()) and month(ReceivedDate)=month(current_date()) and year(ReceivedDate)=year(current_date())";
  $resultT=mysqli_query($con2,$queryT);
  $rowT=mysqli_fetch_assoc($resultT);
  $AcheivedSonika=$rowT["Acheived"];


  if ($AcheivedSakshi<$TargetAmountSakshi) {
    $PendingTargetSakshi=$TargetAmountSakshi-$AcheivedSakshi;
  }else{
    $PendingTargetSakshi=0;
  }


  if ($AcheivedVersha<$TargetAmountVersha) {
    $PendingTargetVersha=$TargetAmountVersha-$AcheivedVersha;
  }else{
    $PendingTargetVersha=0;
  }


  if ($AcheivedSonika<$TargetAmountSonika) {
    $PendingTargetSonika=$TargetAmountSonika-$AcheivedSonika;
  }else{
    $PendingTargetSonika=0;
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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

    <link rel="stylesheet" href="dist/sortable-tables.min.css">
    <script src="dist/sortable-tables.min.js"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <style type="text/css">
    table{
      font-size: 14px;
    }
    th,a {
      cursor: pointer;
    }
  </style>
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
          <li class="breadcrumb-item active">Work Report</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Target Sakshi <span><?php echo date('M', strtotime("-1 month"));?></span></h5>

              <div id="piechart" align="center" style="width: 180px;"></div>

            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Target Versha <span><?php echo date('M', strtotime("-2 month"));?></span></h5>

              <div id="piechart2" align="center" style="width: 180px;"></div>

            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Target Sonika <span><?php echo date('M', strtotime("-3 month"));?></span></h5>

              <div id="piechart3" align="center" style="width: 180px;"></div>

            </div>
          </div>
        </div>
      </div>



      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">

          <center>
            <div class="pagetitle">
              <h1>Reminders Per Day</h1>
            </div>
          </center>
          <div class="table-responsive container">
            <table class="table table-hover table-bordered border-primary  display">     
              <thead> 
                <tr> 
                  <th style="min-width:160px">Name</th>
                  <th style="min-width:80px">Date</th>           
                  <th style="min-width:150px">No. of Branches</th>           
                </tr>                     
              </thead>                 
              <tbody>
                <?php 
                $query="SELECT COUNT(SUBQUERY.BranchCode) as CountBranchCode, SUBQUERY.user, SUBQUERY.ReminderOn from
                (
                SELECT cyrusbackend.pass.UserName As user, cyrusbilling.reminders.BranchCode, count(cyrusbilling.reminders.ID) AS CountOfID, date(cyrusbilling.reminders.ReminderDate) as ReminderOn FROM cyrusbackend.pass
                inner join cyrusbilling.reminders on cyrusbackend.pass.ID=cyrusbilling.reminders.UserID 
                WHERE date(cyrusbilling.reminders.ReminderDate)>='2022-01-01'
                Group By cyrusbackend.pass.UserName, cyrusbilling.reminders.BranchCode, date(cyrusbilling.reminders.ReminderDate)
              ) AS SUBQUERY group by SUBQUERY.user, SUBQUERY.ReminderOn";

              $result=mysqli_query($con2,$query);
              while($row = mysqli_fetch_array($result)){

                print "<tr>";
                print "<td>".$row['user']."</td>";             
                print '<td><span class="d-none">'.$row['ReminderOn'].'</span>'.date("d-M-Y", strtotime($row['ReminderOn']))."</td>";
                print "<td>".$row['CountBranchCode']."</td>"; 
                print "</tr>";

              }

              ?>
            </tbody>
          </table>

        </div>
        <br><br>
        <h4 align="center">Reminders Per Month</h4>

        <div class="table-responsive container">
          <table class="table table-hover table-bordered border-primary  display"> 
            <thead> 
              <tr> 
                <th style="min-width:160px">Name</th>
                <th style="min-width:80px">Month</th>           
                <th style="min-width:150px">No. of Branches</th>           
              </tr>                     
            </thead>                 
            <tbody>
              <?php 
              $query="SELECT COUNT(SUBQUERY.BranchCode) as CountBranchCode, SUBQUERY.user, SUBQUERY.ReminderOn as month  from
              (
              SELECT cyrusbackend.pass.UserName As user, cyrusbilling.reminders.BranchCode, count(cyrusbilling.reminders.ID) AS CountOfID, date(cyrusbilling.reminders.ReminderDate) as ReminderOn FROM cyrusbackend.pass
              inner join cyrusbilling.reminders on cyrusbackend.pass.ID=cyrusbilling.reminders.UserID 
              WHERE date(cyrusbilling.reminders.ReminderDate)>='2022-01-01'
              Group By cyrusbackend.pass.UserName, cyrusbilling.reminders.BranchCode, date(cyrusbilling.reminders.ReminderDate)
            ) AS SUBQUERY group by SUBQUERY.user, month(SUBQUERY.ReminderOn)";

            $result=mysqli_query($con2,$query);
            while($row = mysqli_fetch_array($result)){

              print "<tr>";
              print "<td>".$row['user']."</td>";             
              print '<td><span class="d-none">'.$row['month'].'</span>'.date("M-Y", strtotime($row['month']))."</td>";
              print "<td>".$row['CountBranchCode']."</td>"; 
              print "</tr>";

            }

            ?>
          </tbody>
        </table>
      </div>

      <br><br>
      <h4 align="center">Monthly Payment Relization</h4>

      <div class="table-responsive container">
        <table class="table table-hover table-bordered border-primary  display"> 
          <thead> 
            <tr> 
              <th style="min-width:150px">Month</th>           
              <th style="min-width:150px">Amount</th>           
            </tr>                     
          </thead>                 
          <tbody>
            <?php 
            $query="SELECT sum(Amount), GenDate FROM cyrusbilling.`reminder lock` WHERE GenDate>='2022-01-01' group by month(Gendate), year(GenDate) order by GenDate desc";

            $result=mysqli_query($con2,$query);
            while($row = mysqli_fetch_array($result)){

              print "<tr>";           
              print '<td><span class="d-none">'.$row['GenDate'].'</span>'.date("M-Y", strtotime($row['GenDate']))."</td>";
              print "<td>".number_format($row['sum(Amount)'],2)."</td>"; 
              print "</tr>";

            }

            ?>
          </tbody>
        </table>
      </div>

      <div id="r"></div>
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
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<script src="assets/js/main.js"></script>
<script src="ajax-script.js"></script>
<?php include"js-php.php"; ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false,

    } );
  } );


  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  google.charts.setOnLoadCallback(drawChart2);
  google.charts.setOnLoadCallback(drawChart3);

  function drawChart() {
    var data1 = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTargetSakshi?>, <?php echo $PendingTargetSakshi?>],
      ['Acheived : '+<?php echo $AcheivedSakshi?>, <?php echo $AcheivedSakshi?>]
      ]);


    var options1 = {
      'title':'Target Amount : ' + <?php echo $TargetAmountSakshi?>,
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
    chart.draw(data1, options1);
  }



  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart2() {
    var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTargetVersha?>, <?php echo $PendingTargetVersha?>],
      ['Acheived : '+<?php echo $AcheivedVersha?>, <?php echo $AcheivedVersha?>]
      ]);


    var options = {
      'title':'Target Amount : ' + <?php echo $TargetAmountVersha?>,
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

    var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
    chart2.draw(data, options);
  }


  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart3() {
    var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTargetSonika?>, <?php echo $PendingTargetSonika?>],
      ['Acheived : '+<?php echo $AcheivedSonika?>, <?php echo $AcheivedSonika?>]
      ]);


    var options = {
      'title':'Target Amount : ' + <?php echo $TargetAmountSonika?>,
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

    var chart2 = new google.visualization.PieChart(document.getElementById('piechart3'));
    chart2.draw(data, options);
  }


</script>

</body>

</html>

<?php 
$con->close();
$con2->close();
?>