<?php

include('connection.php'); 
//include 'session.php';

if(isset($_POST['submit'])){

  $BillNo=$_POST['billno'];

  $query ="SELECT BookNo FROM billbook WHERE BookNo='$BillNo'";
  $results = mysqli_query($con2, $query);
  $row=mysqli_fetch_assoc($results);

    //echo $ApprovalID;
  if (empty($row)==false){


    $eBillNo=base64_encode($BillNo);
    header("location:/cyrus/reception/billView.php?billno=$eBillNo");
  }else{
    echo '<script>alert("No record found")</script>';
  }
}

?>


<!doctype html>
  <html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="Anant Singh Suryavanshi">
    <title>Serach Biils</title>
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="sweetalert.min.js"></script>
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

  <?php 
  include 'navbar.php';
  //include 'modals.php';

  ?>
<legend style="text-align: center;">Search Bills</legend>
<br>
  <div class="container">
    
    <fieldset>

      <form method="POST" action="">
        <div class="row">
          <center>
            <div class="form-group col-md-4">
              <label for="Branch">Enter Invoice Number</label>
              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="billno" required>
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