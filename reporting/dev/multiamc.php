<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
$Type=$_SESSION['usertype'];
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

  <title>Mult-AMC Assign</title>
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
          <li class="breadcrumb-item active">Multi-Amc Confirmation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="container">

            <div class="row g-3">
              <div class="col-md-12">
                <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
                <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
                  <div class="row g-3">

                    <div class="col-sm-5">
                      <center><label >Select Area Employee</label></center>
                      <select id="EmployeeAmc" class="form-control rounded-corner" required>
                        <option value="">Select Employee</option>
                        <?php
                        $query="SELECT EmployeeCode, `Employee Name` from employees WHERE Inservice=1 order by `Employee Name`";
                        $result2=mysqli_query($con,$query);
                        if (mysqli_num_rows($result2)>0)
                        {
                          while ($arr=mysqli_fetch_assoc($result2))
                          {
                            ?>
                            <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-sm-5">
                      <center><label>Assign To</label></center>
                      <select id="EmployeeAssign" class="form-control rounded-corner" required>
                        <option value="">Select Employee</option>
                        <?php
                        $query="SELECT EmployeeCode, `Employee Name` from employees WHERE Inservice=1 order by `Employee Name`";
                        $result2=mysqli_query($con,$query);
                        if (mysqli_num_rows($result2)>0)
                        {
                          while ($arr=mysqli_fetch_assoc($result2))
                          {
                            ?>
                            <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-sm-2" style="margin-top:50px">
                      <input  class="form-check-input" type="checkbox" value="" id="SelectAll">
                      <label class="form-check-label">
                        Select All
                      </label>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <br><br>
            <div id="viewResult"></div>
            <table class="table table-hover table-bordered border-primary display">
              <thead>
                <tr>
                  <th style="min-width:80px">Sr. No</th>
                  <th style="min-width:160px">Bank</th>
                  <th style="min-width:160px">Zone</th>
                  <th style="min-width:160px">Branch</th>
                  <th style="min-width:160px">District</th>
                  <th style="min-width:80px">AMC ID</th>
                  <th>Description</th>
                  <th style="min-width:120px">Action</th>
                </tr>
              </thead>
              <tbody id="MultiOrders">

              </tbody>
            </table>

            <center>
              <button class="btn btn-primary S" style="margin: 20px;" id="button">Submit</button>
            </center>

          </div>
        </div>
      </div>
      <!-- End Recent Sales -->
    </div>
  </div>
  <!-- End Left side columns -->
<div id="viewResult"></div>
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

<script type="text/javascript">

  $(document).on('change','#EmployeeAmc', function(){
    EmployeeCode = $(this).val();
    //console.log(EmployeeCode);
    if(EmployeeCode){
      $.ajax({
        type:'POST',
        url:'multiordersdata.php',
        data:{'EmployeeCodeAMC':EmployeeCode},
        success:function(result){
          $('#MultiOrders').html(result);
          //console.log((result));

        }
      }); 
    }
  });

  $(document).on('change','#ZoneM', function(){
    var ZoneCode = $(this).val();
    
    if(ZoneCode){
      $.ajax({
        type:'POST',
        url:'multiordersdata.php',
        data:{'ZoneCode':ZoneCode, 'BankCode':BankCode},
        success:function(result){
          $('#MultiOrders').html(result);

        }
      }); 
    }
  });
  $("#SelectAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
  });


  
  $('#button').on('click', function() {
    var AMCID = [];
    var EmployeeCode=document.getElementById("EmployeeAssign").value;
    $("input:checkbox[name=select]:checked").each(function() {
        //
        AMCID.push($(this).val());
      });
    console.log(AMCID);
    console.log(EmployeeCode);
    if (AMCID.length==0) {
      swal("error", "No AMC ID Selected", "error");
    }else if(EmployeeCode==''){
      swal("error", "No Assign Employee Selected", "error");
    }else{
      var element = document.getElementById("button");
      element.classList.add("d-none");

      $.ajax({
        type:'POST',
        url:'addmultiamc.php',
        data:{'AMCID':AMCID, 'EmployeeCode':EmployeeCode},
        success:function(result){
          
          var delayInMilliseconds = 2000; 
          console.log(array);
          setTimeout(function() {
            location.reload();
          }, delayInMilliseconds);
          
          $('#viewResult').html(result);

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