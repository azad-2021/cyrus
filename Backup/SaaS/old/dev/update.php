<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$ID = $_GET['id'];

if (isset($_GET['Type'])) {
  $Type = $_GET['Type'];
}else{
  $Type='';
}
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


$queryOrders ="SELECT * FROM `orders` WHERE OrderID=$ID";
$resultsOrders = mysqli_query($con,$queryOrders);
$row1=mysqli_fetch_array($resultsOrders,MYSQLI_ASSOC);
$SimType=$row1["SimType"];
$OperatorID=$row1["OperatorID"];

$query2 ="SELECT * FROM `production` WHERE OrderID=$ID";
$result2 = mysqli_query($con, $query2);
$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
$prevSimID=$row2["SimID"];

$query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType'";
$results = mysqli_query($con,$query);


if(isset($_POST['submit'])){

  $SimID=$_POST['SimID'];


  $Remark=$_POST['Remark'];

  if (empty($Remark)==true) {
    echo '<script>alert("Please Enter Update Remark")</script>';
  }else{


    $sql = "UPDATE production SET SimID=$SimID WHERE OrderID=$ID";
    $sql2 = "UPDATE simprovider SET IssueDate=NULL, RemarkUpdate='$Remark' WHERE ID=$prevSimID";

    if ($con->query($sql) === TRUE) {
           //header("location:protable.php?");
      echo '<script>alert("Your response recorded successfully")</script>';
    }else {
      echo "Error updating record: " . $con->error;
    }

    if ($con->query($sql2) === TRUE) {
           //header("location:protable.php?");
      echo '<script>alert("Your response recorded successfully")</script>';
    }else {
      echo "Error updating record: " . $con->error;
    }



    $queryAdd = "UPDATE simprovider SET IssueDate='$Date' WHERE ID=$SimID";

    if ($con->query($queryAdd) === TRUE) {
      echo '<script>alert("Your response recorded successfully")</script>';
      header("location:instable.php?user=$username");
    }else {
      echo  $con->error;
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
    <title>Update Details</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
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
            <a class="nav-link" aria-current="page" href="instable.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewinst.php?">View Submitted Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add.php?id=<?php echo $ID;  ?>">Add Number</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="">Update</a>
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
    <br><br>
    <legend style="text-align: center;" class="my-select">Select Number</legend>
    <fieldset>

      <form method="POST" action="">

        <center>
          <div class="form-group col-md-3">
           <select class="form-control my-select3" name="SimID">
            <option value="">Select</option>
            <?php
            while ($arr=mysqli_fetch_assoc($results)){
              ?>
              <option value="<?php echo $arr['ID']; ?>"><?php echo $arr['MobileNumber']; ?></option>

            <?php } ?>                
          </select>

        </div>
      </center>
      <div class="form-group col-md-12" align="center">

        <label for="Remark">Remark</label>
        <textarea class="form-control my-select3" id="exampleFormControlTextarea1" cols="4" rows="4" name="Remark"></textarea>
      </div>  
      <br><br>
      <center>
        <input type="submit"  class=" btn btn-success my-button" value="submit" name="submit"></input>
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
