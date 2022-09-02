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
          <li class="breadcrumb-item active">Old Pending Work</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">
            <br>
            <div class="table-responsive container">
              <table class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                <thead>
                  <tr class="text-dark">
                    <th scope="col" style="min-width:200px">Employee</th>
                    <th scope="col" style="min-width:200px">Pending Work</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 

                 $query2="SELECT distinct jobcardmain.BranchCode FROM cyrusbackend.jobcardmain
                 join branchs on jobcardmain.BranchCode=branchs.BranchCode
                 WHERE VisitDate>='2022-01-01' and length(WorkPending)>1 and Address3 not like '%Reserved%'";
                 $result2=mysqli_query($con,$query2);

                 while($rowB = mysqli_fetch_array($result2)){

                   $query3="SELECT * FROM cyrusbackend.gadget";
                   $result3=mysqli_query($con,$query3);

                   while($rowC = mysqli_fetch_array($result3)){

                    $GadgetID=$rowC['GadgetID'];
                    $BranchCode=$rowB['BranchCode'];

                    $query4="SELECT * FROM cyrusbackend.jobcardmain WHERE length(WorkPending)>1 and BranchCode=$BranchCode and GadgetID=$GadgetID and VisitDate>='2022-01-01'
                    order by Job_Card_No desc limit 1";
                    $result4=mysqli_query($con,$query4);
                    while($rowD = mysqli_fetch_array($result4)){

                      ?>

                      <tr>
                        <td ><?php echo $rowD['BranchCode']; ?></td>
                        <td ><?php echo $rowD['Card Number']; ?></td>
                      </tr>
                      <?php
                    }
                  }
                }
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
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
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

 var exampleModal = document.getElementById('editQty')
 exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var ItemID = button.getAttribute('data-bs-ItemID')
  console.log(ItemID);
  document.getElementById("ItemIDUpdate").value = ItemID;

})

 var exampleModal = document.getElementById('add')
 exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var ID = button.getAttribute('data-bs-orderid')
  var ZoneCode=button.getAttribute('data-bs-zonecode')
      //console.log(recipient);
      //document.getElementById("orderid").value = ID;
      //document.getElementById("ZoneCode").value = ZoneCode;
    })


 $(document).on('click', '.cl', function(){

  var delayInMilliseconds = 1000; 

  setTimeout(function() {
    location.reload();
  }, delayInMilliseconds);


});

 function limit(element)
 {
  var max_chars = 5;

  if(element.value.length > max_chars) {
    element.value = element.value.substr(0, max_chars);
  }
}

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>