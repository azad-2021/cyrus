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
  <title>Inventory Pending</title>
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

    <!-- Inventory Pending 
    <div class="modal fade" id="InventoryPending" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Materials Pending Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="InventoryData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>
  -->
  <div class="modal fade" data-bs-backdrop="static" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Materials</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="material">

          </div>
          <br>
          <form id="f1">
            <div class="col-lg-3">
              <input type="number" name="" id="order_id" class="d-none form-control">
            </div>
            <div class="col-lg-3">
              <input type="number" name="" id="zone_code" class="d-none form-control">
            </div>
            <div class="row text-centered">
              <div class="col-lg-5">
                <center>
                  <label >Select Items</label>
                </center>
                <select id="ItemID" class="form-control my-select3" name="Items" required>
                  <option value="">Select</option>
                </select>
              </div>
              <div class="col-lg-5">
                <center>
                  <label>Enter Quantity</label>
                </center>
                <input type="number" name="" id="qty" class="form-control my-select3" onkeydown="limit(this);" onkeyup="limit(this);">
              </div>
              <div class="col-lg-2">
                <center>
                  <label></label>
                  <br>
                </center>
                <button type="button" class="btn btn-primary btn-lg addUpdateItems">Add</button>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary confirmUpdate cl">Confirm</button>
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-12 table-responsive" style="margin: 12px;">
   <table class="container table table-hover display table-bordered border-primary">
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
   $query2="SELECT * FROM demandbase join orders on demandbase.OrderID=orders.OrderID join branchdetails on orders.BranchCode=branchdetails.BranchCode where demandbase.StatusID=2 Order By demandbase.OrderID desc";
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
<script src="ajax.js"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false,
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

  var exampleModal = document.getElementById('editQty')
  exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var ItemID = button.getAttribute('data-bs-ItemID')
  console.log(ItemID);
  document.getElementById("ItemIDUpdate").value = ItemID;

})

  var exampleModal = document.getElementById('add')
  exampleModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var ID = button.getAttribute('data-bs-orderid')
    var ZoneCode=button.getAttribute('data-bs-zonecode')
      //console.log(recipient);
      //document.getElementById("orderid").value = ID;
      //document.getElementById("ZoneCode").value = ZoneCode;
    })


  $(document).on('click', '.cl', function(){

    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      location.reload();
    }, delayInMilliseconds);


  });

  function limit(element)
  {
    var max_chars = 5;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }
</script>
</body>
</html>
