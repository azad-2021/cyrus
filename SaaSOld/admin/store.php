<?php

include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Hour = date('G');
//echo $_SESSION['user'];

$user=$_SESSION['user'];

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}
$ID = $_GET['id'];

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
//$Date = date('Y-m-d',strtotime($timestamp));

$query ="SELECT * FROM `employees` WHERE Inservice='1' ORDER by `Employee Name`";
$results = mysqli_query($con2,$query);  


if(isset($_POST['submit'])){



  $IssueTo=$_POST['EmployeeCode'];
  $Remark=$_POST['Remark'];
  $Date=$_POST['Date'];
//echo $IssueTo;
      //$IssueTo = (int)$IssueTo;
  $queryAdd="INSERT INTO `store`( `OrderID`, `ReleaseDate`, `EmployeeCode`, `Remark` ) VALUES ('$ID', '$Date','$IssueTo', '$Remark')" ;
  $resultAdd = mysqli_query($con,$queryAdd);
  if ($resultAdd) {
    echo '<script>alert("Your response recorded successfully")</script>';

    $sql = "UPDATE orders SET Status='2' WHERE OrderID=$ID";

    if ($con->query($sql) === TRUE) {
     header("location:storetable.php?");
   }else {
    echo "Error updating record: " . $con->error;
  }

}else{
  echo $con->error;
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Update Date</title>
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
          <li class="breadcrumb-item active">Update Date</li>
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
                <label for="IssueDate">Release To</label>
                <select class="form-control rounded-corner" name="EmployeeCode" required="">
                  <option>Select</option>
                  <?php 
                  while ($arr=mysqli_fetch_assoc($results))
                  {
                    ?>
                    <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                    <?php
                  }?>      
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="ADate">Release Date</label>
                <br>
                <input type="date" name="Date" placeholder="dd/mm/yy" class="form-control rounded-corner" required>
              </div>
            </center>

            <div class="form-group col-md-12" align="center">
              <label for="Remark">Remark</label>
              <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" cols="4" rows="2" name="Remark"></textarea>
            </div>

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
<!-- Template Main JS File -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>