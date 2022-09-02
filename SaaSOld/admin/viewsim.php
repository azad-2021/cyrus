<?php

include('connection.php'); 
include 'session.php';
$Type=$_SESSION['usertype'];
$EXEID=$_SESSION['userid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$Hour = date('G');
//echo $_SESSION['user'];

$user=$_SESSION['user'];

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

$query ="SELECT BankName, ZoneRegionName, BranchName, Gadget, orders.OrderID, simprovider.SimProvider, simprovider.SimType, MobileNumber, SimNo, Operator, ReleaseDate as SimReleaseDate, production.IssueDate as InuseDate, ActivationDate, ExpDate, simprovider.ID as SimID, ProductionID, DATEDIFF(ExpDate,ActivationDate) as leftDays FROM saas.simprovider
join production on simprovider.ID=production.SimID
join orders on production.OrderID=orders.OrderID
join gadget on orders.GadgetID=gadget.GadgetID
join operators on orders.OperatorID=operators.OperatorID
join cyrusbackend.branchdetails on SaaS.orders.BranchCode=branchdetails.BranchCode
WHERE Installed=1 and orders.SimProvider='Cyrus' ORDER BY orders.OrderID DESC";
$results = mysqli_query($con, $query); 


if (isset($_POST['submit'])) {
  $RDate=$_POST['RDate'];
  $ExpDate=$_POST['ExpDate'];
  $SimID=$_POST['SimID'];
  echo "<meta http-equiv='refresh' content='0'>";
}


if (isset($_POST['suspend'])) {
  $SDate=$_POST['SDate'];
  $Remark=$_POST['SuspensionRemark'];
  $SimID=$_POST['SimID'];
  echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['changesim'])) {
  $SimNo=$_POST['SimNo'];
  $SimID=$_POST['SimID'];
  echo "<meta http-equiv='refresh' content='0'>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Active SIM Cards</title>
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
  <script src="assets/js/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="datatable/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="datatable/css/responsive.bootstrap5.min.css"/>

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

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">


          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content rounded-corner">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Recharge Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="">
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Rcharge Date</label>
                      <input type="date" name="RDate" class="form-control rounded-corner" required>
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Plan Expiry Date</label>
                      <input type="date" name="ExpDate" class="form-control rounded-corner" required>
                    </div>
                    <div class="mb-3 d-none">
                      <label for="message-text" class="col-form-label">SimID</label>
                      <input type="text" name="SimID" id="Sim" class="form-control rounded-corner" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class=" btn btn-primary my-button" value="submit" name="submit">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="suspension" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content rounded-corner">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="">
                    <div class="mb-3 d-none">
                      <label for="recipient-name" class="col-form-label">Sim ID</label>
                      <input type="text" name="SimID" id="SimS" class="form-control rounded-corner">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Suspension Date</label>
                      <input type="date" name="SDate" class="form-control rounded-corner" required>
                    </div>
                    <div class="mb-3 ">
                      <label for="message-text" class="col-form-label">Suspension Remark</label>
                      <textarea class="form-control rounded-corner" name="SuspensionRemark" required></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class=" btn btn-primary my-button" value="suspend" name="suspend">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="modal fade" id="SimNoChange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content rounded-corner">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="">
                    <div class="mb-3 d-none">
                      <label for="recipient-name" class="col-form-label">Sim ID</label>
                      <input type="text" name="SimID" id="SimNo" class="form-control rounded-corner">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">New Sim Number</label>
                      <input type="number" name="SimNo" maxlength="20" class="form-control rounded-corner" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class=" btn btn-primary my-button" value="changesim" name="changesim">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <h3 align="center">Completed Orders</h3>  
          <br />  
          <div class="table-responsive">  
           <table class="table table-hover table-bordered border-primary" id="example" class="display nowrap"> 
            <thead> 
              <tr> 
                <th>Bank</th> 
                <th>Zone</th> 
                <th>Branch</th> 
                <th>Gadget</th>
                <th>Order Id</th>
                <th>Sim Provider</th>
                <th>Sim Type</th>
                <th>Mobile No</th> 
                <th>Sim No</th>
                <th>Operator</th> 
                <th>Sim Release Date</th>
                <th>In Use Date</th>
                <th>Activation Date</th>
                <th>Expiry Date</th>
                <th>Validity Days Left</th>
                <th>Action</th>
              </tr>                     
            </thead>                 
            <tbody> 
              <?php  

              while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
                if ($row["leftDays"]<0) {
                  $Action='<a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#exampleModal" class="Recharge">Recharge Now</a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#suspension" class="Suspend">Suspend Number</a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#SimNoChange" class="SimNoChange">Change Sim Number</a>';

                  $Bank='<span style="color: red;">'.$row["BankName"].'</span>';
                }elseif ($row["leftDays"]<=30) {
                  $Bank='<span style="color: blue;">'.$row["BankName"].'</span>';
                  $Action='<a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#exampleModal" class="Recharge">Recharge Now</a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#suspension" class="Suspend">Suspend Number</a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#SimNoChange" class="SimNoChange">Change Sim Number</a>';
                }else{
                 $Bank=$row["BankName"]; 
                 $Action='<a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#suspension" class="Suspend">Suspend Number</a> 
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <a id="'.$row["SimID"].'" data-bs-toggle="modal" data-bs-target="#SimNoChange" class="SimNoChange">Change Sim Number</a>';
               }
               echo '  
               <tr>
               <td>'.$Bank.'</td> 
               <td>'.$row["ZoneRegionName"].'</td>  
               <td>'.$row["BranchName"].'</td>  
               <td>'.$row["Gadget"].'</td>
               <td>'.$row["OrderID"].'</td>
               <td>'.$row["SimProvider"].'</td>
               <td>'.$row["SimType"].'</td>
               <td>'.$row["MobileNumber"].'</td>
               <td>'.$row["SimNo"].'</td>
               <td>'.$row["Operator"].'</td>
               <td>'.date('d-m-Y',strtotime($row["SimReleaseDate"])).'</td>
               <td>'.date('d-m-Y',strtotime($row["InuseDate"])).'</td>
               <td>'.date('d-m-Y',strtotime($row["ActivationDate"])).'</td> 
               <td>'.date('d-m-Y',strtotime($row["ExpDate"])).'</td>
               <td>'.$row["leftDays"].'</td> 
               <td>'.$Action.'</td>     
               </tr>  
               ';  
             }
             ?> 
             <tfoot>
              <tr>
                <th>Bank</th> 
                <th>Zone</th> 
                <th>Branch</th> 
                <th>Gadget</th>
                <th>Order Id</th>
                <th>Sim Provider</th>
                <th>Sim Type</th>
                <th>Mobile No</th> 
                <th>Sim No</th>
                <th>Operator</th> 
                <th>Sim Release Date</th>
                <th>In Use Date</th>
                <th>Activation Date</th>
                <th>Expiry Date</th>
                <th>Validity Days Left</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>  
        </div>  
      </div>
    </div>
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

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="datatable/js/jquery.dataTables.min.js"></script>]
<script src="datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="datatable/js/dataTables.responsive.min.js"></script>
<script src="datatable/js/responsive.bootstrap5.min.js"></script>

<script>

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
  $('#myTable').DataTable( {
    responsive: true
  } );


  $(document).on('click','.Recharge', function(){
    var SimID =  $(this).attr("id");
    console.log(SimID); 
    document.getElementById("Sim").value=SimID;
  });

  $(document).on('click','.Suspend', function(){
    var SimID =  $(this).attr("id");
    console.log(SimID); 
    document.getElementById("SimS").value=SimID;
  });

  $(document).on('click','.SimNoChange', function(){
    var SimID =  $(this).attr("id");
    console.log(SimID); 
    document.getElementById("SimNo").value=SimID;
  });
</script>
</body>
</html>

<?php 
$con -> close();
$con2 -> close();
$con3 -> close();

?>