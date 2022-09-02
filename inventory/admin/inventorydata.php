<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

if ($Type=='Executive') {
  header('location:/cyrus/executive/index.php');
}elseif($Type=='Dataentry'){
  header('location:reporting.php');
}

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Release Orders</title>
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

  <link rel="stylesheet" type="text/css" href="datatables/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="datatables/css/jquery.dataTables.min.css">


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


            <!-- Inventory Pending Orders of Employees-->
            <div class="modal fade" id="PendingOrders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-corner">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pending Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" id="PendingInventoryData">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>  

            <div class="modal fade" id="ReleaseOrders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" >
                <div class="modal-content rounded-corner" style="background-color: #f0f0f0;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pending Materials</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" id="ReleaseData" >

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>  

            <div class="col-lg-12" style="margin: 12px;">
             <table class="container table table-hover display table-bordered border-primary responsive">
              <h4 align="center">Material Confirmed from Inventory</h4> 
              <thead> 
               <tr>
                <th style="min-width:20px">SNo.</th>
                <th style="min-width:150px">Employee Name</th>
                <th style="min-width:80px">Pending Orders</th>

              </tr>                     
            </thead>                 
            <tbody>
             <?php 
             $query2="SELECT count(orders.OrderID), `Employee Name`, orders.EmployeeCode from orders
             join demandbase on orders.OrderID=demandbase.OrderID
             join employees on orders.EmployeeCode=employees.EmployeeCode
             WHERE AssignDate is not null and StatusID=3
             Group by orders.EmployeeCode order by `Employee Name`";

             $result2=mysqli_query($con,$query2);

             if (mysqli_num_rows($result2)>0)
             {
              $Sn=1;

              while($row = mysqli_fetch_array($result2)){
                ?>

                <tr>
                  <th><?php echo $Sn; ?></th>
                  <td ><?php echo $row['Employee Name']; ?></td>
                  <td style="color: blue;" class="showEmployeeData" id="<?php print $row['EmployeeCode']; ?>" data-bs-toggle="modal" data-bs-target="#PendingOrders" ><?php echo $row['count(orders.OrderID)']; ?></td>
                </tr>
                <?php
                $Sn++;
              }

              $con->close();
              $con2->close();
            }
            ?>
          </tbody>
        </table>


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
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables/js/dataTables.responsive.min.js"></script>
<!-- Template Main JS File -->

<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false
    } );
  } );
</script>
</body>
</html>
