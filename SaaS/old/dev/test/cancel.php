<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$ID = $_GET['id'];

$query ="SELECT * FROM `orders` WHERE OrderID=$ID";
$results = mysqli_query($con, $query);
$rows=mysqli_fetch_array($results,MYSQLI_ASSOC);
$BranchCode=$rows['BranchCode'];
$GadgetID=$rows['GadgetID'];

$queryBranch ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
$resultBranch = mysqli_query($con2, $queryBranch);
$row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
$Branch=$row4["BranchName"];
  //$BranchCode=$row4["BranchCode"];
$ZoneCode= $row4["ZoneRegionCode"];

$queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
$resultZone = mysqli_query($con2, $queryZone);
$row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
$Zone=$row2["ZoneRegionName"];
$BankCode=$row2["BankCode"];

$queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
$resultBank = mysqli_query($con2, $queryBank);
$row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
$Bank=$row3["BankName"];


$queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
$resultGadget = mysqli_query($con, $queryGadget);
$row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
$Gadget=$row5["Gadget"];

if(isset($_POST['submit'])){
  if(empty($_POST['Remark']==true)){
    echo '<script>alert("Please Enter Remark")</script>';
  }else{
    $Remark=$_POST['Remark'];
    $query2 ="SELECT * FROM `production` WHERE OrderID=$ID";
    $result2 = mysqli_query($con, $query2);
    $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
    $prevSimID=$row2["SimID"];

    $sql = "UPDATE orders SET Installed='2', Remark='$Remark' WHERE OrderID=$ID";
    $sql2 = "UPDATE simprovider SET IssueDate=NULL WHERE ID=$prevSimID";
    if ($con->query($sql) === TRUE) {
         //header("location:instable.php?");
    }else {
      echo "Error updating record: " . $con->error;
    }
    if ($con->query($sql2) === TRUE) {
      header("location:instable.php?");
    }else {
      echo "Error updating record: " . $con->error;
    }
  }
}
?>



<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <title>Cancel Order</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    fieldset {
      background-color: #eeeeee;
      margin: 5px;
      padding: 10px;
    }

    legend {
      background-color: #26082F;
      color: white;
      padding: 5px 5px;
    }

    .r {
      margin: 5px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
    <div class="container-fluid" align="center">
      <a class="navbar-brand" href="/index.html"><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="instable.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewinst.php?">View Submitted Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Cancel Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <br><br>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Bank</th>
            <th>Zone</th>
            <th>Branch</th>
            <th>Gadget</th>
            <th>Order ID</th>
          </tr>
        </thead>
        <tbody>
          <td><?php echo $Bank;?></td>
          <td><?php echo $Zone;?></td>
          <td><?php echo $Branch;?></td>
          <td><?php echo $Gadget;?></td>
          <td><?php echo $ID;?></td>
        </tbody>
      </table>
    </div>
    <br>
    <fieldset>
      <legend style="text-align: center;">Enter Reason of Cancellation</legend>
      <form method="POST" action="">
        <div class="form-row">
          <div class="form-group col-md-12" >
            <label align="center" for="Remark">Remark</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" cols="4" rows="2" name="Remark"></textarea>
          </div>
        </div>  
        <br><br>
        <center>
          <input type="submit"  class=" btn btn-danger" value="submit" name="submit"></input>
        </center>      
      </form>
    </fieldset>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
$con -> close();
$con2 -> close();
?>