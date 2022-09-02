<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$query ="SELECT * FROM `operators`";
$resultOperator = mysqli_query($con, $query);


if(isset($_POST['submit'])){


  $Mobile=$_POST['Mobile'];
  $SimNo=$_POST['SimNo'];
  $SimType=$_POST['SimType'];
  $OperatorID=$_POST['Operator'];
  $Provider=$_POST['Provider'];
  $Remark=$_POST['Remark'];

  $query ="SELECT * FROM `simprovider` WHERE `MobileNumber`=$Mobile";
  $result = mysqli_query($con, $query);
     // $date = str_replace('-"', '/', $IssueDate);  
     // $IssueDate = date("y/m/d", strtotime($date));
  $errors='';
  if (strlen($Mobile) < 13){
    $errors='<script>alert("Mobile Number must be 12 Digit Long")</script>';
  }elseif (strlen($SimNo) < 20){
    $errors='<script>alert("Sim Number must be 20 Digit Long")</script>';

  }elseif(empty(mysqli_fetch_assoc($result))==false){
    $errors='<script>alert("Mobile Number Already Exists")</script>';
  }
  if (empty($errors)==true) {
        // code...
    
    if(empty($_POST['ADate'])==false) {


      $ADate=$_POST['ADate'];
      $ExpDate=$_POST['RDate'];
      $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `ActivationDate`, `ExpDate`, `Remark`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$ADate', '$ExpDate', '$Remark')" ;

    }else{

      $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `Remark`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$Remark')" ;

    }
    $resultAdd = mysqli_query($con,$queryAdd);
    if ($resultAdd) {
      echo '<script>alert("Your response recorded successfully")</script>';
      header("location:simtable.php?user=$username");
    }else {
      echo "Error updating record: " . $con->error;
    }

  }else{
    echo $errors;
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

  </style>


  <script type="text/javascript">
    function yesnoCheck(that) {
      if(that.value == "Bank"){
        document.getElementById("1").style.display = "flex";
      }else{
        document.getElementById("1").style.display = "none";
      }
    }


    function limit1(element)
    {
      var max_chars = 20;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }


    function limit2(element)
    {
      var max_chars = 13;

      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }


  </script>
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
            <a class="nav-link active" target="blank" href="sim.php?">Release Sim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="blank" href="viewsim.php?">Active Sim Cards</a>
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
    <legend style="text-align: center;">Enter Details</legend>
    <fieldset>

      <form method="POST" action="">
        <div class="form-row">

          <div class="form-group col-md-3">
            <label for="Branch">Mobile No.</label>
            <input type="text" minlength="13" maxlength="13" class="form-control" placeholder="Mobile No" name="Mobile" onkeydown="limit2(this);" onkeyup="limit2(this);" required>
          </div>
          <div class="form-group col-md-3">
            <label for="Bank ID">Sim No.</label>
            <input type="text" class="form-control" placeholder="Sim No" name="SimNo" onkeydown="limit1(this);" onkeyup="limit1(this);"required>
          </div>
          <div class="form-group col-md-2">
            <label for="IssueDate">Sim Type</label>
            <select class="form-control" name="SimType" required>
              <option value="">Select</option>
              <option value="Prepaid">Prepaid</option>
              <option value="Postpaid">Postpaid</option>
            </select>

          </div>
          <div class="form-group col-md-2">
            <label for="IssueDate">Sim Provider</label>
            <select class="form-control" name="Provider" required onchange="yesnoCheck(this);">
              <option value="">Select</option>
              <option value="Bank">Bank</option>
              <option value="Cyrus">Cyrus</option>
            </select>

          </div>
          <div class="form-group col-md-2">
            <label for="operator">Operator</label>
            <select class="form-control" name="Operator">
              <option value="">Select</option>
              <?php
              while ($arr=mysqli_fetch_assoc($resultOperator)){
                ?>
                <option value="<?php echo $arr['OperatorID']; ?>"><?php echo $arr['Operator']; ?></option>
                
              <?php } ?>                
            </select>

          </div>

          <div class="form-group col-md-12" id="1"  style="display: none;">
            <label for="SimType">Activation Date</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="date" name="ADate" placeholder="dd/mm/yy">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="SimType">Recharge Expiry Date</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="date" name="RDate" placeholder="dd/mm/yy">

          </div>
          <div class="form-group col-md-12">

            <label for="Remark">Remark</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" cols="4" rows="4" name="Remark"></textarea>

          </div>

        </div>  
        <br><br>
        <center>

          <input type="submit"  class=" btn btn-success" value="submit" name="submit" onclick="checkLength()" /></input>
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