<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$ID = $_GET['id'];


$query ="SELECT * FROM `employees` WHERE Inservice='1' ORDER by `Employee Name`";
 $results = mysqli_query($con2,$query);  

$query2 ="SELECT * FROM `orders` WHERE OrderID=$ID and OperatorID is not null";
$result2 = mysqli_query($con,$query2);
$row=mysqli_fetch_array($result2,MYSQLI_ASSOC);

$query3 ="SELECT * FROM `orders` WHERE OrderID=$ID and OperatorID is null";
$result3 = mysqli_query($con,$query3);
$row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);


if (empty($row3)==false) {
  // code...
  $Provider2=$row3['SimProvider'];
}else{
  $Provider2='';
}


if (empty($row)==false) {
  // code...
  $Provider=$row['SimProvider'];
}else{
  $Provider='';
}


date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


if(isset($_POST['submit'])){

$error=[];

if(empty($_POST['EmployeeCode']==true)){
  $error='<script>alert("Please Select Service Engineer")</script>';
 }elseif(empty($_POST['InstDate']==true)){
   $error='<script>alert("Please Enter Installation Date")</script>';
 }elseif (isset($_POST['Mobile'])) {

      $Mobile=$_POST['Mobile'];
      $SimNo=$_POST['SimNo'];
  if (strlen($Mobile) < 10){
    $error='<script>alert("Mobile Number must be 10 Digit Long")</script>';
  }elseif (strlen($SimNo) < 20){
    $error='<script>alert("Sim Number must be 20 Digit Long")</script>';
  }
}

 if(empty($error)==true){


      $InstalledBy=$_POST['EmployeeCode'];
      $InstDate=$_POST['InstDate'];

      if (isset($_POST['Mobile'])) {

      $Mobile=$_POST['Mobile'];
      $SimNo=$_POST['SimNo'];
      $SimType=$_POST['SimType'];
      $OperatorID=$_POST['Operator'];
      $ADate=$_POST['ADate'];
      $ExpDate=$_POST['ExpDate'];

      $queryAdd="INSERT INTO `simprovider`( `MobileNumber`, `SimNo`, `SimType`, `OperatorID`, `SimProvider`, `ReleaseDate`, `IssueDate`, `ActivationDate`, `ExpDate`) VALUES ('$Mobile','$SimNo','$SimType', '$OperatorID', 'Bank', '$Date', '$Date', '$ADate', '$ExpDate')" ;
      $resultAdd = mysqli_query($con,$queryAdd);
      if ($resultAdd) {

        $query3 ="SELECT ID FROM `simprovider` WHERE MobileNumber=$Mobile";
        $result3 = mysqli_query($con,$query3);
        $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
        $SimID=$row3['ID'];

        $sql = "UPDATE production SET SimID=$SimID WHERE OrderID=$ID";
        $sql2 = "UPDATE orders SET SimType='$SimType', OperatorID=$OperatorID, Status='3', Installed='1' WHERE OrderID=$ID";

        if ($con->query($sql) === TRUE) {
           //header("location:protable.php?");
          echo '<script>alert("Your response recorded successfully")</script>';
        }else {
          echo "Error updating record: " . $con->error;
        }

        if ($con->query($sql2) === TRUE) {
           header("location:instable.php?");
          //echo '<script>alert("Your response recorded successfully")</script>';
        }else {
          echo "Error updating record: " . $con->error;
        }

      }else {
          echo "Error updating record: " . $con->error;
      }

      $queryAdd="INSERT INTO `installation`( `OrderID`, `InstalledBy`, `InstallationDate` ) VALUES ('$ID', '$InstalledBy','$InstDate')" ;
      $resultAdd = mysqli_query($con,$queryAdd);
       
    }else{

      //$date = str_replace('-"', '/', $InstallationDate);  
      //$IssueDate = date("Y/m/d", strtotime($date));

      $queryAdd="INSERT INTO `installation`( `OrderID`, `InstalledBy`, `InstallationDate` ) VALUES ('$ID', '$InstalledBy','$InstDate')" ;
      $resultAdd = mysqli_query($con,$queryAdd);
      if ($resultAdd) {
        echo '<script>alert("Your response recorded successfully")</script>';

        if (isset($_POST['ADate'])) {

          $ADate=$_POST['ADate'];
          $ExpDate=$_POST['ExpDate'];

          $query4 ="SELECT * FROM `production` WHERE OrderID=$ID";
          $result4 = mysqli_query($con,$query4);
          $row4=mysqli_fetch_array($result4,MYSQLI_ASSOC);
          $SimID=$row4['SimID'];

        $sqlX = "UPDATE simprovider SET ActivationDate='$ADate', ExpDate='$ExpDate' WHERE ID=$SimID";

        if ($con->query($sqlX) === TRUE) {
           echo '<script>alert("Your response recorded successfully")</script>';
        }else {
          echo "Error updating record: " . $con->error;
        }

        }

        $sql = "UPDATE orders SET Status='3', Installed='1' WHERE OrderID=$ID";

        if ($con->query($sql) === TRUE) {
           header("location:instable.php?");
        }else {
          echo "Error updating record: " . $con->error;
        }
       
      }else{
    echo $con->error;
  }

  }
}else{
    print_r($error);
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
        <meta name="author" content="Anant Singh Suryavanshi">
        <title>Installation</title>
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

      .r {
        margin: 5px;
      }
    </style>

  <script type="text/javascript">

  function limit1(element)
{
    var max_chars = 20;

    if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}


  function limit2(element)
{
    var max_chars = 10;

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
        <a class="nav-link active" href="#">Installation</a>
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



<?php
        if ($Provider2=='Bank') {

        $query ="SELECT * FROM `operators`";
        $resultOperator = mysqli_query($con, $query);
  ?>
<div class="form-row">
    <div class="form-group col-md-3">
      <label for="Branch">Mobile No.</label>
      <input type="number" class="form-control" placeholder="Mobile No" name="Mobile" onkeydown="limit2(this);" onkeyup="limit2(this);" required minlength="10">
    </div>
      <div class="form-group col-md-3">
      <label for="Bank ID">Sim No.</label>
      <input type="number" class="form-control" placeholder="Sim No" name="SimNo" onkeydown="limit1(this);" onkeyup="limit1(this);" required>
    </div>
    <div class="form-group col-md-3">
      <label for="IssueDate">Sim Type</label>
     <select class="form-control" name="SimType" required>
      <option value="">Select</option>
      <option value="Prepaid">Prepaid</option>
      <option value="Postpaid">Postpaid</option>
    </select>

    </div>
    <div class="form-group col-md-3">
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
    <div class="form-group col-md-3">
      <label for="ADate">Activation Date</label>
      <br>
      <input type="date" name="ADate" placeholder="dd/mm/yy">
    </div>

    <div class="form-group col-md-3">
      <label for="ADate">Plan Expiry Date</label>
      <br>
      <input type="date" name="ExpDate" placeholder="dd/mm/yy">
    </div>

</div>
<?php } ?>


<?php
        if ($Provider=='Bank') {

        $query ="SELECT * FROM `operators`";
        $resultOperator = mysqli_query($con, $query);
  ?>
<div class="form-row">

    <div class="form-group col-md-3">
      <label for="ADate">Activation Date</label>
      <br>
      <input type="date" name="ADate" placeholder="dd/mm/yy">
    </div>

    <div class="form-group col-md-3">
      <label for="ADate">Plan Expiry Date</label>
      <br>
      <input type="date" name="ExpDate" placeholder="dd/mm/yy">
    </div>

</div>
<?php } ?>


<center>

    <div class="form-group col-md-3">
      <label for="IssueDate">Installed By</label>
     <select class="form-control" name="EmployeeCode">
      <option value="">Select</option>
      <?php 
                      while ($arr=mysqli_fetch_assoc($results))
                      {
                          ?>
                          <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                          <?php
                      }?>      
    </select>

    </div>
    <div class="form-group col-md-3">
      <label for="InstDate">Installation Date</label>
      <br>
      <input type="date" name="InstDate" placeholder="dd/mm/yy">
    </div>
</center>
  <br><br>
  <center>

  <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
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