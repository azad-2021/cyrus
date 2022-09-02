<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$SimID = $_GET['id'];
$OrderID = $_GET['oid'];


if (isset($_POST['submit'])) {
  $RDate=$_POST['RDate'];
  $ExpDate=$_POST['ExpDate'];

}
/*
$query ="SELECT BankName, ZoneRegionName, BranchName, Gadget, orders.OrderID, simprovider.SimProvider, simprovider.SimType, MobileNumber, SimNo, Operator, ReleaseDate as SimReleaseDate, production.IssueDate as InuseDate, ActivationDate, ExpDate, simprovider.ID as SimID, ProductionID, DATEDIFF(ExpDate,ActivationDate) as leftDays FROM saas.simprovider
join production on simprovider.ID=production.SimID
join orders on production.OrderID=orders.OrderID
join gadget on orders.GadgetID=gadget.GadgetID
join operators on orders.OperatorID=operators.OperatorID
join cyrusbackend.branchdetails on SaaS.orders.BranchCode=branchdetails.BranchCode
WHERE Installed=1 and orders.SimProvider='Cyrus' ORDER BY orders.OrderID DESC";
$results = mysqli_query($con, $query); 
*/
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
    <form method="POST" action="">
      <center>
        <div class="form-group col-md-3">
          <label for="ADate">Rcharge Date</label>
          <br>
          <input type="date" name="RDate" class="form-control my-select3" required>
        </div>
        <div class="form-group col-md-3">
          <label for="ADate">Plan Expiry Date</label>
          <br>
          <input type="date" name="ExpDate" class="form-control my-select3" required>
        </div>
      </center>
    <center>
      <input type="submit"  class=" btn btn-success my-button" value="submit" name="submit"></input>
    </center>      
  </form>
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
    var table = $('#example').DataTable( {
      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      responsive: true
    } );
  } );

</script>
</body>
</html>

<?php 
$con -> close();
$con2 -> close();
?>