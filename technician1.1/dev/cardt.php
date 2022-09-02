<?php 

include 'connection.php';
include 'session.php';
$OID = $_GET['oid'];
$complaintID = $_GET['cid'];
$EmployeeUID = $_GET['eid'];
$BranchCode = $_GET['brcode'];
$ZoneCode = $_GET['zcode'];
$GadgetID = $_GET['gid'];
$AMCID = $_GET['amcid'];

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

if(empty($GadgetID)==true){

  $querygadget="SELECT * FROM gadget";
  $resultGadget=mysqli_query($con2,$querygadget);
}else{
  $querygadget="SELECT * FROM gadget where GadgetID=$GadgetID";
  $resultGadget=mysqli_query($con2,$querygadget);
}

function getjobcard() {
  if(isset($_POST['jobcard'])){
    $job = $_POST['jobcard'];
   // $job =strtoupper($jobcard);
    $input = preg_replace("/[^a-zA-Z0-9]+/", "", $job);
    $jobcard=strtoupper($input);
  }
  return $jobcard;
}

function site(){
  if(isset($_POST['site'])){
    $site = $_POST['site'];
    return $site;
  }
}

function tech(){
  if(isset($_POST['addTech'])){
    $addtech = $_POST['addTech'];
    return $addtech;
  }
}

$Site = site();

if(isset($_FILES['image'])){



  if ((empty($AMCID)==false)) {
      // code...
    $OID=$AMCID;
  }
  $errors='';
  $JOBCARD = getjobcard();
  $GadgetID = $_POST['GadgetID'];

  $query ="SELECT * FROM `approval` where EmployeeID='$EmployeeUID' and posted='0' and JobCardNo='$JOBCARD'";
  $results = mysqli_query($con2, $query);
  $dataName=mysqli_fetch_assoc($results);
  if (empty($dataName)==false) {
      // code...
   
    $name = $dataName['JobCardNo']; 
  } 
  

  $AddTech = tech();
    //echo $JOBCARD;
  $file_name = $_FILES['image']['name'];
    //$file_name = 'data';
  $file_size =$_FILES['image']['size'];
  $file_tmp =$_FILES['image']['tmp_name'];
  $file_type=$_FILES['image']['type'];
  $tmp = explode('.', $_FILES['image']['name']);
  $file_ext = strtolower(end($tmp));    
  $newfilename=$JOBCARD.".".$file_ext;         
  $extensions= array("jpeg","jpg","pdf");






  if(in_array($file_ext,$extensions)=== false){
    $errors ='<script>alert("File must be JPG, JPEG or pdf")</script>';
  }elseif($file_size > 2097152){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif($file_size == 0){
    $errors ='<script>alert("File must be less than 2MB")</script>';
  }elseif(empty($JOBCARD)==true){
    $errors = '<script>alert("Please enter jobcard number")</script>';
  }elseif(empty($Site)==true){
    $errors = '<script>alert("Please select site status")</script>';
  }elseif(empty($AddTech)==true){
    $errors = '<script>alert("Please select Technician Option")</script>';
  }elseif($name==$JOBCARD){
    $errors = '<script>alert("JOBCARD already exists")</script>';
  }


  
  if(empty($errors)==true){
    $JOBCARD = getjobcard();

    if ($Site == 'OK') {
      $Status = 1;
    }elseif($Site == 'NOT OK'){
      $Status = 0;
    }

    $Upload=move_uploaded_file($file_tmp,"jobcard/".$newfilename);

    /* Insert Data into Approval database */
    if ($Upload==1) {
        // code...
      $queryAdd="INSERT INTO `approval`( `BranchCode`, `ComplaintID`, `OrderID`, `JobCardNo`, `Status`, `EmployeeID`, `VisitDate`, `GadgetID`) VALUES ('$BranchCode','$complaintID','$OID', '$JOBCARD', '$Status', '$EmployeeUID', '$Date', '$GadgetID')";
      mysqli_query($con2,$queryAdd);
    }
    $AddTech = tech();
    
    if(empty($AMCID)==false){
      $sql2 = "UPDATE  `orders` SET Attended='1' WHERE OrderID=$AMCID";
      $queryV2=mysqli_query($con2,$sql2);
    }elseif(empty($OID)==false){
      $sql3 = "UPDATE  `orders` SET Attended='1' WHERE OrderID=$OID";
      $queryV3=mysqli_query($con2,$sql3);
    }elseif(empty($complaintID)==false){
      $sql4 = "UPDATE  `complaints` SET Attended='1' WHERE ComplaintID=$complaintID";
      $queryV3=mysqli_query($con2,$sql4);
    }

    if ($AddTech=='YES') {
     header("location:technician.php?cid=$complaintID&eid=$EmployeeUID&brcode=$BranchCode&cardno=$JOBCARD&oid=$OID&site=$Status&zcode=$ZoneCode&gid=$GadgetID");
   }else{
     header("location:pro.php?cid=$complaintID&eid=$EmployeeUID&brcode=$BranchCode&oid=$OID&cardno=$JOBCARD&zcode=$ZoneCode");
   }
 }else{
  print($errors);
}



}


$con2 -> close();
$con3 -> close();
$con4 -> close();


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Job Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css"> 
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  
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
            <a class="nav-link" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" hidden="" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <br>
    <!-- Job card section -->
    <fieldset class="my-select">
      <form name="fileUpload" action = "" method = "POST" enctype = "multipart/form-data">
        <div class="row">
          <div class="col-lg-2">
            <label><h5>Job card no:</h5></label>
          </div>
          <div class="col-lg-10">
            <input type="text" class="form-control my-select" name="jobcard" style="text-transform:uppercase"  id="txtInput" onkeypress="return checkSpcialChar(event)" required>
            
          </div>
          
          <legend class="legendCard my-select">Upload Job Card File</legend>
          <input id="formFile" class="upload my-select" type = "file" name = "image" />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="files.png" width="50" height="50" />
          <br>

          <center>

            <p class="p">File must be in pdf or jpeg format with size not more than 2MB</p>
            
            <label for="Gadget"><h5>Gadget: </h5></label>
            <div class="col-lg-8">
              <select class="form-control my-select" id="exampleFormControlSelect2" name="GadgetID">
                <?php
                while($data=mysqli_fetch_assoc($resultGadget)){

                  echo '<option value='.$data['GadgetID'].'>'.$data['Gadget'].'</option>'; 
                }  
                ?>
              </select>
            </div>
            <br>
            <h5>Site Status:&nbsp;&nbsp;
              <input type="radio" name="site" id="site" value="OK">
              <label for="OK">OK</label>
              &nbsp;&nbsp;&nbsp;
              <input type="radio" id="site" name="site" value="NOT OK">
              <label for="NOT OK">Not OK</label>
            </h5>
            <br>
            <h5>More Employees:&nbsp;&nbsp;
              <input type="radio" name="addTech" id="addTech" value="YES">
              <label for="yes">Yes</label>
              &nbsp;
              <input type="radio" id="addTech" name="addTech" value="NO">
              <label for="no">No</label>
            </h5>
            <br>
            <input name="submit" class="btn btn-lg btn-success my-button" value="Submit" type = "submit"/> 
          </center>
          <br>
        </div>
      </form>
      <!-- END of Job section -->
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type = "text/javascript" >  
      function preventBack() { window.history.forward(); }  
      setTimeout("preventBack()", 0);  
      window.onunload = function () { null };  
    </script> 
  </fieldset>
</body>
</html>

