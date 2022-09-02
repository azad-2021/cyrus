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

if (isset($_POST['submit'])) {
  $OrderID=$_POST['EOrderID'];
  $Remark=$_POST['ERemark'];

  $sql = "UPDATE orders SET `Executive Remark`='$Remark' WHERE OrderID=$OrderID";
  if ($con->query($sql) === TRUE) {
    echo '<meta http-equiv="refresh" content="0">';
  }else {
    echo "Error: " . $sql . "<br>" . $con->error;

  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Employee Target</title>
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
          <li class="breadcrumb-item active">Pending Material Confirmation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal fade" data-bs-backdrop="static" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="material">

              </div>
              <br>
              <form id="f1">
                <div class="row text-centered">
                  <div class="col-lg-5">
                    <center>
                      <label >Select Items</label>
                    </center>
                    <select id="ItemID" class="form-control rounded-corner" name="Items" required>
                      <option value="">Select</option>
                    </select>
                  </div>
                  <div class="col-lg-5">
                    <center>
                      <label>Enter Quantity</label>
                    </center>
                    <input type="number" name="" id="qty" class="form-control rounded-corner" onkeydown="limit(this);" onkeyup="limit(this);">
                  </div>
                  <div class="col-lg-2">
                    <center>
                      <label></label>
                      <br>
                    </center>
                    <button type="button" class="btn btn-primary btn-lg addItems">Add</button>
                  </div>
                  <div class="col-lg-3 d-none">
                    <input type="number" name="" id="orderid" class="form-control">
                  </div>
                  <div class="col-lg-3 d-none">
                    <input type="number" name="" id="ZoneCode" class="form-control">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary cl confirm">Confirm</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" data-bs-backdrop="static" id="AddRemark" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Executive Remark</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="f1" method="POST" action="">
                <div class="row text-centered">
                  <center>
                    <div class="col-lg-6">

                      <label >Enter Remark</label>
                      <textarea class="form-control rounded-corner" name="ERemark" required></textarea>

                    </div>
                  </center>
                  <div class="col-lg-3 d-none">
                    <input type="text" id="EOrderID" name="EOrderID" class="form-control">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">
            <br>

            <div class="table-responsive container">
              <table class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                <thead>
                  <tr class="text-dark">
                    <th scope="col" style="min-width:150px">Employee Name</th>
                    <th scope="col" style="min-width:150px">Target Amount</th>
                    <th scope="col" style="min-width:150px">Billed Amount</th>
                    <th scope="col" style="min-width:150px">Pending Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $queryT="SELECT TargetAmounts, EmployeeCode, `Employee Name` FROM cyrusbackend.employees
                  join districts on employees.EmployeeCode=districts.`Assign To`
                  join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  WHERE ControlerID=$EXEID
                  group by EmployeeCode order by `Employee Name`";
                  $resultT=mysqli_query($con,$queryT);

                  $TargetArray=array();
                  $AceivedArray=array();

                  while ($row=mysqli_fetch_assoc($resultT)){

                    $EmployeeCode=$row["EmployeeCode"];
                    $query4="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
                    WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=month(current_date()) and year(BillDate)=year(current_date())";
                    $result4=mysqli_query($con2,$query4);
                    $row4 = mysqli_fetch_array($result4);
                    if(!empty($row4["sum(TotalBilledValue)"])){
                      $BilledAmount=number_format((float)$row4["sum(TotalBilledValue)"], 2, '.', '');
                      $Pending=$row["TargetAmounts"]-$row4["sum(TotalBilledValue)"];
                    }else{
                      $BilledAmount='0.00';
                      $Pending='0.00';
                    }

                    ?>
                    <tr>
                      <td><a target="_blank" href="/cyrus/technician/executiveview.php?eid=<?php echo $row["EmployeeCode"]; ?>&name=<?php echo $row["Employee Name"]; ?>"><?php echo $row["Employee Name"]; ?></a></td>
                      <td><?php echo $row["TargetAmounts"]; ?></td>
                      <td><?php echo $BilledAmount; ?></td>
                      <td><?php echo $Pending; ?></td>
                    </tr>
                  <?php } ?>
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

  var exampleModal = document.getElementById('add')
  exampleModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var ID = button.getAttribute('data-bs-orderid')
    var ZoneCode=button.getAttribute('data-bs-zonecode')
      //console.log(recipient);
      document.getElementById("orderid").value = ID;
      document.getElementById("ZoneCode").value = ZoneCode;
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


  $(document).on('click', '.AddRemark', function(){
  //$('#dataModal').modal();
  var OrderID=$(this).attr("id");
  document.getElementById("EOrderID").value=OrderID;
  //console.log(OrderID);
});

</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>