
<?php 
include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));
?>


<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Pending Payment</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

  

</head>  
<body> 

  <?php 
  include 'navbar.php';
  include 'modals.php';
  ?>
  <div class="container">

    <div class="table-responsive">
      <table  id="unassigned" class="table table-hover table-bordered border-primary display responsive nowrap" style="width:100%">
        <h5 align="center" style="margin:20px;">Pending Payment</h5>
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
          $query="SELECT BankName, ZoneRegionName, EmployeeCode,  BranchName, BookNo, BankCode, ZoneRegionCode, BillDate, sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
          join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
          join cyrusbackend.districts on billbook.EmployeeCode=districts.`Assign To`
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and ControlerID=$EXEID and BankName!='Cyrus'
          group by BankCode, ZoneRegionCode
          ORDER BY BankName";

          $result=mysqli_query($con2,$query);
          while($row = mysqli_fetch_array($result)){
            $BankCode=$row["BankCode"];
            $ZoneCode=$row["ZoneRegionCode"];
            $query1="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
            join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
            join cyrusbackend.districts on billbook.EmployeeCode=districts.`Assign To`
            join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate<'$ThirtyDays' and ControlerID=$EXEID";
            $result1=mysqli_query($con2,$query1);

            if (mysqli_num_rows($result1)>0){

              $row1 = mysqli_fetch_array($result1);
              $PendingPaymentThirtyDays=($row1["TotalAmount"]-$row1["ReceiveAMOUNT"]);
            }else{

              $PendingPaymentThirtyDays=0;
            }


            $query1="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
            join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
            join cyrusbackend.districts on billbook.EmployeeCode=districts.`Assign To`
            join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate<='$NintyDays' and ControlerID=$EXEID";
            $result1=mysqli_query($con2,$query1);

            if (mysqli_num_rows($result1)>0){

              $row1 = mysqli_fetch_array($result1);
              $PendingPaymentNintyDays=($row1["TotalAmount"]-$row1["ReceiveAMOUNT"]);
            }else{

              $PendingPaymentNintyDays=0;
            }


            $query1="SELECT sum(TotalBilledValue) as TotalAmount, sum(ReceivedAmount) as ReceiveAMOUNT FROM cyrusbilling.billbook
            join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
            join cyrusbackend.districts on billbook.EmployeeCode=districts.`Assign To`
            join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            WHERE (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0 and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and BillDate>'$NintyDays' and ControlerID=$EXEID";
            $result1=mysqli_query($con2,$query1);

            if (mysqli_num_rows($result1)>0){

              $row1 = mysqli_fetch_array($result1);
              $PendingPaymentMoreNintyDays=($row1["TotalAmount"]-$row1["ReceiveAMOUNT"]);
            }else{

              $PendingPaymentMoreNintyDays=0;
            }


            ?>
            <tr>
              <td><?php echo $row["BankName"]; ?></td>

              <td><?php echo $row["ZoneRegionName"]; ?></td>
              <td><?php echo (sprintf('%0.2f', $PendingPaymentThirtyDays)); ?></td> 
              <td><?php echo (sprintf('%0.2f', $PendingPaymentNintyDays)); ?></td> 
              <td><?php echo (sprintf('%0.2f', $PendingPaymentMoreNintyDays)); ?></td>
              <td><?php echo (sprintf('%0.2f', ($PendingPaymentThirtyDays+$PendingPaymentNintyDays+$PendingPaymentMoreNintyDays))); ?></td> 
                         
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
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
        },*/
        stateSave: true,
      } );
    } );

  </script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
  <script src="ajax.js"></script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>
