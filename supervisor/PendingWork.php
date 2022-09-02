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

  <title>Pending Work</title>
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
          <li class="breadcrumb-item active">Pending Work</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal fade" id="ViewAMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending AMC</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="AMCData">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewAO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Orders</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="AOData">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewAC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Complaints</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="ACData">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>



      <div class="modal fade" id="ViewAMCB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending AMC</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="AMCDataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewAOB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Orders</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="AODataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewACB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Complaints</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="ACDataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Sales -->
    <div class="col-12">
      <div class="card recent-sales overflow-auto">

        <div class="card-body">
          <h5 class="card-title">Pending Work  <span>| Group by Employee</span></h5>

          <div class="table-responsive container">
            <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
              <thead>
                <tr class="text-dark">
                  <th>Service Engineer</th>
                  <th>Pending Orders </th>
                  <th>Pending Complaints</th>                
                  <th>Pending AMC</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $row3='';
                $query="SELECT DISTINCT EmployeeCode, `Employee Name` FROM employees
                join cyrusbackend.districts on employees.EmployeeCode=districts.`Assign To`
                join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                WHERE Inservice=1 and districts.SubControllerID=$EXEID Order By `Employee Name`";
                $resultTech=mysqli_query($con,$query);
                while($rowE=mysqli_fetch_assoc($resultTech)){
                 $Employee=$rowE["Employee Name"];
                 $EmployeeID=$rowE["EmployeeCode"];

                 $query="SELECT count(DISTINCT ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allcomplaint 
                 join cyrusbackend.districts on allcomplaint.Address3=districts.District
                 join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeID and districts.SubControllerID=$EXEID";
                 $result=mysqli_query($con,$query);
                 $row = mysqli_fetch_array($result);

                 $query2="SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allorders join cyrusbackend.districts on allorders.Address3=districts.District
                 join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode 
                 WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$EmployeeID and districts.SubControllerID=$EXEID";
                 $result2=mysqli_query($con,$query2);
                 $row2 = mysqli_fetch_array($result2);
                 $AMC=$row2["count(OrderID)"];

                 $query3 = "SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM allorders
                 join cyrusbackend.districts on allorders.Address3=districts.District
                 join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode 
                 WHERE EmployeeCode=$EmployeeID and AssignDate is not NULL and Attended=0 and Discription not like '%AMC%' and districts.SubControllerID=$EXEID";
                 $result3 = mysqli_query($con, $query3);
                 $row3 = mysqli_fetch_array($result3);
                 $AO=$row3["count(OrderID)"];
                if ($row["count(DISTINCT ComplaintID)"]>0 or $AMC>0 or $AO>0) {             
                 ?>
                 <tr>
                  <td><?php echo $Employee; ?></td>
                  <td><a class="view_AO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAO"><?php echo $AO; ?></a></td>

                  <td><a class="view_AC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAC"><?php echo $row["count(DISTINCT ComplaintID)"]; ?></a></td>


                  <td><a class="view_AMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAMC"><?php echo $AMC; ?></a></td>              
                </tr>

              <?php } }?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card-body">
        <h5 class="card-title">Pending Work  <span>| Group by Bank & Zone</span></h5>

        <div class="table-responsive container">
          <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
           <thead id="unhead">
            <tr>
              <th>Bank</th>
              <th>Zone</th>
              <th>Pending Orders </th>
              <th>Pending Complaints</th>                
              <th>Pending AMC</th>           
            </tr>
          </thead>
          <tbody >
            <?php 

            $query="SELECT BankName, zoneregionname, ZoneRegionCode as ZoneCode, BankCode FROM cyrusbackend.branchdetails
            join cyrusbackend.districts on branchdetails.Address3=districts.District
            join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            WHERE districts.SubControllerID=$EXEID
            group by BankCode, ZoneregionCode
            Order By BankName";

            $result=mysqli_query($con,$query);
            while($row=mysqli_fetch_assoc($result)){

              $ZoneCode=$row["ZoneCode"];
              $BankCode=$row["BankCode"];

              $query="SELECT count(OrderID) FROM cyrusbackend.orders 
              join branchdetails on orders.BranchCode=branchdetails.BranchCode
              join cyrusbackend.districts on branchdetails.Address3=districts.District
              join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
              WHERE BankCode=$BankCode and ZoneRegionCode=$ZoneCode  and AssignDate is not null and Attended=0 and Discription not like '%AMC%' and districts.SubControllerID=$EXEID";

              $result2=mysqli_query($con,$query);
              if (mysqli_num_rows($result2)>0){
                $row2=mysqli_fetch_assoc($result2);
                $PendingOrders=$row2["count(OrderID)"];
              }
              $query="SELECT count(OrderID) FROM cyrusbackend.orders 
              join branchdetails on orders.BranchCode=branchdetails.BranchCode
              join cyrusbackend.districts on branchdetails.Address3=districts.District
              join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
              WHERE BankCode=$BankCode and ZoneRegionCode=$ZoneCode  and AssignDate is not null and Attended=0 and Discription like '%AMC%' and districts.SubControllerID=$EXEID";
              if (mysqli_num_rows($result2)>0){
                $result2=mysqli_query($con,$query);
                $row2=mysqli_fetch_assoc($result2);
                $PendingAMC=$row2["count(OrderID)"];
              }

              $query="SELECT count(ComplaintID) FROM cyrusbackend.complaints
              join branchdetails on complaints.BranchCode=branchdetails.BranchCode
              join cyrusbackend.districts on branchdetails.Address3=districts.District
              join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
              WHERE BankCode=$BankCode and ZoneRegionCode=$ZoneCode  and AssignDate is not null and Attended=0 and districts.SubControllerID=$EXEID" ;
              if (mysqli_num_rows($result2)>0){
                $result2=mysqli_query($con,$query);       
                $row2=mysqli_fetch_assoc($result2);
                $PendingComplaint=$row2["count(ComplaintID)"];
              }

              if ((!empty($PendingOrders)) || (!empty($PendingComplaint)) || (!empty($PendingAMC))) {
                ?>
                <tr>
                  <td><?php echo $row["BankName"]; ?></td>
                  <td><?php echo $row["ZoneRegionName"]; ?></td>
                  <td><a class="view_AOB" id="<?php print $ZoneCode ?> " id2="<?php print $BankCode ?>" data-bs-target="#ViewAO"><?php echo $PendingOrders; ?></a></td>

                  <td ><a class="view_ACB" id="<?php print $ZoneCode ?>" id2="<?php print $BankCode?>" data-bs-target="#ViewAC"><?php echo $PendingComplaint; ?></a></td>

                  <td><a class="view_AMCB" id="<?php print $ZoneCode ?>" id2="<?php print $BankCode?>" data-bs-target="#ViewAMC"><?php echo $PendingAMC; ?></a></td>          
                </tr>
              <?php }}?>
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


//Pending
$(document).on('click', '.view_AO', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"assignOrders.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#AOData').html(data);
    $('#ViewAO').modal('show');
  }
});
});

$(document).on('click', '.view_AC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"complaints.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#ACData').html(data);
    $('#ViewAC').modal('show');
  }
});
});

$(document).on('click', '.view_AMC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"amc.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#AMCData').html(data);
    $('#ViewAMC').modal('show');
  }
});
});


$(document).on('click', '.view_AOB', function(){
  //$('#dataModal').modal();
  var Zone = $(this).attr("id");
  var Bank=$(this).attr("id2");
  console.log(Zone);
  $.ajax({
   url:"assignOrders.php",
   method:"POST",
   data:{Zone:Zone, Bank:Bank},
   success:function(data){
    $('#AODataB').html(data);
    $('#ViewAOB').modal('show');
  }
});
});

$(document).on('click', '.view_ACB', function(){
  var Zone = $(this).attr("id");
  var Bank=$(this).attr("id2");
  console.log(Zone);
  $.ajax({
   url:"complaints.php",
   method:"POST",
   data:{Zone:Zone, Bank:Bank},
   success:function(data){
    $('#ACDataB').html(data);
    $('#ViewACB').modal('show');
  }
});
});

$(document).on('click', '.view_AMCB', function(){
  var Zone = $(this).attr("id");
  var Bank=$(this).attr("id2");
  console.log(Zone);
  $.ajax({
   url:"amc.php",
   method:"POST",
   data:{Zone:Zone, Bank:Bank},
   success:function(data){
    $('#AMCDataB').html(data);
    $('#ViewAMCB').modal('show');
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