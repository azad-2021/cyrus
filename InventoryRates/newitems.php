<?php 
include 'connection.php';
//include 'session.php';

//$EXEID=$_SESSION['userid'];
$_SESSION['user']='Accounts';
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Hour = date('G');

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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
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
    </div>

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";
    //include "modals.php";
    ?>
  </header>
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
          <li class="breadcrumb-item active">Add new materials</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
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
                  <div class="col-sm-3">
                    <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                      <option value="">Zone</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <input type="number" name="no_input" min="1" class="form-control rounded-corner" placeholder="Number of materials" id="no_input" disabled="">
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-primary addcolumns">Add</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="table-responsive" style="margin:20px">
          <table class="table table-hover table-bordered border-primary">
            <thead>
              <th style="min-width:50px">Sr. No</th>
              <th style="min-width:350px">Material Name</th>
              <th style="min-width:50px">Rate</th>
              <th style="min-width:100px">Item Category</th>         
            </thead>
            <tbody id="itemdata">

            </tbody>
          </table>
        </div>
        <br>
        <div id="re"></div>
      </div>
      <center>
        <button type="button"  class="btn btn-primary Save" >Submit</button>
      </center>
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
  
  <script src="assets/js/main.js"></script>
  <script type="text/javascript">

   var rows =0;

   $(document).on('change','#Bank', function(){
    var BankCode = $(this).val();
    if(BankCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BankCode':BankCode},
        success:function(result){
          $('#Zone').html(result);

        }
      }); 
    }else{
      $('#Zone').html('<option value="">Zone</option>');
      $('#Branch').html('<option value="">Branch</option>'); 
    }
  });

   $(document).on('change','#Zone', function(){
    document.getElementById("no_input").disabled = false;
  });

   $(document).on('click', '.addcolumns', function(){
    rows = document.getElementById("no_input").value;

    if (rows>0) {
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'rows':rows},
        success:function(result){
          $('#itemdata').html(result);

        } 
      });
    }
  });

   $(document).on('click', '.Save', function () {
    var Desc = [];
    var Rate=[];
    var Category=[];
    var i2=2000
    var i3=3000
    var ZoneCode=document.getElementById("Zone").value;
    for (let i = 1; i <=rows; i++) {
      console.log(i);
      var desc=document.getElementById(i).value;
      var rate=document.getElementById(i2).value;
      var category=document.getElementById(i3).value;

      var error=0;
      if (desc=='' || rate=='' || category=='') {
        swal("error", "Please enter all fields", "error");
        error=1;

      }else{
        Desc.push(desc);
        Rate.push(rate);
        Category.push(category);
        i2++;
        i3++;
      }
    }
    console.log(Desc);
    console.log(Rate);
    console.log(Category);
    if(error==0){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'Zone':ZoneCode, 'Rate':Rate, 'Catagory':Category, 'Description':Desc},
        success:function(result){
          $('#re').html(result);

          swal("success","Material Added","success");
          var delayInMilliseconds = 2000; 
          setTimeout(function() {
            location.reload();
          }, delayInMilliseconds);
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