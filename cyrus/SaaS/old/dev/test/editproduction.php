<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$ID = $_GET['id'];


$query ="SELECT * FROM `sirius_simcard_details` WHERE `ID`='$ID'";
$results = mysqli_query($con, $query); 
$data=mysqli_fetch_array($results); 
$prevIssue=$data["Panel_Issue_Date"];   
$PrevStatus=$data['CurrentStatus'];
$PrevRemark=$data['ProductionRemark'];



if(isset($_POST['submit'])){
  if(empty($_POST['IssueDate']==true)){
    echo '<script>alert("Please Enter Issue Date")</script>';
  }elseif(empty($_POST['Status']==true)){
    echo '<script>alert("Please Select Current Status")</script>';
  }elseif(empty($_POST['Remark']==true)){
    echo '<script>alert("Please Enter Remark")</script>';
  }else{
    $IssueDate=$_POST['IssueDate'];
    $Status=$_POST['Status'];
    $Remark=$_POST['Remark'];

    $date = str_replace('-"', '/', $IssueDate);  
    $IssueDate = date("Y/m/d", strtotime($date)); 

    $queryAdd = "UPDATE `sirius_simcard_details` SET  Panel_Issue_Date='$IssueDate',  CurrentStatus='$Status',  ProductionRemark='$Remark' WHERE ID=$ID";
    $resultAdd = mysqli_query($con,$queryAdd);
    if ($resultAdd) {
      header("location:protable.php?");
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
    <meta name="author" content="Anant Singh Suryavanshi">
    <title>Production</title>
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
</head>

<body>

  <div class="container">
    <br>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eeeeee;">
      <a class="navbar-brand" href="protable.php">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
          </li>
        </ul>
      </div>
    </nav>
    <br><br>
    <legend style="text-align: center;">Enter Details</legend>
    <fieldset>
      <form method="POST" action="">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="IssueDate">Panel issue Date: <?php echo $prevIssue; ?></label>
            <br>
            <input type="date" name="IssueDate" placeholder="dd/mm/yy">
          </div>
          <div class="form-group col-md-4">
            <label for="Current Status">Current Status: <?php echo $PrevStatus  ?></label>
            <select class="form-control" name="Status">
              <option value="">Select</option>
              <option value="Issue">Issue</option>
              <option value="Installed">Installed</option>      
            </select>

          </div>
          <div class="form-group col-md-4" align="center">
            <label for="Remark">Remark: <?php echo $PrevRemark ?></label>
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