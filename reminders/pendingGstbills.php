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

$SevenDays = date('Y-m-d', strtotime($Date. ' - 7 days'));
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

  <title>Based on Next Reminder</title>
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
        <span class="d-none d-lg-block">Pending Bills</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";

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
          <li class="breadcrumb-item active"> Based on Next Reminders</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal fade" data-bs-backdrop="static" id="ViewBill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Bill Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="billdata">

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <br>
          <div class="card-body">

            <center>
              <div class="pagetitle">
                <h1>Group By Bank & Zone</h1>
              </div>
            </center>
            <div class="table-responsive container">
              <table class="table table-hover table-bordered border-primary display table-responsive" id="example"> 
                <thead> 
                  <tr> 
                    <th style="min-width: 180px;">Bank</th>
                    <th style="min-width: 180px;">Zone</th>           
                    <th style="min-width: 180px;">Branch</th>
                    <th style="min-width: 100px;">Bill No</th>
                    <th style="min-width: 100px;">Bill Date</th>        
                    <th style="min-width: 150px;">Total Billed Value</th> 
                    <th style="min-width: 150px;">Received Amount</th> 
                    <th style="min-width: 150px;">Pending Payment</th>
                    <th style="min-width: 180px;">Next reminder Date</th>   
                    <th style="min-width: 500px;">Description</th> 

                  </tr>                     
                </thead>                 
                <tbody>
                  <?php 

                  $query="SELECT * FROM cyrusbilling.vreminderbasedon
                  join cyrusbackend.branchdetails on vreminderbasedon.BranchCode=branchdetails.BranchCode 
                  join cyrusbackend.`reminder bank` on branchdetails.ZoneRegionCode=`reminder bank`.ZoneRegionCode WHERE  ExecutiveID=$EXEID";
                  $result=mysqli_query($con2,$query);

                  while($row = mysqli_fetch_array($result)){
                    print "<tr>";
                    print "<td>".$row['BankName']."</td>";             
                    print "<td>".$row['ZoneRegionName']."</td>";
                    print "<td>".$row['BranchName']."</td>"; 

                    print '<td><a href="" data-bs-toggle="modal" data-bs-target="#Bill" class="Bill" id="'.$row['BranchCode'].'">'.$row['BillNumber']."</a> </td>";

                    print '<td><span class="d-none">'.$row['Bill DATE'].'</span>'.date("d-M-Y", strtotime($row['Bill DATE']))."</td>";
                    print "<td>".$row['TotalBilledValue']."</td>";
                    print "<td>".$row['ReceivedAmount']."</td>";
                    print "<td>".$row['Pending Payment']."</td>";
                    print '<td><span class="d-none">'.$row['MaxOfMaxOfNextReminderDate'].'</span>'.date("d-M-Y", strtotime($row['MaxOfMaxOfNextReminderDate']))."</td>";
                    print "<td>".$row['MaxOfMaxOfDescription']."</td>";
                    print "</tr>";
                  }

                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th style="min-width: 180px;">Bank</th>
                    <th style="min-width: 180px;">Zone</th>           
                    <th style="min-width: 180px;">Branch</th>
                    <th style="min-width: 100px;">Bill No</th>
                    <th style="min-width: 100px;">Bill Date</th>        
                    <th style="min-width: 150px;">Total Billed Value</th> 
                    <th style="min-width: 150px;">Received Amount</th> 
                    <th style="min-width: 150px;">Pending Payment</th>
                    <th style="min-width: 180px;">Next reminder Date</th>   
                    <th style="min-width: 500px;">Description</th> 
                  </tr>
                </tfoot>
              </table>
            </div>
            <br><br>
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
<script src="ajax-script.js"></script>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      responsive :true;
    } );

    // DataTable
    var table = $('#example').DataTable({
      initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
              var that = this;

              $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                  that
                  .search( this.value )
                  .draw();
                }
              } );
            } );
          },
          responsive: false
        });

  } );
</script>
<script type="text/javascript">


  $(document).on('click', '.view_Bills', function(){
    var Zone = $(this).attr("id");
    var Bank=$(this).attr("id2");
    var Type=$(this).attr("id3");
    console.log(Zone);
    console.log(Bank);
    $.ajax({
     url:"BillsData.php",
     method:"POST",
     data:{Zone:Zone, Bank:Bank, Type:Type},
     success:function(data){
      $('#billdata').html(data);
      $('#ViewBill').modal('show');
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