<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$ID = $_GET['id'];

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$query ="SELECT * FROM `employees` WHERE Inservice='1' ORDER by `Employee Name`";
$results = mysqli_query($con2,$query);  


if(isset($_POST['submit'])){



  $IssueTo=$_POST['EmployeeCode'];
  $Remark=$_POST['Remark'];
//echo $IssueTo;
      //$IssueTo = (int)$IssueTo;
  $queryAdd="INSERT INTO `store`( `OrderID`, `ReleaseDate`, `EmployeeCode`, `Remark` ) VALUES ('$ID', '$Date','$IssueTo', '$Remark')" ;
  $resultAdd = mysqli_query($con,$queryAdd);
  if ($resultAdd) {
    echo '<script>alert("Your response recorded successfully")</script>';

    $sql = "UPDATE orders SET Status='2' WHERE OrderID=$ID";

    if ($con->query($sql) === TRUE) {
     header("location:storetable.php?");
   }else {
    echo "Error updating record: " . $con->error;
  }

}else{
  echo $con->error;
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
    <title>Store</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
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
            <a class="nav-link" aria-current="page" href="storetable.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewstore.php?">View Submitted Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Store</a>
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
    <legend style="text-align: center;">Enter Details</legend>
    <fieldset>
      <form method="POST" action="">
        <center>
          <div class="form-group col-md-3">
            <label for="IssueDate">Release To</label>
            <select class="form-control" name="EmployeeCode" required="">
              <option>Select</option>
              <?php 
              while ($arr=mysqli_fetch_assoc($results))
              {
                ?>
                <option value="<?php echo $arr['EmployeeCode']; ?>"><?php echo $arr['Employee Name']; ?></option>
                <?php
              }?>      
            </select>
          </div>
        </center>
        <div class="form-group col-md-12" align="center">
          <label for="Remark">Remark</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" cols="4" rows="2" name="Remark"></textarea>
        </div>

      </div>  
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