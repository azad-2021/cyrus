<?php 

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$link='';
$EXEID=$_SESSION['userid'];
$Type=$_SESSION['usertype'];
date_default_timezone_set('Asia/Calcutta');
$Hour = date('G');
if ( $Hour >= 1 && $Hour <= 11 ) {
  $wish= "Good Morning ".$_SESSION['user'];
} else if ( $Hour >= 12 && $Hour <= 15 ) {
  $wish= "Good Afternoon ".$_SESSION['user'];
} else if ( $Hour >= 19 || $Hour <= 23 ) {
  $wish= "Good Evening ".$_SESSION['user'];
}

$jobcard = base64_decode($_GET['cardno']);
$BranchCode = base64_decode($_GET['brcode']);
//echo "$jobcard";
$JOBCARD=$jobcard;
$Job=$jobcard;

$query ="SELECT * FROM `jobcardmain`
join gadget on jobcardmain.GadgetID=gadget.GadgetID
join employees on jobcardmain.EmployeeCode=employees.EmployeeCode
join branchdetails on jobcardmain.BranchCode=branchdetails.BranchCode
WHERE `Card Number`='$jobcard'";
$results = mysqli_query($con, $query);
$row=mysqli_fetch_array($results,MYSQLI_ASSOC);

$GadgetID=$row["GadgetID"];
$Gadget=$row["Gadget"];
$VisitDate=$row["VisitDate"];
$EmployeeID=$row["EmployeeCode"];
$EmployeeName=$row["Employee Name"];
$enEmployeeID=base64_encode($EmployeeID);
$Branch=$row["BranchName"];
$ZoneCode= $row["ZoneRegionCode"];       
$Zone=$row["ZoneRegionName"];
$BankCode=$row["BankCode"];
$Bank=$row["BankName"];

if (strpos($jobcard, 'AMC') == true) {
  $s=substr($jobcard,-1) ;
  if ($s!='C') {
    $jobcard=substr($jobcard, 0,-1) ;
  }
  $s=substr($jobcard, 0,-1) ;
  $s=substr($s, 0,-1) ;
  $jobcard=substr($s, 0,-1) ;
}

$s=substr($jobcard,-1) ;

if ($s == 'C') {
   //echo 'CCTV';
  $link='CCTV';
}elseif ($s == 'A') {
    //echo 'Alarm';
  $link='Alarm';
}else{
  $jobcard=substr($jobcard, 0,-1) ;
  $s=substr($jobcard, -1) ;
    //echo $s;
  if ($s == 'C') {
   //echo 'CCTV';
    $link='CCTV';
  }elseif ($s == 'A') {
    //echo 'Alarm';
    $link='Alarm';
  }
}

if (strpos(base64_decode($_GET['cardno']), 'AMC') == true) {

  $jobcard = base64_decode($_GET['cardno']);
  $s=substr($jobcard, -1) ;
  if ($s!='C') {
    $jobcard=substr($jobcard, 0,-1) ;
  }

}

if(isset($_POST['submit'])){

  $Arrival=$_POST['Arrival'];
  $Departure=$_POST['Departure'];
  $ServiceDone=$_POST['ServiceDone'];
  $Pending=$_POST['PendingWork'];
  $VerifiedBy=$_POST['VerifiedBy'];


  $sql = "UPDATE jobcardmain SET `ServiceDone`='$ServiceDone', `WorkPending`='$Pending', `TimeofArrivial`='$Arrival', `TimeofDeparture`='$Departure', `VerifiedBy`='$VerifiedBy' WHERE `Card Number`='$JOBCARD'";

  if ($con->query($sql) === TRUE) {
  //echo '<script>alert("Record Added")</script>';
    header("location:jobcardentry.php?empid=$enEmployeeID");
  } else {
    echo "Error updating record: " . $con->error;
  }

  if ($link=='CCTV') {

    $DVRMake=$_POST['DVRMake'];
    $Channel=$_POST['Channel'];
    if ($Channel=='4') {
      $Model='CCTVModel4';
    }elseif($Channel=='8') {
      $Model='CCTVModel8';
    }elseif($Channel=='16') {
      $Model='CCTVModel16';
    }

    $THDD=$_POST['THDD'];
    $AHDD=$_POST['AHDD'];
    $FDate=$_POST['FDate'];
    $LDate=$_POST['LDate'];
    $Camera=$_POST['Camera'];
    
    $DVR=$_POST['DVR'];
    $NoRecording=$_POST['NoRecording'];

    $CleaningCamera=$_POST['CleaningCamera'];
    $OpeningCleaning=$_POST['OpeningCleaning'];
    $Connector=$_POST['Connectors'];
    $PowerSupply=$_POST['PowerSupply'];

    $sql2 = "INSERT INTO jobcardcctv (`Card Number`, `CCTVMake`, $Model, CamerNumber, RecordingFrom, RecordingUpto, NoRecording, HDDTotal, HDDAllocated, OpeningCleaning, CheckingBNC, CheckingPowerSupply)
    VALUES ('$JOBCARD', '$DVR', '1', '$Camera', '$FDate', '$LDate', '$NoRecording', '$THDD', '$AHDD', '$OpeningCleaning', '$Connector', '$PowerSupply')";

    if ($con->query($sql2) === TRUE) {
          //echo '<script>alert("Record Added")</script>';
      header("location:jobcardentry.php?empid=$enEmployeeID");
    } else {
      echo "Error: " . $sql2 . "<br>" . $con->error;
      $myfile = fopen("errcctv.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

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
          <li class="breadcrumb-item active">Jobcard details of  <?php echo$EmployeeName; ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php 
    if ($link=='Alarm') {
     ?>
     <div class="table-responsive container">
      <table class="table table-hover table-bordered border-primary" width="100%">
        <thead>
          <tr>
            <th style="text-align:center">Bank</th>
            <th style="text-align:center">Zone</th>
            <th style="text-align:center">Branch</th>
            <th style="text-align:center">Jobcard</th>
            <th style="text-align:center">Gadget</th>
            <th style="text-align:center">Visit Date</th>
            <th style="text-align:center">Service Engineer</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $Bank ?></td>
            <td><?php echo $Zone ?></td>
            <td><?php echo $Branch ?></td>
            <td><a href="/technician/view.php?card=<?php echo base64_encode($jobcard);?>" target="_blank"><?php echo $JOBCARD;?></a></td>
            <td><?php echo $Gadget ?></td>
            <td><?php echo date('d-m-Y',strtotime($VisitDate)) ?></td>
            <td><?php echo $EmployeeName ?></td>
          </tr>
          <tbody>
          </table>  
        </div>
        <div class="row g-3">
          <div class="col-md-12">
            <h4 class="mb-3" align="center">Alarm Jobcard Entry</h4>
            <form class="needs-validation form-control novalidate rounded-corner" method="POST">
              <div class="row g-3">
                <div class="col-sm-4 div">
                  <label for="Show Jobcard Number" class="form-label">Arrival Time</label>
                  <input type="time" class="form-control rounded-corner" placeholder="" name="Arrival" required>
                  <div class="invalid-feedback">
                    Valid time is required.
                  </div>

                </div>
                <div class="col-sm-4 div">
                  <label for="Departure Time" class="form-label">Departure Time</label>
                  <input type="time" class="form-control rounded-corner" placeholder="" name="Departure" required>
                </div>
                <div class="col-sm-4 div">
                  <label for="Verified By" class="form-label">Verified By</label>
                  <input type="text" class="form-control rounded-corner" placeholder="" name="VerifiedBy">
                </div>
                <div class="col-sm-6 div">
                  <label for="Service Done" class="form-label">Service Done</label>
                  <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" rows="3" name="ServiceDone" required></textarea>
                  <div class="invalid-feedback">
                    Valid Service Done is required.
                  </div>
                </div>
                <div class="col-sm-6 div">
                  <label for="Pending Work" class="form-label">Pending Work</label>
                  <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" rows="3" name="PendingWork"></textarea>
                </div>
              </div>
              <center>

                <div class="col-sm-6">
                  <br>
                  <button class="btn btn-primary my-button" type="submit" name="submit">Submit</button>
                </div>
              </center>
            </form>
          </div>
        </div>
        <?php 
      }elseif($link=='CCTV'){

       ?>

       <div class="table-responsive">
        <table class=" row-border table table-hover table-bordered border-primary" style="width:100%">
          <thead>
            <tr>
              <th style="text-align:center">Bank</th>
              <th style="text-align:center">Zone</th>
              <th style="text-align:center">Branch</th>
              <th style="text-align:center">Jobcard</th>
              <th style="text-align:center">Gadget</th>
              <th style="text-align:center">Visit Date</th>
              <th style="text-align:center">Service Engineer</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $Bank ?></td>
              <td><?php echo $Zone ?></td>
              <td><?php echo $Branch ?></td>
              <td><a href="/technician/view.php?card=<?php echo base64_encode($jobcard);?>" target="_blank"><?php echo $JOBCARD;?></a></td>
              <td><?php echo $Gadget ?></td>
              <td><?php echo date('d-m-Y',strtotime($VisitDate)) ?></td>
              <td><?php echo $EmployeeName ?></td>
            </tr>
            <tbody>
            </table>
          </div>
          <div class="row g-3">
            <div class="col-md-12">
              <h4 class="mb-3" align="center">CCTV Jobcard Entry</h4>
              <form class="needs-validation form-control novalidate rounded-corner" method="POST">
                <div class="row g-3">

                  <div class="col-sm-3 div">
                    <label for="Show Jobcard Number" class="form-label">Arrival Time</label>
                    <input type="time" class="form-control rounded-corner" placeholder="" name="Arrival" required>
                  </div>
                  <div class="col-sm-3 div">
                    <label for="Show Jobcard Number" class="form-label">Departure Time</label>
                    <input type="time" class="form-control rounded-corner" placeholder="" name="Departure" required>
                  </div>
                  <div class="col-sm-3 div">
                    <label for="Total HDD" class="form-label">Total HDD</label>
                    <input type="number" class="form-control rounded-corner" placeholder="" name="THDD">
                  </div>
                  <div class="col-sm-3 div">
                    <label for="Allocated HDD" class="form-label">Allocated HDD</label>
                    <input type="number" class="form-control rounded-corner" placeholder="" name="AHDD">
                  </div>
                  <div class="col-sm-4 div">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" value="4" id="flexCheckDefault" name="Channel">
                      <label class="form-check-label" for="flexCheckDefault">
                        4 Channel
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-4 div">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" value="8" id="flexCheckDefault" name="Channel">
                      <label class="form-check-label" for="flexCheckDefault">
                        8 Channel
                      </label>
                    </div>
                  </div>

                  <div class="col-sm-4 div">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" value="16" id="flexCheckDefault" name="Channel">
                      <label class="form-check-label" for="flexCheckDefault">
                        16 Channel
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3 div">
                    <label class="form-label" for="flexCheckDefault">DVR Make</label>
                    <input type="text" class="form-control rounded-corner" placeholder="DVR Make" name="DVR">
                  </div>
                  <div class="col-sm-3 div">
                    <label class="form-label" for="Camera Type">Types Of Camera Installed</label>
                    <input type="number" class="form-control rounded-corner" placeholder="" name="Camera">
                  </div>
                  <div class="col-sm-3 div">
                    <label for="last recording date" class="form-label">Days of No Recording</label>
                    <input type="number" class="form-control rounded-corner" placeholder="" name="NoRecording">
                  </div>
                  <div class="col-sm-3 div">
                    <label for="Show Jobcard Number" class="form-label">Verified By</label>
                    <input type="text" class="form-control rounded-corner" placeholder="" name="VerifiedBy">
                  </div>   



                  <div class="form-check col-sm-3 div">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="OpeningCleaning">
                    <label class="form-check-label" for="flexCheckDefault">
                      Opening and cleaning of DVR/PC
                    </label>
                  </div>
                  <div class="form-check col-sm-3 div">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="CleaningCamera">
                    <label class="form-check-label" for="flexCheckChecked">
                      Checking and Cleaning Cameras
                    </label>
                  </div>
                  <div class="form-check col-sm-3 div">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="Connectors">
                    <label class="form-check-label" for="flexCheckDefault">
                      Checking of Connectors
                    </label>
                  </div>
                  <div class="form-check col-sm-3 div">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="PowerSupply">
                    <label class="form-check-label" for="flexCheckChecked">
                      Checking Power Supply
                    </label>
                  </div>

                  <div class="col-sm-6 div">
                    <label for="Service Done" class="form-label">Service Done</label>
                    <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" rows="3" name="ServiceDone" required></textarea>
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
                  </div>
                  <div class="col-sm-6 div">
                    <label for="Pending Work" class="form-label">Pending Work</label>
                    <textarea class="form-control rounded-corner" id="exampleFormControlTextarea1" rows="3" name="PendingWork"></textarea>
                  </div>
                </div>
                <center>
                  <div class="col-sm-3 div">
                    <label for="first recording date" class="form-label">First Stored Recording Date</label>
                    <input type="datetime-local" class="form-control rounded-corner" placeholder="" name="FDate">
                  </div>
                  <div class="col-sm-3 div">
                    <label for="last recording date" class="form-label">Last Stored Recording Date</label>
                    <input type="datetime-local" class="form-control rounded-corner" placeholder="" name="LDate">
                  </div>
                  <div class="col-sm-6">
                    <br>
                    <button class="btn btn-primary my-button" type="submit" name="submit">Submit</button>
                  </div>
                </center>
              </form>
            </div>
          </div>
          <?php 
        }

        ?>


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
      <script src="assets/js/jquery-3.6.0.min.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="ajax.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

      <script type="text/javascript">
      </script>
    </body>

    </html>

    <?php 
    $con->close();
    $con2->close();
  ?>