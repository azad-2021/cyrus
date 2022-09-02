<?php 
include 'connection.php';
include 'session.php';

if (isset($_GET['user'])) {
  $EXEID=$_GET['user'];
  $_SESSION['query']=$EXEID;
}if (isset($_SESSION['query'])) {
  $EXEID=$_SESSION['query'];
}else{
  $EXEID=$_SESSION['userid'];
}
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');
//echo $_SESSION['user'];


if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

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
  include "modals.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Unassigned Work</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal fade" id="ViewUNC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Unassigned Complaints</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="UNCData">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewUAMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Unassigned AMC</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="UAMCData">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewUNO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Unassigned Orders</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="UNOData">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewUNCB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Unassigned Complaints</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="UNCDataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewUAMCB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Unassigned AMC</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="UAMCDataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewUNOB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Unassigned Orders</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="UNODataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">
            <h5 class="card-title">Uassigned Work  <span>| Group by Employee</span></h5>

            <div class="table-responsive container">
              <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                <thead>
                  <tr>
                    <th>Service Engineer</th>
                    <th>Unassigned Orders </th>
                    <th>Unassigned Complaints</th>                
                    <th>Unassigned AMC</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                 $query="SELECT `Employee Name`, employees.EmployeeCode FROM cyrusbackend.employees
                 join districts on employees.EmployeeCode=districts.`Assign To`
                 join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                 where ControlerID=$EXEID
                 group by employees.EmployeeCode
                 order by `Employee Name`;";

                 $resultTech=mysqli_query($con,$query);
                 while($rowE=mysqli_fetch_assoc($resultTech)){
                  $Employee=$rowE["Employee Name"];
                  $EmployeeID=$rowE["EmployeeCode"];

                  $query="SELECT count(ComplaintID) FROM cyrusbackend.vallcomplaintsd join districts on vallcomplaintsd.Address3=districts.District
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID and ControlerID=$EXEID";
                  $result=mysqli_query($con,$query);
                  $row = mysqli_fetch_array($result);

                  $query2="SELECT count(vallordersd.OrderID) FROM vallordersd
                  join districts on vallordersd.Address3=districts.District
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  WHERE vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID and ControlerID=$EXEID";
                  $result2=mysqli_query($con,$query2);
                  $row2 = mysqli_fetch_array($result2);

                  $query3 = "SELECT count(vallordersd.OrderID) FROM vallordersd
                  join districts on vallordersd.Address3=districts.District
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  WHERE AssignDate is null and Discription not like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID and ControlerID=$EXEID";
                  $result3 = mysqli_query($con, $query3);
                  $row3 = mysqli_fetch_array($result3);
                  if ($row["count(ComplaintID)"]>0 or $row2["count(vallordersd.OrderID)"]>0 or $row3["count(vallordersd.OrderID)"]>0) {

                    ?>
                    <tr>
                      <td><?php echo $Employee; ?></td>

                      <td><a class="view_UNO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUNO"><?php echo $row3["count(vallordersd.OrderID)"]; ?></a></td>

                      <td ><a class="view_UNC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUNC"><?php echo $row["count(ComplaintID)"]; ?></a></td>

                      <td><a class="view_UAMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUAMC"><?php echo $row2["count(vallordersd.OrderID)"];?></a></td>              
                    </tr>
                    <?php

                  }}

                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card-body">
            <h5 class="card-title">Uassigned Work  <span>| Group by Bank & Zone</span></h5>

            <div class="table-responsive container">
              <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
               <thead id="unhead">
                <tr>
                  <th>Bank</th>
                  <th>Zone</th>
                  <th>Unassigned Orders </th>
                  <th>Unassigned Complaints</th>                
                  <th>Unassigned AMC</th>           
                </tr>
              </thead>
              <tbody >
                <?php 

                $query="SELECT * FROM cyrusbackend.branchdetails 
                join districts on branchdetails.Address3=districts.District
                join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                WHERE ControlerID=$EXEID and Address3 not like 'Reserved'
                Group by BankName, ZoneRegionName;";

                $resultB=mysqli_query($con,$query);
                while($rowB=mysqli_fetch_assoc($resultB)){
                  $ZoneRegionName=$rowB["ZoneRegionName"];
                  $BankName=$rowB["BankName"];

                  $query="SELECT BankName, ZoneRegionName, count(DISTINCT ComplaintID) FROM cyrusbackend.vallcomplaintsd 
                  join districts on vallcomplaintsd .EmployeeCode=districts.`Assign To`
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  where ControlerID=$EXEID and AssignDate is null and Attended=0 and BankName='$BankName' and ZoneRegionName='$ZoneRegionName'";
                  $result=mysqli_query($con,$query);
                  $row = mysqli_fetch_array($result);

                  $query2="SELECT count(DISTINCT vallordersd.OrderID) , BankName, ZoneRegionName FROM vallordersd
                  join districts on vallordersd.EmployeeCode=districts.`Assign To`
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  WHERE ControlerID=$EXEID and vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and BankName='$BankName' and ZoneRegionName='$ZoneRegionName'";
                  $result2=mysqli_query($con,$query2);
                  $row2 = mysqli_fetch_array($result2);

                  $query3 = "SELECT count(DISTINCT vallordersd.OrderID) AS CountOfOrderID, BankName, ZoneRegionName FROM vallordersd
                  join districts on vallordersd.EmployeeCode=districts.`Assign To`
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  WHERE ControlerID=$EXEID and vallordersd.AssignDate is null and vallordersd.Discription not like '%AMC%' and BankName='$BankName' and ZoneRegionName='$ZoneRegionName'";
                  $result3 = mysqli_query($con, $query3);
                  $row3 = mysqli_fetch_array($result3);
                  if ($row3["CountOfOrderID"]!=0 or $row["count(DISTINCT ComplaintID)"]!=0 or $row2["count(DISTINCT vallordersd.OrderID)"] ) {
                   ?>
                   <tr>
                    <td><?php echo $BankName; ?></td>
                    <td><?php echo $ZoneRegionName; ?></td>
                    <td><a class="view_UNOB" id="<?php print $BankName; ?>" id2="<?php print $ZoneRegionName; ?>" data-bs-target="#ViewUNOB"><?php echo $row3["CountOfOrderID"]; ?></a></td>

                    <td ><a class="view_UNCB" id="<?php print $BankName; ?>" id2="<?php print $ZoneRegionName; ?>" data-bs-target="#ViewUNCB"><?php echo $row["count(DISTINCT ComplaintID)"]; ?></a></td>

                    <td><a class="view_UAMCB" id="<?php print $BankName; ?>" id2="<?php print $ZoneRegionName; ?>" data-bs-target="#ViewUAMCB"><?php echo $row2["count(DISTINCT vallordersd.OrderID)"];; ?></a></td>              
                  </tr>
                <?php }} 
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End Recent Sales -->
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
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: true,
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

  $(document).on('click', '.view_UNO', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"uno.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#UNOData').html(data);
    $('#ViewUNO').modal('show');
  }
});
});


  $(document).on('click', '.view_UNC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");

  console.log(EmployeeID);
  $.ajax({
   url:"unc.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#UNCData').html(data);
    $('#ViewUNC').modal('show');
  }
});
});

  $(document).on('click', '.view_UAMC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"unamc.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#UAMCData').html(data);
    $('#ViewUAMC').modal('show');
  }
});
});


  $(document).on('click', '.view_UNOB', function(){
    var Zone = $(this).attr("id2");
    var Bank=$(this).attr("id");
    console.log(Zone);
    $.ajax({
     url:"uno.php",
     method:"POST",
     data:{Zone:Zone, Bank:Bank},
     success:function(data){
      $('#UNODataB').html(data);
      $('#ViewUNOB').modal('show');
    }
  });
  });


  $(document).on('click', '.view_UNCB', function(){
    var Zone = $(this).attr("id2");
    var Bank=$(this).attr("id");
    console.log(Zone);
    $.ajax({
     url:"unc.php",
     method:"POST",
     data:{Zone:Zone, Bank:Bank},
     success:function(data){
      $('#UNCDataB').html(data);
      $('#ViewUNCB').modal('show');
    }
  });
  });

  $(document).on('click', '.view_UAMCB', function(){
    var Zone = $(this).attr("id2");
    var Bank=$(this).attr("id");
    console.log(Zone);
    $.ajax({
     url:"unamc.php",
     method:"POST",
     data:{Zone:Zone, Bank:Bank},
     success:function(data){
      $('#UAMCDataB').html(data);
      $('#ViewUAMCB').modal('show');
    }
  });
  });

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>