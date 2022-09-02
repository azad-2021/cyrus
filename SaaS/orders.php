<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

$OrderID=$_GET['oid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

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


$query ="SELECT * FROM `gadget`";
$results = mysqli_query($con, $query);


$query ="SELECT * FROM `operators`";
$resultOperator = mysqli_query($con, $query);

$query2 ="SELECT * FROM `operators`";
$results2 = mysqli_query($con, $query2);

$query3 ="SELECT * FROM saas.orders
join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode WHERE OrderID=$OrderID";
$result3 = mysqli_query($con, $query3);
$arr3=mysqli_fetch_assoc($result3);

if(isset($_POST['submit'])){

  $GadgetID=$_POST['GadgetID'];
  $Validity=$_POST['Validity'];
  $SimType=$_POST['SimType'];
  $OperatorID=$_POST['OperatorID'];
  $Remark=$_POST['Remark'];
  $Provider=$_POST['Provider'];
  $errors='';

  if($Provider=='Cyrus'){
    if (empty($Validity)==true) {
      $errors='<script>alert("Please Enter Validity of Recharge")</script>';
    }
  }

  if(isset($_POST['Other'])){
    $_POST['Other'];

    if ($Other=='1') {

      if (empty($Remark)==true) {
        $errors='<script>alert("Please Enter Remark")</script>';
      }
    }
  }elseif($GadgetID=='5') {
    if (empty($_POST['categoryZ2M1'] or $_POST['categoryZ2M2'])==true) {

      $errors='<script>alert("Please Enter Zone Message")</script>';
    }else{

      $CatZ2M1=$_POST['categoryZ2M1'];
      $CatZ2M2=$_POST['categoryZ2M2'];

      $Category='Zone 1 = '.$CatZ2M1.';
      Zone 2 = '.$CatZ2M2;
    }
  }elseif ($GadgetID=='6') {
    if (empty($_POST['categoryZ4M1'] or $_POST['categoryZ4M2'] or $_POST['categoryZ4M3'] or $_POST['categoryZ4M4'])==true) {
      $errors='<script>alert("Please Enter Zone Message")</script>';
    }else{

      $CatZ4M1=$_POST['categoryZ4M1'];
      $CatZ4M2=$_POST['categoryZ4M2'];
      $CatZ4M3=$_POST['categoryZ4M3'];
      $CatZ4M4=$_POST['categoryZ4M4'];

      $Category='Zone 1 = '.$CatZ4M1.';
      Zone 2 = '.$CatZ4M2.';
      Zone 3 = '.$CatZ4M3.';
      Zone 4 = '.$CatZ4M4;
    }
  }

  if (empty($errors)==true) {

    if (empty($OperatorID)==false) {
        // code...
      if (empty($SimType)==true) {
        echo '<script>alert("Please select Sim Type")</script>';
      }else{
        $sql="UPDATE orders SET GadgetID='$GadgetID', SimProvider='$Provider', SimType='$SimType', OperatorID=$OperatorID, ValidityRecharge=$Validity, VoiceMessage='$Category', Remark='$Remark' WHERE OrderID=$OrderID";

        if ($con3->query($sql) === TRUE) {
          header("location:ReceivedOrders.php?");
        } else {
          echo "Error: " . $sql . "<br>" . $con3->error;
        }
      }
    }else{

      $queryAdd="UPDATE orders SET GadgetID='$GadgetID', SimProvider='$Provider', ValidityRecharge=$Validity, VoiceMessage='$Category', Remark='$Remark' WHERE OrderID=$OrderID";
      $resultAdd = mysqli_query($con3,$queryAdd);
      if ($resultAdd) {
        header("location:ReceivedOrders.php?");
      }
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

  <title>Add Orders</title>
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
          <li class="breadcrumb-item active">Add Orders</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <form method="POST" action="" class="form-control rounded-corner">
        <div class="row">

          <div class="form-group col-lg-4">
            <label>Bank</label>
            <input type="text" class="form-control rounded-corner" name="Bank" value="<?php echo $arr3['BankName'] ?>" disabled>
          </div>
          <div class="form-group col-lg-4">
            <label>Zone</label>
            <input type="text" class="form-control rounded-corner" name="Zone" value="<?php echo $arr3['ZoneRegionName'] ?>" disabled>
          </div>
          <div class="form-group col-lg-4">
            <label>Branch</label>
            <input type="text" class="form-control rounded-corner" name="Branch" value="<?php echo $arr3['BranchName'] ?>" disabled>
          </div>

          <div class="col-lg-3">
            <label><span style="color: red;">* </span>Gadget</label>
            <select class="form-control rounded-corner" name="GadgetID" required onchange="yesnoCheck(this);">
              <option value="">Select Gadget</option>
              <?php 
              while ($arr=mysqli_fetch_assoc($results))
              {
                ?>
                <option value="<?php echo $arr['GadgetID']; ?>"><?php echo $arr['Gadget']; ?></option>
                <?php
              }?>      
            </select>
          </div>

          <div class="form-group col-lg-3">
            <label for="SimType"><span style="color: red;">* </span>Sim Provider</label>
            <select class="form-control rounded-corner" id="provider" name="Provider" required>
              <option value="">Select</option>
              <option value="Bank">Bank</option>
              <option value="Cyrus">Cyrus</option>  
              <option value="No SIM">No SIM</option>     
            </select>
          </div>

          <div class="form-group col-lg-3">
            <label for="SimType">Select Sim Type</label>
            <select class="form-control rounded-corner" id="SimType" name="SimType">
              <option value="">Select</option>
              <option value="Prepaid">Prepaid</option>
              <option value="Postpaid">Postpaid</option>      
            </select>
          </div>

          <div class="form-group col-lg-3">
            <label for="Operator">Operator</label>
            <select class="form-control rounded-corner" id="Operator" name="OperatorID">
              <option value="">Select</option>
              <?php 
              while ($arr=mysqli_fetch_assoc($resultOperator))
              {
                ?>
                <option value="<?php echo $arr['OperatorID']; ?>"><?php echo $arr['Operator']; ?></option>
                <?php
              }?>      
            </select>
          </div>

          <div class="form-group col-lg-4">
            <label for="Validity of Recharge">Validity of Recharge in Months</label>
            <select class="form-control rounded-corner" name="Validity">
              <option value="">Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>   
              <option value="5">5</option>
              <option value="6">6</option>   
              <option value="7">7</option>
              <option value="8">8</option>   
              <option value="9">9</option>
              <option value="10">10</option> 
              <option value="11">11</option>
              <option value="12">12</option>   
              <option value="24">24</option>   
            </select>
          </div>
          <div id="1" style="display: none;">
            <div class="form-group col-lg-3">
              <label for="Validity of Recharge">Voice Category for Zone 1</label>
              <select class="form-control rounded-corner" name="categoryZ2M1">
                <option value="">Select</option>
                <option value="Alarm">Alarm</option>
                <option value="Fire Alarm">Fire Alarm</option>
              </select>
            </div>

            <div class="form-group col-lg-3">
              <label for="Validity of Recharge">Voice Category for Zone 2</label>
              <select class="form-control rounded-corner" name="categoryZ2M2">
                <option value="">Select</option>
                <option value="Alarm">Alarm</option>
                <option value="Fire Alarm">Fire Alarm</option>
              </select>
            </div>

            <div class="form-group col-lg-3">
              <p>For other Remark is mandatory</p>
              <label class="form-check-label" for="flexCheckDefault">Other</label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="Other">
            </div>
          </div>

          <div id="2" style="display: none;">
            <div class="form-group col-lg-2">
              <label for="Validity of Recharge">Category Zone 1</label>
              <select class="form-control rounded-corner" name="categoryZ4M1">
                <option value="">Select</option>
                <option value="Alarm">Alarm</option>
                <option value="Fire Alarm">Fire Alarm</option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <label for="Validity of Recharge">Category Zone 2</label>
              <select class="form-control rounded-corner" name="categoryZ4M2">
                <option value="">Select</option>
                <option value="Alarm">Alarm</option>
                <option value="Fire Alarm">Fire Alarm</option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <label for="Validity of Recharge">Category Zone 3</label>
              <select class="form-control rounded-corner" name="categoryZ4M3">
                <option value="">Select</option>
                <option value="Alarm">Alarm</option>
                <option value="Fire Alarm">Fire Alarm</option>
              </select>
            </div>

            <div class="form-group col-lg-3">
              <label for="Validity of Recharge">Category Zone 4</label>
              <select class="form-control rounded-corner" name="categoryZ4M4">
                <option value="">Select</option>
                <option value="Alarm">Alarm</option>
                <option value="Fire Alarm">Fire Alarm</option>
              </select>
            </div>

            <div class="form-group col-lg-3">
              <p>For other Remark is mandatory</p>
              <label class="form-check-label" for="flexCheckDefault">Other</label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="Other">
            </div>
          </div>
          <div class="form-group col-lg-4">
            <label>Reference ID</label>
            <input type="text" class="form-control rounded-corner" name="Branch" value="<?php echo $arr3['RefID'] ?>" disabled>
          </div>

          <div class="form-group col-md-12">
            <label for="Remark">Remark</label>
            <textarea class="form-control rounded-corner"cols="12" rows="4" name="Remark"></textarea>
          </div> 
          <center>
            <br><br>
            <input type="submit"  class=" btn btn-primary" value="submit" name="submit"></input>
          </center> 
        </div>
      </div>     
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
    if(that.value == "5"){
      document.getElementById("1").style.display = "flex";
      document.getElementById("2").style.display = "none";
    }else if(that.value == "6") {
      document.getElementById("2").style.display = "flex";
      document.getElementById("1").style.display = "none";
    }else{
      document.getElementById("1").style.display = "none";
      document.getElementById("2").style.display = "none";
    }
  }
  $(document).on('change','#provider', function(){
    var Provider = document.getElementById("provider").value;
    console.log(Provider);
    if (Provider=='No SIM') {
      document.getElementById("SimType").disabled = true;
      document.getElementById("Operator").disabled = true;
    }else{
      document.getElementById("SimType").disabled = false;
      document.getElementById("Operator").disabled = false;
    }
  });
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
$con3 -> close();
?>