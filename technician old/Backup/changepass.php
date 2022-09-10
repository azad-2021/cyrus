<?php

include('connection.php');
include('session.php');
$EmployeeID = $_SESSION['empid'];
$username=$_SESSION['user'];

if(isset($_POST['submit'])){

	$newPassword=$_POST['Password'];
	//echo $newPassword;
  $sql = "UPDATE employees SET UserPassword='$newPassword' WHERE EmployeeCode=$EmployeeID";

  if ($con2->query($sql) === TRUE) {
    //echo "Record updated successfully";
  	header('location:logout.php');
  } else {
    echo "Error updating record: " . $con2->error;
  }

  $con2->close();
}

?>


<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 

<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cyrus</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sign-in.css" rel="stylesheet">
    <link rel="icon" href="cyrus logo.png" type="image/icon type">

  </head>
  <body class="text-center">
    
    <form class="form-signin" action="" method="POST">
      <img class="img-fluid mb-4" alt="Cyrus Logo" height="100" src="cyrus%20logo.png" width="100" style="margin: 35px;">
      <h1 class="h3 mb-3 font-weight-normal">Welcome to Cyrus</h1>
      <h1 class="h3 mb-3 font-weight-normal">Please enter New Password</h1>
      <div class="form-group mb-2">
        <label ><?php echo $username;  ?></label>
      </div>
      <div class="form-group mx-sm-3 mb-2">
        <label for="inputPassword2" class="sr-only">New Password</label>
        <input type="password" class="form-control" id="inputPassword2" placeholder="Enter New Password" name="Password" maxlength="16" required>
      </div>
      <button type="submit" class="btn btn-primary mb-2" value="submit" name="submit">Submit</button>
      <p class="mt-5 mb-3 text-muted">&copy; Cyrus Electronics Pvt. Ltd.</p>

    </form>
        <!-- Bootstrap core JavaScript
          ================================================== -->
          <!-- Placed at the end of the document so the pages load faster -->
          <script src="assets/js/jquery.min.js"></script>
          <script src="assets/js/popper.js"></script>
          <script src="bootstrap/js/bootstrap.min.js"></script>



        </body>
        </html>
