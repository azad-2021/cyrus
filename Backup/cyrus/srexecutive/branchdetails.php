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


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Branch Details</title>
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

  <style type="text/css">
  table.scrolldown {
    width: 100%;

    /* border-collapse: collapse; */
    border-spacing: 0;
    border: 2px solid black;
  }

  /* To display the block as level element */
  table.scrolldown tbody, table.scrolldown thead {
    display: block;
  } 

  thead tr th {
    height: 40px; 
    line-height: 40px;
  }

  table.scrolldown tbody {

    /* Set the height of table body */
    height: 150px; 

    /* Set vertical scroll */
    overflow-y: auto;

    /* Hide the horizontal scroll */
    overflow-x: hidden; 
  }
  td,th{
    min-width: 200px;
    font-size: 14px;
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
    </div><!-- End Logo -->

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";
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
          <li class="breadcrumb-item active">Branch Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

     <div class="row g-3">
      <div class="col-md-12">
        <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
        <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
          <div class="row g-3">

            <div class="col-sm-4">
              <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                <option value="">Bank</option>
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
            <div class="col-sm-4">
              <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>
            <div class="col-sm-4">
              <select id="Branch" class="form-control rounded-corner" name="Branch" required>
                <option value="">Branch</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-12 container" >
      <br>
      <h4 align="center" style="margin-bottom: 20px">Branch Details</h4>
      <div class="row lg-12" id="BranchData">
      </div>
    </div>
    <div class="modal fade" id="ViewVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">VAT Bill details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="VATData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="ViewGST" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">GST Bill Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="GSTData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Sales -->
    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <br>
        <div class="card-body">

          <div class="col-lg-12" style="margin: 12px; overflow: auto;">
            <table class="display table table-hover table-bordered border-primary">
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
          <div class="col-lg-12" style="margin: 12px; overflow: auto;">
            <table class="table table-hover table-bordered border-primary scrolldown table-responsive"> 
              <h5 style="margin: 2px; text-align: center;">Orders</h5>
              <thead> 
                <tr> 
                  <th>Order ID</th>
                  <th>Information Date</th>

                  <th >Attended</th>
                  <th >Visit Date</th>

                  <th >Gadget</th>                        
                  <th >Assign Date</th>                            
                  <th >Call Verified</th>   
                  <th >Employee</th>
                  <th style="min-width:500px">Discription</th> 
                  <th style="min-width:400px;">Verification Remark</th>
                  <th style="min-width:500px">Executive Remark</th>

                </tr>                     
              </thead>               
              <tbody id="Order">

              </tbody>
            </table>
          </div>
          <div class="col-lg-12" style="margin: 12px; overflow: auto;">
            <table class="table scrolldown table table-hover table-bordered border-primary"> 
              <h5 style="margin: 5px; text-align: center;">Complaints</h5>
              <thead> 
                <tr> 
                  <th >Complaint ID</th>
                  <th >Information Date</th>
                  <th >Attended</th>
                  <th>Date of Visit</th>           
                  <th >Gadget</th>            
                  <th >Assign Date</th>
                  <th >Call Verified</th>             
                  <th>Employee</th>
                  <th style="min-width: 500px;">Discription</th> 
                  <th style="min-width: 400px;">Verification Remark</th>
                  <th style="min-width: 500px;">Executive Remark</th>

                </tr>                     
              </thead>                 
              <tbody id="Complaints" > 

              </tbody>
            </table> 
          </div>
          <div class="col-lg-12" style="margin: 12px; overflow: auto;">
            <table class="display table table-hover table-bordered border-primary scrolldown" id="resizeMe3">
              <h5 style="margin: 2px; text-align: center;">Jobcard</h5>
              <thead> 
                <tr> 
                  <th>Jobcard Number</th>
                  <th>Date of Visit</th>
                  <th>Gadget</th>
                  <th>Employee</th>
                  <th style="min-width: 800px;">Service Done</th>
                  <th style="min-width: 800px;">Pending Work</th>   
                </tr>                     
              </thead>                 
              <tbody id="jobcard"> 

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

<!-- Template Main JS File -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax-script.js"></script>


<?php include"js-php.php"; ?>
<script type="text/javascript">

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>