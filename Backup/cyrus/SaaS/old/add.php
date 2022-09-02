<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$ID = $_GET['id'];

$query ="SELECT * FROM `operators`";
$resultOperator = mysqli_query($con, $query);

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


if(isset($_POST['submit'])){
  $Mobile=$_POST['Mobile'];
  $SimNo=$_POST['SimNo'];
  $Provider=$_POST['Provider'];
  $ADate=$_POST['ADate'];
  $ExpDate=$_POST['ExpDate'];
  $error='';

  $query ="SELECT * FROM `simprovider` WHERE MobileNumber=$Mobile";
  $results = mysqli_query($con,$query);

  if (strlen($Mobile) < 13){
    $error='<script>alert("Mobile Number must be 12 Digit Long")</script>';
  }elseif(strlen($SimNo) < 20 and $Provider=='Cyrus'){
    $error='<script>alert("Sim Number must be 20 Digit Long")</script>';
  }elseif ($results->num_rows > 0) {
   $error='<script>alert("Mobile Number already exist")</script>';
 }elseif (empty($SimNo) and $Provider=='Cyrus') {
   $error='<script>alert("Please Enter SimNo")</script>';
 }elseif (empty($ADate) and $Provider=='Cyrus') {
   $error='<script>alert("Please Enter Activation Date")</script>';
 }elseif (empty($ExpDate) and $Provider=='Cyrus') {
   $error='<script>alert("Please Enter Plan Expiry Date")</script>';
 }

 if(empty($error)==true){
  $SimType=$_POST['SimType'];
  $OperatorID=$_POST['Operator'];
  $Provider=$_POST['Provider'];
  $Remark=$_POST['Remark'];

  

  $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`,`ReleaseDate`, `IssueDate`, `ActivationDate`, `ExpDate`, `Remark`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', '$Provider', '$Date', '$Date', '$ADate', '$ExpDate', '$Remark')" ;
  $resultAdd = mysqli_query($con,$queryAdd);
  if ($resultAdd) {
    echo '<script>alert("Your response recorded successfully")</script>';
           //header("location:simtable.php?user=$username");
    $query ="SELECT * FROM `simprovider` WHERE MobileNumber=$Mobile";
    $results = mysqli_query($con,$query);
    $row3=mysqli_fetch_array($results,MYSQLI_ASSOC);
    $SimID=$row3["ID"];

    $sql = "UPDATE production SET SimID=$SimID WHERE OrderID=$ID";
    $sql2 = "UPDATE orders SET SimType='$SimType', OperatorID=$OperatorID WHERE OrderID=$ID";
    $sql3 = "UPDATE simprovider SET IssueDate=NULL, RemarkUpdate='Sim Changed' WHERE ID=$prevSimID";

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

    if ($con->query($sql3) === TRUE) {
     header("location:instable.php?");
     echo '<script>alert("Your response recorded successfully")</script>';
   }else {
    echo "Error updating record: " . $con->error;
  }

}else{
  echo "Error updating record: " . $con->error;
}
}else{
  echo $error;
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
    <title>Add Number</title>
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
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

  <script type="text/javascript">

    function limit1(element){
      var max_chars = 20;
      if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
      }
    }

    function limit2(element){
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
            <a class="nav-link" aria-current="page" href="instable.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewinst.php?">View Submitted Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="">Add Number</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/cyrus/executive/changepass.php">Change Password</a>
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
    <legend style="text-align: center;" class="my-select">Enter Details</legend>
    <fieldset>
      <form method="POST" action="">
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="Branch">Mobile No.</label>
            <input type="text" maxlength="13" class="form-control my-select3" placeholder="Mobile No" name="Mobile" onkeydown="limit2(this);" onkeyup="limit2(this);" required>
          </div>
          <div class="form-group col-md-3">
            <label for="Bank ID">Sim No.</label>
            <input type="number" class="form-control my-select3" placeholder="Sim No" name="SimNo" onkeydown="limit1(this);" onkeyup="limit1(this);">
          </div>
          <div class="form-group col-md-3">
            <label for="IssueDate">Sim Type</label>
            <select class="form-control my-select3" name="SimType" required>
              <option value="">Select</option>
              <option value="Prepaid">Prepaid</option>
              <option value="Postpaid">Postpaid</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="IssueDate">Sim Provider</label>
            <select class="form-control my-select3" name="Provider" required>
              <option value="">Select</option>
              <option value="Cyrus">Cyrus</option>
              <option value="Bank">Bank</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="operator">Operator</label>
            <select class="form-control my-select3" name="Operator">
              <option value="">Select</option>
              <?php
              while ($arr=mysqli_fetch_assoc($resultOperator)){
                ?>
                <option value="<?php echo $arr['OperatorID']; ?>"><?php echo $arr['Operator']; ?></option>
                
              <?php } ?>                
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="ADate">Activation Date</label>
            <br>
            <input type="date" name="ADate" placeholder="dd/mm/yy" class="form-control my-select3">
          </div>
          <div class="form-group col-md-3">
            <label for="ADate">Plan Expiry Date</label>
            <br>
            <input type="date" name="ExpDate" placeholder="dd/mm/yy" class="form-control my-select3">
          </div>
          <div class="form-group col-md-12">
            <label for="Remark">Remark</label>
            <textarea class="form-control my-select3" id="exampleFormControlTextarea1" cols="4" rows="4" name="Remark"></textarea>
          </div>
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
