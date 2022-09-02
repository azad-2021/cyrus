<?php 
include 'connection.php';
include 'session.php';

//$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

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

  <title>Pending work from jobcard</title>
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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  table{
    font-size: 14px;
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
          <li class="breadcrumb-item active">Work Report</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">

          <center>
            <div class="pagetitle">
              <h1>Pending work detail</h1>
            </center>
            <div class="table-responsive container">
              <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                <thead id="unhead">
                  <tr>
                    <th style="min-width: 150px">Bank</th>
                    <th style="min-width: 120px">Zone</th>
                    <th style="min-width: 150px">Branch</th>
                    <th style="min-width: 120px">Jobcard Number</th>
                    <th style="min-width: 100px">Visit Date</th>
                    <th style="min-width: 80px">Gadget</th>
                    <th style="min-width: 180px">Pending Work</th>
                    <th style="min-width: 80px">Estimate</th>
                    <th style="min-width: 120px">Action</th>
                  </tr>
                </thead>
                <tbody >
                  <?php 
                  $query="SELECT DISTINCT BranchCode FROM cyrusbackend.jobcardmain WHERE length(WorkPending)>2 and VisitDate>='2022-01-01'";

                  $result=mysqli_query($con,$query);

                  while($row = mysqli_fetch_array($result)){

                    $BranchCode=$row["BranchCode"];

                    $queryG="SELECT * from gadget";

                    $resultG=mysqli_query($con,$queryG);

                    while($rowG = mysqli_fetch_array($resultG)){
                      $GadgetID=$rowG["GadgetID"];

                      $query1="SELECT * FROM cyrusbackend.jobcardmain 
                      join branchdetails on jobcardmain.BranchCode=branchdetails.BranchCode
                      WHERE NOT exists (SELECT * FROM cyrusbackend.`jobcard reminder` WHERE `jobcard reminder`.`Card Number`=jobcardmain.`Card Number`) and length(WorkPending)>10 and VisitDate>='2022-01-01' and jobcardmain.BranchCode=$BranchCode and GadgetID=$GadgetID order by Job_Card_No desc limit 1";
                      $result1=mysqli_query($con,$query1);
                      while($row1 = mysqli_fetch_array($result1)){
                        $Jobcard=$row1["Card Number"];

                        $query2="SELECT * FROM cyrusbackend.approval
                        join cyrusbilling.estimates on approval.ApprovalID=estimates.ApprovalID
                        WHERE Vremark not like '%REJECTED%' and JobCardNo='$Jobcard'";
                        $result2=mysqli_query($con,$query2);
                        if (mysqli_num_rows($result2)>0){
                          $row2 = mysqli_fetch_array($result2);
                          $Estimate='<td><a target="_blank" href="viewe.php?apid='.$row2["ApprovalID"].'">Print Estimate</a></td>';
                        }else{
                          $Estimate='<td>No Estimate Given</td>';
                        }

                        ?>
                        <tr>
                          <td><?php echo $row1["BankName"]; ?></td>
                          <td><?php echo $row1["ZoneRegionName"]; ?></td>
                          <td><?php echo $row1["BranchName"]; ?></td>
                          <td><a href="/technician/view.php?card=<?php echo base64_encode($row1["Card Number"]); ?>" target="_blank"><?php echo $row1["Card Number"]; ?></a></td>
                          <td><?php echo $row1["VisitDate"]; ?></td>
                          <td><?php echo $rowG["Gadget"]; ?></td>
                          <td><?php echo $row1["WorkPending"]; ?></td>

                          <?php echo $Estimate ?>
                          <td><button class="btn btn-primary JobcardReminder" id="<?php print $Jobcard ?> " data-bs-toggle="modal" data-bs-target="#JobcardReminder">Add Remark</button></td>

                        <?php } }
                      }?>
                    </tbody>
                  </table>
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


        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

        <script src="assets/js/main.js"></script>
        <script src="ajax.js"></script>

        <script type="text/javascript">
          $(document).ready(function() {
            $('table.display').DataTable( {
              responsive: false,
          /*
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
          */
          stateSave: false,
        } );
          } );


          $(document).on('click', '.view_WorkReportO', function(){
            var EmployeeCode=$(this).attr("id");
            if (EmployeeCode) {
              $.ajax({
                type:'POST',
                url:'attended.php',
                data:{'EmployeeCodeO':EmployeeCode},
                success:function(result){
                  $('#work_data').html(result);
                  $('#WorkReport').modal('show');        
                }
              }); 
            }
          });


          $(document).on('click', '.view_WorkReportA', function(){
            var EmployeeCode=$(this).attr("id");
            if (EmployeeCode) {
              $.ajax({
                type:'POST',
                url:'attended.php',
                data:{'EmployeeCodeA':EmployeeCode},
                success:function(result){
                  $('#work_data').html(result);
                  $('#WorkReport').modal('show');        
                }
              }); 
            }
          });


          $(document).on('click', '.view_WorkReportC', function(){
            var EmployeeCode=$(this).attr("id");
            if (EmployeeCode) {
              $.ajax({
                type:'POST',
                url:'attended.php',
                data:{'EmployeeCodeC':EmployeeCode},
                success:function(result){
                  $('#work_data').html(result);
                  $('#WorkReport').modal('show');        
                }
              }); 
            }
          });


          $(document).on('click', '.view_WorkReportB', function(){
            var EmployeeCode=$(this).attr("id");
            if (EmployeeCode) {
              $.ajax({
                type:'POST',
                url:'attended.php',
                data:{'EmployeeCodeB':EmployeeCode},
                success:function(result){
                  $('#work_data').html(result);
                  $('#WorkReport').modal('show');        
                }
              }); 
            }
          });

          $(document).on('click', '.JobcardReminder', function(){
            var jobcard=$(this).attr("id");
            document.getElementById("cardnumber").value=jobcard;
          });

          $(document).on('click', '.SaveReminder', function(){
            var Reminder= document.getElementById("JobcardReminderData").value;
            var jobcard= document.getElementById("cardnumber").value;
            if (Reminder) {
              $.ajax({
                type:'POST',
                url:'dataget.php',
                data:{'ReminderU':Reminder, 'Jobcard':jobcard},
                success:function(result){

                 var delayInMilliseconds = 1000; 

                  setTimeout(function() {
                    location.reload();
                  }, delayInMilliseconds);

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