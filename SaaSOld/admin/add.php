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
$username = $_SESSION['user'];
$ID = $_GET['id'];

$query ="SELECT * FROM `operators`";
$resultOperator = mysqli_query($con, $query);

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


if(isset($_POST['submit'])){
  $Mobile=$_POST['Mobile'];
  $SimNo=$_POST['SimNo'];
  $Provider=$_POST['Provider'];
  $ADate=$_POST['ADate'];
  $ExpDate=$_POST['ExpDate'];
  $error='';

  $query ="SELECT * FROM `simprovider` WHERE MobileNumber=$Mobile";
  $results = mysqli_query($con,$query);

  if (strlen($Mobile) < 13){
    $error='<script>alert("Mobile Number must be 12 Digit Long")</script>';
  }elseif(strlen($SimNo) < 20 and $Provider=='Cyrus'){
    $error='<script>alert("Sim Number must be 20 Digit Long")</script>';
  }elseif ($results->num_rows > 0) {
   $error='<script>alert("Mobile Number already exist")</script>';
 }elseif (empty($SimNo) and $Provider=='Cyrus') {
   $error='<script>alert("Please Enter SimNo")</script>';
 }elseif (empty($ADate) and $Provider=='Cyrus') {
   $error='<script>alert("Please Enter Activation Date")</script>';
 }elseif (empty($ExpDate) and $Provider=='Cyrus') {
   $error='<script>alert("Please Enter Plan Expiry Date")</script>';
 }

 if(empty($error)==true){
  $SimType=$_POST['SimType'];
  $OperatorID=$_POST['Operator'];
  $Provider=$_POST['Provider'];
  $Remark=$_POST['Remark'];

  

  $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`,`ReleaseDate`, `IssueDate`, `ActivationDate`, `ExpDate`, `Remark`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$Date', '$Date', '$ADate', '$ExpDate', '$Remark')" ;
  $resultAdd = mysqli_query($con,$queryAdd);
  if ($resultAdd) {
    echo '<script>alert("Your response recorded successfully")</script>';
           //header("location:simtable.php?user=$username");
    $query ="SELECT * FROM `simprovider` WHERE MobileNumber=$Mobile";
    $results = mysqli_query($con,$query);
    $row3=mysqli_fetch_array($results,MYSQLI_ASSOC);
    $SimID=$row3["ID"];

    $sql = "UPDATE production SET SimID=$SimID WHERE OrderID=$ID";
    $sql2 = "UPDATE orders SET SimType='$SimType', OperatorID=$OperatorID WHERE OrderID=$ID";
    $sql3 = "UPDATE simprovider SET IssueDate=NULL, RemarkUpdate='Sim Changed' WHERE ID=$prevSimID";

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

    if ($con->query($sql3) === TRUE) {
     header("location:instable.php?");
     echo '<script>alert("Your response recorded successfully")</script>';
   }else {
    echo "Error updating record: " . $con->error;
  }

}else{
  echo "Error updating record: " . $con->error;
}
}else{
  echo $error;
}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add New Number</title>
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

  <script type="text/javascript">

    function limit1(element){
      var max_chars = 20;
      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }

    function limit2(element){
      var max_chars = 13;
      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }

  </script>
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
          <li class="breadcrumb-item active">Enter Installation Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <form method="POST" action="" align="center">
            <div class="row">
              <div class="form-group col-md-4">
                <label for="Branch">Mobile No.</label>
                <input type="text" maxlength="13" class="form-control rounded-corner" placeholder="Mobile No" name="Mobile" onkeydown="limit2(this);" onkeyup="limit2(this);" required>
              </div>
              <div class="form-group col-md-4">
                <label for="Bank ID">Sim No.</label>
                <input type="number" class="form-control rounded-corner" placeholder="Sim No" name="SimNo" onkeydown="limit1(this);" onkeyup="limit1(this);">
              </div>
              <div class="form-group col-md-4">
                <label for="IssueDate">Sim Type</label>
                <select class="form-control rounded-corner" name="SimType" required>
                  <option value="">Select</option>
                  <option value="Prepaid">Prepaid</option>
                  <option value="Postpaid">Postpaid</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IssueDate">Sim Provider</label>
                <select class="form-control rounded-corner" name="Provider" required>
                  <option value="">Select</option>
                  <option value="Cyrus">Cyrus</option>
                  <option value="Bank">Bank</option>
                </select>
              </div>
              <div class="form-group col-md-4">
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
              <div class="form-group col-md-4">
                <label for="ADate">Activation Date</label>
                <br>
                <input type="date" name="ADate" placeholder="dd/mm/yy" class="form-control rounded-corner">
              </div>
              <center>
                <div class="form-group col-md-4">
                  <label for="ADate">Plan Expiry Date</label>
                  <br>
                  <input type="date" name="ExpDate" placeholder="dd/mm/yy" class="form-control rounded-corner">
                </div>
              </center>
              <div class="form-group col-md-12">
                <label for="Remark">Remark</label>
                <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" cols="4" rows="4" name="Remark"></textarea>
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
