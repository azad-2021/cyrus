<?php 

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$EXEID=$_SESSION['userid'];
$Type=$_SESSION['usertype'];
$user=$_SESSION['user'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

$Hour = date('G');
if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}


$querygadget="SELECT * FROM gadget";
$resultGadget=mysqli_query($con,$querygadget);

$query="SELECT EmployeeCode, `Employee Name` FROM employees WHERE Inservice=1 Order By `Employee Name`";
$resultTech=mysqli_query($con,$query);


if(isset($_POST['submit'])){
 $BranchCode=$_POST['Branch'];
 $GadgetID=$_POST['GadgetID'];
 $VisitDate=$_POST['VisitDate'];
 //$Jobcard=$_POST['Jobcard'];
 $job = $_POST['Jobcard'];
   // $job =strtoupper($jobcard);
 $input = preg_replace("/[^a-zA-Z0-9]+/", "", $job);
 $Jobcard=strtoupper($input);
 $EmployeeID=$_POST['EmployeeID'];


 $Arrival=$_POST['Arrival'];
 $Departure=$_POST['Departure'];
 $ServiceDone=$_POST['ServiceDone'];
 $Pending=$_POST['PendingWork'];
 $VerifiedBy=$_POST['VerifiedBy'];
 $Reference=$_POST['WorkType'];
 $ID=$_POST['WorkID'];

 $Channel=$_POST['Channel'];
 if ($Channel=='4') {
  $Model='CCTVModel4';
}elseif($Channel=='8') {
  $Model='CCTVModel8';
}elseif($Channel=='16') {
  $Model='CCTVModel16';
}

if (!empty($_POST['THDD'])) {
  $THDD=$_POST['THDD'];
}else{
  $THDD=0;
}
if (!empty($_POST['AHDD'])) {
  $AHDD=$_POST['AHDD'];
}else{
  $AHDD=0;
}
if (!empty($_POST['FDate'])) {
  $FDate=$_POST['FDate'];
}else{
  $FDate=null;
}
if (!empty($_POST['LDate'])) {
  $LDate=$_POST['LDate'];
}else{
  $LDate=null;
}

if (!empty($_POST['Camera'])) {
  $Camera=$_POST['Camera'];
}else{
  $Camera=0;
}

if (isset($_POST['DVR'])) {
  $DVR=$_POST['DVR'];
}

if (!empty($_POST['NoRecording'])) {
  $NoRecording=$_POST['NoRecording'];
}else{
  $NoRecording=0;
}

if (!empty($_POST['CleaningCamera'])) {
  $CleaningCamera=$_POST['CleaningCamera'];

}else{
  $CleaningCamera=0;
}

if (!empty($_POST['OpeningCleaning'])) {
  $OpeningCleaning=$_POST['OpeningCleaning'];
}else{
  $OpeningCleaning=0;
}

if (!empty($_POST['Connectors'])) {
  $Connector=$_POST['Connectors'];
}else{
  $Connector=0;
}

if (!empty($_POST['PowerSupply'])) {
  $PowerSupply=$_POST['PowerSupply'];

}else{
 $PowerSupply=0; 
}






$query="SELECT `Card Number` FROM jobcardmain WHERE `Card Number`='$Jobcard'";
$result=mysqli_query($con,$query);
if (mysqli_num_rows($result)>0)
{  
  echo '<script>alert("Jobcard alredy exist")</script>';

}else{


  if ($GadgetID==1) {

    if (!empty($Model) and !empty($_POST['FDate'])) {
      $sql2 = "INSERT INTO jobcardcctv (`Card Number`, `CCTVMake`, `$Model`, `CamerNumber`, `RecordingFrom`, `RecordingUpto`, `NoRecording`, `HDDTotal`, `HDDAllocated`, `OpeningCleaning`, `CheckingBNC`, `CheckingPowerSupply`)
      VALUES ('$Jobcard', '$DVR', '1', '$Camera', '$FDate', '$LDate', '$NoRecording', '$THDD', '$AHDD', '$OpeningCleaning', '$Connector', '$PowerSupply')";
    }else{

      $sql2 = "INSERT INTO jobcardcctv (`Card Number`, `CCTVMake`, `CamerNumber`, `NoRecording`, `HDDTotal`, `HDDAllocated`, `OpeningCleaning`, `CheckingBNC`, `CheckingPowerSupply`)
      VALUES ('$Jobcard', '$DVR', '$Camera', $NoRecording, $THDD, $AHDD, $OpeningCleaning, $Connector, $PowerSupply)";
    }

    if ($con->query($sql2) === TRUE) {
          //echo '<script>alert("Record Added")</script>';
      //header("location:jobcardentry.php?empid=$enEmployeeID");
      $myfile = fopen("success_cctv.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $Jobcard);
      fclose($myfile);
    } else {
      echo "Error: " . $sql2 . "<br>" . $con->error;
      $myfile = fopen("errcctv.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
    }
  }





  $sql = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `GadgetID`, `EmployeeCode`, `ServiceDone`, `WorkPending`, `TimeofArrivial`, `TimeofDeparture`, `VerifiedBy`) VALUES('$Jobcard', '$BranchCode', '$VisitDate',  '$GadgetID', '$EmployeeID', '$ServiceDone', '$Pending', '$Arrival', '$Departure', '$VerifiedBy')";

  if ($con->query($sql) === TRUE) {

    $sql2="INSERT INTO `reference table`( `Reference`, `Card Number`, `EmployeeCode`, `VisitDate`, `User`, `BranchCode`,  `ID`) VALUES ('$Reference','$Jobcard','$EmployeeID', '$VisitDate', '$user', '$BranchCode', '$ID')" ;

    if ($con->query($sql2) === TRUE) {

    } else {
      echo "Error: " . $sql2 . "<br>" . $con->error;
    }


  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }


}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Jobcard Entry</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/sweetalert.min.js"></script>
  <style type="text/css">
  div{

  }
</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/cyrus logo.png" alt="">
        <span class="d-none d-lg-block">Cyrus</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <?php echo $wish; ?>
    </div>
    <?php 
    include "nav.php";
    //include "modals.php";

    ?>

  </header><!-- End Header -->
  <?php 
  include "sidebar.php";
  include "modals.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Add Jobcard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="row">
      <div class="col-md-12">
        <h4 class="mb-3" align="center">Add Job Card</h4>
        <form class="form-control rounded-corner" method="POST">
          <div class="row">

            <div class="col-lg-3 ">
              <label for="Verified By" class="form-label">Bank</label>
              <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                <option value="">Bank</option>
                <?php
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
                }
                ?>
              </select>
            </div>

            <div class="col-lg-3">
              <label for="Verified By" class="form-label">Zone</label>
              <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>

            <div class="col-lg-3 div">
              <label for="Verified By" class="form-label">Branch</label>
              <select id="Branch" class="form-control rounded-corner" name="Branch" required>
                <option value="">Branch</option>
              </select>
            </div>

            <div class="col-lg-3 div">
              <label for="Verified By" class="form-label">Gadget</label>
              <select class="form-control rounded-corner" id="Gadget" name="GadgetID" required>
                <option value="">Select</option>
                <?php
                while($data=mysqli_fetch_assoc($resultGadget)){

                  echo '<option value='.$data['GadgetID'].'>'.$data['Gadget'].'</option>'; 
                }  
                ?>
              </select>
            </div>

            <div class="col-lg-3 div">
              <label for="Show Jobcard Number" class="form-label">Select Service Engineer</label>
              <select class="form-control rounded-corner" id="EmployeeCodeJ" name="EmployeeID" required>
                <option value="">Select</option>
                <?php
                while($data2=mysqli_fetch_assoc($resultTech)){

                  echo '<option value='.$data2['EmployeeCode'].'>'.$data2['Employee Name'].'</option>'; 
                }  
                ?>
              </select>
            </div>

            <div class="col-lg-3 div">
              <label for="Show Jobcard Number" class="form-label">Work Type</label>
              <select class="form-control rounded-corner" name="WorkType" id="WorkType">
                <option value="">Select</option>
                <option value="Order">Order</option>
                <option value="Complaint">Complaint</option>
              </select>
            </div>

            <div class="col-lg-3 div">
              <label for="Visit Date" class="form-label">Date of Visit</label>
              <input type="date" class="form-control rounded-corner" placeholder="" id="VisitDate" name="VisitDate" required>
            </div>

            <div class="col-lg-3 div">
              <label for="WorkID" class="form-label">Select Work ID</label>
              <select class="form-control rounded-corner" id="WorkID" name="WorkID" required>
                <option value="">select</option>
              </select>
            </div>

            <div class="col-lg-3 div">
              <label for="Departure Time" class="form-label">Jobcard Number</label>
              <input type="text" class="form-control rounded-corner" placeholder="" name="Jobcard" style="text-transform: uppercase;" required>
            </div>

            <div class="col-lg-3 div">
              <label for="Show Jobcard Number" class="form-label">Arrival Time</label>
              <input type="time" class="form-control rounded-corner" placeholder="" name="Arrival" required>
            </div>

            <div class="col-lg-3 div">
              <label for="Show Jobcard Number" class="form-label">Departure Time</label>
              <input type="time" class="form-control rounded-corner" placeholder="" name="Departure" required>
            </div>

            <div class="col-lg-3">
              <label for="Show Jobcard Number" class="form-label">Verified By</label>
              <input type="text" class="form-control rounded-corner" placeholder="" name="VerifiedBy">
              <br>
            </div>   

            <section id="Des">
              <div class="row">

                <div class="col-lg-3" style="margin-top: 50px;">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="4" id="flexCheckDefault" name="Channel">
                    <label class="form-check-label" for="flexCheckDefault">
                      4 Channel
                    </label>
                  </div>
                </div>
                <div class="col-lg-3" style="margin-top: 50px;">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="8" id="flexCheckDefault" name="Channel">
                    <label class="form-check-label" for="flexCheckDefault">
                      8 Channel
                    </label>
                  </div>
                </div>

                <div class="col-lg-3" style="margin-top: 50px;"> 
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="16" id="flexCheckDefault" name="Channel">
                    <label class="form-check-label" for="flexCheckDefault">
                      16 Channel
                    </label>
                  </div>
                  <br>
                </div>
                <div class="col-lg-3">
                  <label class="form-label" for="flexCheckDefault">DVR Make</label>
                  <input type="text" class="form-control rounded-corner" placeholder="DVR Make" name="DVR">
                </div>
                <div class="col-lg-3" >
                  <label for="Total HDD" class="form-label">Total HDD</label>
                  <input type="number" class="form-control rounded-corner" placeholder="" name="THDD">
                </div>
                <div class="col-lg-3">
                  <label for="Allocated HDD" class="form-label">Allocated HDD</label>
                  <input type="number" class="form-control rounded-corner" placeholder="" name="AHDD">
                </div>
                
                <div class="col-lg-3">
                  <label class="form-label" for="Camera Type">Types Of Camera Installed</label>
                  <input type="number" class="form-control rounded-corner" placeholder="" name="Camera">
                </div>
                <div class="col-lg-3">
                  <label for="last recording date" class="form-label">Days of No Recording</label>
                  <input type="number" class="form-control rounded-corner" placeholder="" name="NoRecording">
                  <br>
                </div>
                
                <div class="form-check col-lg-3">
                  <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="OpeningCleaning">
                  <label class="form-check-label" for="flexCheckDefault">
                    Opening and cleaning of DVR/PC
                  </label>
                </div>
                <div class="form-check col-lg-3">
                  <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="CleaningCamera">
                  <label class="form-check-label" for="flexCheckChecked">
                    Checking and Cleaning Cameras
                  </label>
                </div>
                <div class="form-check col-lg-3">
                  <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="Connectors">
                  <label class="form-check-label" for="flexCheckDefault">
                    Checking of Connectors
                  </label>
                </div>
                <div class="form-check col-lg-3">
                  <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="PowerSupply">
                  <label class="form-check-label" for="flexCheckChecked">
                    Checking Power Supply
                  </label>
                </div>
                

                <div class="col-lg-6">
                  <label for="first recording date" class="form-label">First Stored Recording Date</label>
                  <input type="date" class="form-control rounded-corner" placeholder="" name="FDate">
                </div>
                <div class="col-lg-6">
                  <label for="last recording date" class="form-label">Last Stored Recording Date</label>
                  <input type="date" class="form-control rounded-corner" placeholder="" name="LDate">
                </div>
              </div>

            </section>

            <div class="col-lg-6">
              <label for="Service Done" class="form-label">Service Done</label>
              <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" rows="3" name="ServiceDone" required></textarea>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
            <div class="col-lg-6">
              <label for="Pending Work" class="form-label">Pending Work</label>
              <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" rows="3" name="PendingWork"></textarea>
            </div>



            <center>
              <br>
              <div class="col-lg-6">
                <button class="btn btn-primary my-button" type="submit" name="submit">Submit</button>
              </div>
            </center>
          </form>
        </div>
      </div>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer" style="margin-top: 200px;">
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
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="ajax-script.js"></script>
    <script type="text/javascript">

      (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
      })()


      $(document).on('change','#Gadget', function(){
        var GadgetID = $(this).val();
        console.log(GadgetID);
        if (GadgetID==1) {
/*
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          document.getElementById("").disabled=false;
          */  
          var nodes = document.getElementById("Des").getElementsByTagName('*');
          for(var i = 0; i < nodes.length; i++){
            nodes[i].disabled = false;
          }

        }else{
          var nodes = document.getElementById("Des").getElementsByTagName('*');
          for(var i = 0; i < nodes.length; i++){
           nodes[i].disabled = true;
         }
       }


     });

      $(document).on('change','#VisitDate', function(){
        var BranchCode=document.getElementById("Branch").value;
        var VisitDate=document.getElementById("VisitDate").value;
        var EmployeeCode=document.getElementById("EmployeeCodeJ").value;
        var Reference=document.getElementById("WorkType").value;

        if (Reference=='') {
          swal("error","Please select work type","error");
          document.getElementById("VisitDate").value='';
        }else if(BranchCode==''){
          swal("error","Please select branch","error");
          document.getElementById("VisitDate").value='';
        }else if(EmployeeCode==''){
          swal("error","Please select service engineer","error");
          document.getElementById("VisitDate").value='';
        }


        if (BranchCode && VisitDate && EmployeeCode && Reference) {
          $.ajax({
            url:"dataget.php",
            method:"POST",
            data:{BranchCodeJ:BranchCode, VisitDate:VisitDate, EmployeeCodeJ:EmployeeCode, Reference:Reference},
            success:function(data){
              $('#WorkID').html(data);
            }
          });
        }else{
          $('#WorkID').html('<option value="">select</option>'); 
        }

      });
    </script>

  </body>

  </html>

  <?php 
  $con->close();
  $con2->close();
?>