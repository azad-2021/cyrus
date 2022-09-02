
<?php 

include 'connection.php';
include 'session.php';

$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));
$querygadget="SELECT * FROM gadget";
$resultGadget=mysqli_query($con,$querygadget);

$query="SELECT * FROM employees WHERE Inservice=1 Order By `Employee Name`";
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

 $sql3 = "INSERT INTO `jobcardmain` (`Card Number`, `BranchCode`, `VisitDate`, `GadgetID`, `EmployeeCode`) VALUES('$Jobcard', '$BranchCode', '$VisitDate',  '$GadgetID', '$EmployeeID')";

 $Result3 = mysqli_query($con,$sql3);
header('location:reporting.php');
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_SESSION['user']; ?></title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <?php 
  include 'navbar.php';
  ?>
  <br><br>
  <div class="container">
   <div class="row g-3">
    <div class="col-md-12">
      <h4 class="mb-3" align="center">Add Job Card</h4>
      <form class="needs-validation form-control novalidate my-select4" method="POST">
        <div class="row g-3">

          <div class="col-sm-3 div">
            <label for="Verified By" class="form-label">Bank</label>
            <select id="Bank" class="form-control my-select3" name="Bank" required>
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
          <div class="col-sm-3 div">
            <label for="Verified By" class="form-label">Zone</label>
            <select id="Zone" class="form-control my-select3" name="Zone" required>
              <option value="">Zone</option>
            </select>
          </div>
          <div class="col-sm-3 div">
            <label for="Verified By" class="form-label">Branch</label>
            <select id="Branch" class="form-control my-select3" name="Branch" required>
              <option value="">Branch</option>
            </select>
          </div>
          <div class="col-sm-3 div">
            <label for="Verified By" class="form-label">Gadget</label>
            <select class="form-control my-select3" id="exampleFormControlSelect2" name="GadgetID" required>
              <option value="">Select</option>
              <?php
              while($data=mysqli_fetch_assoc($resultGadget)){

                echo '<option value='.$data['GadgetID'].'>'.$data['Gadget'].'</option>'; 
              }  
              ?>
            </select>
          </div>
          <div class="col-sm-4 div">
            <label for="Show Jobcard Number" class="form-label">Select Service Engineer</label>
            <select class="form-control my-select3" id="exampleFormControlSelect2" name="EmployeeID" required>
              <option value="">Select</option>
              <?php
              while($data2=mysqli_fetch_assoc($resultTech)){

                echo '<option value='.$data2['EmployeeCode'].'>'.$data2['Employee Name'].'</option>'; 
              }  
              ?>
            </select>
          </div>
          <div class="col-sm-4 div">
            <label for="Departure Time" class="form-label">Jobcard Number</label>
            <input type="text" class="form-control my-select2" placeholder="" name="Jobcard" style="text-transform: uppercase;" required>
          </div>

          <div class="col-sm-3 div">
            <label for="Total HDD" class="form-label">Date of Visit</label>
            <input type="date" class="form-control my-select3" placeholder="" name="VisitDate" required>
          </div>
          <center>

            <div class="col-sm-6">
              <button class="btn btn-primary my-button" type="submit" name="submit">Submit</button>
            </div>
          </center>
        </form>
      </div>
    </div>
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
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="ajax-script.js" type="text/javascript"></script>
      </body>
      </html>
