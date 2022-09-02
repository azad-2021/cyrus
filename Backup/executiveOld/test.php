
<?php 
include 'connection.php';
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
  <title>Home</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/1.4.0/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css
  ">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
</head>  
<body> 
  <div class="container">

    <table class="table table-hover table-bordered border-primary display responsive nowrap" style="width:100%" id="example">
      <h5 align="center" style="margin:20px;">Material Confirmation</h5>
      <thead>
        <tr>
          <th>Bank</th>
          <th>Zone</th>
          <th>Branch</th>
          <th>Order ID</th>
          <th>Order Date</th>       
        </tr>
      </thead>
      <tbody >
        <?php 
        $query="SELECT * FROM cyrusbackend.orders join branchdetails on orders.BranchCode=branchdetails.BranchCode order by DateOfInformation";

        $result=mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)){
          ?>
          <tr>
            <td><?php echo $row["BankName"]; ?></td>

            <td><?php echo $row["ZoneRegionName"]; ?></td>

            <td><?php echo $row["BranchName"];; ?></td>

            <td><?php echo $row["OrderID"]; ?></td>
            <td><?php echo $row["DateOfInformation"];; ?></td>            
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        dom: 'Plfrtip'
      });
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>
