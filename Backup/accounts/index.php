<?php 
include 'connection.php';
include 'session.php';

//$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

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

  <title>Payment</title>
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

  <link rel="stylesheet" href="dist/sortable-tables.min.css">
  <script src="dist/sortable-tables.min.js"></script>
  <style type="text/css">
  table{
    font-size: 14px;
  }
  th,a {
    cursor: pointer;
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
          <li class="breadcrumb-item active">Payment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">


        <div class="row g-3">
          <div class="col-md-12">
            <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
            <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
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

        <!-- Left side columns -->
        <div class="col-lg-12">

          <div id="VatView" class="table-responsive">

          </div>
          <br>
          <div id="GSTView" class="table-responsive">

          </div>

          <center>
            <div class="pagetitle">
              <h1></h1>
            </div>
          </center>
        </div>
      </div>
      <!-- End Left side columns -->
    </section>
  </main>
  <!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="margin-top:150px">
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
  <script src="ajax.js"></script>
  <script src="ajax-script.js"></script>
  <script type="text/javascript">

    $(document).on('click','.PaymentUpdate', function(){
      var BillDate = $(this).attr("BillDate");
      var Billno = $(this).attr("Billno");

      var Totalamount = $(this).attr("Totalamount");
      var Receiveamount = $(this).attr("Receiveamount");
      var ReceiveDate = $(this).attr("ReceiveDate");

      var CGST = $(this).attr("CGST");
      var SGST = $(this).attr("SGST");
      var IGST = $(this).attr("IGST");

      var SAmount = $(this).attr("SAmount");
      var SDt = $(this).attr("SDt");

      var SRAmount = $(this).attr("BillDate");
      var SRDt = $(this).attr("SRDt");

      var DD = $(this).attr("DD");
      var Remark = $(this).attr("Remark");

/*
      console.log(BillDate);
      console.log(Billno);
      console.log(Totalamount);
      console.log(Receiveamount);
      console.log(ReceiveDate);

      console.log(CGST);
      console.log(SGST);
      console.log(IGST);

      console.log(SAmount);
      console.log(SDt);
      console.log(SRAmount);
      console.log(SRDt);
      console.log(DD);
      console.log(Remark);
      */

      document.getElementById("billdate").value = BillDate;
      document.getElementById("billno").value = Billno;


      document.getElementById("billedamount").value = Totalamount;
      document.getElementById("receivedate").value = ReceiveDate;
      document.getElementById("receiveamount").value = Receiveamount;

      document.getElementById("sgst").value = SGST;
      document.getElementById("cgst").value = CGST;
      document.getElementById("igst").value = IGST;
      
      
      document.getElementById("DD").value = DD;
      document.getElementById("Remark").value = Remark;


      if (parseInt(Receiveamount) != 0) {
        document.getElementById("receivedate").type="text";
        document.getElementById("receivedate").value = ReceiveDate;
        document.getElementById("receiveamount").disabled = true;
        document.getElementById("receivedate").disabled = true;
       // document.getElementById("securityamount").disabled = true;
        //document.getElementById("SreceiveAmount").disabled = true;
        //document.getElementById("SreceiveDate").disabled = true;
        //document.getElementById("securityDate").disabled = true;


      }else{
        document.getElementById("receivedate").type="date";
        document.getElementById("receiveamount").disabled = false;
        document.getElementById("receivedate").disabled = false;
        //document.getElementById("securityamount").disabled = false;
        //document.getElementById("SreceiveAmount").disabled = false;
        //document.getElementById("SreceiveDate").disabled = false;
       // document.getElementById("securityDate").disabled = false;
     }

   });




  </script>

</body>

</html>

<?php 
$con->close();
$con2->close();
?>