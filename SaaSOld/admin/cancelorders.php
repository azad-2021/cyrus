<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

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

  <title>Completed Orders</title>
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
  <link rel="stylesheet" type="text/css" href="datatable/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/responsive.bootstrap5.min.css"/>

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
  //include "modals.php";
?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Completed Orders</li>
      </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">

  <!-- Left side columns -->
  <div class="col-lg-12">
    <div class="row">
      <!-- Reports -->

      <div class="col-lg-12">
        <!-- Start -->
        <div class="table-responsive">
           <table class="table table-hover table-bordered border-primary nowrap" id="myTable"> 
              <thead> 
                  <tr> 
                      <th>Bank</th> 
                      <th>Zone</th> 
                      <th>Branch</th> 
                      <th>Gadget</th>
                      <th>Order Id</th>
                      <th>Order Date</th> 
                      <th>Remark</th>
                  </tr>                     
              </thead>                 
              <tbody> 
                  <?php  
                  $query ="SELECT * FROM saas.orders
                  join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
                  join gadget on orders.GadgetID=gadget.GadgetID
                  WHERE Executive='Zeeshan Sayeed' and Installed=2 order by OrderID Desc;";
                  $results = mysqli_query($con, $query);
                  while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){  

                    echo '  
                    <tr>
                    <td>'.$row["BankName"].'</td> 
                    <td>'.$row["ZoneRegionName"].'</td>  
                    <td>'.$row["BranchName"].'</td>  
                    <td>'.$row["OrderID"].'</td>
                    <td>'.$row["Gadget"].'</td>
                    <td>'.$row["Date"].'</td>  
                    <td>'.$row["Remark"].'</td> 
                    </tr>  
                    ';  
                } 
                ?> 

            </table>  
        </div>  
        <!-- END-->
    </div>
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

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="datatable/js/jquery.dataTables.min.js"></script>]
<script src="datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="datatable/js/dataTables.responsive.min.js"></script>
<script src="datatable/js/responsive.bootstrap5.min.js"></script>

<script type="text/javascript">

  $(document).ready(function() {
    $('#myTable').DataTable( {
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal( {
            header: function ( row ) {
              var data = row.data();
              return 'Details for '+data[0]+' '+data[1];
          }
      } ),
          renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
            tableClass: 'table'
        } )
      }
  },

} );
} );

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
$con3->close();
?>