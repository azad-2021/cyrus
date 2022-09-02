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
  <title>Released Materials</title>
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


    <div class="col-lg-12" style="margin: 12px;">
     <table class="container table table-hover display table-bordered border-primary responsive">
      <h4 align="center">Material Confirmation from Inventory</h4> 
      <thead> 
       <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:80px">Order ID</th>
        <th style="min-width:150px">Bank</th>
        <th style="min-width:150px">Zone</th>
        <th style="min-width:150px">Branch</th>
        <th style="min-width:300px">Discription</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     //$query2="SELECT * FROM cyrusbackend.demandbase join demandextended on demandbase.OrderID=demandextended.OrderID join cyrusbilling.rates on demandextended.ItemID=rates.ItemID where StatusID=2 and rates.ItemID !=1654 Order By demandbase.OrderID";
     $query2="SELECT * FROM demandbase join orders on demandbase.OrderID=orders.OrderID join branchdetails on orders.BranchCode=branchdetails.BranchCode where StatusID=2 Order By demandbase.OrderID";
     $result2=mysqli_query($con,$query2);

     if (mysqli_num_rows($result2)>0)
     {
      $Sn=1;

      while($row = mysqli_fetch_array($result2)){
        echo '<input class="d-none" type="text" id="'.$row['OrderID'].'" value="'.$row["ZoneRegionCode"].'" name="">';
        ?>

        <tr>
          <th><?php echo $Sn; ?></th>
          <td style="color: blue;" class="inventory" id="<?php echo $row['OrderID']; ?>" data-bs-toggle="modal" data-bs-target="#InventoryPending" ><?php echo $row['OrderID']; ?></td>
          <td ><?php echo $row['BankName']; ?></td>
          <td ><?php echo $row['ZoneRegionName']; ?></td>
          <td ><?php echo $row['BranchName']; ?></td>
          <td><?php echo $row['Discription']; ?></td>
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
<script src="search.js"></script>
<script src="ajax-script.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false
    } );
  } );
</script>
</body>
</html>
