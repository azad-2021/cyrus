<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$ID = $_GET['id'];
$OrderID = $_GET['oid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$query ="SELECT * FROM `orders` WHERE OrderID=$OrderID";
$results = mysqli_query($con, $query);
$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
$PlanLimit=$row["ValidityRecharge"];


if(isset($_POST['submit'])){

  $ExpDate=$_POST['RDate'];

  $sql = "UPDATE simprovider SET ActivationDate='$Date', ExpDate='$ExpDate' WHERE ID=$ID";
  if ($con->query($sql) === TRUE) {
    header("location:simtable.php?");
    echo '<script>alert("Sim Activated")</script>';
  }else{
    echo "Error updating record: " . $con->error;
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
    <title>Sim Provider</title>
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
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
            <a class="nav-link" target="blank" href="viewsim.php?">Active Sim Cards</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" target="blank" href="">Activate Sim Card</a>
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

    <legend class="my-select" style="text-align: center;">Enter Plan Expiry Date</legend>
    <fieldset>
      <form method="POST" action="">
        <center>
          <div class="form-group col-md-3" >
            <label for="operator">Plan Limit
              <?php
              echo $PlanLimit.' Months';                       
              ?>                
            </label>
            <br>
            <input type="date" name="RDate" placeholder="dd/mm/yy" class="form-control my-select">
          </div>
        </center>

        <div class="form-group col-md-12">
          <label for="Remark">Remark</label>
          <textarea class="form-control my-select" id="exampleFormControlTextarea1" cols="4" rows="4" name="Remark"></textarea>
        </div>
        <br><br>
        <center>
          <input type="submit"  class=" btn btn-success my-button " value="submit" name="submit"></input>
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