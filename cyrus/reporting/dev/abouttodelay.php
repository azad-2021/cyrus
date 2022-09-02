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

  <title>About to Delay Work</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.1/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
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
          <li class="breadcrumb-item active">About to delay</li>
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
          <th style="min-width:120px">Bank</th>
          <th style="min-width:110px">Zone</th>
          <th style="min-width:120px">Branch</th>
          <th style="min-width:120px">District</th>
          <th style="min-width:90px">Order ID</th>
          <th style="min-width:250px">Description</th>
          <th style="min-width:130px">Information Date</th>
          <th style="min-width:130px">Assign Date</th>
          <th style="min-width:110px">Reassigned Times</th>
          <th style="min-width:130px">Service Engineer</th>
          <th style="min-width:100px">Left Days</th>
          <th style="min-width:100px">Reassign Date</th>
          <th style="min-width:100px">Action</th>
        </tr>
      </thead>
      <tbody >
        <?php 
        //echo $EXEID;
        if ($Type=="Executive") {
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 6 day), current_date()) As LeftDays, Discription FROM allorders
          join cyrusbackend.districts on allorders.Address3=districts.District
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription not like '%AMC%' and ControlerID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 3 day), current_date())>=0";
        }else{              
          $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 6 day), current_date()) As LeftDays, Discription FROM allorders
          join reporting on allorders.EmployeeCode=reporting.EmployeeID
          WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription not like '%AMC%' and ExecutiveID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 3 day), current_date())>=0";
        }
        $result=mysqli_query($con,$query);
        while($row=mysqli_fetch_assoc($result)){
          $Employee=$row["Employee NAME"];
          $EmployeeID=$row["EmployeeCode"];
          $OrderID=$row["OrderID"];
          $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$OrderID and Type='o' and AssignType='R'";
          $result3=mysqli_query($con,$query3);
          $row3 = mysqli_fetch_array($result3);

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
            <td><?php echo $row3["count(ID)"]; ?></td>
            <td><?php echo $Employee; ?></td> 
            <td><?php echo $row["LeftDays"]; ?></td> 
            <td><input type="date" value="<?php echo $Date; ?>" id="<?php print $row['OrderID'];?>" name="Date" class="form-control rounded-corner" align="center"></td>

            <td>
              <form id="resetAO">
                <select class="form-control rounded-corner" id="AO">
                 <option value="">Select</option>        
                 <?php
                 if ($Type !="Executive") {
                   if ($row3["count(ID)"]<5) {
                     $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
                     $resultTech=mysqli_query($con,$queryTech);
                     while($data=mysqli_fetch_assoc($resultTech)){
                      $json = array("EmployeeID"=>$data['EmployeeCode'], "OrderID"=>$row['OrderID'], "Status"=>"Assigned", "Count"=>$row3['count(ID)'], "exEmployeeID"=>$exEmployeeID);
                      $Data=json_encode($json);
                      echo "<option value=".$Data.">".$data['Employee Name']."</option>";
                    }
                  }
                }  
                ?>
              </select>
            </form>
          </td>
        </tr>
      <?php }?>
    </tbody>
    <tfoot>
      <tr>
        <th style="min-width:120px">Bank</th>
        <th style="min-width:110px">Zone</th>
        <th style="min-width:120px">Branch</th>
        <th style="min-width:120px">District</th>
        <th style="min-width:90px">Order ID</th>
        <th style="min-width:250px">Description</th>
        <th style="min-width:130px">Information Date</th>
        <th style="min-width:130px">Assign Date</th>
        <th style="min-width:110px">Reassigned Times</th>
        <th style="min-width:130px">Service Engineer</th>
        <th style="min-width:100px">Left Days</th>
        <th style="min-width:100px">Reassign Date</th>
        <th style="min-width:100px">Action</th>
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
        <th style="min-width:120px">Bank</th>
        <th style="min-width:110px">Zone</th>
        <th style="min-width:120px">Branch</th>
        <th style="min-width:120px">District</th>
        <th style="min-width:100px">Complaint ID</th>
        <th style="min-width:250px">Description</th>
        <th style="min-width:130px">Information Date</th>
        <th style="min-width:130px">Assign Date</th>
        <th style="min-width:100px">Reassigned Times</th>
        <th style="min-width:130px">Service Engineer</th>
        <th style="min-width:100px">Left Days</th>
        <th style="min-width:100px">Reassign Date</th>
        <th style="min-width:100px">Action</th>
      </tr>
    </thead>
    <tbody >
      <?php 
        //echo $EXEID;
      if ($Type=="Executive") {
        $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, ComplaintID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 2 day), current_date()) As LeftDays, Discription FROM allcomplaint
        join cyrusbackend.districts on allcomplaint.Address3=districts.District
        join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
        WHERE allcomplaint.AssignDate is not null and Attended=0 and ControlerID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 1 day), current_date())>=0";
      }else{              
        $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, ComplaintID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 2 day), current_date()) As LeftDays, Discription FROM allcomplaint
        join reporting on allcomplaint.EmployeeCode=reporting.EmployeeID
        WHERE allcomplaint.AssignDate is not null and Attended=0 and ExecutiveID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 1 day), current_date())>=0";
      }

      $result=mysqli_query($con,$query);
      while($row=mysqli_fetch_assoc($result)){
        $Employee=$row["Employee NAME"];
        $EmployeeID=$row["EmployeeCode"];

        $ComplaintID=$row['ComplaintID'];
        $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$ComplaintID and Type='c' and AssignType='R'";
        $result3=mysqli_query($con,$query3);
        $row3 = mysqli_fetch_array($result3);
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
          <td><?php echo $row3["count(ID)"]; ?></td> 
          <td><?php echo $Employee; ?></td> 
          <td><?php echo $row["LeftDays"]; ?></td> 
          <td><input type="date" value="<?php echo $Date; ?>" id="<?php print $row['ComplaintID'];?>" name="Date" class="form-control rounded-corner" align="center"></td>

          <td>
            <form class="resetAC">
              <select class="form-control rounded-corner" style="text-align: center;" id="AC">
               <option value="">Select</option>        
               <?php
               if ($Type !="Executive") {
                 if ($row3["count(ID)"]<5) {
                   $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
                   $resultTech=mysqli_query($con,$queryTech);
                   while($data=mysqli_fetch_assoc($resultTech)){
                    $json = array("EmployeeID"=>$data['EmployeeCode'], "ComplaintID"=>$row['ComplaintID'], "Status"=>"Assigned", "Count"=>$row3['count(ID)'], "exEmployeeID"=>$exEmployeeID);
                    $Data=json_encode($json);

                    echo "<option value=".$Data.">".$data['Employee Name']."</option>";
                  }
                } 
              } 
              ?>
            </select>
          </form>
        </td>
      </tr>
    <?php }?>
  </tbody>
  <tfoot>
    <tr>
      <th style="min-width:120px">Bank</th>
      <th style="min-width:110px">Zone</th>
      <th style="min-width:120px">Branch</th>
      <th style="min-width:120px">District</th>
      <th style="min-width:90px">Order ID</th>
      <th style="min-width:250px">Description</th>
      <th style="min-width:130px">Information Date</th>
      <th style="min-width:130px">Assign Date</th>
      <th style="min-width:100px">Reassigned Times</th>
      <th style="min-width:130px">Service Engineer</th>
      <th style="min-width:100px">Left Days</th>
      <th style="min-width:100px">Reassign Date</th>
      <th style="min-width:100px">Action</th>
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
        <th style="min-width:120px">Bank</th>
        <th style="min-width:110px">Zone</th>
        <th style="min-width:120px">Branch</th>
        <th style="min-width:120px">District</th>
        <th style="min-width:90px">AMC ID</th>
        <th style="min-width:250px">Description</th>
        <th style="min-width:130px">Information Date</th>
        <th style="min-width:130px">Assign Date</th>
        <th style="min-width:100px">Reassigned Times</th>
        <th style="min-width:130px">Service Engineer</th>
        <th style="min-width:100px">Left Days</th>
        <th style="min-width:100px">Reassign Date</th>
        <th style="min-width:100px">Action</th>
      </tr>
    </thead>
    <tbody >
      <?php 
        //echo $EXEID;
      if ($Type=="Executive") {
        $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 90 day), current_date()) As LeftDays, Discription FROM allorders
        join cyrusbackend.districts on allorders.Address3=districts.District
        join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
        WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription like '%AMC%' and ControlerID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 60 day), current_date())>=0";
      }else{              
        $query="SELECT BankName, ZoneRegionName, BranchName, Address3, EmployeeCode, `Employee Name`, OrderID, DateOfInformation, AssignDate, datediff(DATE_ADD(AssignDate,INTERVAL 90 day), current_date()) As LeftDays, Discription FROM allorders
        join reporting on allorders.EmployeeCode=reporting.EmployeeID
        WHERE allorders.AssignDate is not null and Attended=0 and allorders.Discription like '%AMC%' and ExecutiveID=$EXEID and datediff(DATE_ADD(AssignDate,INTERVAL 60 day), current_date())>=0";
      }
      $result=mysqli_query($con,$query);
      while($row=mysqli_fetch_assoc($result)){
        $Employee=$row["Employee NAME"];
        $EmployeeID=$row["EmployeeCode"];

        $OrderID=$row["OrderID"];
        $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$OrderID and Type='o' and AssignType='R'";
        $result3=mysqli_query($con,$query3);
        $row3 = mysqli_fetch_array($result3);
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
          <td><?php echo $row3["count(ID)"]; ?></td> 
          <td><?php echo $Employee; ?></td> 
          <td><?php echo $row["LeftDays"]; ?></td> 
          <td><input type="date" value="<?php echo $Date; ?>" id="<?php print $row['OrderID'];?>" name="Date" class="form-control rounded-corner" align="center"></td>

          <td>
            <form id="resetAO">
              <select class="form-control rounded-corner" id="amc">
               <option value="">Select</option>        
               <?php
               if ($Type !="Executive") {
                 if ($row3["count(ID)"]<5) {
                   $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
                   $resultTech=mysqli_query($con,$queryTech);
                   while($data=mysqli_fetch_assoc($resultTech)){
                    $json = array("EmployeeID"=>$data['EmployeeCode'], "OrderID"=>$row['OrderID'], "Status"=>"Assigned", "Count"=>$row3['count(ID)'], "exEmployeeID"=>$exEmployeeID);
                    $Data=json_encode($json);
                    echo "<option value=".$Data.">".$data['Employee Name']."</option>";
                  }
                }
              }  
              ?>
            </select>
          </form>
        </td>
      </tr>
    <?php }?>
  </tbody>
  <tfoot>
    <tr>
      <th style="min-width:120px">Bank</th>
      <th style="min-width:110px">Zone</th>
      <th style="min-width:120px">Branch</th>
      <th style="min-width:120px">District</th>
      <th style="min-width:90px">Order ID</th>
      <th style="min-width:250px">Description</th>
      <th style="min-width:130px">Information Date</th>
      <th style="min-width:130px">Assign Date</th>
      <th style="min-width:100px">Reassigned Times</th>
      <th style="min-width:130px">Service Engineer</th>
      <th style="min-width:100px">Left Days</th>
      <th style="min-width:100px">Reassign Date</th>
      <th style="min-width:100px">Action</th>
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
<script src="https://cdn.datatables.net/searchpanes/2.0.1/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript">
  /*
  $(document).ready(function() {
    $('table.display').DataTable( {

      "rowCallback": function( row, data ) {
        //$('td', row).css('background-color', '#E8A9BC');

        if (data[9] < "0") {
          $('td', row).css('background-color', '#E8A9BC');
        } else if (data[9] >="0") {
          $('td', row).css('background-color', '#A9B8E8');
        }

      },

      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      buttons: [
      {
        extend: 'searchPanes',
        config: {
          cascadePanes: true
        }
      }
      ],
      columnDefs: [
      {
        searchPanes: {
          header: 'Length of Life'
        },
        targets: [3]
      }
      ],
      dom: 'Bfrtip',
      responsive: false

    } );
  } );

  */


  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {

      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#example').DataTable({

      "rowCallback": function( row, data ) {
        //$('td', row).css('background-color', '#E8A9BC');

        if (data[10] < "0") {
          $('td', row).css('background-color', '#E8A9BC');
        } else if (data[10] >="0") {
          $('td', row).css('background-color', '#A9B8E8');
        }

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
        //$('td', row).css('background-color', '#E8A9BC');

        if (data[10] < "0") {
          $('td', row).css('background-color', '#E8A9BC');
        } else if (data[10] >="0") {
          $('td', row).css('background-color', '#A9B8E8');
        }

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
        //$('td', row).css('background-color', '#E8A9BC');

        if (data[10] < "0") {
          $('td', row).css('background-color', '#E8A9BC');
        } else if (data[10] >="0") {
          $('td', row).css('background-color', '#A9B8E8');
        }

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

  $(document).on('click', '.AddRemark', function(){

    var OrderID=$(this).attr("id");
    C=$(this).attr("id2");
    document.getElementById("EOrderID").value=OrderID;

  });

  $(document).on('click', '.SaveRemark', function(){
    var ID=document.getElementById("EOrderID").value;
    var Remark=document.getElementById("ERemark").value;
    if (Remark) {
      if (C==1) {
        $.ajax({
          url:"reassign.php",
          method:"POST",
          data:{'ERemarkC':Remark, 'EComplaintID':ID},
          success:function(data){
            $('#AddRemark').modal('hide');
            $("#fE").trigger('reset');
            swal("success","Remark Updated","success");
          }
        });
      }else{
        $.ajax({
          url:"reassign.php",
          method:"POST",
          data:{'ERemarkO':Remark, 'EOrderID':ID},
          success:function(data){
            swal("success","Remark Updated","success");
            $('#AddRemark').modal('hide');
            $("#fE").trigger('reset');
          }
        });
      }
    }

  });


</script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>