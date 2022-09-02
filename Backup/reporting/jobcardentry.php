<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];
$user=$_SESSION['user'];

$EmployeeID=base64_decode($_GET['empid']);

date_default_timezone_set('Asia/Calcutta');
$Date="2021-10-07 00:00:00";

$Hour = date('G');
if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

$query2 ="SELECT * FROM `employees` Where EmployeeCode='$EmployeeID'";
$results2 = mysqli_query($con, $query2);
$row2=mysqli_fetch_array($results2);
$EmployeeName = $row2["Employee Name"]; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Jobcard Entry</title>
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

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
          <li class="breadcrumb-item active">Jobcard details of  <?php echo$EmployeeName; ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="table-responsive container">
      <table id="userTable2" class="table table-hover table-bordered border-primary">
        <thead> 
          <tr> 
            <th>Bank</th>
            <th>Zone</th>
            <th>Branch</th>
            <th>Jobcard Number</th>
            <th>Date of Visit</th>   
            <th>Action</th>
          </tr>                     
        </thead>                 
        <tbody> 
          <?php  
          $query ="SELECT * FROM `jobcardmain` Where EmployeeCode='$EmployeeID' and ServiceDone is null and VisitDate>='$Date'";

          $results = mysqli_query($con, $query); 
          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
            $BranchCode=$row["BranchCode"];
            $enBranchCode=base64_encode($BranchCode);
            $enJobcard=base64_encode($row["Card Number"]);
            $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
            $result = mysqli_query($con, $query);
            $row1=mysqli_fetch_array($result);
            $ZoneCode=$row1["ZoneRegionCode"];

            $orgDate = $row["VisitDate"];   
            $Visit = date("d/m/Y", strtotime($orgDate));

            $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
            $resultZone = mysqli_query($con, $queryZone);
            $row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
            $Zone=$row2["ZoneRegionName"];
            $BankCode=$row2["BankCode"];

            $queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
            $resultBank = mysqli_query($con, $queryBank);
            $row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
            $Bank=$row3["BankName"];


            echo '  
            <td>'.$Bank.'</td>
            <td>'.$Zone.'</td>
            <td>'.$row1["BranchName"].'</td>
            <td>'.$row["Card Number"].'</td>
            <td>'.$Visit.'</td>                       
            <td style="text-align:center"><a href=jobcard.php?cardno='.$enJobcard.'&brcode='.$enBranchCode.'>Fill Details </a></td>  
            </tr>  
            ';  
            $Visit='';}  


            ?> 

          </tbody>
        </table>  
      </div>
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
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

    <script type="text/javascript">

      $(document).ready(function() {
       var table = $('#userTable2').DataTable( {
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
        responsive: true

      } );
     } );
   </script>
 </body>

 </html>

 <?php 
 $con->close();
 $con2->close();
?>