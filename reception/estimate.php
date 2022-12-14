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

  <title>Estimate</title>
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
    font-size: 18px;
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
          <li class="breadcrumb-item active">Estimate Details</li>
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
                <select id="BranchE" class="form-control rounded-corner" name="Branch" required>
                  <option value="">Branch</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>


      <div class="modal fade" id="Estimate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Estimates</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="EstimateData">

            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!--<button data-bs-toggle="modal" data-bs-target="#AddItems" class="btn btn-primary" id="Add" name="add">Add Items</button>-->
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="AddItems" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Items</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="text" class="apd d-none" id="apd" name="">

            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <select id="items" class="form-control rounded-corner" name="Items" required>
                    <option value="">Select</option>
                  </select>
                </div>
                <center>
                  <div class="mb-3">
                    <label class="rounded-corner">Enter Quantity</label><br>
                    <input class="rounded-corner" type="number" name="" id="addQty" class="form-control">
                  </div>
                </center>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" data-bs-dismiss="modal" class="btn btn-primary addItems">Save</button>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-hover table-bordered border-primary display">
        <thead>
          <tr>
            <th scope="col">Employee</th>
            <th scope="col">Date</th>
            <th scope="col">Print</th> 
          </tr>
        </thead>
        <tbody id="EstimateDataR">

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
<script src="ajax-script.js"></script>

<script type="text/javascript">
$(document).on('change','#Zone', function(){
  var ZoneCode = $(this).val();
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ZoneCode':ZoneCode},
      success:function(result){
        $('#BranchE').html(result);
        
      }
    }); 
  }
});

$(document).on('change','#BranchE', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'estView.php',
      data:{'Branch':BranchCode},
      success:function(result){
        $('#EstimateDataR').html(result);
        
      }
    }); 
  }
});
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>