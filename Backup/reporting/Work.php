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

  <title>Unassigned & Pending Work</title>
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
<style type="text/css">
a {
  cursor: pointer;
  margin: 15px 0;
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
  include "modals.php";
  ?>
  <main id="main" class="main">
    <div class="modal fade" id="ViewUNO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Unassigned Orders</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="UNOData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewAO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assigned Orders</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="AOData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewAC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assigned Complaints</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ACData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewUNC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Unassigned Complaints</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="UNCData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewUAMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Unassigned AMC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="UAMCData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewAMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assigned AMC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="AMCData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            <form id="fE">
              <div class="row text-centered">
                <center>
                  <div class="col-lg-6">

                    <label >Enter Remark</label>
                    <textarea class="form-control rounded-corner" id="ERemark" name="ERemark" required></textarea>

                  </div>
                </center>
                <div class="col-lg-3 d-none">
                  <input type="text" id="EOrderID" name="EOrderID" class="form-control">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary SaveRemark">Save</button>
          </div>
          
        </div>
      </div>
    </div>

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Unassigned & Pending Work</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="table-responsive container">
      <center>
       <div class="pagetitle">
        <nav><h1>Unassigned Work</h1></nav>
      </div>
    </center>
    <table class="table table-hover table-bordered border-primary display" id="myTable">
      <thead id="unhead">
        <tr>
          <th>Service Engineer</th>
          <th>Unassigned Orders </th>
          <th>Unassigned Complaints</th>                
          <th>Unassigned AMC</th>           
        </tr>
      </thead>
      <tbody >
        <?php 
        //echo $EXEID;
        if ($Type=="Executive") {
          $query="SELECT DISTINCT EmployeeCode, `Employee Name` FROM employees
          join cyrusbackend.districts on employees.EmployeeCode=districts.`Assign To`
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE Inservice=1 and ControlerID=$EXEID Order By `Employee Name`";
        }else{              
          $query="SELECT EmployeeCode, `Employee Name` FROM cyrusbackend.reporting join employees on reporting.EmployeeID=employees.EmployeeCode WHERE ExecutiveID=$EXEID order by `Employee Name`";
        }
        $resultTech=mysqli_query($con,$query);
        while($rowE=mysqli_fetch_assoc($resultTech)){
          $Employee=$rowE["Employee Name"];
          $EmployeeID=$rowE["EmployeeCode"];

          $query="SELECT count(ComplaintID) FROM cyrusbackend.vallcomplaintsd WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";
          $result=mysqli_query($con,$query);
          $row = mysqli_fetch_array($result);

          $query2="SELECT count(vallordersd.OrderID) FROM vallordersd WHERE vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
          $result2=mysqli_query($con,$query2);
          $row2 = mysqli_fetch_array($result2);

          $query3 = "SELECT count(unassignedorders.OrderID) FROM unassignedorders WHERE AssignDate is null and Discription not like '%AMC%' and unassignedorders.EmployeeCode=$EmployeeID";
          $result3 = mysqli_query($con, $query3);
          $row3 = mysqli_fetch_array($result3);
          if (($row["count(ComplaintID)"]!=0) or ($row2["count(vallordersd.OrderID)"]!=0) or ($row3["count(unassignedorders.OrderID)"]!=0) ) {

            ?>
            <tr>
              <td><?php echo $Employee; ?></td>

              <td><a class="view_UNO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUNO"><?php echo $row3["count(unassignedorders.OrderID)"]; ?></a></td>

              <td ><a class="view_UNC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUNC"><?php echo $row["count(ComplaintID)"]; ?></a></td>

              <td><a class="view_UAMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewUAMC"><?php echo $row2["count(vallordersd.OrderID)"]; ?></a></td>              
            </tr>
          <?php } }?>
        </tbody>
      </table>  
    </div>

    <div class="table-responsive"> 

      <br><br> 
      <div class="table-responsive container">
        <center>
         <div class="pagetitle">
          <nav><h1>Pending Work</h1></nav>
        </div>
      </center>

      <table class="table table-hover table-bordered border-primary display"> 
        <thead id="ahead">
          <tr>
            <th>Service Engineer</th>
            <th>Assigned Orders</th>  
            <th>Assigned Complaints</th> 
            <th>Assigned AMC</th>               
          </tr>
        </thead>
        <tbody>
          <?php 
          $row3='';
          if ($Type=="Executive") {
            $query="SELECT DISTINCT EmployeeCode, `Employee Name` FROM employees
            join cyrusbackend.districts on employees.EmployeeCode=districts.`Assign To`
            join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            WHERE Inservice=1 and ControlerID=$EXEID Order By `Employee Name`";
          }else{
            $query="SELECT EmployeeCode, `Employee Name` FROM cyrusbackend.reporting join employees on reporting.EmployeeID=employees.EmployeeCode WHERE ExecutiveID=$EXEID order by `Employee Name`";
          }
          $resultTech=mysqli_query($con,$query);
          while($rowE=mysqli_fetch_assoc($resultTech)){
           $Employee=$rowE["Employee Name"];
           $EmployeeID=$rowE["EmployeeCode"];

           $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allcomplaint WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeID";
           $result=mysqli_query($con,$query);
           $row = mysqli_fetch_array($result);

           $query2="SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allorders WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$EmployeeID";
           $result2=mysqli_query($con,$query2);
           $row2 = mysqli_fetch_array($result2);
           $AMC=$row2["count(OrderID)"];

           $query3 = "SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM allorders WHERE EmployeeCode=$EmployeeID and AssignDate is not NULL and Attended=0 and Discription not like '%AMC%'";
           $result3 = mysqli_query($con, $query3);
           $row3 = mysqli_fetch_array($result3);
           $AO=$row3["count(OrderID)"];
           if ($row["count(ComplaintID)"]>0 or $AO>0 or $AMC>0 ) {           
             ?>
             <tr>
              <td><?php echo $Employee; ?></td>
              <td><a class="view_AO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAO"><?php echo $AO; ?></a></td>

              <td><a class="view_AC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAC"><?php echo $row["count(ComplaintID)"]; ?></a></td>


              <td><a class="view_AMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAMC"><?php echo $AMC; ?></a></td>              
            </tr>

          <?php } }?>
        </tbody>
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
      $('table.display').DataTable( {
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
        responsive: true
      } );
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