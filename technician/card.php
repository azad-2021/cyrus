<?php 
include 'connection.php';
include 'session.php';

$EmployeeCode=$_SESSION['empid'];

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));
$NintyDays = date('Y-m-d', strtotime($Date. ' - 90 days'));

$Hour = date('G');

if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['Tuser'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['Tuser'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['Tuser'];
}

$OID = 0;
$complaintID=0;
if (!empty($_GET['cid'])) {
  $complaintID = $_GET['cid'];
}

if (!empty($_GET['oid'])) {
  $OID = $_GET['oid'];
}

$BranchCode = $_GET['brcode'];
$ZoneCode = $_GET['zcode'];
$GadgetID = $_GET['gid'];
$AMCID = $_GET['amcid']; 
$PostedDate=$_GET['PostedDate']; 


if (isset($_GET['Rej'])) {
 $Rej= $_GET['Rej'];
 $_SESSION['Rej']=$Rej;
}else{
  $Rej=0;
  $_SESSION['Rej']=0;
}


$LDate =date('Y-m-d',strtotime($timestamp));
$dedline = date('Y-m-d', strtotime($LDate. ' -2 days'));
//echo $dedline;
if(empty($GadgetID)==true){

  $querygadget="SELECT * FROM cyrusbackend.gadget";
  $resultGadget=mysqli_query($con,$querygadget);
}else{
  $querygadget="SELECT * FROM cyrusbackend.gadget where GadgetID=$GadgetID";
  $resultGadget=mysqli_query($con,$querygadget);
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

  $JOBCARD = getjobcard();
  $errors='';
  $AMCR=0;
  if ((empty($AMCID)==false)) {
    $JOBCARD=$JOBCARD.'AMC';
    $OID=$AMCID;
  }else{
    $query ="SELECT * FROM orders where Discription like '%AMC%' and AssignDate is not null and Attended=0 and BranchCode=$BranchCode and EmployeeCode=$EmployeeCode";
    $resultAMC = mysqli_query($con, $query);
    if (mysqli_num_rows($resultAMC)>0){
      $AMCR=1;
    }else{
      $AMCR=0;
    }
  }
  $GadgetID = $_POST['GadgetID'];
  $VisitDate=$_POST['VisitDate'];

  $query ="SELECT * FROM `approval` where JobCardNo='$JOBCARD' and posted=0";
  $result = mysqli_query($con, $query);

  $query2 ="SELECT * FROM `jobcardmain` where `Card Number`='$JOBCARD'";
  $result2 = mysqli_query($con, $query2);

  if (mysqli_num_rows($result)>0){
    $dataName=mysqli_fetch_assoc($result);
    $name = $dataName['JobCardNo']; 
  }elseif (mysqli_num_rows($result2)>0){
    $dataName=mysqli_fetch_assoc($result2);
    $name = $dataName['Card Number']; 
  }

  $AddTech = tech();
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
  }elseif($VisitDate<$PostedDate){
    $errors = '<script>alert("Visit Date must be greater than Posted Date")</script>';
  }elseif($VisitDate>$LDate){
    $errors = '<script>alert("Visit Date must be less than or equal to current Date")</script>';
  }elseif($AMCR==1){
    $errors = '<script>alert("AMC Visit is due on this branch, Please complete it")</script>';
  }



  if(empty($errors)==true){
    $JOBCARD = getjobcard();
    if ((empty($AMCID)==false)) {
      $JOBCARD=$JOBCARD.'AMC';
    }

    if (isset($_POST['VisitDate'])) {
      $Date = $_POST['VisitDate'];
      $_SESSION['VisitDate']=$Date;
    }


    if ($Site == 'OK') {
      $Status = 1;
    }elseif($Site == 'NOT OK'){
      $Status = 0;
    }

    $Upload=move_uploaded_file($file_tmp,"jobcard/".$newfilename);

    /* Insert Data into Approval database */
    if ($Upload==1) {
        // code...
      $queryAdd="INSERT INTO `approval`( `BranchCode`, `ComplaintID`, `OrderID`, `JobCardNo`, `Status`, `EmployeeID`, `VisitDate`, `GadgetID`) VALUES ('$BranchCode','$complaintID','$OID', '$JOBCARD', '$Status', '$EmployeeCode', '$VisitDate', '$GadgetID')";
      //mysqli_query($con,$queryAdd);
      if ($con->query($queryAdd) === TRUE) {
        $_SESSION['apid']=$con->insert_id;
      }else {
        echo "Error: " . $sql . "<br>" . $con->error;
        $myfile = fopen("errapp.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $con->error);
        fclose($myfile);
      }
    }
    $AddTech = tech();

    if(empty($AMCID)==false){

      $sqlTS = "SELECT `TimeStamp` from orders WHERE OrderID=$AMCID and `TimeStamp` is not null";
      $resultTS=mysqli_query($con,$sqlTS);

      if (mysqli_num_rows($resultTS)>0) {
        $sql2 = "UPDATE  `orders` SET Attended='1' WHERE OrderID=$AMCID";
      }else{
        $sql2 = "UPDATE  `orders` SET Attended='1', `TimeStamp`='$timestamp' WHERE OrderID=$AMCID";
      }


      $queryV2=mysqli_query($con,$sql2);
    }elseif(empty($OID)==false){

      $sqlTS = "SELECT `TimeStamp` from orders WHERE OrderID=$OID and `TimeStamp` is not null";
      $resultTS=mysqli_query($con,$sqlTS);

      if (mysqli_num_rows($resultTS)>0) {

        $sql3 = "UPDATE  `orders` SET Attended='1' WHERE OrderID=$OID";


      }else{
        $sql3 = "UPDATE  `orders` SET Attended='1', `TimeStamp`='$timestamp' WHERE OrderID=$OID";
      }

      $queryV3=mysqli_query($con,$sql3);
    }elseif(empty($complaintID)==false){

      $sqlTS = "SELECT `TimeStamp` from complaints WHERE  WHERE ComplaintID=$complaintID and `TimeStamp` is not null";
      $resultTS=mysqli_query($con,$sqlTS);
      if (mysqli_num_rows($resultTS)>0) {
        $sql4 = "UPDATE  `complaints` SET Attended='1' WHERE ComplaintID=$complaintID";

      }else{
        $sql4 = "UPDATE  `complaints` SET Attended='1', `TimeStamp`='$timestamp' WHERE ComplaintID=$complaintID";
      }

      $queryV3=mysqli_query($con,$sql4);
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


$con -> close();
$con2 -> close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Upload Jobcard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/cyrus logo.png" rel="icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  table, tr, th{
    font-size: 14px;
    align-items: center;
  }
  a {
    cursor: pointer;
    
  }


  .overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("assets/img/loader.gif") center no-repeat;
  }
  /* Turn off scrollbar when body element has the loading class */
  body.loading{
    overflow: hidden;   
  }
  /* Make spinner image visible when body element has the loading class */
  body.loading .overlay{
    display: block;
  }

</style>
</head>
<body>
 <div class="overlay"></div>
 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="assets/img/cyrus logo.png" alt="">
      <span class="d-none d-lg-block">Cyrus</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar">
    <?php echo $wish; ?>
  </div>
  <?php 
  include "nav.php";
    //include "modals.php";
  ?>
</header>
<?php 
include "sidebar.php";

?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Enter Jobcard Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">

        <center>
          <div class="pagetitle">
            <h1>Enter Details</h1>
          </div>

        </center>


        <form class="form-control rounded-corner" name="fileUpload" action = "" method = "POST" enctype = "multipart/form-data">
          <div class="row">
            <div class="col-lg-4">
              <label>Enter jobcard number</label>
              <input type="text" class="form-control rounded-corner" name="jobcard" style="text-transform:uppercase"  id="txtInput" required>            
            </div>
            <div class="col-lg-4">
              <label>Upload jobcard</label>
              <input type="file" class="form-control rounded-corner" required name = "image" / >         
            </div>

            <div class="col-lg-4">
              <label>Select Gadget</label>
              <select class="form-control rounded-corner" name="GadgetID" required>
                <?php
                if (empty($GadgetID)==true) {
                  echo '<option value="">Select</option>'; 
                }
                while($data=mysqli_fetch_assoc($resultGadget)){

                  echo '<option value='.$data['GadgetID'].'>'.$data['Gadget'].'</option>'; 
                }  
                ?>
              </select>
            </div>

            <div class="col-lg-4">
              <label>Select Visit Date</label>
              <input type="date" name="VisitDate" id="VisitDate" class="form-control rounded-corner" required>
            </div>

            <div class="col-lg-4" style="margin-top: 20px;">
              <label>Site Status</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="site" id="site" value="OK">
                <label class="form-check-label" for="inlineRadio1">OK</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="site" value="NOT OK">
                <label class="form-check-label" for="inlineRadio2">not OK</label>
              </div>
            </div>


            <div class="col-lg-4" style="margin-top:20px;">
              <label>More Employees</label>
              
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="addTech" id="addTech" value="YES">
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="addTech" id="addTech" value="No">
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div>
            </div>


          </div>
          <center>
            <input name="submit" class="btn btn-lg btn-primary" value="Submit" type = "submit"/>
          </center>
        </form>


      </div>



    </div>
  </div>
  <!-- End Left side columns -->
</section>

</main>
<!-- End #main -->
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright 2022 <strong><span>Cyrus</span></strong>. All Rights Reserved
  </div>
</footer>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>




<script src="assets/js/main.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  

  $(document).on('change','#VisitDate', function(){
    var VisitDate = $(this).val();
    console.log(VisitDate);
    var dedline = "<?php echo $dedline ?>"
    console.log(dedline);
    if(VisitDate<="<?php echo $dedline ?>"){
      swal("warning","यह जॉबकार्ड 2 दिन से ज्यादा पुराना है, अतः इस पर पेनल्टी लग सकती है ।", "warning");
    }
  });

</script>
</body>

</html>

<?php 

?>