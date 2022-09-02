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
$query ="SELECT * FROM `orders` WHERE Status='2' and Installed='0'";
$results = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Store Details</title>
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
  <link rel="stylesheet" type="text/css" href="datatable/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/responsive.bootstrap5.min.css"/>

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
            <table class="table table-hover table-bordered border-primary nowrap" id="example" width="100%"> 
              <thead> 
                  <tr>  
                      <th>Bank</th> 
                      <th>Zone</th> 
                      <th>Branch</th>
                      <th>Order Id</th> 
                      <th>Gadget</th> 
                      <th>Mobile No</th> 
                      <th>Sim NO</th> 
                      <th>Sim Type</th> 
                      <th>Operator</th> 
                      <th>Production Issue date</th>
                      <th>Store Release Date</th>
                      <th>Release To</th>
                      <th>Remark</th>
                      <th>Update Date</th>
                  </tr>                     
              </thead>                 
              <tbody> 
                  <?php  
                  while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 

                    $BranchCode=$row["BranchCode"];
                    $GadgetID=$row["GadgetID"];
                    $OrderID=$row["OrderID"];
                    $OperatorID=$row["OperatorID"];
                    $Status=$row["Status"];

                    $queryP ="SELECT * FROM `production` WHERE OrderID=$OrderID";
                    $resultsP = mysqli_query($con, $queryP);
                    $row8=mysqli_fetch_array($resultsP,MYSQLI_ASSOC);
                    if (!empty($row8)) {
                        $SimID=$row8["SimID"];
                    }
                    

                    $queryBranch ="SELECT * FROM branchdetails WHERE `BranchCode`='$BranchCode'";
                    $resultBranch = mysqli_query($con2, $queryBranch);
                    $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
                    if (!empty($row4)) {
                     $Branch=$row4["BranchName"];            
                     $Zone=$row4["ZoneRegionName"];
                     $Bank=$row4["BankName"];
                 }
                 
                 $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
                 $resultGadget = mysqli_query($con, $queryGadget);
                 $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
                 $Gadget=$row5["Gadget"];

                 if (empty($SimID)==false) {
                    $querySim ="SELECT * FROM `simprovider` WHERE ID=$SimID";
                    $resultsSim = mysqli_query($con, $querySim);
                    $row6=mysqli_fetch_array($resultsSim,MYSQLI_ASSOC);
                    $Mobile=$row6["MobileNumber"];
                    $SimNo=$row6["SimNo"];
                    $ReleaseDate=$row6["IssueDate"];
                    $IssueDate=$row6["IssueDate"];
                }else{
                    $Mobile='';
                    $SimNo='';
                    $ReleaseDate='';
                    $IssueDate='';
                }

                if (empty($OperatorID)==false) {
                    $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
                    $resultsO = mysqli_query($con, $queryO);
                    $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
                    $Operator=$row7["Operator"];
                }else{
                    $Operator='';
                }

                $queryS ="SELECT * FROM `store`
                join cyrusbackend.employees on store.EmployeeCode=employees.EmployeeCode
                WHERE OrderID=$OrderID and store.EmployeeCode>0";
                $resultsS = mysqli_query($con, $queryS);
                $rowS=mysqli_fetch_array($resultsS,MYSQLI_ASSOC);
                $ID=$rowS["ReleaseID"];
                $Remark=$rowS["Remark"];

                echo '  
                <tr> 
                <td>'.$Bank.'</td>
                <td>'.$Zone.'</td>  
                <td>'.$Branch.'</td>
                <td>'.$row["OrderID"].'</td>  
                <td>'.$Gadget.'</td>  
                <td>'.$Mobile.'</td>
                <td>'.$SimNo.'</td> 
                <td>'.$row["SimType"].'</td>   
                <td>'.$Operator.'</td>    
                <td>'.$ReleaseDate.'</td>
                <td>'.$rowS["ReleaseDate"].'</td>
                <td>'.$rowS["Employee Name"].'</td>
                <td>'.$Remark.'</td>
                <td><a target="blank" href=storedate.php?id='.$ID.'>Update Date</a></td> 
                </tr> 
                </tr>  
                ';  
            }

            ?> 

        </table>  
    </div>  
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
<script src="datatable/js/jquery.dataTables.min.js"></script>]
<script src="datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="datatable/js/dataTables.responsive.min.js"></script>
<script src="datatable/js/responsive.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal( {
                        header: function ( row ) {
                            var data = row.data();
                            return 'Details for '+data[0]+' '+data[1];
                        }
                    } ),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                        tableClass: 'table'
                    } )
                }
            },
            stateSave: true,

        } );
    } );

</script>
</body>
</html>