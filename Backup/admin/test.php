<?php 
include 'connection.php';
//include 'session.php';

//$EXEID=$_SESSION['userid'];
$_SESSION['user']='Accounts';
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Hour = date('G');

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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.6.0.min.js"></script>
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
  include "modals.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Accounts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal" tabindex="-1" id="RecurranceDetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Recurrance Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="Recurrance">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive" style="margin:20px">
        <table class="table table-hover table-bordered border-primary datatable">
          <thead>
            <th style="min-width:200px">Bank</th>
            <th style="min-width:200px">Zone</th>
            <th style="min-width:50px">Branch</th>
            <th style="min-width:150px">Employee</th> 
            <th style="min-width:150px">Action</th>       
          </thead>
          <tbody>
            <?php 
            $ZoneData="SELECT BankName, ZoneRegionName, BranchName,jobcardmain.VisitDate, `Employee Name`, BranchName, jobcardmain.BranchCode FROM cyrusbackend.jobcardmain
            join `reference table` on jobcardmain.`Card Number`=`reference table`.`Card Number`
            join branchdetails on jobcardmain.BranchCode=branchdetails.BranchCode
            join employees on jobcardmain.EmployeeCode=employees.EmployeeCode
            WHERE jobcardmain.VisitDate>'2022-03-20'
            group by jobcardmain.VisitDate
            having count(jobcardmain.BranchCode)>1;";
            $result=mysqli_query($con,$ZoneData);
            if (mysqli_num_rows($result)>0)
            {   

              while ($row=mysqli_fetch_assoc($result))
              {
                print "<tr>";
                print '<td>'.$row['BankName']."</td>";
                print '<td>'.$row['ZoneRegionName']."</td>";
                print '<td>'.$row['BranchName']."</td>";
                print '<td>'.$row['Employee Name']."</td>";
                print '<td><a href="" data-bs-toggle="modal" data-bs-target="#RecurranceDetails" class="details" id="'.$row['BranchCode'].'">See Details</a></td>';
                print "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div id="re"></div>
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

<script src="ajax.js"></script>
<script type="text/javascript">

 $(document).on('click','.details', function(){
  var BranchCode = $(this).attr("id");
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'recurrances.php',
      data:{'BranchCode':BranchCode},
      success:function(result){
        $('#RecurranceDetails').modal('show');
        $('#Recurrance').html(result);
        
      }
    }); 
  }
});

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>