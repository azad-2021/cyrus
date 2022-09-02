<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];
$EmployeeID=base64_decode($_GET['empid']);
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

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

$EXEID=$_SESSION['userid'];
$Type=$_SESSION['usertype'];




$query ="SELECT * FROM `approval` Where EmployeeID='$EmployeeID' and posted='0'";

$results = mysqli_query($con, $query); 

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

  <title>Reporting Details</title>
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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.1/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
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
    <section class="section dashboard">
      <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Verification details of <?php echo$EmployeeName; ?></li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <div class="table-responsive container">
        <table class="table table-hover table-bordered border-primary" id="example" width="100%"> 
          <thead> 
            <tr> 
              <th>Branch</th>
              <th>Order ID</th>
              <th>Complaint ID</th>
              <th>Date of Visit</th>
              <th>First Upload Date</th>  
              <th>Status</th> 
              <th>Action</th>
            </tr>                     
          </thead>                 
          <tbody> 
            <?php  
            while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
              {  
                $BranchCode=$row["BranchCode"];

                if ($row["ComplaintID"]>0) {
                  $ComplaintID=$row["ComplaintID"];
                  $query ="SELECT `TimeStamp` FROM `complaints` Where ComplaintID=$ComplaintID";
                }else{
                  $OrderID=$row["OrderID"];
                  $query ="SELECT `TimeStamp` FROM `orders` Where OrderID=$OrderID";

                }


                $result = mysqli_query($con, $query);
                $row3=mysqli_fetch_array($result);

                $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
                $result = mysqli_query($con, $query);
                $row1=mysqli_fetch_array($result);

                $date = $row["VisitDate"];  
                    //$date = str_replace('-"', '/', $orgDate);  
                $Visit = date("d-M-Y", strtotime($date));

                $Status=$row["Status"];
                if ($Status==1) {
                  $Status='OK';
                }else{
                  $Status='NOT Ok';
                }

                echo '  
                <td>'.$row1["BranchName"].'</td>
                <td>'.$row["OrderID"].'</td>
                <td>'.$row["ComplaintID"].'</td>
                <td>'.'<span class="d-none">'.$row['VisitDate'].'</span>'.$Visit.'</td>
                <td>'.'<span class="d-none">'.$row3['TimeStamp'].'</span>'.date("d-M-Y h:i:sa", strtotime($row3["TimeStamp"])).'</td> 
                <td>'.$Status.'</td>                                
                <td><a target="blank" href=verify.php?apid='.base64_encode($row["ApprovalID"]).'>Verify Details</a></td> 
                </tr>  
                ';  
                $Visit='';}}  


                ?> 
              </tbody>
            </table>  
          </div>
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

      <script src="assets/js/main.js"></script>
      <script src="ajax.js"></script>
      <script src="ajax-script.js"></script>
      <script src="search.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
      <script src="https://cdn.datatables.net/searchpanes/2.0.1/js/dataTables.searchPanes.min.js"></script>
      <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

      <script type="text/javascript">

        $(document).ready(function() {
         var table = $('#example').DataTable( {
          rowReorder: {
            selector: 'td:nth-child(2)'
          },
          "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
          //dom: 'Plfrtip',
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