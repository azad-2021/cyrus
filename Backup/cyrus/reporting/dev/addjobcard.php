<?php 

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$EXEID=$_SESSION['userid'];
$Type=$_SESSION['usertype'];

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

$Hour = date('G');
if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}


$querygadget="SELECT * FROM gadget";
$resultGadget=mysqli_query($con,$querygadget);

$query="SELECT * FROM employees WHERE Inservice=1 Order By `Employee Name`";
$resultTech=mysqli_query($con,$query);


if(isset($_POST['submit'])){
 $BranchCode=$_POST['Branch'];
 $GadgetID=$_POST['GadgetID'];
 $VisitDate=$_POST['VisitDate'];
 //$Jobcard=$_POST['Jobcard'];
 $job = $_POST['Jobcard'];
   // $job =strtoupper($jobcard);
 $input = preg_replace("/[^a-zA-Z0-9]+/", "", $job);
 $Jobcard=strtoupper($input);
 $EmployeeID=$_POST['EmployeeID'];

 $sql = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `GadgetID`, `EmployeeCode`) VALUES('$Jobcard', '$BranchCode', '$VisitDate',  '$GadgetID', '$EmployeeID')";

 $Result3 = mysqli_query($con,$sql);
 header('location:reporting.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Jobcard Entry</title>
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
          <li class="breadcrumb-item active">Add Jobcard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="row g-3">
      <div class="col-md-12">
        <h4 class="mb-3" align="center">Add Job Card</h4>
        <form class="needs-validation form-control novalidate rounded-corner" method="POST">
          <div class="row g-3">

            <div class="col-sm-3 div">
              <label for="Verified By" class="form-label">Bank</label>
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
            <div class="col-sm-3 div">
              <label for="Verified By" class="form-label">Zone</label>
              <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>
            <div class="col-sm-3 div">
              <label for="Verified By" class="form-label">Branch</label>
              <select id="Branch" class="form-control rounded-corner" name="Branch" required>
                <option value="">Branch</option>
              </select>
            </div>
            <div class="col-sm-3 div">
              <label for="Verified By" class="form-label">Gadget</label>
              <select class="form-control rounded-corner" id="exampleFormControlSelect2" name="GadgetID" required>
                <option value="">Select</option>
                <?php
                while($data=mysqli_fetch_assoc($resultGadget)){

                  echo '<option value='.$data['GadgetID'].'>'.$data['Gadget'].'</option>'; 
                }  
                ?>
              </select>
            </div>
            <div class="col-sm-4 div">
              <label for="Show Jobcard Number" class="form-label">Select Service Engineer</label>
              <select class="form-control rounded-corner" id="exampleFormControlSelect2" name="EmployeeID" required>
                <option value="">Select</option>
                <?php
                while($data2=mysqli_fetch_assoc($resultTech)){

                  echo '<option value='.$data2['EmployeeCode'].'>'.$data2['Employee Name'].'</option>'; 
                }  
                ?>
              </select>
            </div>
            <div class="col-sm-4 div">
              <label for="Departure Time" class="form-label">Jobcard Number</label>
              <input type="text" class="form-control rounded-corner" placeholder="" name="Jobcard" style="text-transform: uppercase;" required>
            </div>

            <div class="col-sm-3 div">
              <label for="Total HDD" class="form-label">Date of Visit</label>
              <input type="date" class="form-control rounded-corner" placeholder="" name="VisitDate" required>
            </div>
            <center>

              <div class="col-sm-6">
                <button class="btn btn-primary my-button" type="submit" name="submit">Submit</button>
              </div>
            </center>
          </form>
        </div>
      </div>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer" style="margin-top: 200px;">
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

      (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
      })()
    </script>

  </body>

</html>

  <?php 
  $con->close();
  $con2->close();
?>