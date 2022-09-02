
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
  <title>Pending Work</title>
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

      <table id="unassigned" class="table table-hover table-bordered border-primary display  nowrap" style="width:100%">
        <h5 align="center" style="margin:20px;">Pending Orders/Complaints/AMC</h5>
        <thead id="unhead">
          <tr>
            <th>Service Engineer</th>
            <th>Pending Orders </th>
            <th>Pending Complaints</th>                
            <th>Pending AMC</th>           
          </tr>
        </thead>
        <tbody >
          <?php 
          
          $query="SELECT sum(`Pending Order`) as PendingOrders, sum(`Pending Complaints`) as PendingComplaints, sum(`Pending AMC`) as PendingAMC, `Employee Name`, EmployeeCode FROM cyrusbackend.pendingwork
          join districts on pendingwork.Address3=districts.District
          join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE ControlerID=$EXEID and (`pending Order` is not null OR `Pending Complaints` is not null OR `pending AMC` is not null) group by districts.`Assign To`;";
          
          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_assoc($result)){
            $Employee=$row["Employee Name"];


            ?>
            <tr>
              <th><?php echo $Employee; ?></th>

              <td><?php echo $row["PendingOrders"]; ?></a></td>

              <td ><?php echo $row["PendingComplaints"]; ?></a></td>

              <td><?php echo $row["PendingAMC"];; ?></a></td>              
            </tr>
          <?php } ?>
        </tbody>
      </table>    
    </div>

    <div class="table-responsive">
      <table id="unassigned" class="table table-hover table-bordered border-primary display  nowrap" style="width:100%">
        <h5 align="center" style="margin:20px;">Pending Orders/Complaints/AMC Group By Bank, Zone</h5>
        <thead id="unhead">
          <tr>
            <th>Bank</th>
            <th>Zone</th>
            <th>Pending Orders </th>
            <th>Pending Complaints</th>                
            <th>Pending AMC</th>           
          </tr>
        </thead>
        <tbody >
          <?php 

          $query="SELECT BankName, ZoneRegionName, sum(`Pending Order`) as PendingOrders, sum(`Pending Complaints`) as PendingComplaints, sum(`Pending AMC`) as PendingAMC FROM cyrusbackend.pendingwork
          join districts on pendingwork.Address3=districts.District
          join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE ControlerID=8 and (`pending Order` is not null OR `Pending Complaints` is not null OR `pending AMC` is not null) group by BankName, ZoneRegionName";

          $result=mysqli_query($con,$query);
          while($row=mysqli_fetch_assoc($result)){
            $ZoneRegionName=$row["ZoneRegionName"];
            $BankName=$row["BankName"];

            ?>
            <tr>
              <th><?php echo $BankName; ?></th>
              <th><?php echo $ZoneRegionName; ?></th>
              <td><?php echo $row["PendingOrders"]; ?></a></td>

              <td ><?php echo $row["PendingComplaints"]; ?></a></td>

              <td><?php echo $row["PendingAMC"];; ?></a></td>          
            </tr>
          <?php }?>
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
