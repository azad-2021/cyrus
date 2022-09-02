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


$query ="SELECT * FROM `employees` WHERE Inservice='1' ORDER by `Employee Name`";
$results = mysqli_query($con2,$query);  

$query2 ="SELECT * FROM `orders` WHERE OrderID=$ID and OperatorID is not null";
$result2 = mysqli_query($con,$query2);
$row=mysqli_fetch_array($result2,MYSQLI_ASSOC);

$query3 ="SELECT * FROM `orders` WHERE OrderID=$ID and OperatorID is null";
$result3 = mysqli_query($con,$query3);
$row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);

$query4 ="SELECT * FROM `orders` WHERE OrderID=$ID";
$result4 = mysqli_query($con,$query4);
$data=mysqli_fetch_array($result4,MYSQLI_ASSOC);

$query5 ="SELECT MobileNumber FROM `simprovider` join production on simprovider.ID=production.SimID WHERE production.OrderID=$ID";
$result5 = mysqli_query($con,$query5);
$row5=mysqli_fetch_array($result5,MYSQLI_ASSOC);
$Mobile=$row5["MobileNumber"];

$BranchCode=$data["BranchCode"];
$queryBranch ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
$resultBranch = mysqli_query($con2, $queryBranch);
$row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
$Branch=$row4["BranchName"];
//$BranchCode=$row4["BranchCode"];
$ZoneCode= $row4["ZoneRegionCode"];

$queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
$resultZone = mysqli_query($con2, $queryZone);
$row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
$Zone=$row2["ZoneRegionName"];
$BankCode=$row2["BankCode"];

$queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
$resultBank = mysqli_query($con2, $queryBank);
$row5=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
$Bank=$row5["BankName"];

if (empty($row3)==false) {
  // code...
  $Provider2=$row3['SimProvider'];
}else{
  $Provider2='';
}


if (empty($row)==false) {
  // code...
  $Provider=$row['SimProvider'];

}else{
  $Provider='';
}


date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


if(isset($_POST['submit'])){

  $error=[];

  if(empty($_POST['EmployeeCode']==true)){
    $error='<script>alert("Please Select Service Engineer")</script>';
  }elseif(empty($_POST['InstDate']==true)){
   $error='<script>alert("Please Enter Installation Date")</script>';
 }elseif (isset($_POST['Mobile'])) {

  $Mobile=$_POST['Mobile'];
  $SimNo=$_POST['SimNo'];
  $ADate=$_POST['ADate'];
  $ExpDate=$_POST['ExpDate'];
  
  if (strlen($Mobile) < 10){
    $error='<script>alert("Mobile Number must be 10 Digit Long")</script>';
  }if (!empty($SimNo) and strlen($SimNo) < 20){
    $error='<script>alert("Sim Number must be 20 Digit Long")</script>';
  }

}

if(empty($error)==true){


  $InstalledBy=$_POST['EmployeeCode'];
  $InstDate=$_POST['InstDate'];
  $Remark=$_POST['Remark'];
  if (isset($_POST['Mobile'])) {

    $Mobile=$_POST['Mobile'];
    $SimNo=$_POST['SimNo'];
    $SimType=$_POST['SimType'];
    $OperatorID=$_POST['Operator'];
    $ADate=$_POST['ADate'];
    $ExpDate=$_POST['ExpDate'];

    $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `ReleaseDate`, `IssueDate`, `ActivationDate`, `ExpDate`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', 'Bank', '$Date', '$Date', '$ADate', '$ExpDate')" ;
    $resultAdd = mysqli_query($con,$queryAdd);
    if ($resultAdd) {

      $query3 ="SELECT ID FROM `simprovider` WHERE MobileNumber=$Mobile";
      $result3 = mysqli_query($con,$query3);
      $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
      $SimID=$row3['ID'];

      $sql = "UPDATE production SET SimID=$SimID WHERE OrderID=$ID";
      $sql2 = "UPDATE orders SET SimType='$SimType', OperatorID=$OperatorID, Status='3', Installed='1' WHERE OrderID=$ID";

      if ($con->query($sql) === TRUE) {
           //header("location:protable.php?");
        echo '<script>alert("Your response recorded successfully")</script>';
      }else {
        echo "Error updating record: " . $con->error;
      }

      if ($con->query($sql2) === TRUE) {
       header("location:index.php?");
          //echo '<script>alert("Your response recorded successfully")</script>';
     }else {
      echo "Error updating record: " . $con->error;
    }

  }else {
    echo "Error updating record: " . $con->error;
  }

  $queryAdd="INSERT INTO `installation`( `OrderID`, `InstalledBy`, `InstallationDate`, `Remark` ) VALUES ('$ID', '$InstalledBy','$InstDate', '$Remark')" ;
  $resultAdd = mysqli_query($con,$queryAdd);

}else{
  $queryAdd="INSERT INTO `installation`( `OrderID`, `InstalledBy`, `InstallationDate`, `Remark` ) VALUES ('$ID', '$InstalledBy','$InstDate', '$Remark')" ;
  $resultAdd = mysqli_query($con,$queryAdd);
  if ($resultAdd) {
    echo '<script>alert("Your response recorded successfully")</script>';

    if (isset($_POST['ADate'])) {

      $ADate=$_POST['ADate'];
      $ExpDate=$_POST['ExpDate'];

      $query4 ="SELECT * FROM `production` WHERE OrderID=$ID";
      $result4 = mysqli_query($con,$query4);
      $row4=mysqli_fetch_array($result4,MYSQLI_ASSOC);
      $SimID=$row4['SimID'];

      $sqlX = "UPDATE simprovider SET ActivationDate='$ADate', ExpDate='$ExpDate' WHERE ID=$SimID";

      if ($con->query($sqlX) === TRUE) {
       echo '<script>alert("Your response recorded successfully")</script>';
     }else {
      echo "Error updating record: " . $con->error;
    }

  }

  $sql = "UPDATE orders SET Status='3', Installed='1' WHERE OrderID=$ID";

  if ($con->query($sql) === TRUE) {
   header("location:instable.php?");
 }else {
  echo "Error updating record: " . $con->error;
}

}else{
  echo $con->error;
}

}
}else{
  print_r($error);
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Enter Details</title>
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

    function limit1(element)
    {
      var max_chars = 20;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }


    function limit2(element)
    {
      var max_chars = 10;

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

          <form method="POST" action="">
            <?php
            if ($Provider2=='Bank' or $Provider2=='No SIM') {

              $query ="SELECT * FROM `operators`";
              $resultOperator = mysqli_query($con, $query);
              ?>

              <div class="row">
                <div class="form-group col-md-4">
                  <label for="Branch"><span style="color: red;">* </span>Mobile No.</label>
                  <input type="number" class="form-control rounded-corner" placeholder="Mobile No" name="Mobile" onkeydown="limit2(this);" onkeyup="limit2(this);" required minlength="10">
                </div>
                <div class="form-group col-md-4">
                  <label for="Bank ID"><span style="color: red;">* </span>Sim No.</label>
                  <input type="number" class="form-control rounded-corner" placeholder="Sim No" name="SimNo" onkeydown="limit1(this);" onkeyup="limit1(this);">
                </div>
                <div class="form-group col-md-4">
                  <label for="IssueDate"><span style="color: red;">* </span>Sim Type</label>
                  <select class="form-control rounded-corner" name="SimType" required>
                    <option value="">Select</option>
                    <option value="Prepaid">Prepaid</option>
                    <option value="Postpaid">Postpaid</option>
                  </select>

                </div>
                <div class="form-group col-md-4">
                  <label for="operator"><span style="color: red;">* </span>Operator</label>
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

                <div class="form-group col-md-4">
                  <label for="ADate">Plan Expiry Date</label>
                  <br>
                  <input type="date" name="ExpDate" placeholder="dd/mm/yy" class="form-control rounded-corner">
                </div>

              </div>
            <?php } ?>
            <?php
            if ($Provider=='Bank') {

              $query ="SELECT * FROM `operators`";
              $resultOperator = mysqli_query($con, $query);
              ?>
              <div class="row">

                <div class="form-group col-md-6">
                  <label for="ADate">Activation Date</label>
                  <br>
                  <input type="date" name="ADate" placeholder="dd/mm/yy" class="form-control rounded-corner">
                </div>

                <div class="form-group col-md-6">
                  <label for="ADate">Plan Expiry Date</label>
                  <br>
                  <input type="date" name="ExpDate" placeholder="dd/mm/yy" class="form-control rounded-corner">
                </div>

              </div>
            <?php } ?>
            <center>
              <br>
              <table class="table table-hover table-bordered border-primary nowrap">
                <thead>
                  <tr>
                    <th scope="col">Bank</th>
                    <th scope="col">Zone</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Mobile Number</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $Bank ?></td>
                    <td><?php echo $Zone ?></td>
                    <td><?php echo $Branch ?></td>
                    <td><?php echo $Mobile ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="form-group col-md-3">
                <label for="IssueDate"><span style="color: red;">* </span>Installed By</label>
                <select class="form-control rounded-corner" name="EmployeeCode" required>
                  <option value="">Select</option>
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
                <label for="InstDate"><span style="color: red;">* </span>Installation Date</label>
                <br>
                <input type="date" name="InstDate" placeholder="dd/mm/yy" class="form-control rounded-corner" required>
              </div>
              <div class="form-group col-md-3">
                <label for="InstDate">Remark</label>
                <br>
                <input type="text" name="Remark" class="form-control rounded-corner">
              </div>
            </center>
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