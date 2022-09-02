<?php

include('connection.php'); 
include 'session.php';
$ApprovalID = base64_decode($_GET['apid']);
$enApprovalID=$_GET['apid'];
$sql = "SELECT * from pbills where ApprovalID = '$ApprovalID'";  
$resultB = mysqli_query($con2, $sql);  
$rowB = mysqli_fetch_assoc($resultB);  


if($rowB){
  $Material='YES';
}else{
  $Material='NO';
}


$sql2 = "select * from estimates where ApprovalID = '$ApprovalID'";  
$resultE = mysqli_query($con2, $sql2);  
$rowE = mysqli_fetch_assoc($resultE);  

if($rowE){
  $Estimate='YES';
}else{
  $Estimate='NO';
}

$user=$_SESSION['user'];
$query ="SELECT * FROM `approval`
join gadget on approval.GadgetID=gadget.GadgetID
Where ApprovalID='$ApprovalID'";
$results = mysqli_query($con, $query);
$row=mysqli_fetch_array($results);


$VisitDate = $row["VisitDate"];
$Status = $row["Status"];
$GadgetID = $row["GadgetID"];
$Jobcard = $row["JobCardNo"]; 
$enJobcard=base64_encode($Jobcard);
$EmployeeID = $row["EmployeeID"];
$Gadget=$row["Gadget"];
if(isset($_POST['OrderID'])){
  $ID= $row["OrderID"];

}else{
  $ID= $row["ComplaintID"];
}
  //$orgDate = $VisitDate;  
  //$date = str_replace('-"', '/', $orgDate);  
  //$VisitDate = date("d/m/Y", strtotime($date));  

$BranchCode = $row["BranchCode"];
$CID = $row["ComplaintID"];
$OID = $row["OrderID"];   
$Vby = $_SESSION['user'];
date_default_timezone_set('Asia/Kolkata');
$Date =date('Y-m-d');

$query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
$result = mysqli_query($con, $query);
$row1=mysqli_fetch_array($result);


$Zcode=$row1["ZoneRegionCode"];
$BranchName= $row1["BranchName"];
$BranchPhone=$row1["PhoneNo"];
$BranchMobile=$row1["Mobile Number"];
$District=$row1["Address3"];

$query2 ="SELECT * FROM `zoneregions` Where ZoneRegionCode='$Zcode'";
$result2 = mysqli_query($con, $query2);
$row2=mysqli_fetch_array($result2);
$BankCode= $row2["BankCode"];
$Zone= $row2["ZoneRegionName"];

$query1 ="SELECT * FROM `bank` Where BankCode='$BankCode'";
$result1 = mysqli_query($con, $query1);
$row11=mysqli_fetch_array($result1);
$Bank= $row11["BankName"];



if(empty($CID==false)){
  $refrence='Complaint';
  $ID=$CID;
  $query2 ="SELECT * FROM `complaints` Where ComplaintID='$CID'";
  $results2 = mysqli_query($con, $query2);
  $row2=mysqli_fetch_array($results2);
  $Description = $row2["Discription"];
}else{

  $refrence='Order';
  $ID=$OID;
  $query2 ="SELECT * FROM `orders` Where OrderID='$OID'";
  $results2 = mysqli_query($con, $query2);
  $row2=mysqli_fetch_array($results2);
  $Description = $row2["Discription"];
}

$sqlx = "SELECT * from `jobcardmain` where `Card Number` = '$Jobcard'";  
$resultx = mysqli_query($con, $sqlx);  
$rowx=mysqli_fetch_array($resultx);
//$job=$rowx["Card Number"];

if(empty($rowx==false)){
 echo '<script>alert("Jobcard alredy exist")</script>';

}

if(isset($_POST['submit'])){
 $Vremark=$_POST['VRemark'];
 $Vpending=$_POST['Vpending'];

 $posted='1';
 $errors= '';
 if (empty($_POST['VRemark'])==true) {
    // code...
  $errors = '<script>alert("Please enter Verification Remark")</script>';
}elseif(empty($_POST['Vok'])==true){
  $errors = '<script>alert("Please select Branch Status")</script>';
}elseif(empty($_POST['call'])==true){
  $errors = '<script>alert("Please select Call Status")</script>';
}elseif(empty($_POST['Vopen'])==true){
  $errors = '<script>alert("Please select Close ID")</script>';
}elseif(empty($rowx==false) and $Vremark != 'REJECTED'){
 $errors= '<script>alert("Jobcard alredy exist Plese type REJECTED")</script>';
}



if(empty($errors)==true){
 $Vok=$_POST['Vok'];
 $Vopen=$_POST['Vopen'];
 $call=$_POST['call'];

 if ($Vok=='YES') {
  $Vok='1';
}else{
  $Vok='0';
}

if ($call=='YES') {
  $call='1';
  $Remark='OK';
}else{
  $call='0';
  $Remark='NOT OK';
}



if ($Vopen=='YES') {
  $Vopen='0';
  $Attended='1';
}else{
  $Vopen='1';
  $Attended='0';
}

if ($Vok=='1') {
  $Remark='OK';
}else{
  $Remark='NOT OK';
}



$sql = "UPDATE `approval` SET VDate='$Date', Vby='$user', Vremark='$Vremark', Vpending='$Vpending', Vok='$Vok', vopen='$Vopen', posted='$posted' WHERE ApprovalID=$ApprovalID";
$resultupdate = mysqli_query($con,$sql);


if ($Vremark=='REJECTED') {

}else{
  $queryAdd="INSERT INTO `reference table`( `Reference`, `Card Number`, `EmployeeCode`, `VisitDate`, `User`, `BranchCode`,  `ID`) VALUES ('$refrence','$Jobcard','$EmployeeID', '$VisitDate', '$user', '$BranchCode', '$ID')" ;
  $ResultADD = mysqli_query($con,$queryAdd);

  $sql3 = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `WorkPending`, `Remark`, `GadgetID`, `EmployeeCode`) VALUES('$Jobcard', '$BranchCode', '$VisitDate', '$Vpending', '$Remark', '$GadgetID', '$EmployeeID')";

  $Result3 = mysqli_query($con,$sql3);
/*
  if ($con->query($sql3) === TRUE) {
  }else{
    echo $con->error;
  }
*/
}
if(empty($CID==false)){
  $sql2 = "UPDATE `complaints` SET Attended='$Attended', AttendDate='$VisitDate', `Call verified`='$call', `Verification remark`='$Vremark' WHERE ComplaintID='$CID'";

  if ($con->query($sql2) === TRUE) {

            //header("location:vexecutive.php?empid=$EmployeeID")
    if ($Vremark=='REJECTED') {

      header("location:/technician/rejectjobcard.php?cardno=$Jobcard&empid=$EmployeeID");
    }else{

      $sql = "UPDATE `complaints` SET `Executive Remark`='$Vremark' WHERE ComplaintID=$ID";
      $resultupdate = mysqli_query($con,$sql);
      header("location:/technician/copyjobcard.php?cardno=$Jobcard&empid=$EmployeeID");
    }
  }else{
    echo "Error updating record: in Complaints:  " . $con->error;
  }

}else{

  $sqlo = "UPDATE `orders` SET Attended='$Attended', AttendDate='$VisitDate', `Call verified`='$call', `Verification remark`='$Vremark' WHERE OrderID='$OID'";

  if ($con->query($sqlo) === TRUE) {
          //echo "Record updated successfully";
           // header("location:vexecutive.php?empid=$EmployeeID");
          //header("location:/technician/copyjobcard.php?cardno=$Jobcard&empid=$EmployeeID");
    if ($Vremark=='REJECTED') {
      $enEmployeeID=base64_encode($EmployeeID);
      header("location:/technician/rejectjobcard.php?cardno=$Jobcard&empid=$enEmployeeID");
    }else{
      $sql = "UPDATE `orders` SET `Executive Remark`='$Vremark' WHERE OrderID=$OID";
      $resultupdate = mysqli_query($con,$sql);
      $enEmployeeID=base64_encode($EmployeeID);
      header("location:/technician/copyjobcard.php?cardno=$Jobcard&empid=$enEmployeeID");
    }
  }else {
    echo  $con->error;
  }
}

}else{
  print_r($errors);
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
    <meta name="author" content="">
    <title>Verify Approvals</title>
    <!-- Bootstrap core CSS -->
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
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

    table{
      font-size: 14px;
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
            <a class="nav-link" href="/technician/editjobcard.php?apid=<?php echo $enApprovalID.'&cardno='.$enJobcard;  ?>">Edit Job Card</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search.php" target="_blank">Search Jobcard</a>
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
    <div class="table-responsive">
      <table class="table table-hover table-sm table-bordered border-primary" id="example" class="display nowrap" id="example">
        <thead>
          <tr>
            <th style="min-width:120px">Bank</th>
            <th style="min-width:120px">Zone</th>
            <th style="min-width:280px">Branch Name</th>
            <th style="min-width:50px">ID</th>
            <th style="min-width:100px">Gadget</th>
            <th style="min-width:150px">Phone No.</th>
            <th style="min-width:150px">Mobile No.</th>
            <th style="min-width:120px">Date of Visit</th>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $Bank;?></td>
            <td><?php echo $Zone;?></td>
            <td><?php echo $BranchName;?></td>
            <td><?php echo $ID;?></td>
            <td><?php echo $Gadget;?></td>
            <td><?php echo $BranchPhone;?></td>
            <td><?php echo $BranchMobile;?></td>
            <td><?php echo $VisitDate;?></td>
            
          </tr>
        </tbody>
      </table>
    </div>

    <div class="table-responsive">
      <table class="table table-hover table-sm table-bordered border-primary" id="example" class="display nowrap" id="example">
        <thead>
          <tr>
            <th style="min-width:250px">Description</th>
            <th style="min-width:100px">Job Card No.</th>
            <th style="min-width:150px">Material Consumed</th>
            <th style="min-width:150px">Estimate</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $Description;?></td>
            <td><a href="/technician/view.php?card=<?php echo base64_encode($Jobcard);?>" target="_blank"><?php echo $Jobcard;?></a></td>
            <td><a href="viewm.php?apid=<?php echo $ApprovalID;?>" target="_blank"><?php  echo $Material; ?></a></td>
            <td><a href="viewe.php?apid=<?php echo $ApprovalID;?>" target="_blank"><?php  echo $Estimate; ?></a></td>
          </tr>
        </tbody>
      </table>
    </div>

    <br>

    <legend style="text-align: center;" class="my-select">Verification Status</legend>
    <fieldset>

      <form method="POST" action="">
        <div class="row">
          <div class="form-group col-md-12">
            <label for="Branch">Verification Remark</label>
            <textarea class="form-control my-select" id="exampleFormControlTextarea1" cols="4" rows="2" name="VRemark"></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="Bank ID">Pending Work</label>

            <textarea class="form-control my-select" id="exampleFormControlTextarea1" cols="4" rows="2" name="Vpending"></textarea>
          </div>
          <div class="form-group col-md-4">
            <h5><label for="Branch">Branch OK</label></h5>
            <input type="radio" name="Vok" id="Vok" value="YES">
            <label for="yes">Yes</label>
            &nbsp;
            <input type="radio" id="Vok" name="Vok" value="NO">
            <label for="no">No</label>

          </div>

          <div class="form-group col-md-4">
            <h5><label for="Branch">Call Verified</label></h5>
            <input type="radio" name="call" id="call" value="YES">
            <label for="yes">Yes</label>
            &nbsp;
            <input type="radio" id="call" name="call" value="NO">
            <label for="no">No</label>

          </div>

          <div class="form-group col-md-4">
            <h5><label for="Branch">Close ID</label></h5>
            <input type="radio" name="Vopen" id="Vopen" value="YES">
            <label for="yes">Yes</label>
            &nbsp;
            <input type="radio" id="Vopen" name="Vopen" value="No">
            <label for="no">No</label>

          </div>
        </div>  
        <br><br>
        <center>

          <input type="submit"  class=" btn btn-primary my-button" value="submit" name="submit"></input>
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
  </script>


</body>
</html>
<?php 
$con -> close();
$con2 -> close();
?> 