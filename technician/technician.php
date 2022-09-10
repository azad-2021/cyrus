<?php 
include 'connection.php';
include 'session.php';



date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['Tuser'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['Tuser'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['Tuser'];
}

$OID = $_GET['oid'];
$card = $_GET['cardno'];
$complaintID = $_GET['cid'];
$EmployeeCode = $_GET['eid'];
$EmployeeCode=$_SESSION['empid'];
$BranchCode = $_GET['brcode'];
$Status = $_GET['site'];

$ZoneCode = $_GET['zcode'];
$JobCARD = $_GET['cardno'];
$GadgetID = $_GET['gid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

if (isset($_SESSION['VisitDate'])) {
 $Date= $_SESSION['VisitDate'];

}else{
  $Rej=0;

}



$queryTech="SELECT * FROM employees Where Inservice=1 and EmployeeCode!=85 order by `Employee Name`"; 
$resultTech=mysqli_query($con,$queryTech);



$queryApprovalID="SELECT * FROM approval where JobCardNo='$JobCARD' and posted='0'";
$resultApprovalID=mysqli_query($con,$queryApprovalID);
$dataApprovalID=mysqli_fetch_assoc($resultApprovalID);
$approvalID = $dataApprovalID['ApprovalID'];
//echo $JobCARD;
if(isset($_POST['Addtech']))
{
  $Employee=$_POST['EmployeeCode'];

  $query="SELECT * FROM cyrusbackend.add_technician where TechnicianID=$Employee and EmployeeUID=$EmployeeCode"; 
  $result=mysqli_query($con,$query); 
  if (mysqli_num_rows($result)>0)
  {
    echo '<script>alert("Technician already in list")</script>';
  }else{
    $queryCheckTechnician="SELECT * From employees where EmployeeCode=$Employee";
    $resultCheckTechnician=mysqli_query($con,$queryCheckTechnician);
    $dataCheckTechnician=mysqli_fetch_assoc($resultCheckTechnician);
    $TechnicianName = $dataCheckTechnician['Employee Name'];
    $TechnicianContact = $dataCheckTechnician['Phone'];
    $TechnicianCode = $dataCheckTechnician['Employee Code'];

    $queryAddtech="INSERT INTO `add_technician` (`EmployeeUID`, `TechnicianID`, `TechnicianName`, `TechnicianContact`) VALUES ($EmployeeCode, '$Employee', '$TechnicianName', $TechnicianContact);";
    mysqli_query($con,$queryAddtech);

    if($queryAddtech){
      echo "<meta http-equiv='refresh' content='0'>";
    }
  }
}

if(isset($_POST['submit']))
{
  $a = 1;
  $queryTechnician="SELECT TechnicianID FROM add_technician"; 
  $resultTechnician=mysqli_query($con,$queryTechnician); 

  while($data=mysqli_fetch_assoc($resultTechnician)){
   $te = $data['TechnicianID'];;
   $jobcard = $card .$a;

   /* Insert Data into Approval database */
   $queryAdd="INSERT INTO `approval`( `BranchCode`, `ComplaintID`, `OrderID`, `JobCardNo`, `Status`, `EmployeeCode`, `VisitDate`, `GadgetID`) VALUES ('$BranchCode','$complaintID','$OID', '$jobcard', '$Status', '$te', '$Date', '$GadgetID')";
   mysqli_query($con,$queryAdd);
   $a++;
 }

 $queryRemove="DELETE FROM `add_technician` WHERE `EmployeeUID`='$EmployeeCode'";
 $resultRemove=mysqli_query($con,$queryRemove); 
 header("location:pro.php?cid=$complaintID&eid=$EmployeeCode&brcode=$BranchCode&oid=$OID&cardno=$JobCARD&zcode=$ZoneCode");
 if (isset($_SESSION['VisitDate'])) {
   unset($_SESSION['VisitDate']);
 }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Employee</title>
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

  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  table, tr, th{
    font-size: 14px;
    align-items: center;
  }
  a {
    cursor: pointer;
    
  }


  .overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("assets/img/loader.gif") center no-repeat;
  }
  /* Turn off scrollbar when body element has the loading class */
  body.loading{
    overflow: hidden;   
  }
  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay{
    display: block;
  }

</style>
</head>
<body>
 <div class="overlay"></div>
 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="assets/img/cyrus logo.png" alt="">
      <span class="d-none d-lg-block">Cyrus</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar">
    <?php echo $wish; ?>
  </div>
  <?php 
  include "nav.php";
    //include "modals.php";
  ?>
</header>
<?php 
include "sidebar.php";

?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Add Employee</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">

        <center>
          <div class="pagetitle">
            <h1>Enter Details</h1>
          </div>

        </center>


        <form class="form-control rounded-corner" name="fileUpload" action = "" method = "POST" enctype = "multipart/form-data">
          <div class="row">
            <center>
              <div class="col-lg-4">
                <label>Select Employee</label>
                <select class="form-control rounded-corner" name="EmployeeCode" required>
                  <?php
                  while($data=mysqli_fetch_assoc($resultTech)){
                    echo "<option value=".$data['EmployeeCode'].">".$data['Employee Name']."</option>";
                  }  
                  ?>
                </select>
              </div>
              <div class="col-lg-4" style="margin:20px;">
                <input type="submit"  class=" btn btn-primary" value="Add" name="Addtech"></input>
              </div>
            </center>

            <div class="col-lg-12 table-responsive">
              <table id="userTable2" class="display nowrap table-striped table-hover table-sm" id="exampleFormControlSelect2" class="form-control">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact Number</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 

                  $query= "SELECT * FROM cyrusbackend.employees inner join add_technician on employees.EmployeeCode=add_technician.TechnicianID where add_technician.EmployeeUID=$EmployeeCode";
                  $result=mysqli_query($con,$query);

                  if (mysqli_num_rows($result)>0)
                  {

                    while($data=mysqli_fetch_assoc($result)){ ?>
                      <tr>
                        <td >
                          <?php echo $ttid =$data['TechnicianID']; ?>
                        </td>
                        <td >
                          <?php echo $data['TechnicianName']; ?>
                        </td>
                        <td >
                          <?php echo $data['TechnicianContact']; ?>
                        </td>
                        <td >
                          <td >
                            <form accept="" method="post">
                              <input type="hidden" name="ttid" value=" <?php echo $ttid ?>">
                              <input type="hidden" name="tid" value="<?php echo $tid ?>">
                              <input type="hidden" name="tCode" value="<?php echo $data['TechnicianCode'] ?>">
                              <input type="submit" name="removeTechnician" value="Remove" class="btn btn-danger my-button">
                            </form>
                          </td>
                        </tr>
                      <?php } } ?>
                    </tbody>
                  </table>     

                </div>
                <center>
                  <br><br>
                  <input name="submit" class="btn btn-lg btn-primary" value="Submit" type = "submit">
                </center>
              </form>


            </div>



          </div>
        </div>
        <!-- End Left side columns -->
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>




    <script src="assets/js/main.js"></script>
    <script src="ajax.js"></script>

    <script type="text/javascript">
      function preventBack() { window.history.forward(); }  
      setTimeout("preventBack()", 0);  
      window.onunload = function () { null };  

      $(document).ready(function() {
       var table = $('#userTable2').DataTable( {
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        responsive: true
      } );
     } );

   </script>
 </body>

 </html>


 <?php if(isset($_POST['removeTechnician']))
 {
  $ttid=$_POST['ttid'];
  $tid=$_POST['tid'];
  $queryRemove="DELETE FROM `add_technician` WHERE  `TechnicianID`='$ttid' and `EmployeeUID`='$EmployeeCode'";
  $resultRemove=mysqli_query($con,$queryRemove);
  if($resultRemove){

    echo "<meta http-equiv='refresh' content='0'>";
  }
}

$con -> close();
$con2 -> close();

?>