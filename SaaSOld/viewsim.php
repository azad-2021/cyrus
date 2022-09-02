<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$query ="SELECT BankName, ZoneRegionName, BranchName, Gadget, orders.OrderID, simprovider.SimProvider, simprovider.SimType, MobileNumber, SimNo, Operator, ReleaseDate as SimReleaseDate, production.IssueDate as InuseDate, ActivationDate, ExpDate, simprovider.ID as SimID, ProductionID, DATEDIFF(ExpDate,ActivationDate) as leftDays FROM saas.simprovider
join production on simprovider.ID=production.SimID
join orders on production.OrderID=orders.OrderID
join gadget on orders.GadgetID=gadget.GadgetID
join operators on orders.OperatorID=operators.OperatorID
join cyrusbackend.branchdetails on SaaS.orders.BranchCode=branchdetails.BranchCode
WHERE Installed=1 and orders.SimProvider='Cyrus' ORDER BY orders.OrderID DESC";
$results = mysqli_query($con, $query); 


if (isset($_POST['submit'])) {
  $RDate=$_POST['RDate'];
  $ExpDate=$_POST['ExpDate'];
  $SimID=$_POST['SimID'];
  echo "<meta http-equiv='refresh' content='0'>";
}


if (isset($_POST['suspend'])) {
  $SDate=$_POST['SDate'];
  $Remark=$_POST['SuspensionRemark'];
  $SimID=$_POST['SimID'];
  echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['changesim'])) {
  $SimNo=$_POST['SimNo'];
  $SimID=$_POST['SimID'];
  echo "<meta http-equiv='refresh' content='0'>";
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
 <title>Completed Orders</title>
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
            <a class="nav-link" aria-current="page" href="simtable.php">Home</a>
          </li>
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" target="blank" href="simpending.php?">Pending Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="blank" href="sim.php?">Release Sim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" target="blank" href="viewsim.php?">Active Sim Cards</a>
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
  <br><br> 
  <div class="container">  


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Recharge Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Rcharge Date</label>
                <input type="date" name="RDate" class="form-control my-select3" required>
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Plan Expiry Date</label>
                <input type="date" name="ExpDate" class="form-control my-select3" required>
              </div>
              <div class="mb-3 d-none">
                <label for="message-text" class="col-form-label">SimID</label>
                <input type="text" name="SimID" id="Sim" class="form-control my-select3" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class=" btn btn-primary my-button" value="submit" name="submit">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="suspension" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mobile Number Suspension</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <div class="mb-3 d-none">
                <label for="recipient-name" class="col-form-label">Sim ID</label>
                <input type="text" name="SimID" id="SimS" class="form-control my-select3">
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Suspension Date</label>
                <input type="date" name="SDate" class="form-control my-select3" required>
              </div>
              <div class="mb-3 ">
                <label for="message-text" class="col-form-label">Suspension Remark</label>
                <textarea class="form-control my-select3" name="SuspensionRemark" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class=" btn btn-primary my-button" value="suspend" name="suspend">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="SimNoChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change SimNo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <div class="mb-3 d-none">
                <label for="recipient-name" class="col-form-label">Sim ID</label>
                <input type="text" name="SimID" id="SimNo" class="form-control my-select3">
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">New Sim Number</label>
                <input type="number" name="SimNo" maxlength="20" class="form-control my-select3" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class=" btn btn-primary my-button" value="changesim" name="changesim">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <h3 align="center">Completed Orders</h3>  
    <br />  
    <div class="table-responsive">  
     <table class="table table-hover table-bordered border-primary" id="example" class="display nowrap"> 
      <thead> 
        <tr> 
          <th>Bank</th> 
          <th>Zone</th> 
          <th>Branch</th> 
          <th>Gadget</th>
          <th>Order Id</th>
          <th>Sim Provider</th>
          <th>Sim Type</th>
          <th>Mobile No</th> 
          <th>Sim No</th>
          <th>Operator</th> 
          <th>Sim Release Date</th>
          <th>In Use Date</th>
          <th>Activation Date</th>
          <th>Expiry Date</th>
          <th>Validity Days Left</th>
          <th>Action</th>
        </tr>                     
      </thead>                 
      <tbody> 
        <?php  

        while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
          if ($row["leftDays"]<0) {
            $Action='<a id="'.$row["SimID"].'" data-toggle="modal" data-target="#exampleModal" class="Recharge">Recharge Now</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a id="'.$row["SimID"].'" data-toggle="modal" data-target="#suspension" class="Suspend">Suspend Number</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a id="'.$row["SimID"].'" data-toggle="modal" data-target="#SimNoChange" class="SimNoChange">Change Sim Number</a>';

            $Bank='<span style="color: red;">'.$row["BankName"].'</span>';
          }elseif ($row["leftDays"]<=30) {
            $Bank='<span style="color: blue;">'.$row["BankName"].'</span>';
            $Action='<a id="'.$row["SimID"].'" data-toggle="modal" data-target="#exampleModal" class="Recharge">Recharge Now</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a id="'.$row["SimID"].'" data-toggle="modal" data-target="#suspension" class="Suspend">Suspend Number</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a id="'.$row["SimID"].'" data-toggle="modal" data-target="#SimNoChange" class="SimNoChange">Change Sim Number</a>';
          }else{
           $Bank=$row["BankName"]; 
           $Action='<a id="'.$row["SimID"].'" data-toggle="modal" data-target="#suspension" class="Suspend">Suspend Number</a> 
           &nbsp;&nbsp;&nbsp;&nbsp;
           <a id="'.$row["SimID"].'" data-toggle="modal" data-target="#SimNoChange" class="SimNoChange">Change Sim Number</a>';
         }



         echo '  
         <tr>
         <td>'.$Bank.'</td> 
         <td>'.$row["ZoneRegionName"].'</td>  
         <td>'.$row["BranchName"].'</td>  
         <td>'.$row["Gadget"].'</td>
         <td>'.$row["OrderID"].'</td>
         <td>'.$row["SimProvider"].'</td>
         <td>'.$row["SimType"].'</td>
         <td>'.$row["MobileNumber"].'</td>
         <td>'.$row["SimNo"].'</td>
         <td>'.$row["Operator"].'</td>
         <td>'.$row["SimReleaseDate"].'</td>
         <td>'.$row["InuseDate"].'</td>
         <td>'.$row["ActivationDate"].'</td> 
         <td>'.$row["ExpDate"].'</td>
         <td>'.$row["leftDays"].'</td> 
         <td>'.$Action.'</td>     
         </tr>  
         ';  
       }
       ?> 
       <tfoot>
        <tr>
          <th>Bank</th> 
          <th>Zone</th> 
          <th>Branch</th> 
          <th>Gadget</th>
          <th>Order Id</th>
          <th>Sim Provider</th>
          <th>Sim Type</th>
          <th>Mobile No</th> 
          <th>Sim No</th>
          <th>Operator</th> 
          <th>Sim Release Date</th>
          <th>In Use Date</th>
          <th>Activation Date</th>
          <th>Expiry Date</th>
          <th>Validity Days Left</th>
          <th>Action</th>
        </tr>
      </tfoot>
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

<script>

    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      responsive :true;
    } );

    // DataTable
    var table = $('#example').DataTable({
      initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
              var that = this;

              $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                  that
                  .search( this.value )
                  .draw();
                }
              } );
            } );
        },
        responsive: false
    });

} );
    $('#myTable').DataTable( {
    responsive: true
} );


  $(document).on('click','.Recharge', function(){
    var SimID =  $(this).attr("id");
    console.log(SimID); 
    document.getElementById("Sim").value=SimID;
  });

  $(document).on('click','.Suspend', function(){
    var SimID =  $(this).attr("id");
    console.log(SimID); 
    document.getElementById("SimS").value=SimID;
  });

  $(document).on('click','.SimNoChange', function(){
    var SimID =  $(this).attr("id");
    console.log(SimID); 
    document.getElementById("SimNo").value=SimID;
  });
</script>
</body>
</html>

<?php 
$con -> close();
$con2 -> close();
?>