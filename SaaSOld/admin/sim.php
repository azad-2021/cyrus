<?php

include('connection.php'); 
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');

$user=$_SESSION['user'];

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

$query ="SELECT * FROM `operators`";
$resultOperator = mysqli_query($con, $query);


if(isset($_POST['submit'])){


  $Mobile=$_POST['Mobile'];
  $SimNo=$_POST['SimNo'];
  $SimType=$_POST['SimType'];
  $OperatorID=$_POST['Operator'];
  $Provider=$_POST['Provider'];
  $Remark=$_POST['Remark'];

  $query ="SELECT * FROM `simprovider` WHERE `MobileNumber`=$Mobile";
  $result = mysqli_query($con, $query);
     // $date = str_replace('-"', '/', $IssueDate);  
     // $IssueDate = date("y/m/d", strtotime($date));
  $errors='';
  if (strlen($Mobile) < 13){
    $errors='<script>alert("Mobile Number must be 12 Digit Long")</script>';
  }elseif (strlen($SimNo) < 20){
    $errors='<script>alert("Sim Number must be 20 Digit Long")</script>';

  }elseif(empty(mysqli_fetch_assoc($result))==false){
    $errors='<script>alert("Mobile Number Already Exists")</script>';
  }
  if (empty($errors)==true) {
        // code...

    if(empty($_POST['ADate'])==false) {


      $ADate=$_POST['ADate'];
      $ExpDate=$_POST['RDate'];
      $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `ActivationDate`, `ExpDate`, `Remark`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$ADate', '$ExpDate', '$Remark')" ;

    }else{

      $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `Remark`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$Remark')" ;

    }
    $resultAdd = mysqli_query($con3,$queryAdd);
    if ($resultAdd) {
      echo '<script>alert("Your response recorded successfully")</script>';
      header("location:simtable.php?user=$username");
    }else {
      echo "Error updating record: " . $con3->error;
    }

  }else{
    echo $errors;
  }
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
  <script src="assets/js/sweetalert.min.js"></script>

</head>

<body>


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

      <form method="POST" action="" class="form-control rounded-corner">
        <div class="row">

          <div class="form-group col-md-3">
            <label for="Branch">Mobile No.</label>
            <input type="text" minlength="13" maxlength="13" class="form-control rounded-corner" placeholder="Mobile No" name="Mobile" onkeydown="limit2(this);" onkeyup="limit2(this);" required>
          </div>
          <div class="form-group col-md-3">
            <label for="Bank ID">Sim No.</label>
            <input type="text" class="form-control rounded-corner" placeholder="Sim No" name="SimNo" onkeydown="limit1(this);" onkeyup="limit1(this);"required>
          </div>
          <div class="form-group col-md-2">
            <label for="IssueDate">Sim Type</label>
            <select class="form-control rounded-corner" name="SimType" required>
              <option value="">Select</option>
              <option value="Prepaid">Prepaid</option>
              <option value="Postpaid">Postpaid</option>
            </select>

          </div>
          <div class="form-group col-md-2">
            <label for="IssueDate">Sim Provider</label>
            <select class="form-control rounded-corner" name="Provider" required onchange="yesnoCheck(this);">
              <option value="">Select</option>
              <option value="Bank">Bank</option>
              <option value="Cyrus">Cyrus</option>
            </select>

          </div>
          <div class="form-group col-md-2">
            <label for="operator">Operator</label>
            <select class="form-control rounded-corner" name="Operator">
              <option value="">Select</option>
              <?php
              while ($arr=mysqli_fetch_assoc($resultOperator)){
                ?>
                <option value="<?php echo $arr['OperatorID']; ?>"><?php echo $arr['Operator']; ?></option>
                
              <?php } ?>                
            </select>

          </div>

          <div class="form-group col-md-12" id="1"  style="display: none;">
            <label for="SimType">Activation Date</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="date" name="ADate" placeholder="dd/mm/yy" class="form-control rounded-corner">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="SimType">Recharge Expiry Date</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="date" name="RDate" placeholder="dd/mm/yy" class="form-control rounded-corner">

          </div>
          <div class="form-group col-md-12">
            <br>
            <label for="Remark">Remark</label>
            <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" cols="4" rows="4" name="Remark"></textarea>

          </div>

        </div>  
        <br><br>
        <center>

          <input type="submit"  class=" btn btn-primary" value="submit" name="submit" onclick="checkLength()" /></input>
        </center>      
      </form>
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

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>

<?php 
$con -> close();
$con2 -> close();
?>