<?php 
include 'connection.php';
include 'session.php';
$Type=$_SESSION['usertype'];
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


$queryT="SELECT TargetAmounts, EmployeeCode FROM cyrusbackend.employees
join districts on employees.EmployeeCode=districts.`Assign To`
join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
WHERE ControlerID=$EXEID
group by EmployeeCode";
$resultT=mysqli_query($con,$queryT);

$TargetArray=array();
$AceivedArray=array();

while ($rowT=mysqli_fetch_assoc($resultT)){

  $EmployeeCode=$rowT["EmployeeCode"];
  $query4="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=month(current_date()) and year(BillDate)=year(current_date()) and BankCode not in (17,29,30,33,43,46,49,50,52)";
  $result4=mysqli_query($con2,$query4);
  $row4 = mysqli_fetch_array($result4);

  $TargetArray[]=$rowT["TargetAmounts"];
  $AceivedArray[]=$row4["sum(TotalBilledValue)"];

  $query5="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-1) and year(BillDate)=year(current_date()) and BankCode not in (17,29,30,33,43,46,49,50,52)";
  $result5=mysqli_query($con2,$query5);
  $row5 = mysqli_fetch_array($result5);
  $AceivedArray1[]=$row5["sum(TotalBilledValue)"];

  $query5="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-2) and year(BillDate)=year(current_date()) and BankCode not in (17,29,30,33,43,46,49,50,52)";
  $result5=mysqli_query($con2,$query5);
  $row5 = mysqli_fetch_array($result5);
  $AceivedArray2[]=$row5["sum(TotalBilledValue)"];

  $query5="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
  join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
  WHERE EmployeeCode=$EmployeeCode and Cancelled=0 and month(BillDate)=(month(current_date())-3) and year(BillDate)=year(current_date()) and BankCode not in (17,29,30,33,43,46,49,50,52)";
  $result5=mysqli_query($con2,$query5);
  $row5 = mysqli_fetch_array($result5);
  $AceivedArray3[]=$row5["sum(TotalBilledValue)"];

}

$Target=array_sum($TargetArray);
$AcheivedTarget=array_sum($AceivedArray);
$PendingTarget=$Target-$AcheivedTarget;

$AcheivedTarget1=array_sum($AceivedArray1);
$PendingTarget1=$Target-$AcheivedTarget1;

$AcheivedTarget2=array_sum($AceivedArray2);
$PendingTarget2=$Target-$AcheivedTarget2;

$AcheivedTarget3=array_sum($AceivedArray3);
$PendingTarget3=$Target-$AcheivedTarget3;

if ($PendingTarget<0) {
  $PendingTarget=0;
}

if ($PendingTarget1<0) {
  $PendingTarget1=0;
}

if ($PendingTarget2<0) {
  $PendingTarget2=0;
}

if ($PendingTarget3<0) {
  $PendingTarget3=0;
}

$sql ="SELECT count(DISTINCT ZoneRegionCode) as ZoneCount FROM dsr.`visit details`
WHERE month(VisitDate)=month(curdate()) and ExecutiveID=$EXEID";
$result = mysqli_query($con3,$sql);
$row1 = mysqli_fetch_array($result);

$sql ="SELECT count(DISTINCT ZoneRegionCode) as ZoneCount FROM dsr.`visit details`
join cyrusbackend.`cyrus regions` on `visit details`.ExecutiveID=`cyrus regions`.SubControllerID
WHERE month(VisitDate)=month(curdate()) and ControlerID=$EXEID";
$result = mysqli_query($con3,$sql);
$row2 = mysqli_fetch_array($result);

$sql ="SELECT * FROM dsr.`control details` WHERE month(TimeStamp)=month(curdate()) and ExecutiveID=$EXEID Order By ID DESC LIMIT 1";
$result = mysqli_query($con3,$sql);
$row3 = mysqli_fetch_array($result);
$TotalZones=$row3["NoOfZones"];
$VisitedZones=$row1["ZoneCount"] + $row2["ZoneCount"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Performance</title>
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

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <script src="https://www.gstatic.com/charts/loader.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

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
      <h1>Performance Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Performance</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">


      <div class="modal fade" id="ViewAMC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending AMC</h5>
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

      <div class="modal fade" id="ViewAO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Orders</h5>
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
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Complaints</h5>
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

      <div class="modal fade" id="ViewAMCB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending AMC</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="AMCDataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewAOB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Orders</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="AODataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ViewACB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Complaints</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="ACDataB">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewCompleted" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Completed delayed Work</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="CompletedDelayedData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="TotalVisits" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PR</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="table-responsive container">
              <table class="table text-start align-middle table-bordered table-hover mb-0" width="100%">
                <thead>
                  <tr class="text-dark">
                    <th>Sr No</th>
                    <th>Bank</th>
                    <th>Zone</th>
                  </tr>
                </thead>
                <tbody id="TotalVisitsData">
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="VisitedVisits" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Completed PR</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="table-responsive container">
              <table class="table text-start align-middle table-bordered table-hover mb-0" width="100%">
                <thead>
                  <tr class="text-dark">
                    <th>Bank</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Visit Date</th>
                    <th>Next Visit Date</th>
                    <th>Description</th>
                    <th>Visit By</th>
                  </tr>
                </thead>
                <tbody id="VisitedVisitsData">
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="PendingVisits" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pending PR</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="table-responsive container">
              <table class="table text-start align-middle table-bordered table-hover mb-0" width="100%">
                <thead>
                  <tr class="text-dark">
                    <th>Sr No</th>
                    <th>Bank</th>
                    <th>Zone</th>
                  </tr>
                </thead>
                <tbody id="PendingVisitsData">
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total <span>| PR</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $TotalZones; ?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Completed <span>| PR</h5>

                    <div class="d-flex align-items-center">
                      <div class="ps-3">
                        <h6><?php echo $VisitedZones; ?></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- End Revenue Card -->

              <!-- Customers Card -->

              <div class="col-xxl-4 col-xl-4">

                <div class="card info-card customers-card">

                  <div class="card-body">
                    <h5 class="card-title">Your <span>| Performance</span></h5>

                    <div class="d-flex align-items-center">
                    <!--
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                  -->
                  <div class="ps-3">
                    <h6><?php echo ''; ?></h6>
                  </div>
                </div>

              </div>
            </div>

          </div>

          <!-- End Customers Card -->

          <!-- Reports -->


          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Billing Target <span>  <?php echo date('M',strtotime($timestamp));?><a style="float:right" href="employeetarget.php" target="_blank">Show All</a></span></h5>

                <div id="piechart" align="center"></div>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Billing Target <span><?php echo date('M', strtotime("-1 month"));?><a style="float:right" href="employeetarget1.php" target="_blank">Show All</a></span></h5>

                  <div id="piechart2" align="center" style="width: 180px;"></div>

                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Billing Target <span><?php echo date('M', strtotime("-2 month"));?><a style="float:right" href="employeetarget2.php" target="_blank">Show All</a></span></h5>

                  <div id="piechart3" align="center" style="width: 180px;"></div>

                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Billing Target <span><?php echo date('M', strtotime("-3 month"));?><a style="float:right" href="employeetarget3.php" target="_blank">Show All</a></span></h5>

                  <div id="piechart4" align="center" style="width: 180px;"></div>

                </div>
              </div>
            </div>
          </div>


          <!-- Recent Sales -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <div class="card-body">
                <h5 class="card-title"> PR <span>| <?php echo date('M',strtotime($timestamp));?></span></h5>

                <div class="table-responsive container">
                  <table class="table text-start align-middle table-bordered table-hover mb-0" width="100%">
                    <thead>
                      <tr class="text-dark">
                        <th>Total Visits</th>
                        <th>Completed Visits</th>
                        <th>Pending Visits</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      print "<tr>";
                      print '<td style="min-width: 150px;"><a href="" data-bs-toggle="modal" data-bs-target="#TotalVisits" class="TotalVisits">'.$TotalZones."</a></td>";
                      print '<td style="min-width: 150px;"><a href="" data-bs-toggle="modal" data-bs-target="#VisitedVisits" class="ViditedVisits">'.$VisitedZones."</a></td>";
                      print '<td style="min-width: 150px;"><a href="" data-bs-toggle="modal" data-bs-target="#PendingVisits" class="PendingVisits">'.($TotalZones- $VisitedZones)."</a></td>";
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Recent Sales -->
              <div class="col-12">
                <div class="card recent-sales overflow-auto">

                  <div class="card-body">
                    <h5 class="card-title">Overdue Pending Work </h5>

                    <div class="table-responsive container">
                      <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                        <thead>
                          <tr class="text-dark">
                            <th>Service Engineer</th>
                            <th>Pending Orders </th>
                            <th>Pending Complaints</th>                
                            <th>Pending AMC</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $row3='';
                          $query="SELECT DISTINCT EmployeeCode, `Employee Name` FROM employees
                          join cyrusbackend.districts on employees.EmployeeCode=districts.`Assign To`
                          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                          WHERE Inservice=1 and ControlerID=$EXEID Order By `Employee Name`";
                          $resultTech=mysqli_query($con,$query);
                          while($rowE=mysqli_fetch_assoc($resultTech)){
                           $Employee=$rowE["Employee Name"];
                           $EmployeeID=$rowE["EmployeeCode"];

                           $query="SELECT count(DISTINCT ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allcomplaint 
                           join cyrusbackend.districts on allcomplaint.Address3=districts.District
                           join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode WHERE AssignDate is not null and Attended=0 and datediff(Current_date(), AssignDate)>10 and ControlerID=$EXEID and EmployeeCode=$EmployeeID";
                           $result=mysqli_query($con,$query);
                           $row = mysqli_fetch_array($result);

                           $query2="SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM cyrusbackend.allorders join cyrusbackend.districts on allorders.Address3=districts.District
                           join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode 
                           WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$EmployeeID and ControlerID=$EXEID and datediff(Current_date(), AssignDate)>60";
                           $result2=mysqli_query($con,$query2);
                           $row2 = mysqli_fetch_array($result2);
                           $AMC=$row2["count(OrderID)"];

                           $query3 = "SELECT count(OrderID), `Employee NAME`, EmployeeCode FROM allorders
                           join cyrusbackend.districts on allorders.Address3=districts.District
                           join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode 
                           WHERE EmployeeCode=$EmployeeID and AssignDate is not NULL and Attended=0 and Discription not like '%AMC%' and ControlerID=$EXEID and datediff(Current_date(), AssignDate)>30";
                           $result3 = mysqli_query($con, $query3);
                           $row3 = mysqli_fetch_array($result3);
                           $AO=$row3["count(OrderID)"];
                           if ($row["count(DISTINCT ComplaintID)"]>0 or $AMC>0 or $AO>0) {             
                             ?>
                             <tr>
                              <td><?php echo $Employee; ?></td>
                              <td><a class="view_AO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAO"><?php echo $AO; ?></a></td>

                              <td><a class="view_AC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAC"><?php echo $row["count(DISTINCT ComplaintID)"]; ?></a></td>


                              <td><a class="view_AMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAMC"><?php echo $AMC; ?></a></td>              
                            </tr>

                          <?php } }?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Delayed Completed Work</h5>

                    <div class="table-responsive container">
                      <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                        <thead>
                          <tr class="text-dark">
                            <th>Service Engineer</th>
                            <th>Completed Orders </th>
                            <th>Completed Complaints</th>                
                            <th>Completed AMC</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $row3='';
                          $query="SELECT DISTINCT EmployeeCode, `Employee Name` FROM employees
                          join cyrusbackend.districts on employees.EmployeeCode=districts.`Assign To`
                          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                          WHERE Inservice=1 and ControlerID=$EXEID Order By `Employee Name`";
                          $resultTech=mysqli_query($con,$query);
                          while($rowE=mysqli_fetch_assoc($resultTech)){
                           $Employee=$rowE["Employee Name"];
                           $EmployeeID=$rowE["EmployeeCode"];

                           $query="SELECT count(ComplaintID) FROM cyrusbackend.complaints
                           join branchdetails on complaints.BranchCode=branchdetails.BranchCode
                           join districts on branchdetails.Address3=districts.District
                           join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                           where AttendDate is not null and Attended=1 and datediff(AttendDate, AssignDate)>10 and ControlerID=$EXEID and complaints.EmployeeCode=$EmployeeID and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                           $result=mysqli_query($con,$query);
                           $row = mysqli_fetch_array($result);

                           $query2="SELECT count(OrderID) FROM cyrusbackend.orders
                           join branchdetails on orders.BranchCode=branchdetails.BranchCode
                           join districts on branchdetails.Address3=districts.District
                           join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                           where AttendDate is not null and Attended=1 and datediff(AttendDate, AssignDate)>90 and ControlerID=$EXEID and Discription like '%AMC%'and orders.EmployeeCode=$EmployeeID and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                           $result2=mysqli_query($con,$query2);
                           $row2 = mysqli_fetch_array($result2);
                           $AMC=$row2["count(OrderID)"];

                           $query3 = "SELECT count(OrderID) FROM cyrusbackend.orders
                           join branchdetails on orders.BranchCode=branchdetails.BranchCode
                           join districts on branchdetails.Address3=districts.District
                           join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                           where AttendDate is not null and Attended=1 and datediff(AttendDate, AssignDate)>30 and ControlerID=$EXEID and Discription not like '%AMC%'and orders.EmployeeCode=$EmployeeID and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
                           $result3 = mysqli_query($con, $query3);
                           $row3 = mysqli_fetch_array($result3);
                           $AO=$row3["count(OrderID)"];
                           if ($row["count(ComplaintID)"]>0 or $AMC>0 or $AO>0) {             
                             ?>
                             <tr>
                              <td><?php echo $Employee; ?></td>
                              <td><a class="view_CompletedO" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAO"><?php echo $AO; ?></a></td>

                              <td><a class="view_CompletedC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAC"><?php echo $row["count(ComplaintID)"]; ?></a></td>


                              <td><a class="view_CompletedAMC" id="<?php print $EmployeeID; ?>" data-bs-target="#ViewAMC"><?php echo $AMC; ?></a></td>              
                            </tr>

                          <?php } }?>
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
        </span>
      </h5>
    </div>
  </div>
</div>
</span>
</h5>
</div>
</div>
</div>
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

 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);
 google.charts.setOnLoadCallback(drawChart2);
 google.charts.setOnLoadCallback(drawChart3);
 google.charts.setOnLoadCallback(drawChart4);

 function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Pending', 'Achieved'],
    ['Pending : '+ <?php echo $PendingTarget?>, <?php echo $PendingTarget?>],
    ['Billed : '+<?php echo $AcheivedTarget?>, <?php echo $AcheivedTarget?>]
    ]);


  var options = {
    'title':'Billing Target : ' + <?php echo $Target?>,
    colors: ['red', 'green', ],
    fontSize: 15,
    chartArea: {
      left: "10%",
      top: "20%",
      bottom: "10%",
      height: "90%",
      width: "90%",

    }

  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}


google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart2() {
  var data2 = google.visualization.arrayToDataTable([
    ['Pending', 'Achieved'],
    ['Pending : '+ <?php echo $PendingTarget1?>, <?php echo $PendingTarget1?>],
    ['Billed : '+<?php echo $AcheivedTarget1?>, <?php echo $AcheivedTarget1?>]
    ]);


  var options2 = {
    legend: 'none',
    colors: ['red', 'green', ],
    fontSize: 15,
    chartArea: {
      left: "10%",
      top: "20%",
      bottom: "10%",
      height: "90%",
      width: "90%",

    }

  };

  var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
  chart2.draw(data2, options2);
}

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart3() {
  var data2 = google.visualization.arrayToDataTable([
    ['Pending', 'Achieved'],
    ['Pending : '+ <?php echo $PendingTarget2?>, <?php echo $PendingTarget2?>],
    ['Billed : '+<?php echo $AcheivedTarget2?>, <?php echo $AcheivedTarget2?>]
    ]);


  var options2 = {
    legend: 'none',
    colors: ['red', 'green', ],
    fontSize: 15,
    chartArea: {
      left: "10%",
      top: "20%",
      bottom: "10%",
      height: "90%",
      width: "90%",

    }

  };

  var chart2 = new google.visualization.PieChart(document.getElementById('piechart3'));
  chart2.draw(data2, options2);
}

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart4() {
  var data2 = google.visualization.arrayToDataTable([
    ['Pending', 'Achieved'],
    ['Pending : '+ <?php echo $PendingTarget3?>, <?php echo $PendingTarget3?>],
    ['Billed : '+<?php echo $AcheivedTarget3?>, <?php echo $AcheivedTarget3?>]
    ]);


  var options2 = {
    colors: ['red', 'green', ],
    legend: 'none',
    fontSize: 15,
    chartArea: {
      left: "10%",
      top: "20%",
      bottom: "10%",
      height: "90%",
      width: "90%",

    }

  };

  var chart2 = new google.visualization.PieChart(document.getElementById('piechart4'));
  chart2.draw(data2, options2);
}



//Pending
$(document).on('click', '.view_AO', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"assignOrders.php",
   method:"POST",
   data:{EmployeeID:EmployeeID, 'delayed':'delayed'},
   success:function(data){
    $('#AOData').html(data);
    $('#ViewAO').modal('show');
  }
});
});

$(document).on('click', '.view_AC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"complaints.php",
   method:"POST",
   data:{EmployeeID:EmployeeID, 'delayed':'delayed'},
   success:function(data){
    $('#ACData').html(data);
    $('#ViewAC').modal('show');
  }
});
});

$(document).on('click', '.view_AMC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"amc.php",
   method:"POST",
   data:{EmployeeID:EmployeeID, 'delayed':'delayed'},
   success:function(data){
    $('#AMCData').html(data);
    $('#ViewAMC').modal('show');
  }
});
});

$(document).on('click', '.view_CompletedO', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"assignOrders.php",
   method:"POST",
   data:{'EmployeeIDC':EmployeeID, 'CompletedO':'delayed'},
   success:function(data){
    $('.display2').DataTable().clear();
    $('.display2').DataTable().destroy();
    $('#CompletedDelayedData').html(data);


    $('table.display2').DataTable( {

      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: false
    } );

    $('#ViewCompleted').modal('show');
  }
});
});

$(document).on('click', '.view_CompletedC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"complaints.php",
   method:"POST",
   data:{'EmployeeIDC':EmployeeID, 'CompletedC':'delayed'},
   success:function(data){

    $('.display2').DataTable().clear();
    $('.display2').DataTable().destroy();

    $('#CompletedDelayedData').html(data);

    $('table.display2').DataTable( {

      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: false
    } );

    $('#ViewCompleted').modal('show');
  }
});
});

$(document).on('click', '.view_CompletedAMC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"amc.php",
   method:"POST",
   data:{'EmployeeIDC':EmployeeID, 'CompletedAMC':'delayed'},
   success:function(data){
     $('.display2').DataTable().clear();
     $('.display2').DataTable().destroy();
     $('#CompletedDelayedData').html(data);

     $('table.display2').DataTable( {

      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: false
    } );

     $('#ViewCompleted').modal('show');
   }
 });
});



$(document).on('click', '.TotalVisits', function(){

  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'TotalVisits':'TotalVisits'},
   success:function(data){
     $('#TotalVisitsData').html(data);
   }
 });


});

$(document).on('click', '.ViditedVisits', function(){

  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'BankVisit':'BankVisit'},
   success:function(data){
     $('#VisitedVisitsData').html(data);
   }
 });
});


$(document).on('click', '.PendingVisits', function(){
  console.log("v");
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'PendingVisit':'PendingVisit'},
   success:function(data){
    console.log(data);
    $('#PendingVisitsData').html(data);
  }
});
});

</script>

</body>

</html>

<?php 
echo $VisitedZones;
$con->close();
$con2->close();
?>