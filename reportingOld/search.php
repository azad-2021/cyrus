<?php

include('connection.php'); 
include 'session.php';

if(isset($_POST['submit'])){

  $Jobcard=$_POST['Jobcard'];

  $query ="SELECT * FROM `approval` WHERE JobCardNo='$Jobcard'";
  $results = mysqli_query($con, $query);
  $row=mysqli_fetch_assoc($results);
    
    //echo $ApprovalID;
  if (empty($row)==false){

    $ApprovalID=$row['ApprovalID'];
    echo $ApprovalID;
    $Jobcard=base64_encode($Jobcard);
    header("location:/technician/view.php?card=$Jobcard");
  }
}

/*
  $BranchCode=$_POST['Branch'];
  $ZoneCode=$_POST['Zone'];
  $BankCode=$_POST['Bank'];


  $query ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
  $results = mysqli_query($con, $query);
  $row=mysqli_fetch_assoc($results);
  $Bank=$row['BankName'];

  $query ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
  $results = mysqli_query($con, $query);
  $row=mysqli_fetch_assoc($results);
  $Zone=$row['ZoneRegionName'];

  $query ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
  $results = mysqli_query($con, $query);
  $row=mysqli_fetch_assoc($results);
  $Branch=$row['BranchName'];


  echo $Zone.'<br>';
  echo $Branch.'<br>';
  echo $Bank.'<br>';
  if (mysqli_num_rows($result)>0){

  }
  */

  ?>


  <!doctype html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Search Jobcard</title>
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
              <a class="nav-link active" aria-current="page" href="reporting.php?">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="/html/technician/editjobcard.php?apid=<?php echo $ApprovalID.'&cardno='.$Jobcard;  ?>">Edit Job Card</a>
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

      <legend style="text-align: center;">Search Jobcard</legend>
      <fieldset>

        <form method="POST" action="">
          <div class="row">
          <!--
          <div class="form-group col-md-2">
            <label for="Branch">Select Bank</label>
            <select id="Bank" class="form-select" name="Bank" required>
              <option value="">Select Bank</option>
              <?php
              /*
              $BankData="Select BankCode, BankName from bank order by BankName";
              $result=mysqli_query($con,$BankData);
              if (mysqli_num_rows($result)>0)
              {
                while ($arr=mysqli_fetch_assoc($result))
                {
                  ?>
                  <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                  <?php
                }
              }*/
              ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="Branch">Select Zone</label>
            <select id="Zone" class="form-control" name="Zone" required>
              <option value="">Select</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="Branch">Branch</label>
            <select id="Branch" class="form-control" name="Branch" required>
              <option value="">Select</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="Branch">Select Search Type</label>
            <select class="form-select" aria-label="Default select example" required>
              <option value="">Select</option>
              <option value="OrderID">Order ID</option>
              <option value="ComplaintID">Complaint ID</option>
              <option value="Jobcard">Jobcard Number</option>
            </select>
          </div>
        -->
        <center>
          <div class="form-group col-md-2">
            <label for="Branch">Enter Jobcard Number</label>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="Jobcard" required>
          </div>

          <div class="form-group col-md-2">
            <label for="Branch"><br><br></label>
            <input type="submit"  class="btn btn-primary" name="submit"></input>
          </div>
        </center>
      </div>  

    </form>

  </fieldset>
</div>

<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="ajax-script.js" type="text/javascript"></script>
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