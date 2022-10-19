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
  $Remark=!empty($_POST['Remark'])?$_POST['Remark']:'';
  $ZoneCode=$_POST['Zone'];
  $query ="SELECT * FROM `simprovider` WHERE `MobileNumber`=$Mobile";
  $result = mysqli_query($con, $query);
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

      if (!empty($Remark)) {

       $sql="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `ActivationDate`, `ExpDate`, `Remark`, ZoneregionCode) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$ADate', '$ExpDate', '$Remark', $ZoneCode)" ;
     }else{

       $sql="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `ActivationDate`, `ExpDate`, ZoneregionCode) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$ADate', '$ExpDate', $ZoneCode)" ;
     }

   }else{

    if (!empty($Remark)) {
      $sql="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `Remark`, ZoneregionCode) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$Remark', $ZoneCode)" ;
    }else{

      $sql="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, ZoneregionCode) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', $ZoneCode)" ;
    }

  }


  if ($con->query($sql) === TRUE) {
    echo '<script>alert("Your response recorded successfully")</script>';
    header("location:index.php?");
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
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

          <div class="col-lg-3">
            <label>Select Bank</label>
            <select id="Bank" class="form-control rounded-corner" name="Bank" required>
              <option value="">Bank</option>
              <?php
              $BankData="Select BankCode, BankName from bank order by BankName";
              $result=mysqli_query($con2,$BankData);
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
          <div class="col-lg-3">
            <label>Select Zone</label>
            <select id="Zone" class="form-control rounded-corner" name="Zone" required>
              <option value="">Zone</option>
            </select>
          </div>


          <div class="col-lg-3">
            <label for="Branch">Mobile No.</label>
            <input type="text" minlength="13" maxlength="13" class="form-control rounded-corner" placeholder="Mobile No" name="Mobile" onkeydown="limit2(this);" onkeyup="limit2(this);" required>
          </div>
          <div class="col-lg-3">
            <label for="Bank ID">SIM No.</label>
            <input type="text" class="form-control rounded-corner" placeholder="Sim No" name="SimNo" onkeydown="limit1(this);" onkeyup="limit1(this);"required>
          </div>
          <div class="col-lg-2">
            <label for="IssueDate">SIM Type</label>
            <select class="form-control rounded-corner" name="SimType" required>
              <option value="">Select</option>
              <option value="Prepaid">Prepaid</option>
              <option value="Postpaid">Postpaid</option>
            </select>

          </div>
          <div class="col-lg-2">
            <label for="IssueDate">SIM Provider</label>
            <select class="form-control rounded-corner" name="Provider" required onchange="yesnoCheck(this);">
              <option value="">Select</option>
              <option value="Bank">Bank</option>
              <option value="Cyrus">Cyrus</option>
            </select>

          </div>
          <div class="col-lg-2">
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

          <div class="col-lg-3">
            <label for="SimType">Activation Date</label>
            <input type="date" id="ADate" name="ADate" placeholder="dd/mm/yy" class="form-control rounded-corner">
          </div>

          <div class="col-lg-3">
            <label for="SimType">Recharge Expiry Date</label>
            <input type="date" id="ExpDate" name="RDate" placeholder="dd/mm/yy" class="form-control rounded-corner">
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
  <script type="text/javascript">


   function yesnoCheck(that) {
    if(that.value == "Bank"){
      document.getElementById("ADate").required=true;
      document.getElementById("ExpDate").required=true;

      document.getElementById("ExpDate").disabled=false;
      document.getElementById("ADate").disabled=false;

    }else{
      document.getElementById("ExpDate").required=false;
      document.getElementById("ADate").required=false;

      document.getElementById("ExpDate").disabled=true;
      document.getElementById("ADate").disabled=true;
    }
  }


  function limit1(element)
  {
    var max_chars = 20;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }


  function limit2(element)
  {
    var max_chars = 13;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }



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
    }
  });
</script>
</body>
</html>
<?php 
$con -> close();
$con2 -> close();
$con3 -> close();
?>