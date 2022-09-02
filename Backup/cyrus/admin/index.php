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
  <style type="text/css">
  table{
    font-size: 14px;
  }
  th,a {
    cursor: pointer;
  }


  .overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("assets/img/loader.gif") center no-repeat;
  }
  /* Turn off scrollbar when body element has the loading class */
  body.loading{
    overflow: hidden;   
  }
  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay{
    display: block;
  }

</style>
</head>
<body>
 <div class="overlay"></div>
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
            <h1>Service engineer performance report <?php echo date('M-y',strtotime($timestamp)); ?></h1>
          </div>

        </center>
        <div class="table-responsive container">
          <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
            <thead id="unhead">
              <tr>
                <th style="min-width: 180px">Employee Name</th>
                <th style="min-width: 100px">Attended Orders</th>
                <th style="min-width: 100px">Attended Complaints</th>
                <th style="min-width: 100px">Attended AMC</th>
                <th style="min-width: 100px">Pending Orders</th>
                <th style="min-width: 100px">Pending Complaints</th>
                <th style="min-width: 100px">Pending AMC</th>
                <th style="min-width: 100px">Working Days</th>
                <th style="min-width: 100px">Work within time</th>
                <th style="min-width: 100px">Work out of time</th>
                <th style="min-width: 100px">Billing Amount</th>  
              </tr>
            </thead>
            <tbody >
              <?php 
              $query="SELECT EmployeeCode, `Employee Name` from cyrusbackend.employees WHERE Inservice=1 ORDER BY `Employee Name`";

              $result=mysqli_query($con,$query);

              while($row = mysqli_fetch_array($result)){

                $EmployeeCode=$row["EmployeeCode"];

                $query1="SELECT count(OrderID) as AttendedOrders FROM cyrusbackend.orders
                WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
                month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                $result1=mysqli_query($con2,$query1);
                $row1 = mysqli_fetch_array($result1);



                $query2="SELECT count(OrderID) as AttendedAMC FROM cyrusbackend.orders
                WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
                month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                $result2=mysqli_query($con2,$query2);
                $row2 = mysqli_fetch_array($result2);

                $query3="SELECT count(ComplaintID) as AttendedComplaints FROM cyrusbackend.allcomplaint
                WHERE EmployeeCode=$EmployeeCode and Attended=1 and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                $result3=mysqli_query($con2,$query3);
                $row3 = mysqli_fetch_array($result3);

                $query4="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
                WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=month(current_date()) and year(BillDate)=year(current_date())";
                $result4=mysqli_query($con2,$query4);
                $row4 = mysqli_fetch_array($result4);

                $query5="SELECT count(Distinct VisitDate) as WorkingDays FROM cyrusbackend.jobcardmain WHERE EmployeeCode=$EmployeeCode and month(VisitDate)=month(current_date()) and year(VisitDate)=year(current_date())";
                $result5=mysqli_query($con2,$query5);
                $row5 = mysqli_fetch_array($result5);


                $query6="SELECT count(OrderID) FROM cyrusbackend.orders
                join branchdetails on orders.BranchCode=branchdetails.BranchCode
                Where EmployeeCode=$EmployeeCode and Discription not like '%AMC%' and AssignDate is not null and Attended=0 and Address3 not like '%reserved%'";
                $result6=mysqli_query($con,$query6);

                $query7="SELECT count(OrderID) FROM cyrusbackend.orders
                join branchdetails on orders.BranchCode=branchdetails.BranchCode
                Where EmployeeCode=$EmployeeCode and Discription like '%AMC%' and AssignDate is not null and Attended=0 and Address3 not like '%reserved%'";
                $result7=mysqli_query($con,$query7);


                $query8="SELECT count(ComplaintID) FROM cyrusbackend.complaints
                join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=0 and Address3 not like '%reserved%'";
                $result8=mysqli_query($con,$query8);



                $query9="SELECT count(ComplaintID) FROM cyrusbackend.complaints
                join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=1 and Address3 not like '%reserved%' and datediff(AttendDate, AssignDate)>2 and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                $result9=mysqli_query($con,$query9);
                $row9 = mysqli_fetch_array($result9);

                $query10="SELECT count(ComplaintID) FROM cyrusbackend.complaints
                join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                Where EmployeeCode=$EmployeeCode and AssignDate is not null and Attended=1 and Address3 not like '%reserved%' and datediff(AttendDate, AssignDate)<=2 and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                $result10=mysqli_query($con,$query10);
                $row10 = mysqli_fetch_array($result10);



                $query11="SELECT count(OrderID) FROM cyrusbackend.orders
                WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
                month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date()) and datediff(AttendDate, AssignDate)<=10";
                $result11=mysqli_query($con,$query11);
                $row11 = mysqli_fetch_array($result11);

                $query12="SELECT count(OrderID) FROM cyrusbackend.orders
                WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription not like '%AMC%' and
                month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date()) and datediff(AttendDate, AssignDate)>10";
                $result12=mysqli_query($con,$query12);
                $row12 = mysqli_fetch_array($result12);



                $query13="SELECT count(OrderID) FROM cyrusbackend.orders
                WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
                month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date()) and datediff(AttendDate, AssignDate)<=60";
                $result13=mysqli_query($con,$query13);
                $row13 = mysqli_fetch_array($result13);

                $query14="SELECT count(OrderID) FROM cyrusbackend.orders
                WHERE EmployeeCode=$EmployeeCode and Attended=1 and Discription like '%AMC%' and
                month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date()) and datediff(AttendDate, AssignDate)>60";
                $result14=mysqli_query($con,$query14);
                $row14 = mysqli_fetch_array($result14);



                $PO=0;
                $PC=0;
                $PA=0;

                $row6 = mysqli_fetch_array($result6);
                $row7 = mysqli_fetch_array($result7);
                $row8 = mysqli_fetch_array($result8);

                $PO=$row6["count(OrderID)"];
                $PA=$row7["count(OrderID)"];
                $PC=$row8["count(ComplaintID)"];

                $PendingWork=$PO+$PC+$PA;

                if ($row1["AttendedOrders"]!=0 or $row2["AttendedAMC"]!=0 or $row3["AttendedComplaints"]!=0 or $PendingWork>0) {

                  ?>
                  <tr>
                    <td><?php echo $row["Employee Name"]; ?></td>

                    <td> <a class="view_WorkReportO" id="<?php print $EmployeeCode ?> " data-bs-target="#WorkReport"><?php echo $row1["AttendedOrders"]; ?></a></td>
                    <td> <a class="view_WorkReportC" id="<?php print $EmployeeCode ?> " data-bs-target="#ReportC"><?php echo $row3["AttendedComplaints"]; ?></a></td>
                    <td> <a class="view_WorkReportA" id="<?php print $EmployeeCode ?> " data-bs-target="#ReportAMC"><?php echo $row2["AttendedAMC"]; ?></a></td>

                    <td><?php echo $PO; ?></td>
                    <td><?php echo $PC; ?></td>
                    <td><?php echo $PA; ?></td>


                    <td><?php echo $row5["WorkingDays"]; ?></td>

                    <td><?php echo $row10["count(ComplaintID)"]+$row11["count(OrderID)"]+$row13["count(OrderID)"]; ?></td>
                    <td><?php echo $row9["count(ComplaintID)"]+$row12["count(OrderID)"]+$row14["count(OrderID)"]; ?></td>

                    <td> <a class="view_WorkReportB" id="<?php print $EmployeeCode ?> " data-bs-target="#ReportAMC"><?php echo $row4["sum(TotalBilledValue)"]; ?></a></td>


                  </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
          <br><br>
          <h4 align="center">Service engineer old work</h4>

          <div class="row g-3">
            <div class="col-md-12">
              <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
              <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
                <div class="row g-3">
                    <!--
                    <div class="col-sm-4">
                      <label>Select Employee</label>
                      <select id="employee" class="form-control rounded-corner" name="Bank" required>
                        <option value="">Select</option>
                        <?php
                        $Data="SELECT * FROM cyrusbackend.employees WHERE Inservice=1 ORDER BY `Employee Name`";
                        $result=mysqli_query($con,$Data);
                        if (mysqli_num_rows($result)>0)
                        {
                          while ($arr=mysqli_fetch_assoc($result))
                          {
                            ?>
                            <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  -->
                  <div class="col-sm-6">
                    <label>Start Date</label>
                    <input type="date" id="SDate" class="form-control rounded-corner">
                  </div>

                  <div class="col-sm-6">
                    <label>End Date</label>
                    <input type="date" id="EDate" class="form-control rounded-corner">
                  </div>

                </div>
              </form>
            </div>
          </div>

          <div class="table-responsive container">
            <table width="100%" class="table text-start align-middle table-bordered border-primary table-hover mb-0 display2">
              <thead>
                <tr>
                  <th style="min-width: 150px">Employee Name</th>
                  <th style="min-width: 90px">Attended Orders</th>
                  <th style="min-width: 90px">Attended Complaints</th>
                  <th style="min-width: 90px">Attended AMC</th>
                  <th style="min-width: 90px">Working Days</th>
                  <th style="min-width: 100px">Work within time</th>
                  <th style="min-width: 90px">Work out of time</th>
                  <th style="min-width: 90px">Billing Amount</th>  
                </tr>
              </thead>
              <tbody id="work_dataP">

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
            $('.displayO').DataTable().clear();
            $('.displayO').DataTable().destroy();
            $('#work_data').html(result);

            $('table.displayO').DataTable( {

              rowReorder: {
                selector: 'td:nth-child(2)'
              },
              "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
              responsive: false
            } );

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
              $('.display2').DataTable().clear();
              $('.display2').DataTable().destroy();
              $('#work_dataP').html(result); 

              
              $('table.display2').DataTable( {

                rowReorder: {
                  selector: 'td:nth-child(2)'
                },
                "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
                responsive: false
              } );

            }
          });
        }
      });


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

    $(document).on({
      ajaxStart: function(){
        $("body").addClass("loading"); 
      },
      ajaxStop: function(){ 
        $("body").removeClass("loading"); 
      }    
    });

  </script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>