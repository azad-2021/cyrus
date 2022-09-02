<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$link='';
$EXEID=$_SESSION['userid'];

$jobcard = base64_decode($_GET['cardno']);
$BranchCode = base64_decode($_GET['brcode']);
//echo "$jobcard";
$JOBCARD=$jobcard;


$query ="SELECT * FROM `jobcardmain` WHERE `Card Number`='$jobcard'";
$results = mysqli_query($con, $query);
$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
$GadgetID=$row["GadgetID"];
$VisitDate=$row["VisitDate"];
$EmployeeID=$row["EmployeeCode"];
$enEmployeeID=base64_encode($EmployeeID);

$q ="SELECT * FROM `employees` WHERE `EmployeeCode`='$EmployeeID'";
$r = mysqli_query($con, $q);
$ro=mysqli_fetch_array($r,MYSQLI_ASSOC);
$EmployeeName=$ro["Employee Name"];


$query ="SELECT * FROM `gadget` WHERE `GadgetID`=$GadgetID";
$results2 = mysqli_query($con, $query);
$row2=mysqli_fetch_array($results2,MYSQLI_ASSOC);
$Gadget=$row2["Gadget"];


$queryBranch ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
$resultBranch = mysqli_query($con, $queryBranch);
$row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
$Branch=$row4["BranchName"];
//$BranchCode=$row4["BranchCode"];
$ZoneCode= $row4["ZoneRegionCode"];

$queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
$resultZone = mysqli_query($con, $queryZone);
$row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
$Zone=$row2["ZoneRegionName"];
$BankCode=$row2["BankCode"];

$queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
$resultBank = mysqli_query($con, $queryBank);
$row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
$Bank=$row3["BankName"];


if (strpos($jobcard, 'AMC') == true) {

    $s=substr($jobcard, 0,-1) ;
    $s=substr($s, 0,-1) ;
    $jobcard=substr($s, 0,-1) ;
}



$s=substr($jobcard,-1) ;
   // echo $s;


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
}

}


}
//echo $jobcard;
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Jobcard Entry</title>
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
</head>
<body>
    <?php 

    include"navbar.php";
    if ($link=='Alarm') {
     ?>
     <div class="container div">

        <main>
            <div class="table-responsive">
                <table class=" row-border table table-hover table-dark table-bordered border-primary" style="width:100%">
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
                          <td><?php echo $VisitDate ?></td>
                          <td><?php echo $EmployeeName ?></td>
                      </tr>
                      <tbody>
                      </table>
                  </div>
                  <div class="row g-3">
                    <div class="col-md-12">
                        <h4 class="mb-3" align="center">Alarm Jobcard Entry</h4>
                        <form class="needs-validation form-control novalidate my-select4" method="POST">
                            <div class="row g-3">
                                <div class="col-sm-4 div">
                                    <label for="Show Jobcard Number" class="form-label">Arrival Time</label>
                                    <input type="time" class="form-control my-select3" placeholder="" name="Arrival" required>
                                    <div class="invalid-feedback">
                                        Valid time is required.
                                    </div>

                                </div>
                                <div class="col-sm-4 div">
                                    <label for="Departure Time" class="form-label">Departure Time</label>
                                    <input type="time" class="form-control my-select3" placeholder="" name="Departure" required>
                                </div>
                                <div class="col-sm-4 div">
                                    <label for="Verified By" class="form-label">Verified By</label>
                                    <input type="text" class="form-control my-select2" placeholder="" name="VerifiedBy">
                                </div>
                                <div class="col-sm-6 div">
                                    <label for="Service Done" class="form-label">Service Done</label>
                                    <textarea class="form-control my-select2" id="exampleFormControlTextarea1" rows="3" name="ServiceDone" required></textarea>
                                    <div class="invalid-feedback">
                                        Valid Service Done is required.
                                    </div>
                                </div>
                                <div class="col-sm-6 div">
                                    <label for="Pending Work" class="form-label">Pending Work</label>
                                    <textarea class="form-control my-select2" id="exampleFormControlTextarea1" rows="3" name="PendingWork"></textarea>
                                </div>
                            </div>
                            <center>

                                <div class="col-sm-6">
                                    <button class="btn btn-primary my-button" type="submit" name="submit">Submit</button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </main>
            
            <?php 
        }elseif($link=='CCTV'){

         ?>
         <div class="container div">
            <main>
                <div class="table-responsive">
                    <table class=" row-border table table-hover table-dark table-bordered border-primary" style="width:100%">
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
                              <td><?php echo $VisitDate ?></td>
                              <td><?php echo $EmployeeName ?></td>
                          </tr>
                          <tbody>
                          </table>
                      </div>
                      <div class="row g-3">
                        <div class="col-md-12">
                            <h4 class="mb-3" align="center">CCTV Jobcard Entry</h4>
                            <form class="needs-validation form-control novalidate my-select4" method="POST">
                                <div class="row g-3">

                                    <div class="col-sm-3 div">
                                        <label for="Show Jobcard Number" class="form-label">Arrival Time</label>
                                        <input type="time" class="form-control my-select3" placeholder="" name="Arrival" required>
                                    </div>
                                    <div class="col-sm-3 div">
                                        <label for="Show Jobcard Number" class="form-label">Departure Time</label>
                                        <input type="time" class="form-control my-select3" placeholder="" name="Departure" required>
                                    </div>
                                    <div class="col-sm-3 div">
                                        <label for="Total HDD" class="form-label">Total HDD</label>
                                        <input type="number" class="form-control my-select2" placeholder="" name="THDD">
                                    </div>
                                    <div class="col-sm-3 div">
                                        <label for="Allocated HDD" class="form-label">Allocated HDD</label>
                                        <input type="number" class="form-control my-select2" placeholder="" name="AHDD">
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
                                <input type="text" class="form-control my-select2" placeholder="DVR Make" name="DVR">
                            </div>
                            <div class="col-sm-3 div">
                                <label class="form-label" for="Camera Type">Types Of Camera Installed</label>
                                <input type="number" class="form-control my-select2" placeholder="" name="Camera">
                            </div>
                            <div class="col-sm-3 div">
                                <label for="last recording date" class="form-label">Days of No Recording</label>
                                <input type="number" class="form-control my-select2" placeholder="" name="NoRecording">
                            </div>
                            <div class="col-sm-3 div">
                                <label for="Show Jobcard Number" class="form-label">Verified By</label>
                                <input type="text" class="form-control my-select2" placeholder="" name="VerifiedBy">
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
                <textarea class="form-control my-select2" id="exampleFormControlTextarea1" rows="3" name="ServiceDone" required></textarea>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="col-sm-6 div">
                <label for="Pending Work" class="form-label">Pending Work</label>
                <textarea class="form-control my-select2" id="exampleFormControlTextarea1" rows="3" name="PendingWork"></textarea>
            </div>
        </div>
        <center>
            <div class="col-sm-3 div">
                <label for="first recording date" class="form-label">First Stored Recording Date</label>
                <input type="datetime-local" class="form-control my-select3" placeholder="" name="FDate">
            </div>
            <div class="col-sm-3 div">
                <label for="last recording date" class="form-label">Last Stored Recording Date</label>
                <input type="datetime-local" class="form-control my-select3" placeholder="" name="LDate">
            </div>
            <div class="col-sm-6">
                <button class="btn btn-primary my-button" type="submit" name="submit">Submit</button>
            </div>
        </center>
    </form>
</div>
</div>
</main>

<?php 
}

?>
<footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">2021 © Cyrus Electronics Pvt. Ltd.</p>
</footer>
</div>
<script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
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
    </script>
</body>
</html>

<?php 

//echo $s;
$con -> close();
$con2 -> close();



?>