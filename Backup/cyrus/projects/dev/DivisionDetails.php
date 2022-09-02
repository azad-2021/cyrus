<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

$AddEn=1;
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$exdate=date('Y-m-d', strtotime($Date. ' + 2 days'));
$exdate2=date('Y-m-d', strtotime($Date. ' + 7 days'));

$Hour = date('G');
//echo $_SESSION['user'];

$user=$_SESSION['user'];

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
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
            <div class="row g-3">
              <div class="col-md-12">
                <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
                <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
                  <div class="row g-3">

                    <div class="col-lg-6">
                      <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                        <option value="">Organization</option>
                        <?php
                        $BankData="Select BankCode, BankName from bank order by BankName";
                        $result=mysqli_query($con,$BankData);
                        if (mysqli_num_rows($result)>0)
                        {
                          while ($arr=mysqli_fetch_assoc($result))
                          {
                            ?>
                            <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                        <option value="">Zone/Division</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!--<h4 align="center" style="margin: 20px">Branch Details</h4>
            <div class="row lg-12" id="BranchData"></div>
            -->
            <div class="col-lg-12" style="margin: 12px; overflow: auto;">
              <table class="scrolldown table table-hover table-bordered border-primary table-responsive" id="resizeMe"> 
                <h5 style="margin: 2px; text-align: center;">Orders</h5>
                <thead> 
                  <tr> 
                    <th style="min-width: 100px;">Order ID</th>
                    <th style="min-width: 120px;">LOA Date</th>
                    <th style="min-width: 160px;">Date of Completion</th>
                    <th style="min-width: 500px;">Discription</th>
                    <th style="min-width: 150px;">BG Amount</th>
                    <th style="min-width: 120px;">BG Date</th>
                    <th style="min-width: 100px;">Completed</th>      
                    <th style="min-width: 120px;">Warranty</th>                 
                    <th style="min-width: 500px;">Remark</th>                                          
                  </tr>                     
                </thead>                 
                <tbody id="Order"> 
                </tbody>
              </table>
            </div>
                <!--
                <div class="col-lg-12" style="margin: 12px; overflow: auto;">
                  <table class=" scrolldown table table-hover table-bordered border-primary"> 
                    <h5 style="margin: 5px; text-align: center;">Complaints</h5>
                    <thead> 
                      <tr> 
                        <th style="min-width: 150px;">Complaint ID</th>
                        <th style="min-width: 150px;">Information Date</th>
                        <th style="min-width: 500px;">Discription</th>
                        <th style="min-width: 150px;">Attended</th>
                        <th style="min-width: 150px;">Date of Visit</th>
                        <th style="min-width: 500px;">Executive Remark</th> 
                        <th style="min-width: 150px;">Gadget</th>            
                        <th style="min-width: 150px;">Assign Date</th>
                        <th style="min-width: 150px;">Call Verified</th>             
                        <th style="min-width: 150px;">Employee</th>            
                      </tr>                     
                    </thead>                 
                    <tbody id="Complaints" > 

                    </tbody>
                  </table> 
                </div>
              

                <div class="col-lg-12" style="margin: 12px; overflow: auto;">
                  <table class="scrolldown table table-hover table-bordered border-primary table-responsive" id="resizeMe"> 
                    <h5 style="margin: 2px; text-align: center;">AMC</h5>
                    <thead> 
                      <tr> 
                        <th style="min-width: 150px;">Device</th>
                        <th style="min-width: 150px;">Start Date</th>
                        <th style="min-width: 150px;">End date</th>
                        <th style="min-width: 150px;">Visits</th> 
                        <th style="min-width: 150px;">Rates</th>        
                      </tr>                     
                    </thead>                 
                    <tbody id="AMCVisit"> 
                    </tbody>
                  </table>
                </div>
              -->


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
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax-script.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
<script type="text/javascript">
 
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>