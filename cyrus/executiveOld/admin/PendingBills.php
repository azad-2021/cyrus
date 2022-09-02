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
//echo $_SESSION['user'];


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

  <title>Pending Bills</title>
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
        <span class="d-none d-lg-block">Pending Bills</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";

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
          <li class="breadcrumb-item active">Pending Bills</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

      <div class="modal fade" data-bs-backdrop="static" id="ViewBill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-corner">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pending Bill Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="billdata">

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <br>
          <div class="card-body">

            <center>
              <div class="pagetitle">
                <h1>Group By Bank & Zone</h1>
              </div>
            </center>
            <div class="table-responsive container">
              <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                <thead id="unhead">
                  <tr>
                    <th style="min-width: 200px">Bank</th>
                    <th style="min-width: 200px">Zone</th>
                    <th style="min-width: 100px">30 Days</th>
                    <th style="min-width: 100px">90 Days</th> 
                    <th style="min-width: 100px">More than 90 Days</th>
                    <th style="min-width: 100px">Total Pending Amount</th>   
                  </tr>
                </thead>
                <tbody >
                  <?php 
                  $query="SELECT BankName, ZoneRegionName, ZoneRegionCode, BankCode from cyrusbackend.branchdetails
                  join cyrusbackend.districts on branchdetails.Address3=districts.District
                  join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                  WHERE ControlerID=$EXEID and BankName!='Cyrus'
                  group by BankCode, ZoneRegionCode
                  ORDER BY BankName";

                  $result=mysqli_query($con2,$query);
                  while($row = mysqli_fetch_array($result)){
                    $BankCode=$row["BankCode"];
                    $ZoneCode=$row["ZoneRegionCode"];
                    $query1="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
                    join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
                    join cyrusbackend.districts on branchdetails.Address3=districts.District
                    join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                    WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate>'$ThirtyDays' and ControlerID=$EXEID and BankName!='Cyrus'";
                    $result1=mysqli_query($con2,$query1);

                    if (mysqli_num_rows($result1)>0){

                      $row1 = mysqli_fetch_array($result1);
                      $PendingPaymentThirtyDays=($row1["TotalAmount"]-$row1["ReceiveAMOUNT"]);
                    }else{

                      $PendingPaymentThirtyDays=0;
                    }


                    $query2="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
                    join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
                    join cyrusbackend.districts on branchdetails.Address3=districts.District
                    join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                    WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 
                    and BankCode=$BankCode and ZoneRegionCode=$ZoneCode
                    and BillDate between '$NintyDays' and  '$ThirtyDays' and ControlerID=$EXEID and BankName!='Cyrus'";
                    $result2=mysqli_query($con2,$query2);

                    if (mysqli_num_rows($result2)>0){

                      $row2 = mysqli_fetch_array($result2);
                      $PendingPaymentNintyDays=($row2["TotalAmount"]-$row2["ReceiveAMOUNT"]);
                    }else{

                      $PendingPaymentNintyDays=0;
                    }


                    $query1="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
                    join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
                    join cyrusbackend.districts on branchdetails.Address3=districts.District
                    join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
                    WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate<'$NintyDays' and ControlerID=$EXEID and BankName!='Cyrus'";
                    $result1=mysqli_query($con2,$query1);

                    if (mysqli_num_rows($result1)>0){

                      $row1 = mysqli_fetch_array($result1);
                      $PendingPaymentMoreNintyDays=($row1["TotalAmount"]-$row1["ReceiveAMOUNT"]);
                    }else{

                      $PendingPaymentMoreNintyDays=0;
                    }

                    if ($PendingPaymentThirtyDays!=0 or $PendingPaymentNintyDays!=0 or $PendingPaymentMoreNintyDays!=0) {

                      ?>
                      <tr>
                        <td><?php echo $row["BankName"]; ?></td>

                        <td> <a class="view_Bills" id="<?php print $ZoneCode ?> " id2="<?php print $BankCode ?>" id3="ControllerID" data-bs-target="#ViewBill"><?php echo $row["ZoneRegionName"]; ?></a></td>
                        <td><?php echo number_format($PendingPaymentThirtyDays,2); ?></td> 
                        <td><?php echo number_format($PendingPaymentNintyDays, 2); ?></td> 
                        <td><?php echo number_format($PendingPaymentMoreNintyDays, 2); ?></td>
                        <td><?php echo number_format(($PendingPaymentThirtyDays+$PendingPaymentNintyDays+$PendingPaymentMoreNintyDays),2); ?></td> 

                      </tr>
                    <?php } }?>
                  </tbody>
                </table>
              </div>
              <br><br>
              <div class="table-responsive container">
                <center>
                  <div class="pagetitle">
                    <h1>Group By Bank & Zone of Reserved District</h1>
                  </div>
                </center>
                <table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
                  <thead id="unhead">
                    <tr>
                      <th style="min-width: 200px">Bank</th>
                      <th style="min-width: 200px">Zone</th>
                      <th style="min-width: 100px">30 Days</th>
                      <th style="min-width: 100px">90 Days</th> 
                      <th style="min-width: 100px">More than 90 Days</th>
                      <th style="min-width: 100px">Total Pending Amount</th>   
                    </tr>
                  </thead>
                  <tbody >
                    <?php 
                    $PendingPaymentThirtyDays=0;
                    $PendingPaymentNintyDays=0;
                    $PendingPaymentMoreNintyDays=0;
                    $query="SELECT * FROM cyrusbackend.branchdetails WHERE Address3 ='Reserved' Group by BankCode, ZoneRegionCode  ORDER BY BankName";
                    $result=mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($result)){
                      $BankCode=$row["BankCode"];
                      $ZoneCode=$row["ZoneRegionCode"];

                      $query1="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
                      join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
                      WHERE (TotalBilledValue-ReceivedAmount)>1 and Address3 ='Reserved'and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate>'$ThirtyDays' and Cancelled=0";
                      $result1=mysqli_query($con2,$query1);

                      if (mysqli_num_rows($result1)>0){

                        $row1 = mysqli_fetch_array($result1);
                        $PendingPaymentThirtyDays=($row1["TotalAmount"]-$row1["ReceiveAMOUNT"]);
                      }else{

                        $PendingPaymentThirtyDays=0;
                      }


                      $query2="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
                      join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
                      WHERE (TotalBilledValue-ReceivedAmount)>1 and Address3 ='Reserved'and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate between '$NintyDays' and  '$ThirtyDays' and Cancelled=0";
                      $result2=mysqli_query($con2,$query2);

                      if (mysqli_num_rows($result2)>0){

                        $row2 = mysqli_fetch_array($result2);
                        $PendingPaymentNintyDays=($row2["TotalAmount"]-$row2["ReceiveAMOUNT"]);
                      }else{

                        $PendingPaymentNintyDays=0;
                      }


                      $query1="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
                      join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
                      WHERE (TotalBilledValue-ReceivedAmount)>1 and Address3 ='Reserved'and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate<'$NintyDays' and Cancelled=0";
                      $result1=mysqli_query($con2,$query1);

                      if (mysqli_num_rows($result1)>0){

                        $row1 = mysqli_fetch_array($result1);
                        $PendingPaymentMoreNintyDays=($row1["TotalAmount"]-$row1["ReceiveAMOUNT"]);
                      }else{

                        $PendingPaymentMoreNintyDays=0;
                      }

                      if ($PendingPaymentThirtyDays!=0 or $PendingPaymentNintyDays!=0 or $PendingPaymentMoreNintyDays!=0) {

                        ?>
                        <tr>
                          <td><?php echo $row["BankName"]; ?></td>

                          <td> <a class="view_Bills" id="<?php print $ZoneCode ?> " id2="<?php print $BankCode ?>" id3="Reserved" data-bs-target="#ViewBill"><?php echo $row["ZoneRegionName"]; ?></a></td>
                          <td><?php echo number_format($PendingPaymentThirtyDays,2); ?></td> 
                          <td><?php echo number_format($PendingPaymentNintyDays, 2); ?></td> 
                          <td><?php echo number_format($PendingPaymentMoreNintyDays, 2); ?></td>
                          <td><?php echo number_format(($PendingPaymentThirtyDays+$PendingPaymentNintyDays+$PendingPaymentMoreNintyDays),2); ?></td> 

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

    $(document).on('click', '.view_Bills', function(){
      var Zone = $(this).attr("id");
      var Bank=$(this).attr("id2");
      var Type=$(this).attr("id3");
      console.log(Zone);
      console.log(Bank);
      $.ajax({
       url:"BillsData.php",
       method:"POST",
       data:{Zone:Zone, Bank:Bank, Type:Type},
       success:function(data){
        $('#billdata').html(data);
        $('#ViewBill').modal('show');
      }
    });
    });


  </script>
</body>

</html>

<?php 
$con->close();
$con2->close();
?>