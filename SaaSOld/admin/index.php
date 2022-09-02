<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];



date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

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

  //unassigned work
if($Type=='Executive'){

  $query="SELECT count(OrderID) FROM saas.orders WHERE Executive ='$user' and Installed=0 and Status=0";
  $result=mysqli_query($con3,$query);
  $row = mysqli_fetch_array($result);
  $ProductionPending=$row["count(OrderID)"];

  $query="SELECT count(OrderID) FROM saas.orders WHERE Executive ='$user' and Installed=0 and Status=1";
  $result=mysqli_query($con3,$query);
  $row = mysqli_fetch_array($result);
  $StorePending=$row["count(OrderID)"];

  $query="SELECT count(OrderID) FROM saas.orders WHERE Executive ='$user' and Installed=0 and Status=2";
  $result=mysqli_query($con3,$query);
  $row = mysqli_fetch_array($result);
  $InstalledPending=$row["count(OrderID)"];
}elseif($Type=='Sim Provider'){


  $query="SELECT count(MobileNumber) FROM saas.simprovider where DATEDIFF(ExpDate, current_date())<0 ";
  $result=mysqli_query($con3,$query);
  $row = mysqli_fetch_array($result);
  $RechargeExp=$row["count(MobileNumber)"];

  $query="SELECT count(MobileNumber) FROM saas.simprovider where DATEDIFF(ExpDate, current_date())>0 ";
  $result=mysqli_query($con3,$query);
  $row = mysqli_fetch_array($result);
  $Recharged=$row["count(MobileNumber)"];

  //$query="SELECT count(OrderID) FROM saas.orders WHERE Executive ='$user' and Installed=0 and Status=2";
  //$result=mysqli_query($con3,$query);
  //$row = mysqli_fetch_array($result);
  //$InstalledPending=$row["count(OrderID)"];
  $Suspended=0;

}elseif($Type=='Production'){


  $query="SELECT count(OrderID) FROM saas.orders WHERE Installed=0 and Status=0";
  $result=mysqli_query($con3,$query);
  $row = mysqli_fetch_array($result);
  $ProductionPending=$row["count(OrderID)"];

  $query="SELECT count(MobileNumber) FROM saas.simprovider where IssueDate is NULL ";
  $result=mysqli_query($con3,$query);
  $row = mysqli_fetch_array($result);
  $MobileStock=$row["count(MobileNumber)"];

  //$query="SELECT count(OrderID) FROM saas.orders WHERE Executive ='$user' and Installed=0 and Status=2";
  //$result=mysqli_query($con3,$query);
  //$row = mysqli_fetch_array($result);
  //$InstalledPending=$row["count(OrderID)"];
  //$Suspended=0;

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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <?php
          if($Type=='Sim Provider'){
            ?>
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Plan Expired SIM Cards</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $RechargeExp; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Active (Non-Expired + Expired) SIM Cards</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $Recharged.' + '.$RechargeExp;?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-4 col-xl-4">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Suspended SIM Cards</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $Suspended; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
          }elseif($Type=='Executive'){
            ?>

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Pending Orders at Production</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $ProductionPending; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Pending Orders at Store</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $StorePending;?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-4 col-xl-4">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Pending Orders at Installation</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $InstalledPending; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
          }elseif($Type=='Production'){
            ?>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Pending Orders at Production</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $ProductionPending; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| SIM Cards in Stock</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $MobileStock;?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--
            <div class="col-xxl-4 col-xl-4">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Pending Orders at Installation</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $InstalledPending; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          -->
            <?php 
          }
          ?>
          <!-- End Customers Card -->

          <!-- Reports -->

          <div class="col-lg-12">
            <!-- Start -->
            <div class="table-responsive">  
              <?php 
              if($Type=='Executive'){
                include"ordertable.php";
              }elseif($Type=='Sim Provider'){
                include"simtable.php";
              }elseif($Type=='Production'){
                include"protable.php";
              }elseif($Type=='Store'){
                include"storetable.php";
              }elseif($Type=='Installation'){
                include"instable.php";
              }
              ?>
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


      $(document).ready(function() {
        $('#example').DataTable( {
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

      $(document).ready(function() {
        $('#example2').DataTable( {
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


      $(document).ready(function() {
        $('#example3').DataTable( {
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
  $con3 -> close();
?>