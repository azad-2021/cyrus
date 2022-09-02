<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

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

  <style type="text/css">
  table{
    font-size: 14px;
  }
  th,a {
    cursor: pointer;
  }


  .overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("assets/img/loader.gif") center no-repeat;
  }
  /* Turn off scrollbar when body element has the loading class */
  body.loading{
    overflow: hidden;   
  }
  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay{
    display: block;
  }
</style>

</head>

<body>

  <div class="overlay"></div>
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
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row g-3">
            <div class="col-md-12">
              <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
              <form class="needs-validation form-control rounded-corner" method="POST" style="margin-bottom: 5px;" >
                <div class="row g-3">

                  <div class="col-lg-3">
                    <label>Select Bank</label>
                    <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                      <option value="">Select</option>
                      <?php
                      $BankData="SELECT BankCode, BankName FROM cyrusbackend.amcs
                      join branchdetails on amcs.ZoneRegionCode=branchdetails.ZoneRegionCode
                      Group by BankCode order by BankName";
                      $result=mysqli_query($con,$BankData);
                      if (mysqli_num_rows($result)>0)
                      {
                        while ($arr=mysqli_fetch_assoc($result))
                        {
                          $d = array("BankName"=>$arr['BankName'], "BankCode"=>$arr['BankCode']);

                          $data= json_encode($d);
                          ?>
                          <option value='<?php echo "$data"; ?>'><?php echo $arr['BankName']; ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label>Select Zone</label>
                    <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                      <option value="">Select</option>
                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label>Start Date</label>
                    <input type="date" name="" id="Sdate" class="form-control rounded-corner">
                  </div>
                  <div class="col-lg-3">
                    <label>End Date</label>
                    <input type="date" name="" id="Edate" class="form-control rounded-corner">
                  </div>
                </div>
              </form>
              <center>
                <button class="btn btn-primary" id="view">View</button>
              </center>
            </div>
          </div>

          <div id="printableArea">
            <div class="col-lg-12 table-responsive" style="margin: 12px;" >
              <center>
                <h4>Posted AMC</h4>
              </center>
              <table class="table table-hover table-bordered border-primary" >

                <thead> 
                 <tr>
                  <th>Sr.No.</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Gadget</th>
                </tr>                     
              </thead>                 
              <tbody id="AMCZone">
              </tbody>
            </table>
          </div>

          <div class="col-lg-12 table-responsive" style="margin: 12px;" >
            <center>
              <h4>AMC Report</h4>
              <h5>
                <div id="BankName" class="col-lg-6"></div>
                <div id="ZoneName" class="col-lg-6"></div>
              </h5>
            </center>
            <table class="table table-hover table-bordered border-primary" >

              <thead> 
               <tr>
                <th>Sr.No.</th>
                <th>Branch</th>
                <th>Jobcard No</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Visit Date</th>
                <th>Status</th>
                <th>Gadget</th>
              </tr>                     
            </thead>                 
            <tbody id="AmcData">
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <center>
      <button class="btn btn-primary" onclick="printDiv('printableArea');">Print</button>
    </center>

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
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->

<script src="assets/js/main.js"></script>


<script type="text/javascript">



  $(document).on('change','#Bank', function(){
    var data = $(this).val();
    //console.log(data);
    const obj = JSON.parse(data);
    BankCode = obj.BankCode;
    document.getElementById("BankName").innerHTML=obj.BankName;
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
    var data = $(this).val();
    console.log(data);
    const obj = JSON.parse(data);
    ZoneCode = obj.ZoneCode;
    if(ZoneCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'AMCZone':ZoneCode},
        success:function(result){
          $('#AMCZone').html(result);
          $('#AmcData').html("");

        }
      }); 
    }
  });


  $(document).on('click','#view', function(){
    var StartDate= document.getElementById("Sdate").value;
    var EndDate= document.getElementById("Edate").value;
    var data= document.getElementById("Zone").value;
    const obj = JSON.parse(data);
    ZoneCode = obj.ZoneCode;

    if(StartDate!='' || EndDate!='' || ZoneCode!=''){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeAMC':ZoneCode,'StartDate':StartDate, 'EndDate':EndDate, 'ZoneCodeA':ZoneCode},
        success:function(result){
          $('#AmcData').html(result);

        }
      }); 
    }else{
      swal("error","Please Enter all fields","error")
    }
  });

  function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }


    $(document).on({
      ajaxStart: function(){
        $("body").addClass("loading"); 
      },
      ajaxStop: function(){ 
        $("body").removeClass("loading"); 
      }    
    });
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>