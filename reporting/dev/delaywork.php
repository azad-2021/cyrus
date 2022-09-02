<?php 
include 'connection.php';
include 'session.php';


if (isset($_SESSION['userid2'])) {
  $EXEID=$_SESSION['userid2'];
  $Type='Reporting';
}else{
  $Type=$_SESSION['usertype'];
  $EXEID=$_SESSION['userid'];
}

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$DateR = date('d-M-y h:i A',strtotime($timestamp));

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




?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Delayed Work</title>
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

</head>
<style type="text/css">
a {
  cursor: pointer;
  margin: 15px 0;
}
</style>
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

    <!-- Find Orders -->

    <div class="modal" id="Reference" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Close ID</h5>
          </div>
          <div class="modal-body">

            <form class="form-control rounded-corner" method="POST" action="">
              <center>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="validationCustom01" class="form-label ">Enter Jobcard No</label>
                    <input type="text" class="form-control rounded-corner" name="Jobcard" required>
                  </div>
                  <div class="col-lg-6">
                    <label for="validationCustom01" class="form-label ">Enter Remark</label>
                    <textarea  type="text" class="form-control rounded-corner" name="Remark" maxlength="150" required></textarea>
                  </div>
                  
                  <input class="d-none" type="text" name="Type" id="Type">
                  <input class="d-none" type="number" name="ID" id="QID">
                </div>
              </center>
            </div>

            <div class="modal-footer">
              <button class="btn btn-primary" type="submit" name="submit" value="submit">Save</button>
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Pending Work</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="table-responsive container">
      <center>
       <div class="pagetitle">
        <nav><h1>Order</h1></nav>
      </div>
    </center>
    <table class="table table-hover table-bordered border-primary display" id="example" width="100%">
      <thead>
        <tr>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th>
          <th style="min-width:150px">District</th>
          <th style="min-width:100px">Order ID</th>
          <th style="min-width:250px">Description</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assign Date</th>
          <th style="min-width:150px">Service Engineer</th>
          <th style="min-width:100px">Delayed Days</th>
          <th style="min-width:130px">Action</th>
        </tr>
      </thead>
      <tbody >
        <?php 
        //echo $EXEID;
        if ($Type=="Executive") {
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 7 day), current_date()) As LeftDays, Discription FROM allorders
          join cyrusbackend.districts on allorders.Address3=districts.District
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription not like '%AMC%' and ControlerID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 7 day), current_date())<0";
        }else{              
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 7 day), current_date()) As LeftDays, Discription FROM allorders
          join reporting on allorders.EmployeeCode=reporting.EmployeeID
          WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription not like '%AMC%' and ExecutiveID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 7 day), current_date())<0;";
        }
        $result=mysqli_query($con,$query);
        while($row=mysqli_fetch_assoc($result)){
          $Employee=$row["Employee NAME"];
          $EmployeeID=$row["EmployeeCode"];

          ?>
          <tr>

            <td><?php echo $row["BankName"]; ?></td>
            <td ><?php echo $row["ZoneRegionName"]; ?></td>
            <td><?php echo $row["BranchName"]; ?></td>    
            <td><?php echo $row["Address3"]; ?></td>   
            <td><?php echo $row["OrderID"]; ?></td> 
            <td><?php echo $row["Discription"]; ?></td> 
            <td><?php echo '<span class="d-none">'.$row['DateOfInformation'].'</span>'.date("d-M-Y", strtotime($row["DateOfInformation"])); ?></td>  
            <td><?php echo '<span class="d-none">'.$row['AssignDate'].'</span>'.date("d-M-Y", strtotime($row["AssignDate"])); ?></td>  
            <td><?php echo $Employee; ?></td> 
            <td><?php echo (-1*$row["LeftDays"]); ?></td> 
            <td><button class="btn btn-primary gen" data-bs-toggle="modal" data-bs-target="#Reference" id="<?php echo $row["OrderID"]; ?>" id2="Order">Close ID</button></td>

          </tr>
        <?php }?>
      </tbody>
      <tfoot>
        <tr>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th>
          <th style="min-width:150px">District</th>
          <th style="min-width:100px">Order ID</th>
          <th style="min-width:250px">Description</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assign Date</th>
          <th style="min-width:150px">Service Engineer</th>
          <th style="min-width:100px">Delayed Days</th>
          <th style="min-width:130px"></th>
        </tr>
      </tfoot>
    </table>  
  </div>


  <div class="table-responsive"> 

    <br><br> 
    <div class="table-responsive container">
      <center>
       <div class="pagetitle">
        <nav><h1>Complaint</h1></nav>
      </div>
    </center>

    <table class="table table-hover table-bordered border-primary display" id="example2" width="100%">
      <thead id="unhead">
        <tr>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th>
          <th style="min-width:150px">District</th>
          <th style="min-width:100px">Complaint ID</th>
          <th style="min-width:250px">Description</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assign Date</th>
          <th style="min-width:150px">Service Engineer</th>
          <th style="min-width:100px">Delayed Days</th>
          <th style="min-width:130px">Action</th>
        </tr>
      </thead>
      <tbody >
        <?php 
        //echo $EXEID;
        if ($Type=="Executive") {
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, ComplaintID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 2 day), current_date()) As LeftDays, Discription FROM allcomplaint
          join cyrusbackend.districts on allcomplaint.Address3=districts.District
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE allcomplaint.AssignDate is not null and Attended=0 and ControlerID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 2 day), current_date())<0;";
        }else{              
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, ComplaintID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 2 day), current_date()) As LeftDays, Discription FROM allcomplaint
          join reporting on allcomplaint.EmployeeCode=reporting.EmployeeID
          WHERE allcomplaint.AssignDate is not null and Attended=0 and ExecutiveID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 2 day), current_date())<0";
        }
        $result=mysqli_query($con,$query);
        while($row=mysqli_fetch_assoc($result)){
          $Employee=$row["Employee NAME"];
          $EmployeeID=$row["EmployeeCode"];

          ?>
          <tr>

            <td><?php echo $row["BankName"]; ?></td>
            <td ><?php echo $row["ZoneRegionName"]; ?></td>
            <td><?php echo $row["BranchName"]; ?></td> 
            <td><?php echo $row["Address3"]; ?></td> 
            <td><?php echo $row["ComplaintID"]; ?></td>    
            <td><?php echo $row["Discription"]; ?></td> 
            <td><?php echo '<span class="d-none">'.$row['DateOfInformation'].'</span>'.date("d-M-Y", strtotime($row["DateOfInformation"])); ?></td>
            <td><?php echo '<span class="d-none">'.$row['AssignDate'].'</span>'.date("d-M-Y", strtotime($row["AssignDate"])); ?></td>   
            <td><?php echo $Employee; ?></td> 
            <td><?php echo  (-1*$row["LeftDays"]); ?></td> 
            <td><button class="btn btn-primary gen" data-bs-toggle="modal" data-bs-target="#Reference" id="<?php echo $row["ComplaintID"]; ?>" id2="Complaint">Close ID</button></td>
          </tr>
        <?php }?>
      </tbody>
      <tfoot>
        <tr>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th>
          <th style="min-width:150px">District</th>
          <th style="min-width:100px">Complaint ID</th>
          <th style="min-width:250px">Description</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assign Date</th>
          <th style="min-width:150px">Service Engineer</th>
          <th style="min-width:100px">Delayed Days</th>
          <th style="min-width:130px"></th>
        </tr>
      </tfoot>
    </table>
  </div>


  <div class="table-responsive"> 

    <br><br> 
    <div class="table-responsive container">
      <center>
       <div class="pagetitle">
        <nav><h1>AMC</h1></nav>
      </div>
    </center>

    <table class="table table-hover table-bordered border-primary display" id="example3" width="100%">
      <thead id="unhead">
        <tr>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th>
          <th style="min-width:150px">District</th>
          <th style="min-width:100px">AMC ID</th>
          <th style="min-width:250px">Description</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assign Date</th>
          <th style="min-width:150px">Service Engineer</th>
          <th style="min-width:100px">Delayed Days</th>
          <th style="min-width:130px">Action</th>
        </tr>
      </thead>
      <tbody >
        <?php 
        //echo $EXEID;
        if ($Type=="Executive") {
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 90 day), current_date()) As LeftDays, Discription FROM allorders
          join cyrusbackend.districts on allorders.Address3=districts.District
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription like '%AMC%' and ControlerID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 90 day), current_date())<0";
        }else{              
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 90 day), current_date()) As LeftDays, Discription FROM allorders
          join reporting on allorders.EmployeeCode=reporting.EmployeeID
          WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription like '%AMC%' and ExecutiveID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 90 day), current_date())<0;";
        }
        $result=mysqli_query($con,$query);
        while($row=mysqli_fetch_assoc($result)){
          $Employee=$row["Employee NAME"];
          $EmployeeID=$row["EmployeeCode"];

          ?>
          <tr>

            <td><?php echo $row["BankName"]; ?></td>
            <td ><?php echo $row["ZoneRegionName"]; ?></td>
            <td><?php echo $row["BranchName"]; ?></td>    
            <td><?php echo $row["Address3"]; ?></td>   
            <td><?php echo $row["OrderID"]; ?></td> 
            <td><?php echo $row["Discription"]; ?></td> 
            <td><?php echo '<span class="d-none">'.$row['DateOfInformation'].'</span>'.date("d-M-Y", strtotime($row["DateOfInformation"])); ?></td>  
            <td><?php echo '<span class="d-none">'.$row['AssignDate'].'</span>'.date("d-M-Y", strtotime($row["AssignDate"])); ?></td>  
            <td><?php echo $Employee; ?></td> 
            <td><?php echo (-1*$row["LeftDays"]); ?></td> 
            <td><button class="btn btn-primary gen" data-bs-toggle="modal" data-bs-target="#Reference" id="<?php echo $row["OrderID"]; ?>" id2="Order">Close ID</button></td>
          </tr>
        <?php }?>
      </tbody>
      <tfoot>
        <tr>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th>
          <th style="min-width:150px">District</th>
          <th style="min-width:100px">AMC ID</th>
          <th style="min-width:250px">Description</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assign Date</th>
          <th style="min-width:150px">Service Engineer</th>
          <th style="min-width:100px">Delayed Days</th>
          <th style="min-width:130px"></th>
        </tr>
      </tfoot>
    </table>
  </div>

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
<script src="ajax.js"></script>
<script src="search.js"></script>
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
    } );

    // DataTable
    var table = $('#example').DataTable({

      "rowCallback": function( row, data ) {
        $('td', row).css('background-color', '#E8A9BC');


      },
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
          //"lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
          responsive: false
        });

  } );


  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example2 tfoot th').each( function () {

      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#example2').DataTable({

      "rowCallback": function( row, data ) {
        $('td', row).css('background-color', '#E8A9BC');


      },
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
          //"lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
          responsive: false
        });

  } );

  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example3 tfoot th').each( function () {

      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#example3').DataTable({

      "rowCallback": function( row, data ) {
        $('td', row).css('background-color', '#E8A9BC');

      },
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
          //"lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
          responsive: false
        });

  } );

  var C=0;

  $(document).on('click', '.gen', function(){

    var ID=$(this).attr("id");
    Type=$(this).attr("id2");
    document.getElementById("QID").value=ID;
    document.getElementById("Type").value=Type;
  });

</script>
</body>

</html>

<?php 

if (isset($_POST['submit'])) {
  $QID=$_POST['ID'];
  $Remark=$_POST['Remark'];
  $Type=$_POST['Type'];
  $Jobcard=$_POST['Jobcard'];

  $input = preg_replace("/[^a-zA-Z0-9]+/", "", $Jobcard);
  $Jobcard=strtoupper($input);
  $sqlx = "SELECT * from `jobcardmain` where `Card Number` = '$Jobcard'";  
  $resultx = mysqli_query($con, $sqlx);  
  if (mysqli_num_rows($resultx)>0)
  {
   echo '<script>alert("Jobcard alredy exist")</script>';

 }else{
  if ($Type=='Order') {

    $query = "SELECT * FROM cyrusbackend.orders WHERE OrderID=$QID";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result); 

    if (!empty($row["Executive Remark"])) {

      $exRemark=$row["Executive Remark"];

      $Remark=$_SESSION['user'].' - '.$DateR.' - '.$Remark.' '.$exRemark;
    }
   // echo $Remark;

    $BranchCode=$row["BranchCode"];
    $GadgetID=$row["GadgetID"];
    $EmployeeCode=$row["EmployeeCode"];


    $sql = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `Remark`, `GadgetID`, `EmployeeCode`, ServiceDone, WorkPending) VALUES('$Jobcard', '$BranchCode', '$Date', 'Not Ok', '$GadgetID', '$EmployeeCode', 'Closed', 'Closed')";

    $sql2 = "INSERT INTO `reference table`( `Reference`, `Card Number`, `EmployeeCode`, `VisitDate`, `User`, `BranchCode`,  `ID`) VALUES ('$Type','$Jobcard','$EmployeeCode', '$Date', '$user', '$BranchCode', '$QID')";

    if ($con->query($sql2) === TRUE) {
        //echo '<meta http-equiv="refresh" content="0">';
    }else {
      echo "Error: " . $sql2 . "<br>" . $con->error;

    }

    if ($con->query($sql) === TRUE) {

      $query1 = "SELECT * FROM cyrusbackend.demandbase WHERE OrderID=$QID";
      $result1 = mysqli_query($con, $query1);
      if(mysqli_num_rows($result1)>0)
      {
        $row1 = mysqli_fetch_array($result1);

        if ($row1["StatusID"]<4) {
          $query1 = "DELETE FROM cyrusbackend.demandextended WHERE OrderID=$QID";
          $result1 = mysqli_query($con, $query1);

          $query1 = "UPDATE cyrusbackend.demandbase SET StatusID=6 WHERE OrderID=$QID";
          $result1 = mysqli_query($con, $query1);

        }
      }
      $sql = "UPDATE orders SET `Executive Remark`='$Remark', AttendDate='$Date', Attended=1 WHERE OrderID=$QID";

      if ($con->query($sql) === TRUE) {
        //echo '<meta http-equiv="refresh" content="0">';
      }else {
        echo "Error: " . $sql . "<br>" . $con->error;

      }
      echo '<meta http-equiv="refresh" content="0">';
    }else {
      echo "Error: " . $sql . "<br>" . $con->error;

    }
  }elseif ($Type=='Complaint'){

    $sql ="SELECT * FROM complaints WHERE ComplaintID=$QID";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result); 
    if (!empty($row["Executive Remark"])) {

      $exRemark=$row["Executive Remark"];

      $Remark=$_SESSION['user'].' - '.$DateR.' - '.$Remark.' '.$exRemark;
    }

    $BranchCode=$row["BranchCode"];
    $GadgetID=$row["GadgetID"];
    $EmployeeCode=$row["EmployeeCode"];
    $sql = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `Remark`, `GadgetID`, `EmployeeCode`, ServiceDone, WorkPending) VALUES('$Jobcard', '$BranchCode', '$Date', 'Not Ok', '$GadgetID', '$EmployeeCode', 'Closed', 'Closed')";

    $sql2 = "INSERT INTO `reference table`( `Reference`, `Card Number`, `EmployeeCode`, `VisitDate`, `User`, `BranchCode`,  `ID`) VALUES ('$Type','$Jobcard','$EmployeeCode', '$Date', '$user', '$BranchCode', '$QID')";

    if ($con->query($sql2) === TRUE) {
        //echo '<meta http-equiv="refresh" content="0">';
    }else {
      echo "Error: " . $sql2 . "<br>" . $con->error;

    }


    $sql = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `Remark`, `GadgetID`, `EmployeeCode`, ServiceDone, WorkPending) 
    VALUES('$Jobcard', '$BranchCode', '$Date', 'Not Ok', '$GadgetID', '$EmployeeCode', 'Closed', 'Closed')";

    if ($con->query($sql) === TRUE) {

      $sql = "UPDATE complaints SET `Executive Remark`='$Remark', AttendDate='$Date', Attended=1 WHERE ComplaintID=$QID";
      if ($con->query($sql) === TRUE) {
        echo '<meta http-equiv="refresh" content="0">';
      }else {
        echo "Error: " . $sql . "<br>" . $con->error;

      }
      echo '<meta http-equiv="refresh" content="0">';
    }else {
      echo "Error: " . $sql . "<br>" . $con->error;

    }


  }


}
}


$con->close();
$con2->close();
?>