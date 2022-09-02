
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
  <title>Unassigned Work</title>
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
        <h5 align="center" style="margin:20px;">Unassigned Orders/Complaints/AMC</h5>
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
          
          $query="SELECT `Employee Name`, employees.EmployeeCode FROM cyrusbackend.employees
          join districts on employees.EmployeeCode=districts.`Assign To`
          join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          where ControlerID=$EXEID
          group by employees.EmployeeCode
          order by `Employee Name`;";
          
          $resultTech=mysqli_query($con,$query);
          while($rowE=mysqli_fetch_assoc($resultTech)){
            $Employee=$rowE["Employee Name"];
            $EmployeeID=$rowE["EmployeeCode"];

            $query="SELECT count(ComplaintID), `Employee NAME`, EmployeeCode FROM cyrusbackend.vallcomplaintsd WHERE AssignDate is null and Attended=0 and EmployeeCode=$EmployeeID";
            $result=mysqli_query($con,$query);
            $row = mysqli_fetch_array($result);

            $query2="SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
            $result2=mysqli_query($con,$query2);
            $row2 = mysqli_fetch_array($result2);

            $query3 = "SELECT count(vallordersd.OrderID), vallordersd.`Employee NAME`, vallordersd.EmployeeCode FROM vallordersd WHERE AssignDate is null and Discription not like '%AMC%' and vallordersd.EmployeeCode=$EmployeeID";
            $result3 = mysqli_query($con, $query3);
            $row3 = mysqli_fetch_array($result3);
            ?>
            <tr>
              <th><?php echo $Employee; ?></th>

              <td><?php echo $row3["count(vallordersd.OrderID)"]; ?></a></td>

              <td ><?php echo $row["count(ComplaintID)"]; ?></a></td>

              <td><?php echo $row2["count(vallordersd.OrderID)"];; ?></a></td>              
            </tr>
          <?php } ?>
        </tbody>
      </table>    
    </div>

    <div class="table-responsive">
      <table id="unassigned" class="table table-hover table-bordered border-primary display  nowrap" style="width:100%">
        <h5 align="center" style="margin:20px;">Unassigned Orders/Complaints/AMC</h5>
        <thead id="unhead">
          <tr>
            <th>Bank</th>
            <th>Zone</th>
            <th>Unassigned Orders </th>
            <th>Unassigned Complaints</th>                
            <th>Unassigned AMC</th>           
          </tr>
        </thead>
        <tbody >
          <?php 
          
          $query="SELECT * FROM cyrusbackend.branchdetails 
          join districts on branchdetails.Address3=districts.District
          join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE ControlerID=$EXEID
          Group by BankName, ZoneRegionName;";
          
          $resultB=mysqli_query($con,$query);
          while($rowB=mysqli_fetch_assoc($resultB)){
            $ZoneRegionName=$rowB["ZoneRegionName"];
            $BankName=$rowB["BankName"];

            $query="SELECT BankName, ZoneRegionName, count(ComplaintID) FROM cyrusbackend.vallcomplaintsd 
            join districts on vallcomplaintsd .EmployeeCode=districts.`Assign To`
            join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            where ControlerID=$EXEID and AssignDate is null and Attended=0 and BankName='$BankName' and ZoneRegionName='$ZoneRegionName'";
            $result=mysqli_query($con,$query);
            $row = mysqli_fetch_array($result);

            $query2="SELECT count(vallordersd.OrderID), BankName, ZoneRegionName FROM vallordersd
            join districts on vallordersd.EmployeeCode=districts.`Assign To`
            join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            WHERE ControlerID=$EXEID and vallordersd.AssignDate is null and vallordersd.Discription like '%AMC%' and BankName='$BankName' and ZoneRegionName='$ZoneRegionName'";
            $result2=mysqli_query($con,$query2);
            $row2 = mysqli_fetch_array($result2);

            $query3 = "SELECT count(vallordersd.OrderID), BankName, ZoneRegionName FROM vallordersd
            join districts on vallordersd.EmployeeCode=districts.`Assign To`
            join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
            WHERE ControlerID=$EXEID and vallordersd.AssignDate is null and vallordersd.Discription not like '%AMC%' and BankName='$BankName' and ZoneRegionName='$ZoneRegionName'";
            $result3 = mysqli_query($con, $query3);
            $row3 = mysqli_fetch_array($result3);
            if ($row3["count(vallordersd.OrderID)"]!=0 or $row["count(ComplaintID)"]!=0 or $row2["count(vallordersd.OrderID)"] ) {
             ?>
             <tr>
              <th><?php echo $BankName; ?></th>
              <th><?php echo $ZoneRegionName; ?></th>
              <td><?php echo $row3["count(vallordersd.OrderID)"]; ?></a></td>

              <td ><?php echo $row["count(ComplaintID)"]; ?></a></td>

              <td><?php echo $row2["count(vallordersd.OrderID)"];; ?></a></td>              
            </tr>
          <?php }} ?>
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
