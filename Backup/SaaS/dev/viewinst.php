<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$query ="SELECT BankName, ZoneRegionName, BranchName, Gadget, orders.OrderID, simprovider.SimProvider,
simprovider.SimType, MobileNumber, SimNo, Operator, simprovider.ReleaseDate as SimReleaseDate,
production.IssueDate as InuseDate, ActivationDate, ExpDate, simprovider.ID as SimID,
ProductionID, DATEDIFF(ExpDate,ActivationDate) as leftDays, `Employee Name` as InstalledBY, InstallationDate, store.ReleaseDate as StoreDate, store.EmployeeCode as StoreReleaseTo,
Executive, orders.Remark as RemarkOrders, simprovider.Remark as RemarkSim, installation.Remark as RemarkInst
FROM saas.orders
join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
join production on orders.OrderID=production.OrderID
join simprovider on production.SimID=simprovider.ID
join gadget on orders.GadgetID=gadget.GadgetID
join operators on orders.OperatorID=operators.OperatorID
join installation on orders.OrderID=installation.OrderID
join store on orders.OrderID=store.OrderID
join cyrusbackend.employees on installation.InstalledBy=employees.EmployeeCode
where orders.Status=3 and Installed=1 order by orders.OrderID";

$results = mysqli_query($con, $query);

if(isset($_POST['submit'])){



  $OrderID=$_POST['OrderID'];
  $Remark=$_POST['Remark'];



  $sql = "UPDATE installation SET Remark='$Remark' WHERE OrderID=$OrderID";

  if ($con->query($sql) === TRUE) {
    echo '<script>alert("Your response recorded successfully")</script>';
    echo '<meta http-equiv="refresh" content="0">';
  }else {
    echo "Error updating record: " . $con->error;
  }


}


?>

<!DOCTYPE html>  
<html>  
<head>   
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="Anant Singh Suryavanshi">
 <title>Installation</title>
 <link rel="icon" href="cyrus logo.png" type="image/icon type">
 <!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
 <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">  
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
 <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
    <div class="container-fluid" align="center">
      <a class="navbar-brand" href="index.html"><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="instable.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewinst.php?">View Submitted Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/cyrus/executive/changepass.php">Change Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <br><br> 

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Remark</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <div class="mb-3 d-none">
                <label for="recipient-name" class="col-form-label ">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name" name="OrderID">

              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Remark</label>
                <textarea class="form-control" id="message-text" name="Remark"></textarea>
              </div>
              
            </div>
            <div class="modal-footer">
              <input type="submit"  class=" btn btn-success my-button" value="submit" name="submit">
            </form>
            <button type="button" class="btn btn-secondary my-button" data-bs-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>

    <h3 align="center">View Installation Details</h3>  
    <br />  
    <div class="table-responsive">  
     <table class="table table-hover table-bordered border-primary" id="example"> 
      <thead> 
        <tr>  
          <th>Bank</th> 
          <th>Zone</th> 
          <th>Branch</th> 
          <th>Order ID</th>
          <th>Gadget</th> 
          <th>Mobile No</th> 
          <th>Sim NO</th> 
          <th>Sim Type</th> 
          <th>Operator</th> 
          <th>Sim Provider</th>
          <th>Executive</th>
          <th>Remark Orders</th>
          <th>Remark Sim Provider</th>
          <th>Production Date</th>       
          <th>Released To</th>
          <th>Store Release Date</th>
          <th>Installed By</th>
          <th>Installation Date</th>
          <th>Validity days</th>
          <th>Remark Installation</th>
        </tr>                     
      </thead>                 
      <tbody> 
        <?php  
        while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
          $EmployeeID=$row["StoreReleaseTo"];
          $query="SELECT `Employee Name` from cyrusbackend.employees WHERE EmployeeCode=$EmployeeID";
          $results2 = mysqli_query($con, $query);
          $row2=mysqli_fetch_array($results2,MYSQLI_ASSOC);
          if ($row["leftDays"]<0) {
            $Bank='<span style="color: red;">'.$row["BankName"].'</span>';
          }elseif ($row["leftDays"]<=30) {
            $Bank='<span style="color: blue;">'.$row["BankName"].'</span>';
          }else{
           $Bank=$row["BankName"]; 
         }



          echo '  
          <tr> 
          <td>'.$Bank.'</td> 
          <td>'.$row["ZoneRegionName"].'</td>  
          <td>'.$row["BranchName"].'</td>  
          <td>'.$row["OrderID"].'</td>
          <td>'.$row["Gadget"].'</td>           
          <td>'.$row["MobileNumber"].'</td>
          <td>'.$row["SimNo"].'</td> 
          <td>'.$row["SimType"].'</td>   
          <td>'.$row["Operator"].'</td>  
          <td>'.$row["SimProvider"].'</td>  
          <td>'.$row["Executive"].'</td>
          <td>'.$row["RemarkOrders"].'</td>
          <td>'.$row["RemarkSim"].'</td>
          <td>'.$row["InuseDate"].'</td>
          <td>'.$row2["Employee Name"].'</td>
          <td>'.$row["StoreDate"].'</td>
          <td>'.$row["InstalledBY"].'</td>
          <td>'.$row["InstallationDate"].'</td> 
          <td>'.$row["leftDays"].'</td>
          <td>'
          ?>

          <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php print $row["OrderID"]; ?>"><?php print $row["RemarkInst"].' : Update'; ?></a>
          <?php
          print '<a target="blank" href=update.php?id='.$row["OrderID"].'&Type=Ins> Update Number</a>';
          "</td>"
          ;  
        }
          ?> 

      </table>  
    </div>  
  </div>  

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
  "></script>
  <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

  <script>

    $(document).ready(function() {
      $('#example').DataTable( {
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

    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.modal-body input')

  modalTitle.textContent = 'New Remark for Order ID ' + recipient
  modalBodyInput.value = recipient
})

</script>
</body>
</html>