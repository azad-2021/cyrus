<?php

include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

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
$ID = $_GET['id'];

if (isset($_GET['Type'])) {
$type=$_GET['Type'];
}else{
  $type='';
}
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


$queryOrders ="SELECT * FROM `orders` WHERE OrderID=$ID";
$resultsOrders = mysqli_query($con,$queryOrders);
$row1=mysqli_fetch_array($resultsOrders,MYSQLI_ASSOC);
$SimType=$row1["SimType"];
$OperatorID=$row1["OperatorID"];

$query2 ="SELECT * FROM `production` WHERE OrderID=$ID";
$result2 = mysqli_query($con, $query2);
$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
$prevSimID=$row2["SimID"];

$query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType'";
$results = mysqli_query($con,$query);


if(isset($_POST['submit'])){

  $SimID=$_POST['SimID'];


  $Remark=$_POST['Remark'];

  if (empty($Remark)==true) {
    echo '<script>alert("Please Enter Update Remark")</script>';
  }else{


    $sql = "UPDATE production SET SimID=$SimID WHERE OrderID=$ID";
    $sql2 = "UPDATE simprovider SET IssueDate=NULL, RemarkUpdate='$Remark' WHERE ID=$prevSimID";

    if ($con->query($sql) === TRUE) {
           //header("location:protable.php?");
      echo '<script>alert("Your response recorded successfully")</script>';
    }else {
      echo "Error updating record: " . $con->error;
    }

    if ($con->query($sql2) === TRUE) {
           //header("location:protable.php?");
      echo '<script>alert("Your response recorded successfully")</script>';
    }else {
      echo "Error updating record: " . $con->error;
    }



    $queryAdd = "UPDATE simprovider SET IssueDate='$Date' WHERE ID=$SimID";

    if ($con->query($queryAdd) === TRUE) {
      echo '<script>alert("Your response recorded successfully")</script>';
      header("location:instable.php?user=$username");
    }else {
      echo  $con->error;
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Installation Details</title>
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
  //include "modals.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Update Number</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <form method="POST" action="">

            <center>
              <div class="form-group col-md-3">
               <select class="form-control rounded-corner" name="SimID">
                <option value="">Select Number</option>
                <?php
                while ($arr=mysqli_fetch_assoc($results)){
                  ?>
                  <option value="<?php echo $arr['ID']; ?>"><?php echo $arr['MobileNumber']; ?></option>

                <?php } ?>                
              </select>

            </div>
          </center>
          <div class="form-group col-md-12" align="center">

            <label for="Remark">Remark</label>
            <textarea class="form-control rounded-corner" cols="4" rows="4" name="Remark"></textarea>
          </div>  
          <br><br>
          <center>
            <input type="submit"  class=" btn btn-primary" value="submit" name="submit"></input>
          </center>      
        </form>
      </div>
    </div>
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
</body>
</html>

<?php 
$con -> close();
$con2 -> close();
?>
