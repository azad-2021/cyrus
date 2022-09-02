<?php 
include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
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
  <title>View Confirmed Materials</title>
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
  <style type="text/css">
  td,th{
    font-size: 17px;

  }
</style>

</head>  
<body> 
  <?php 
  include 'navbar.php';
  include 'modals.php';
  ?>
  <div class="container">



    <!-- Inventory Pending Orders of Employees-->
    <div class="modal fade" id="PendingOrders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pending Orders</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="PendingInventoryData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>  

    <div class="modal fade" id="ReleaseOrders" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content" style="background-color: #f0f0f0;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pending Materials</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ReleaseData" >

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>  

    <div class="col-lg-12" style="margin: 12px;">
     <table class="container table table-hover display table-bordered border-primary responsive">
      <h4 align="center">Material Released Pending from Inventory</h4> 
      <thead> 
       <tr>
        <th style="min-width:150px">Bank</th>
        <th style="min-width:150px">Zone</th>
        <th style="min-width:150px">Branch</th>
        <th style="min-width:150px">Employee Name</th>
        <th style="min-width:80px">Pending Orders</th>

      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     $query2="SELECT * FROM cyrusbackend.approval
     inner join demandbase on approval.OrderID=demandbase.OrderID
     join employees on approval.EmployeeID=employees.EmployeeCode
     join branchdetails on approval.BranchCode=branchdetails.BranchCode
     WHERE StatusID=3 and approval.Vremark!='REJECTED' and posted=1
     Group by approval.OrderID
     order by `Employee Name`";

     $result2=mysqli_query($con,$query2);

     if (mysqli_num_rows($result2)>0)
     {
      while($row = mysqli_fetch_array($result2)){
        //echo '<input class="d-none" type="text" id="'.$row['OrderID'].'" value="'.$row["ZoneRegionCode"].'" name="">';
        ?>

        <tr>
          <td ><?php echo $row['BankName']; ?></td>
          <td ><?php echo $row['ZoneRegionName']; ?></td>
          <td ><?php echo $row['BranchName']; ?></td>
          <td ><?php echo $row['Employee Name']; ?></td>
          <td style="color: blue;" class="showEmployeeReleaseData" id="<?php print $row['OrderID']; ?>" data-bs-toggle="modal" data-bs-target="#PendingOrders" ><?php echo $row['OrderID']; ?></td>
        </tr>
        <?php
        $Sn++;
      }

      $con->close();
      $con2->close();
    }
    ?>
  </tbody>
</table>


</div>
</div>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
<script src="ajax.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false,
      stateSave: true,
    } );
  } );


  $(document).on('click', '.cl', function(){

    var delayInMilliseconds = 100; 

    setTimeout(function() {
      location.reload();
    }, delayInMilliseconds);


  });

</script>
</body>
</html>
