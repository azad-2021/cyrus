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

  <title>Work Region</title>
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
          <li class="breadcrumb-item active">Work Region Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="row g-3">
        <div class="col-md-12">
          <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
          <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
            <div class="row g-3">
              <div class="col-lg-6">
                <select id="Region" class="form-control rounded-corner" name="Region" required>
                  <option value="">Select Region</option>
                  <?php
                  $Data="SELECT * FROM cyrusbackend.`cyrus regions` Order By RegionName";
                  $result=mysqli_query($con,$Data);
                  if (mysqli_num_rows($result)>0)
                  {
                    while ($arr=mysqli_fetch_assoc($result))
                    {
                      ?>
                      <option value="<?php echo $arr['RegionCode']; ?>"><?php echo $arr['RegionName']; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-lg-6">
                <select id="CExecutive" class="form-control rounded-corner" name="Region" required>
                  <option value="">Change Executive</option>
                  <?php
                  $Data="SELECT * FROM cyrusbackend.pass WHERE UserType='Executive' Order By UserName";
                  $result=mysqli_query($con,$Data);
                  if (mysqli_num_rows($result)>0)
                  {
                    while ($arr=mysqli_fetch_assoc($result))
                    {
                      ?>
                      <option value="<?php echo $arr['ID']; ?>"><?php echo $arr['UserName']; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>

            </div>
          </form>
        </div>
      </div>

      <table class="table table-hover table-bordered border-primary display" style="margin-top: 20px;">
        <thead>
          <tr>
            <th scope="col">Sr. No.</th>
            <th scope="col">District</th>
            <th scope="col">Executive</th>
            <th scope="col">Supervisor</th>
            <th scope="col">Change Supervisor</th>  
          </tr>
        </thead>
        <tbody id="RegionData">

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
  <br><br><br><br><br><br>
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
<script src="search.js"></script>
<script src="ajax-script.js"></script>

<script type="text/javascript">
  $( document ).ready(function() {
    document.getElementById("CExecutive").disabled = true;
  });

  $(document).on('change','#Region', function(){
    var RegionCode = $(this).val();
    document.getElementById("CExecutive").value = '';
    if(RegionCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'RegionCode':RegionCode},
        success:function(result){
          document.getElementById("CExecutive").disabled = false;
          $('#RegionData').html(result);

        }
      }); 
    }else{
      document.getElementById("CExecutive").disabled = true;
    }
  });

  $(document).on('change','#CExecutive', function(){
    var RegionCode = document.getElementById("Region").value;
    var ExecutiveID=$(this).val();
    if(RegionCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'RegionCodeC':RegionCode, 'CRegionExecutive':ExecutiveID},
        success:function(result){


        }
      });

      var delayInMilliseconds = 1000; 

      setTimeout(function() {

        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'RegionCode':RegionCode},
          success:function(result){
            document.getElementById("CExecutive").disabled = false;
            $('#RegionData').html(result);

          }
        }); 

      }, delayInMilliseconds);
    }
  });


/*
 $(document).on('change','#Region', function(){
  var RegionCode = $(this).val();
  if(RegionCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'RegionCode':RegionCode},
      success:function(result){
        $('#RegionData').html(result);
        
      }
    }); 
  }
});
*/

$(document).on('change','#Supervisor', function(){
  var ID = $(this).val();
  var DistrictID=$(this).attr("id2");
  var RegionCode=document.getElementById("Region").value;
  if(ID){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'SupervisorID':ID, 'DistrictID':DistrictID},
      success:function(result){
        console.log(result);
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'RegionCode':RegionCode},
          success:function(result){
            $('#RegionData').html(result);

          }
        });
        
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