
<?php

include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

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

$query ="SELECT * FROM `orders` WHERE Installed!=2 and Status=1";;
$results = mysqli_query($con, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Production Details</title>
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

        <h3 align="center">Production Details</h3>  
        <br />  
        <div class="table-responsive">  
         <table class="table table-hover table-bordered border-primary" id="example" width="100%"> 
          <thead> 
              <tr>  
                  <th>Bank</th> 
                  <th>Zone</th> 
                  <th>Branch</th>
                  <th>Order Id </th> 
                  <th>Order Date </th>
                  <th>Gadget</th> 
                  <th>Mobile No</th>
                  <th>Sim No</th> 
                  <th> Sim Type </th>
                  <th>Sim Provider</th> 
                  <th>Operator</th> 
                  <th>Sim Release Date</th>
                  <th>Production Date</th>
                  <th>Update Date</th>
              </tr>                     
          </thead>                 
          <tbody> 
              <?php  
              while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 

                $OrderID=$row["OrderID"];

                $query3 ="SELECT * FROM `production` WHERE OrderID=$OrderID";
                $result3 = mysqli_query($con, $query3);
                $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
                //$OrderID=$row3["OrderID"];
                $SimID=$row3["SimID"];
                if (empty($SimID)==false) {
                    $query2 ="SELECT * FROM `simprovider` WHERE ID=$SimID";
                    $results2 = mysqli_query($con, $query2);
                    $row2=mysqli_fetch_array($results2,MYSQLI_ASSOC);
                    $Mobile=$row2["MobileNumber"];
                    $SimNo=$row2["SimNo"];
                    $ReleaseDate=$row2["ReleaseDate"];
                    $ActivationDate=$row2["ActivationDate"];
                    $Action='<a target="blank" href=proupdate.php?id='.$row3["SimID"].'>Update Date</a>';
                    $IssueDate=$row3["IssueDate"];
                }else{
                    $Mobile='';
                    $ReleaseDate='';
                    $ActivationDate='';
                    $Action='';
                    $IssueDate='';
                }


                $BranchCode=$row["BranchCode"];
                $GadgetID=$row["GadgetID"];
                $OperatorID=$row["OperatorID"];
                $SimType=$row["SimType"];
                $Status=$row["Status"];
                $Provider=$row["SimProvider"];

                $queryBranch ="SELECT * FROM branchdetails WHERE `BranchCode`='$BranchCode'";
                $resultBranch = mysqli_query($con2, $queryBranch);
                $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
                $Branch=$row4["BranchName"];
                                //$BranchCode=$row4["BranchCode"];
                $ZoneCode= $row4["ZoneRegionCode"];             
                $Zone=$row4["ZoneRegionName"];
                $Bank=$row4["BankName"];

                if ($Status==2 and empty($ActivationDate)==true) {
                    $Bank='<span style="color: red;">'.$row4["BankName"].'</span>';
                }else{
                   $Bank=$row4["BankName"]; 
               }

               $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
               $resultGadget = mysqli_query($con, $queryGadget);
               $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
               $Gadget=$row5["Gadget"];

               if (empty($OperatorID)==false) {

                $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
                $resultsO = mysqli_query($con, $queryO);
                $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
                $Operator=$row7["Operator"];                                
            }else{
                $Operator='';
            }                                    
            

            echo '  
            <tr> 
            <td>'.$Bank.'</td>
            <td>'.$Zone.'</td>  
            <td>'.$Branch.'</td>
            <td>'.$OrderID.'</td> 
            <td>'.$row["Date"].'</td>  
            <td>'.$Gadget.'</td>  
            <td>'.$Mobile.'</td>
            <td>'.$SimNo.'</td>
            <td>'.$SimType.'</td>
            <td>'.$Provider.'</td>    
            <td>'.$Operator.'</td>   
            <td>'.$ReleaseDate.'</td>
            <td>'.$IssueDate.'</td>
            <td>'.$Action.'</td> 
            </tr>  
            ';  
        } 
        ?> 

    </table>  
</div>  
<!-- END-->
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
<?php 
$con -> close();
$con2 -> close();
?>


