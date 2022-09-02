<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/sweetalert.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.2/css/searchPanes.dataTables.min.css">
 
  <link rel="stylesheet" type="text/css" href="hhttps://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">







  <style type="text/css">
  table, tr, td{
    font-size: 16px;
  }
</style>

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
      <div class="row">

        <!--  
        <center>
          <div class="col-lg-8" align="center">
            <input type="text" class="form-control rounded-corner" id="myInput" onkeyup="myFunction()" placeholder="Search for Bank">
            <input type="text" class="form-control rounded-corner" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Zone">
          </div>
        </center>
      -->
      <div class="col-lg-12">
        <div id="printableArea">
          <div class="col-lg-12 table-responsive" style="margin: 12px;" >
            <center>
              <h4>AMC</h4>
            </center>
            <table class="table table-hover table-bordered border-primary display" id="myTable" width="100%">

              <thead> 
               <tr>
                <th>Bank</th>
                <th>Zone</th>
                <th>Visits</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Gadget</th>
                <th>Left Days</th>
              </tr>                     
            </thead>                 
            <tbody>
              <?php 
              $sql ="SELECT BankName, ZoneRegionName, StartDate, EndDate, Device, datediff(EndDate, current_date()) as LeftDays, Visits FROM cyrusbackend.amcs
              join zoneregions on amcs.ZoneRegionCode=zoneregions.ZoneRegionCode
              join bank on zoneregions.BankCode=bank.BankCode
              WHERE datediff(EndDate, current_date())>0 order by BankName";

              $result = mysqli_query($con,$sql);

              while ($row = mysqli_fetch_array($result)) { 
                if ($row["LeftDays"]<30) { 
                  $tr='<tr class="table-danger">';
                }else{
                  $tr='<tr class="table-success">';
                }
                echo $tr;
                ?>
                
                <td><?php echo $row["BankName"]; ?></td>
                <td><?php echo $row["ZoneRegionName"]; ?></td>
                <td><?php echo $row["Visits"]; ?></td>
                <td><?php echo date('d-m-Y',strtotime($row["StartDate"])); ?></td>
                <td><?php echo date('d-m-Y',strtotime($row["EndDate"])); ?></td>
                <td><?php echo $row["Device"]; ?></td>
                <td><?php echo $row["LeftDays"]; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
  <center>
    <!--<button class="btn btn-primary" onclick="printDiv('printableArea');">Print</button>-->
  </center>

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
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->

<script src="assets/js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.0.2/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false,
      searchPanes: {
        columns: [0,1,6]
      },
      dom: 'Plfrtip'
    } );
  } );

  function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }

/*
  function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
*/

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>