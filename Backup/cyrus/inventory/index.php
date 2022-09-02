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


$query="SELECT count(orders.OrderID) FROM cyrusbackend.orders 
join demandbase on orders.OrderID=demandbase.OrderID
WHERE StatusID=2;";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$PendingConfirmation=$row["count(orders.OrderID)"];

$query="SELECT count(orders.OrderID) FROM cyrusbackend.orders 
join demandbase on orders.OrderID=demandbase.OrderID
WHERE StatusID=3 and DeliveryDate is null and AssignDate is not null";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$PendingRelease=$row["count(orders.OrderID)"];

$query="SELECT count(distinct approval.OrderID) as Completed FROM cyrusbackend.approval
inner join demandbase on approval.OrderID=demandbase.OrderID
WHERE StatusID=3 and approval.Vremark!='REJECTED' and posted=1";
$result=mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$PendingCompleted=$row["Completed"];

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

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total <span>| Pending Material Confirmation</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $PendingConfirmation; ?></h6>
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
                  <h5 class="card-title">Total <span>| Pending Orders for Release</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $PendingRelease;?></h6>
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
                  <h5 class="card-title">Total <span>| Completed Not Released Materials</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $PendingCompleted; ?></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <!-- End Customers Card -->

            <!-- Reports -->

            <div class="col-12">
              <div class="card">

                <div class="modal fade" data-bs-backdrop="static" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-corner">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Materials</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div id="material">

                        </div>
                        <div class="col-lg-3 d-none">
                          <input type="number" name="" id="orderid" class="form-control rounded-corner">
                        </div>
                        <div class="col-lg-3 d-none">
                          <input type="number" name="" id="ZoneCode" class="form-control rounded-corner">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary confirm cl" data-bs-dismiss="modal">Confirm</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table-responsive container">
                  <table class="table table-hover table-bordered border-primary display nowrap" style="width:100%">
                    <h5 align="center" style="margin:20px;">Material Confirmation Pending</h5>
                    <thead id="unhead">
                      <tr>
                        <th >Bank</th>
                        <th>Zone</th>
                        <th>Branch</th>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Demand Date</th>
                        <th>Demanded By</th>
                        <th>Discription</th>        
                      </tr>
                    </thead>
                    <tbody >
                      <?php 
                      $query="SELECT orders.OrderID, DateOfInformation, StatusID, Discription, orders.BranchCode, DemandGenDate, UserName, BankName, ZoneRegionName, ZoneRegionCode, BranchName
                      FROM cyrusbackend.orders join demandbase on orders.OrderID=demandbase.OrderID
                      join pass on demandbase.ConfirmedByID=pass.ID
                      join branchdetails on orders.BranchCode=branchdetails.BranchCode
                      WHERE StatusID=2";

                      $result=mysqli_query($con,$query);
                      while($row = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                          <td ><?php echo $row["BankName"]; ?></td>

                          <td style="color:blue;" class="add" data-bs-toggle="modal" data-bs-target="#add" id="<?php print $row["ZoneRegionCode"]; ?>" data-bs-orderid="<?php echo $row["OrderID"]; ?>" data-bs-zonecode="<?php echo $row["ZoneRegionCode"]; ?>"><?php echo $row["ZoneRegionName"]; ?></td>

                          <td><?php echo $row["BranchName"]; ?></td>

                          <td><a href="" class="add" data-bs-toggle="modal" data-bs-target="#add" id="<?php print $row["ZoneRegionCode"]; ?>" data-bs-orderid="<?php echo $row["OrderID"]; ?>" data-bs-zonecode="<?php echo $row["ZoneRegionCode"]; ?>"><?php echo $row["OrderID"]; ?></a></td>
                          <td><?php echo $row["DateOfInformation"];; ?></td> 
                          <td><?php echo $row["DemandGenDate"]; ?></td>
                          <td><?php echo $row["UserName"]; ?></td>  
                          <td><?php echo $row["Discription"];; ?></td> 

                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="datatables/js/jquery.dataTables.min.js"></script>
    <script src="datatables/js/dataTables.responsive.min.js"></script>
    <!-- Template Main JS File -->
    
    <script src="assets/js/main.js"></script>
    <script src="ajax.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('table.display').DataTable( {
          responsive: true,
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
          }


        } );
      } );

      var exampleModal = document.getElementById('add')
      exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var ID = button.getAttribute('data-bs-orderid')
        var ZoneCode=button.getAttribute('data-bs-zonecode')
      //console.log(recipient);
      document.getElementById("orderid").value = ID;
      document.getElementById("ZoneCode").value = ZoneCode;
    })

      $(document).on('click', '.confirm', function(){
        var delayInMilliseconds = 1000; 

        setTimeout(function() {
          location.reload();
        }, delayInMilliseconds);
      });
    </script>
  </body>

  </html>

  <?php 
  $con->close();
  $con2->close();
?>