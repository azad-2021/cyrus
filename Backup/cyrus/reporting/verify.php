<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];
$Edit=1;
$ApprovalID = base64_decode($_GET['apid']);
$enApprovalID=$_GET['apid'];
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


$sql = "SELECT * from pbills where ApprovalID = '$ApprovalID'";  
$result = mysqli_query($con2, $sql);  
if (mysqli_num_rows($result)>0)
{
  $Material='YES';
}else{
  $Material='NO';
}

$sql = "select * from estimates where ApprovalID = '$ApprovalID'";  
$result = mysqli_query($con2, $sql);
if (mysqli_num_rows($result)>0)
{
  $Estimate='YES';
}else{
  $Estimate='NO';
}

$query ="SELECT * FROM `approval`
join gadget on approval.GadgetID=gadget.GadgetID
join branchdetails on approval.BranchCode = branchdetails.BranchCode WHERE ApprovalID=$ApprovalID";
$results = mysqli_query($con, $query);
$row=mysqli_fetch_array($results);

$VisitDate = $row["VisitDate"];
$Status = $row["Status"];
$GadgetID = $row["GadgetID"];
$Jobcard = $row["JobCardNo"]; 

if (strpos($Jobcard, 'AMC') == true) {
  $s=substr($Jobcard,-1) ;
  if ($s!='C') {
    $jobcard=substr($Jobcard, 0,-1) ;
  }else{
    $jobcard=$Jobcard;
  }
  $s=substr($jobcard, 0,-1) ;
  $s=substr($s, 0,-1);
  $Jtest=substr($s, 0,-1) ;

  $s=substr($Jtest,-1) ;
  if (($s=='C') or ($s=='A')) {
    $Jtest=$s;

  }else{
    echo '<script>alert("Jobcard number not ending with A or C")</script>';
  }


}else{

  $s=substr($Jobcard,-1) ;
  if (($s!='C') or ($s!='A')) {

    $jobcard=substr($Jobcard, 0,-1) ;
    echo '<script>alert('.$jobcard.')</script>';
  }else{
    $jobcard=$Jobcard;
    echo '<script>alert('.$jobcard.')</script>';
  }

  $s=substr($jobcard,-1) ;
  if (($s=='C') or ($s=='A')) {
    $Jtest=$s;

  }else{
    echo '<script>alert("Jobcard number not ending with A or C")</script>';
  }
}


/*
$s=substr($jobcard,-1) ;

if ($s == 'C') {
   //echo 'CCTV';
  $link='CCTV';
}elseif ($s == 'A') {
    //echo 'Alarm';
  $link='Alarm';
}else{
  $jobcard=substr($jobcard, 0,-1) ;
  $s=substr($jobcard, -1) ;
    //echo $s;
  if ($s == 'C') {
   //echo 'CCTV';
    $link='CCTV';
  }elseif ($s == 'A') {
    //echo 'Alarm';
    $link='Alarm';
  }
}
*/

$enJobcard=base64_encode($Jobcard);
$EmployeeID = $row["EmployeeID"];
$Gadget=$row["Gadget"];
$OrderID=$row["OrderID"];
$ComplaintID=$row["ComplaintID"];
$BranchCode = $row["BranchCode"];
$BranchName= $row["BranchName"];
$BranchPhone=$row["PhoneNo"];
$BranchMobile=$row["Mobile Number"];
$Zone= $row["ZoneRegionName"];
$Bank= $row["BankName"];

if($ComplaintID>0){
  $ID=$ComplaintID;
  $refrence='Complaint';
  $query ="SELECT * FROM `complaints` Where ComplaintID=$ComplaintID";
  $results = mysqli_query($con, $query);
  $row=mysqli_fetch_array($results);
  $Description = $row["Discription"];
}else{
  $ID=$OrderID;
  $refrence='Order';
  $query ="SELECT * FROM `orders` Where OrderID=$OrderID";
  $results = mysqli_query($con, $query);
  $row=mysqli_fetch_array($results);
  $Description = $row["Discription"];
}

$sqlx = "SELECT * from `jobcardmain` where `Card Number` = '$Jobcard'";  
$resultx = mysqli_query($con, $sqlx);  
if (mysqli_num_rows($resultx)>0)
{
 echo '<script>alert("Jobcard alredy exist")</script>';

}

$JAMC=$Jobcard.'AMC';

$sqly = "SELECT * from `jobcardmain` where `Card Number` = '$JAMC'";  
$resulty = mysqli_query($con, $sqly);  
if (mysqli_num_rows($resulty)>0)
{
 echo '<script>alert("Jobcard alredy exist")</script>';

}


if(isset($_POST['submit'])){
 $Vremark=$_POST['VRemark'];
 $Vpending=$_POST['Vpending'];

 $posted='1';
 $errors= '';

 if(empty($_POST['Vok'])==true){
  $errors = '<script>alert("Please select Branch Status")</script>';
}elseif(empty($_POST['call'])==true){
  $errors = '<script>alert("Please select Call Status")</script>';
}elseif(empty($_POST['Vopen'])==true){
  $errors = '<script>alert("Please select Close ID")</script>';
}elseif((mysqli_num_rows($resultx)>0) and $Vremark != 'REJECTED') {
 $errors= '<script>alert("Jobcard alredy exist Plese type REJECTED")</script>';
}elseif((mysqli_num_rows($resulty)>0) and $Vremark != 'REJECTED') {
 $errors= '<script>alert("Jobcard alredy exist Plese type REJECTED")</script>';
}


if(empty($errors)==true){
 $Vok=$_POST['Vok'];
 $Vopen=$_POST['Vopen'];
 $call=$_POST['call'];

 if ($Vok=='YES') {
  $Vok='1';
}else{
  $Vok='0';
}

if ($call=='YES') {
  $call='1';
}else{
  $call='0';
}

if ($Vopen=='YES') {
  $Vopen='0';
  $Attended='1';
}else{
  $Vopen='1';
  $Attended='0';
}

if ($Vok=='1') {
  $Remark='OK';
}else{
  $Remark='NOT OK';
}


if ($Vremark=='REJECTED') {

}else{
  $queryAdd="INSERT INTO `reference table`( `Reference`, `Card Number`, `EmployeeCode`, `VisitDate`, `User`, `BranchCode`,  `ID`) VALUES ('$refrence','$Jobcard','$EmployeeID', '$VisitDate', '$user', '$BranchCode', '$ID')" ;
  $ResultADD = mysqli_query($con,$queryAdd);

  $sql3 = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `WorkPending`, `Remark`, `GadgetID`, `EmployeeCode`) VALUES('$Jobcard', '$BranchCode', '$VisitDate', '$Vpending', '$Remark', '$GadgetID', '$EmployeeID')";

  $Result3 = mysqli_query($con,$sql3);

}
if($ComplaintID>0){
  $sql2 = "UPDATE `complaints` SET Attended='$Attended', AttendDate='$VisitDate', `Call verified`='$call', `Verification remark`='$Vremark' WHERE ComplaintID=$ComplaintID";

  if ($con->query($sql2) === TRUE) {
    if ($Vremark=='REJECTED') {

      $sql = "UPDATE `approval` SET VDate='$Date', Vby='$user', Vremark='$Vremark', Vpending='$Vpending', Vok='$Vok', vopen='$Vopen', posted='$posted' WHERE ComplaintID=$ComplaintID";
      $resultupdate = mysqli_query($con,$sql);
      $query ="SELECT * FROM `approval` WHERE ComplaintID=$ComplaintID";
      $results = mysqli_query($con, $query);
      while($row=mysqli_fetch_array($results)){
        $DelCard=$row["JobCardNo"];
        $query ="DELETE FROM jobcardmain WHERE `Card Number`='$DelCard'";
        $res = mysqli_query($con, $query);
      }

      header("location:/technician/rejectjobcard.php?cardno=$Jobcard&empid=$EmployeeID");
    }else{
      $sql = "UPDATE `approval` SET VDate='$Date', Vby='$user', Vremark='$Vremark', Vpending='$Vpending', Vok='$Vok', vopen='$Vopen', posted='$posted' WHERE ApprovalID=$ApprovalID";
      $resultupdate = mysqli_query($con,$sql);
      $sql = "UPDATE `complaints` SET `Verification remark`='$Vremark' WHERE ComplaintID=$ComplaintID";
      $resultupdate = mysqli_query($con,$sql);
      header("location:/technician/copyjobcard.php?cardno=$Jobcard&empid=$EmployeeID");
    }
  }else{
    echo "Error updating record: in Complaints:  " . $con->error;
  }

}else{

  $sqlo = "UPDATE `orders` SET Attended='$Attended', AttendDate='$VisitDate', `Call verified`='$call', `Verification remark`='$Vremark' WHERE OrderID=$OrderID";

  if ($con->query($sqlo) === TRUE) {
    if ($Vremark=='REJECTED') {

      $sql = "UPDATE `approval` SET VDate='$Date', Vby='$user', Vremark='$Vremark', Vpending='$Vpending', Vok='$Vok', vopen='$Vopen', posted='$posted' WHERE OrderID=$OrderID";
      $resultupdate = mysqli_query($con,$sql);

      $query ="SELECT * FROM `approval` WHERE OrderID=$OrderID";
      $results = mysqli_query($con, $query);
      while($row=mysqli_fetch_array($results)){
        $DelCard=$row["JobCardNo"];
        $query ="DELETE FROM jobcardmain WHERE `Card Number`='$DelCard'";
        $res = mysqli_query($con, $query);
      }


      $enEmployeeID=base64_encode($EmployeeID);
      header("location:/technician/rejectjobcard.php?cardno=$Jobcard&empid=$enEmployeeID");
    }else{
      $sql = "UPDATE `approval` SET VDate='$Date', Vby='$user', Vremark='$Vremark', Vpending='$Vpending', Vok='$Vok', vopen='$Vopen', posted='$posted' WHERE ApprovalID=$ApprovalID";
      $resultupdate = mysqli_query($con,$sql);
      $sql = "UPDATE `orders` SET `Verification remark`='$Vremark' WHERE OrderID=$OrderID";
      $resultupdate = mysqli_query($con,$sql);
      $enEmployeeID=base64_encode($EmployeeID);
      header("location:/technician/copyjobcard.php?cardno=$Jobcard&empid=$enEmployeeID");
    }
  }else {
    echo  $con->error;
  }
}
//header("location:vexecutive.php?empid=$enEmployeeID");
}else{
  print_r($errors);
}
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Verify</title>
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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

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
    <section class="section dashboard">
      <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Verification details</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <div class="table-responsive container">
        <table class="table table-hover table-sm table-bordered border-primary nowrap">
          <thead>
            <tr>
              <th style="min-width:120px">Bank</th>
              <th style="min-width:120px">Zone</th>
              <th style="min-width:280px">Branch Name</th>
              <th style="min-width:50px">ID</th>
              <th style="min-width:100px">Gadget</th>
              <th style="min-width:150px">Phone No.</th>
              <th style="min-width:150px">Mobile No.</th>
              <th style="min-width:120px">Date of Visit</th>

            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $Bank;?></td>
              <td><?php echo $Zone;?></td>
              <td><?php echo $BranchName;?></td>
              <td><?php echo $ID;?></td>
              <td><?php echo $Gadget;?></td>
              <td><?php echo $BranchPhone;?></td>
              <td><?php echo $BranchMobile;?></td>
              <td><?php echo date('d-M-Y',strtotime($VisitDate));?></td>

            </tr>
          </tbody>
        </table>
      </div>

      <div class="table-responsive container">
        <table class="table table-hover table-sm table-bordered border-primary nowrap">
          <thead>
            <tr>
              <th style="min-width:250px">Description</th>
              <th style="min-width:100px">Job Card No.</th>
              <th style="min-width:150px">Material Consumed</th>
              <th style="min-width:150px">Estimate</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $Description;?></td>
              <td><a href="/technician/view.php?card=<?php echo base64_encode($Jobcard);?>" target="_blank"><?php echo $Jobcard;?></a></td>
              <td><a href="viewm.php?apid=<?php echo $ApprovalID;?>" target="_blank"><?php  echo $Material; ?></a></td>
              <td><a href="viewe.php?apid=<?php echo $ApprovalID;?>" target="_blank"><?php  echo $Estimate; ?></a></td>
            </tr>
          </tbody>
        </table>
      </div>

      <br>
      <center>
        <div class="pagetitle">
          <h1>Verification Status</h1>
        </div>
      </center>
      <fieldset>

        <form method="POST" action="">
          <div class="row">
            <div class="col-lg-12">
              <label for="Branch">Verification Remark</label>
              <textarea class="form-control rounded-corner" cols="4" rows="2" name="VRemark" required></textarea>
            </div>
            <div class="col-lg-12">
              <label for="Bank ID">Pending Work</label>
              <textarea class="form-control rounded-corner" cols="4" rows="2" name="Vpending"></textarea>
            </div>

            <div class="col-lg-4">
              <br>
              <h5><label for="Branch">Branch OK</label></h5>
              <input type="radio" name="Vok" id="Vok" value="YES" >
              <label for="yes">Yes</label>
              &nbsp;
              <input type="radio" id="Vok" name="Vok" value="NO">
              <label for="no">No</label>

            </div>

            <div class="col-lg-4">
              <br>
              <h5><label for="Branch">Call Verified</label></h5>
              <input type="radio" name="call" id="call" value="YES">
              <label for="yes">Yes</label>
              &nbsp;
              <input type="radio" id="call" name="call" value="NO">
              <label for="no">No</label>

            </div>

            <div class="col-lg-4">
              <br>
              <h5><label for="Branch">Close ID</label></h5>
              <input type="radio" name="Vopen" id="Vopen" value="YES">
              <label for="yes">Yes</label>
              &nbsp;
              <input type="radio" id="Vopen" name="Vopen" value="No">
              <label for="no">No</label>

            </div>
          </div>  
          <br><br>
          <center>

            <input type="submit"  class=" btn btn-primary my-button" value="submit" name="submit"></input>
          </center>      
        </form>

      </fieldset>
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
  <script src="ajax-script.js"></script>
  <script src="search.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

  <script type="text/javascript">

  </script>
</body>

</html>

<?php 

echo $Jtest;
?>