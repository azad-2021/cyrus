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

  <title>Work Report</title>
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
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  table{
    font-size: 18px;
    font-weight: 600;
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
  //include "modals.php";
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
        <br><br>
        <h4 align="center">Service engineer work report</h4>

        <div class="row g-3">
          <div class="col-md-12">
            <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
            <form class="needs-validation form-control novalidate rounded-corner" method="POST" style="margin-bottom: 5px;">
              <div class="row g-3">

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
                <div class="col-sm-4">
                  <label>Start Date</label>
                  <input type="date" id="SDate" min="2022-01-01" class="form-control rounded-corner">
                </div>

                <div class="col-sm-4">
                  <label>End Date</label>
                  <input type="date" id="EDate" class="form-control rounded-corner">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div id="printTable">
          <div class="table-responsive container" style="margin:30px">
            <table width="100%" class="table text-start align-middle table-bordered border-primary table-hover mb-0" id="myTablePS">
              <thead>
                <tr>
                  <th style="min-width: 110px">Employee</th>
                  <th style="min-width: 120px">Pending Order</th>
                  <th style="min-width: 120px">Pending Complaint</th>
                  <th style="min-width: 120px">Pending AMC</th>
                  <th style="min-width: 120px">Target</th>
                  <th style="min-width: 120px">Billed</th>
                </tr>
              </thead>
              <tbody id="work_dataPP">

              </tbody>
            </table>
          </div>
          <div class="table-responsive container" style="margin:30px">
            <table width="100%" class="table text-start align-middle table-bordered border-primary table-hover mb-0" id="myTablePS">
              <thead>
                <tr>
                  <th style="min-width:80px">Sr. No.</th>
                  <th style="min-width:100px">Visit Date</th>
                  <th style="min-width:120px">Bank</th>
                  <th style="min-width:120px">Zone</th>
                  <th style="min-width:120px">Branch</th>
                  <th style="min-width:140px">Jobcard Number</th>
                  <th style="min-width:120px">Assign Date</th>
                  <th style="min-width:200px">Service Done</th>
                  <th style="min-width:200px">Pending Work</th>
                  <th style="min-width:100px">Remark</th>
                  <th style="min-width:100px">Fine Order</th>
                  <th style="min-width:100px">Fine Complaint</th>
                </tr>
              </thead>
              <tbody id="work_dataP">

              </tbody>
            </table>
          </div>
        </div>
        
        <center>
         <!-- <button class="btn btn-primary Print" style="margin: 20px">Print</button>-->
          <button class="btn btn-primary"  onclick="ExportToExcel('xlsx')">Export table to excel</button>
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

  function printData()
  {
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
 }


 $(document).on('click', '.Print', function(){
  printData();
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
  var EmployeeCode = document.getElementById("employee").value;

  if (SDate==''){
    swal("error","Please select Start Date","error");
  }else if (EmployeeCode==''){
    swal("error","Please select Emoloyee","error");
  }else{
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'EmployeeCodeP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
      success:function(result){
        $('#work_dataP').html(result);        
      }
    });
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'EmployeeCodePP':EmployeeCode, 'SDate':SDate, 'EDate':EDate},
      success:function(result){
        $('#work_dataPP').html(result);        
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

<script type="text/javascript">
  function ExportToExcel(type, fn, dl) {
   var elt = document.getElementById('printTable');
   var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
   return dl ?
   XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
   XLSX.writeFile(wb, fn || ('WorkReport.' + (type || 'xlsx')));
 }
</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>