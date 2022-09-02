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
//echo $Date;

$queryOrders ="SELECT * FROM `orders` WHERE OrderID=$ID";
$resultsOrders = mysqli_query($con,$queryOrders);
$row1=mysqli_fetch_array($resultsOrders,MYSQLI_ASSOC);
$SimType=$row1["SimType"];
$OperatorID=$row1["OperatorID"];
$BranchCode=$row1["BranchCode"];
$GadgetID=$row1["GadgetID"];
$Provider=$row1["SimProvider"];

if ($Provider=='Bank') {
 $query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType' and SimProvider='Bank'";
}else{
  $query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType' and SimProvider='Cyrus'";   
}
//$query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType' and SimProvider='Cyrus'";
$results = mysqli_query($con,$query);
//$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
//$SimID=$row["ID"];

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
$row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
$Bank=$row3["BankName"];


$queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
$resultGadget = mysqli_query($con, $queryGadget);
$row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
$Gadget=$row5["Gadget"];

$queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
$resultsO = mysqli_query($con, $queryO);
$row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
$Operator=$row7["Operator"];

if(isset($_POST['submit'])){


  $SimID=$_POST['SimID'];
  $Remark=$_POST['Remark'];
//echo $SimID;
  $Date=$_POST['Date'];
  $queryAdd="INSERT INTO `production`( `OrderID`, `SimID`, `IssueDate`, `Remark`) VALUES ('$ID', '$SimID', '$Date', '$Remark')" ;
  $resultAdd = mysqli_query($con,$queryAdd);
  if ($resultAdd) {
    echo '<script>alert("Your response recorded successfully")</script>';

    $sql = "UPDATE orders SET Status='1' WHERE OrderID=$ID";
    $sql2 = "UPDATE simprovider SET IssueDate='$Date' WHERE ID=$SimID";
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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row"> 
          <div class="table-responsive">  
           <table class="table table-hover table-bordered border-primary nowrap"> 
            <thead> 
              <tr> 
                <th>Bank</th> 
                <th>Zone</th> 
                <th>Branch</th> 
                <th>Gadget</th> 
                <th>Sim Type</th> 
                <th>Operator</th>
                <th>Sim Provider</th> 
              </tr>                     
            </thead>                 
            <tbody> 
              <?php  
              echo '  
              <tr> 
              <td>'.$Bank.'</td>
              <td>'.$Zone.'</td>  
              <td>'.$Branch.'</td>  
              <td>'.$Gadget.'</td>  
              <td>'.$SimType.'</td>   
              <td>'.$Operator.'</td>
              <td>'.$Provider.'</td>  
              ';  

              ?> 

            </table>  
          </div>  

          <legend style="text-align: center;" class="my-select"><span style="color: red;">* </span>Select Number </legend>

            <form method="POST" action="">

              <center>
                <div class="form-group col-md-3">
                  <input type="text" id="input" class="form-control rounded-corner" placeholder="search number">
                  <br>
                  <select class="form-control rounded-corner" name="SimID" id="phone" required>
                    <option value="">Select</option>
                    <?php
                    while ($arr=mysqli_fetch_assoc($results)){
                      ?>
                      <option value="<?php echo $arr['ID']; ?>"><?php echo $arr['MobileNumber']; ?></option>

                    <?php } ?>                
                  </select>

                </div>

                <div class="form-group col-md-3" align="center">
                  <label><span style="color: red;">* </span>Production Date</label>
                  <input type="date" name="Date" class="form-control rounded-corner" required>
                </div>
              </center>
              <div class="form-group col-md-12" align="center">

                <label for="Remark">Remark</label>
                <textarea class="form-control rounded-corner" cols="1" rows="4" name="Remark"></textarea>


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

    <script>
    </script>

    <script>

      $('#input').keyup(function () {
        select_search($('#input').val(),$('#phone option'));
      });
    </script>
    <script  src="livesearch/select_search.js"></script>
  </body>
  </html>
  <?php 
  $con -> close();
  $con2 -> close();
?>