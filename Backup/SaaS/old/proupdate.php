<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$ID = $_GET['id'];


if(isset($_POST['submit'])){


  $Date=$_POST['Date'];

  $sql = "UPDATE production SET IssueDate='$Date' WHERE SimID=$ID";
  $sql2 = "UPDATE simprovider SET IssueDate='$Date' WHERE ID=$ID";
  if ($con->query($sql) === TRUE) {
           //header("location:protable.php?");
    echo '<script>alert("Your response recorded successfully")</script>';
  }else {
    echo "Error updating record: " . $con->error;
  }

  if ($con->query($sql2) === TRUE) {
   header("location:protable.php?");
          //echo '<script>alert("Your response recorded successfully")</script>';
 }else {
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
    <meta name="author" content="Anant Singh Suryavanshi">
    <title>Production</title>
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
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
            <a class="nav-link" aria-current="page" href="protable.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Production</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewproduction.php">View Filled Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/cyrus/executive/changepass.php">Change Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br><br>
  <div class="container">

    <fieldset>

      <form method="POST" action="">
        
        <center>

          <div class="form-group col-md-3" align="center">
            <label>Production Date</label>
            <input type="date" name="Date" class="form-control" required>
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