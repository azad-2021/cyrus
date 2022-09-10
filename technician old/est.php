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
  $approvalID = $_GET['apid'];
  $ZoneCode = $_GET['zcode'];


   $queryApprovalID="SELECT * FROM approval where ApprovalID=$approvalID";
  $resultApprovalID=mysqli_query($con2,$queryApprovalID);
  $dataApprovalID=mysqli_fetch_assoc($resultApprovalID);
  $JOBCARD= $dataApprovalID['JobCardNo'];



 if(isset($_POST['back'])){

header("location:pro.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&cardno=$JOBCARD&zcode=$ZoneCode&apid=$approvalID");
}

  if(isset($_POST['submit'])){

      if(empty($_POST['estimate'])==true){
        echo '<script>alert("Please select estimate status")</script>';
      }elseif($_POST['estimate']=='YES') {
         header("location:estimate.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&apid=$approvalID&zcode=$ZoneCode");
      }elseif($_POST['estimate']=='NO'){
         header("location:more.php?cid=$complaintID&eid=$EmployeeID&brcode=$BranchCode&oid=$OID&zcode=$ZoneCode");
      }
  }
  
  $con2 -> close();
  $con3 -> close();
  $con4 -> close();

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Estimate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
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
          <h5 align="center">Estimate Given:<br><br>
            <input type="radio" name="estimate" id="estimate" value="YES">
            <label for="OK">Yes</label>
            &nbsp;&nbsp;&nbsp;
            <input type="radio" id="estimate" name="estimate" value="NO">
            <label for="NOT OK">No</label>
          </h5>
          <br> <br>
          <center>
            <input type="submit"  class=" btn btn-success my-button" value="submit" name="submit"></input>
            &nbsp;&nbsp;&nbsp;&nbsp; 
            <input type="submit"  class=" btn btn-danger my-button" value="Back" name="back"></input>
          </center>
          <!-- 
          <center> 
          <br><br> 
          <input type="submit"  class=" btn btn-danger" value="Back" name="back"></input>
          </center>
          -->      
        </form>
      </fieldset>
    </div>
  </body>
</html>