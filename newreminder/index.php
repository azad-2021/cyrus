<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];

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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>

  <link rel="stylesheet" href="dist/sortable-tables.min.css">
  <script src="dist/sortable-tables.min.js"></script>
  <style type="text/css">
  table{
    font-size: 14px;
  }
  th,a {
    cursor: pointer;
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
              <h1>Reminders Per Day</h1>
            </div>
          </center>
          <div class="table-responsive container">
            <table class="table table-hover table-bordered border-primary  display">     
              <thead> 
                <tr> 
                  <th style="min-width:160px">Name</th>
                  <th style="min-width:80px">Date</th>           
                  <th style="min-width:150px">No. of Branches</th>           
                </tr>                     
              </thead>                 
              <tbody>
                <?php 
                $query="SELECT COUNT(SUBQUERY.BranchCode) as CountBranchCode, SUBQUERY.user, SUBQUERY.ReminderOn from
                (
                SELECT cyrusbackend.pass.UserName As user, cyrusbilling.reminders.BranchCode, count(cyrusbilling.reminders.ID) AS CountOfID, date(cyrusbilling.reminders.ReminderDate) as ReminderOn FROM cyrusbackend.pass
                inner join cyrusbilling.reminders on cyrusbackend.pass.ID=cyrusbilling.reminders.UserID 
                Group By cyrusbackend.pass.UserName, cyrusbilling.reminders.BranchCode, date(cyrusbilling.reminders.ReminderDate)
              ) AS SUBQUERY group by SUBQUERY.user, SUBQUERY.ReminderOn";

              $result=mysqli_query($con2,$query);
              while($row = mysqli_fetch_array($result)){

                print "<tr>";
                print "<td>".$row['user']."</td>";             
                print "<td>".date("d-m-Y", strtotime($row['ReminderOn']))."</td>";
                print "<td>".$row['CountBranchCode']."</td>"; 
                print "</tr>";

              }

              ?>
            </tbody>
          </table>

        </div>
        <br><br>
        <h4 align="center">Reminders Per Month</h4>

        <div class="table-responsive container">
          <table class="table table-hover table-bordered border-primary  display"> 
            <thead> 
              <tr> 
                <th style="min-width:160px">Name</th>
                <th style="min-width:80px">Month</th>           
                <th style="min-width:150px">No. of Branches</th>           
              </tr>                     
            </thead>                 
            <tbody>
              <?php 
              $query="SELECT COUNT(SUBQUERY.BranchCode) as CountBranchCode, SUBQUERY.user, SUBQUERY.ReminderOn as month  from
              (
              SELECT cyrusbackend.pass.UserName As user, cyrusbilling.reminders.BranchCode, count(cyrusbilling.reminders.ID) AS CountOfID, date(cyrusbilling.reminders.ReminderDate) as ReminderOn FROM cyrusbackend.pass
              inner join cyrusbilling.reminders on cyrusbackend.pass.ID=cyrusbilling.reminders.UserID 
              Group By cyrusbackend.pass.UserName, cyrusbilling.reminders.BranchCode, date(cyrusbilling.reminders.ReminderDate)
            ) AS SUBQUERY group by SUBQUERY.user, month(SUBQUERY.ReminderOn)";

            $result=mysqli_query($con2,$query);
            while($row = mysqli_fetch_array($result)){

              print "<tr>";
              print "<td>".$row['user']."</td>";             
              print "<td>".date("M-Y", strtotime($row['month']))."</td>";
              print "<td>".$row['CountBranchCode']."</td>"; 
              print "</tr>";

            }

            ?>
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
<script src="ajax-script.js"></script>

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

  $(document).on('change', '#SDate', function(){
    document.getElementById("EDate").value = "";
  });

  $(document).on('change', '#employee', function(){
    document.getElementById("SDate").value = "";
  });

  $(document).on('change', '#EDate', function(){
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
        //var EmployeeCode = document.getElementById("employee").value;

        if (SDate==''){
          swal("error","Please select Start Date","error");
        }else{
          $.ajax({
            type:'POST',
            url:'dataget.php',
            data:{'EmployeeCodeP':'xyz', 'SDate':SDate, 'EDate':EDate},
            success:function(result){
              $('#work_dataP').html(result);        
            }
          });
        }
      });


  function myFunctionPS() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("EmployeePS");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTablePS");
    tr = table.getElementsByTagName("tr");
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

  $(document).on('click', '.view_WorkReportOP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeOP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });

  $(document).on('click', '.view_WorkReportAP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeAP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });


  $(document).on('click', '.view_WorkReportCP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeCP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });


  $(document).on('click', '.view_WorkReportBP', function(){
    var EmployeeCode=$(this).attr("id");
    var SDate = document.getElementById("SDate").value;
    var EDate = document.getElementById("EDate").value;
    if (EmployeeCode) {
      $.ajax({
        type:'POST',
        url:'attended.php',
        data:{'EmployeeCodeBP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
        success:function(result){
          $('#work_data').html(result);
          $('#WorkReport').modal('show');        
        }
      }); 
    }
  });
</script>

<script>

  function sortTable(n) {
    var table;
    table = document.getElementById("myTablePS");
    var rows, i, x, y, count = 0;
    var switching = true;

      // Order is set as ascending
      var direction = "ascending";

       // Run loop until no switching is needed
       while (switching) {
        switching = false;
        var rows = table.rows;

                    //Loop to go through all rows
                    for (i = 1; i < (rows.length - 1); i++) {
                      var Switch = false;

                        // Fetch 2 elements that need to be compared
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];

                        // Check the direction of order
                        if (direction == "ascending") {

                            // Check if 2 rows need to be switched
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase())
                            {
                                // If yes, mark Switch as needed and break loop
                                Switch = true;
                                break;
                              }
                            } else if (direction == "descending") {

                            // Check direction
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())
                            {
                                // If yes, mark Switch as needed and break loop
                                Switch = true;
                                break;
                              }
                            }
                          }
                          if (Switch) {
                        // Function to switch rows and mark switch as completed
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;

                        // Increase count for each switch
                        count++;
                      } else {
                        // Run while loop again for descending order
                        if (count == 0 && direction == "ascending") {
                          direction = "descending";
                          switching = true;
                        }
                      }
                    }
                  }
                </script>

              </body>

              </html>

              <?php 
              $con->close();
              $con2->close();
            ?>