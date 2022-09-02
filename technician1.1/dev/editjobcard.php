<?php

include('connection.php'); 
$ApprovalID = base64_decode($_GET['apid']);
$jobcard = base64_decode($_GET['cardno']);
$enApprovalID=$_GET['apid'];
//echo $ApprovalID;
if(isset($_POST['submit'])){

  $New=$_POST['NewCard'];
  $input = preg_replace("/[^a-zA-Z0-9]+/", "", $New);
  $NewCard=strtoupper($input);


  $filename1 = 'jobcard/'.$NewCard.'.pdf';
  $filename2 = 'jobcard/'.$NewCard.'.JPEG';
  $filename3 = 'jobcard/'.$NewCard.'.jpeg';
  $filename4 = 'jobcard/'.$NewCard.'.jpg';
  if (file_exists($filename1) or file_exists($filename2) or file_exists($filename3) or file_exists($filename4)) {
    echo '<script>alert("Jocard number already exist")</script>';
  }else{


    $sql = "UPDATE `approval` SET JobCardNo='$NewCard' WHERE ApprovalID=$ApprovalID";


    if(rename("jobcard/".$jobcard.".jpg","jobcard/".$NewCard.".jpg")){
   // echo "renamed";
      $resultupdate = mysqli_query($con2,$sql);
      header("location:/executive/verify.php?apid=$enApprovalID");
    }elseif(rename("jobcard/".$jobcard.".jpeg","jobcard/".$NewCard.".jpeg")){
   // echo "renamed";
      $resultupdate = mysqli_query($con2,$sql);
      header("location:/executive/verify.php?apid=$enApprovalID");
    }elseif(rename("jobcard/".$jobcard.".JPEG","jobcard/".$NewCard.".JPEG")){
   // echo "renamed";
      $resultupdate = mysqli_query($con2,$sql);
      header("location:/executive/verify.php?apid=$enApprovalID");
    }elseif(rename("jobcard/".$jobcard.".pdf","jobcard/".$NewCard.".pdf")){
   // echo "renamed";
      $resultupdate = mysqli_query($con2,$sql);
      header("location:/executive/verify.php?apid=$enApprovalID");
    }
  }
}
$con2 -> close();
$con3 -> close();
$con4 -> close();


?>

<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit JobCard</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
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
      <a class="navbar-brand" href=""><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown" align="center">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/executive/reporting.php?">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="">Edit Job Card</a>
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

    <legend style="text-align: center;">Verification Status</legend>
    <fieldset>

      <form method="POST" action="">
        <div class="form-row">

          <div class="form-group col-md-12">
            <label for="Bank ID">Enter New Job Card Number</label>
            <input type="text" class="form-control"  name="NewCard" required>
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
  <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
  "></script>
</body>
</html>