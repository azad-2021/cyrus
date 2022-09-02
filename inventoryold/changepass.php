<?php
//echo "password page";
include('connection.php');
include('session.php');
$username=$_SESSION['user'];
$ID=$_SESSION['userid'];

if(isset($_POST['submit'])){

	$newPassword=$_POST['Password'];
	//echo $newPassword;
    $sql = "UPDATE pass SET Password='$newPassword' WHERE ID='$ID'";

    if ($con->query($sql) === TRUE) {
  //echo "Record updated successfully";
     header('location:logout.php');
 } else {
  echo "Error updating record: " . $con->error;
}

//$con->close();
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
    <body>
     <div class="container">
        <center>
            <img class="img-fluid mb-4" alt="Cyrus Logo" height="50" src="cyrus logo.png" width="50">
            <h1 class="h3 mb-3 font-weight-normal">Welcome to Cyrus</h1>
            <h1 class="h3 mb-3 font-weight-normal">Please enter new passwor</h1>
        </center>       
        <form class="form-signin" action="" method="POST">
            <input type="password" id="pass" name="Password" class="form-control" placeholder="New Password" required>
            <center>
                <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                <p class="mt-5 mb-3 text-muted">&copy; Cyrus Electronics Pvt. Ltd.</p>
            </center>  
        </form>
    </div>
        <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/popper.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
        </body>
        </html>
