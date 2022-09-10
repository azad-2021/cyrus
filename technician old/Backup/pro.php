<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 


<?php 
  include 'connection.php';
  $OID = $_GET['oid'];
  $complaintID = $_GET['cid'];
  $EmployeeID = $_GET['eid'];
  $BranchCode = $_GET['brcode'];
  $JOBCARD = $_GET['cardno'];
  $ZoneCode = $_GET['zcode'];


  $queryApprovalID="SELECT * FROM approval where JobCardNo='$JOBCARD' and posted='0'";
  $resultApprovalID=mysqli_query($con2,$queryApprovalID);
  $dataApprovalID=mysqli_fetch_assoc($resultApprovalID);
  $approvalID = $dataApprovalID['ApprovalID'];
  //echo $approvalID;
  if(isset($_POST['submit'])){

      if(empty($_POST['material'])==true){
        echo '<script>alert("Please select material status")</script>';
      }elseif($_POST['material']=='YES') {
         header("location:product.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&apid=$approvalID&zcode=$ZoneCode");
      }elseif($_POST['material']=='NO'){
         header("location:est.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&apid=$approvalID&zcode=$ZoneCode");
      }
    }


  $con2 -> close();
  $con3 -> close();
  $con4 -> close();


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>add product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
      fieldset {
        background-color: #eeeeee;
        margin: 10px;
      }

      legend {
        background-color: #26082F;
        color: white;
        padding: 5px 10px;
      }

      .r {
        margin: 5px;
      }
    </style>
  </head>
  <body>
<?php 
  include 'navbar.php';
?>
    <br><br>
    <div class="container">
      <fieldset>
        <br><br>
        <form method="post" action="">
          <h5 align="center">Material Consumed:<br><br><br>
            <input type="radio" name="material" id="material" value="YES">
            <label for="OK">Yes</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="material" name="material" value="NO">
            <label for="NOT OK">No</label>
          </h5>
          <br><br>
          <center>
            <input type="submit"  class="btn btn-lg btn-success my-button" value="submit" name="submit"></input>
          </center>      
        </form>
      </fieldset>
    </div>
        <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>