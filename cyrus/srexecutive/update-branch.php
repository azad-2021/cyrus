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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">


  <style type="text/css">

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

            <div class="col-sm-6">
              <select id="BankData" class="form-control rounded-corner" name="Bank" required>
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
            <div class="col-sm-6">
              <select id="ZoneData" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone/Region</option>
              </select>
            </div>

          </div>
        </form>
      </div>
    </div>


    <!-- Recent Sales -->
    <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <br>
        <div class="card-body">
          <div class="col-lg-12 table-responsive" style="margin: 12px; overflow: auto;">
            <table class="table table-hover table-bordered border-primary display"> 
              <thead> 
                <tr> 
                  <th>Sr. No.</th>
                  <th>Branch</th>
                  <th>District</th>
                  <th>Change Zone/Region</th>
                  <th >Change District</th>
                </tr>                     
              </thead>               
              <tbody id="branchData">

              </tbody>
            </table>
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
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax-script.js"></script>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<?php include"js-php.php"; ?>
<script type="text/javascript">
 $(document).on('change','#BankData', function(){
  var BankCode = $(this).val();
  if(BankCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BankCode':BankCode},
      success:function(result){
        $('#ZoneData').html(result);
        
      }
    }); 
  }else{
    $('#ZoneData').html('<option value="">Zone</option>');
  }
});
 
 $(document).on('change','#ZoneData', function(){
  var ZoneCode = $(this).val();
  var BankCode=document.getElementById("BankData").value;
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ZoneCodeData':ZoneCode,'BankData':BankCode},
      success:function(result){
       $('#branchData').html(result);
     }
   }); 
  }
});

 $(document).on('change','#DistrictU', function(){
  var District = $(this).val();
  var BranchCode =$(this).attr("id2");
  var ZoneCode=document.getElementById("ZoneData").value;
  var BankCode=document.getElementById("BankData").value;
  if(District){

    if (confirm("You want to change District. Do you wish to continue?")) {

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'DistrictU':District,'BranchCodeU':BranchCode},
        success:function(result){
          console.log((result));
          swal("success","District Updated", "success");

        }
      }); 

    }
    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeData':ZoneCode,'BankData':BankCode},
        success:function(result){
         $('#branchData').html(result);
       }
     }); 
    }, delayInMilliseconds);

  }

});

 $(document).on('change','#ZoneU', function(){
  var ZoneCodeU = $(this).val();
  var BranchCode =$(this).attr("id2");
  var ZoneCode=document.getElementById("ZoneData").value;
  var BankCode=document.getElementById("BankData").value;
  if(ZoneCodeU){

    if (confirm("You want to change zone/Region. Do you wish to continue?")) {

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeU':ZoneCodeU,'BranchCodeU':BranchCode},
        success:function(result){
          console.log((result));
          swal("success","Zone Updated", "success");

        }
      }); 
    }
    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeData':ZoneCode,'BankData':BankCode},
        success:function(result){
         $('#branchData').html(result);
       }
     }); 
    }, delayInMilliseconds);
    
  }
});

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>