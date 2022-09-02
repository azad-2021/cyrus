
<?php 

include 'connection.php';
//include 'session.php';

$EXEID=12;
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));
$querygadget="SELECT * FROM gadget";
$resultGadget=mysqli_query($con,$querygadget);
/*
$query="SELECT * FROM employees WHERE Inservice=1 Order By `Employee Name`";
$resultTech=mysqli_query($con,$query);
*/
$Date="2021-11-15 00:00:00";
$query1 ="SELECT * FROM `jobcardmain` Where VisitDate>='$Date'";
$results = mysqli_query($con, $query1); 

$query2 ="SELECT * FROM `complaints` Where AttendDate>='$Date'";
$results2 = mysqli_query($con, $query2);

$query3 ="SELECT * FROM `orders` Where AttendDate>='$Date'";
$results3 = mysqli_query($con, $query3);
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>main</title>
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
          <!--
          <div class="col-sm-3 div">
            <label for="Verified By" class="form-label">Branch</label>
            <select id="ID" class="form-control my-select3" name="Branch" required>
              <option value="">Order</option>
            </select>
          </div>-->
        </form>
        <h3 align="center">Jobcard Details</h3>  
        <br />  
        <div class="table-responsive">  
         <table class="table table-hover table-bordered border-primary" id="example"> 
          <thead> 
            <tr> 
              <th>Bank</th>
              <th>Zone</th>
              <th>Branch</th>
              <th>Jobcard Number</th>
              <th>Date of Visit</th>   
            </tr>                     
          </thead>                 
          <tbody id="ID"> 

          </tbody>
        </table> 

        <br>
        <table class="table table-hover table-bordered border-primary" id="example2"> 
          <h4>Complaints</h4>
          <thead> 
            <tr> 
              <th>Bank</th>
              <th>Zone</th>
              <th>Branch</th>
              <th>Complaint ID</th>
              <th>Made By</th>
              <th>Date of Information</th>
              <th>Assign Date</th>
              <th>Date of Visit</th>             
            </tr>                     
          </thead>                 
          <tbody> 
            <?php  
            while ($row=mysqli_fetch_array($results2,MYSQLI_ASSOC)){ 
              $BranchCode=$row["BranchCode"];
              $InfoDate=$row["DateOfInformation"];
              $AssignDate=$row["AssignDate"];
              $MadeBy=$row["MadeBy"];
              $enBranchCode=base64_encode($BranchCode);
              $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
              $result = mysqli_query($con, $query);
              $row1=mysqli_fetch_array($result);
              $ZoneCode=$row1["ZoneRegionCode"];

              $orgDate = $row["AttendDate"];  
              $date = str_replace('-"', '/', $orgDate);  
              $Visit = date("d/m/Y", strtotime($date));

              $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
              $resultZone = mysqli_query($con, $queryZone);
              $row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
              $Zone=$row2["ZoneRegionName"];
              $BankCode=$row2["BankCode"];

              $queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
              $resultBank = mysqli_query($con, $queryBank);
              $row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
              $Bank=$row3["BankName"];


              echo '  
              <td>'.$Bank.'</td>
              <td>'.$Zone.'</td>
              <td>'.$row1["BranchName"].'</td>
              <td>'.$row["ComplaintID"].'</td>
              <td>'.$MadeBy.'</td>
              <td>'.$InfoDate.'</td>
              <td>'.$AssignDate.'</td>
              <td>'.$Visit.'</td>                         
              </tr>  
              ';  
              $Visit='';}  


              ?> 

            </table>
            <br>
            <table class="table table-hover table-bordered border-primary" id="example3"> 
              <h4>Orders</h4>
              <thead> 
                <tr> 
                  <th>Bank</th>
                  <th>Zone</th>
                  <th>Branch</th>
                  <th>Order ID</th>
                  <th>Ordered By</th>
                  <th>Date of Information</th>
                  <th>Assign Date</th>
                  <th>Date of Visit</th>             
                </tr>                     
              </thead>                 
              <tbody> 
                <?php  
                while ($row=mysqli_fetch_array($results3,MYSQLI_ASSOC)){ 
                  $BranchCode=$row["BranchCode"];
                  $InfoDate=$row["DateOfInformation"];
                  $AssignDate=$row["AssignDate"];
                  $MadeBy=$row["OrderedBy"];
                  $enBranchCode=base64_encode($BranchCode);
                  $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
                  $result = mysqli_query($con, $query);
                  $row1=mysqli_fetch_array($result);
                  $ZoneCode=$row1["ZoneRegionCode"];

                  $orgDate = $row["AttendDate"];  
                  $date = str_replace('-"', '/', $orgDate);  
                  $Visit = date("d/m/Y", strtotime($date));

                  $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
                  $resultZone = mysqli_query($con, $queryZone);
                  $row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
                  $Zone=$row2["ZoneRegionName"];
                  $BankCode=$row2["BankCode"];

                  $queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
                  $resultBank = mysqli_query($con, $queryBank);
                  $row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
                  $Bank=$row3["BankName"];


                  echo '  
                  <td>'.$Bank.'</td>
                  <td>'.$Zone.'</td>
                  <td>'.$row1["BranchName"].'</td>
                  <td>'.$row["OrderID"].'</td>
                  <td>'.$MadeBy.'</td>
                  <td>'.$InfoDate.'</td>
                  <td>'.$AssignDate.'</td>
                  <td>'.$Visit.'</td>                         
                  </tr>  
                  ';  
                  $Visit='';}  


                  ?> 

                </table>      
              </div>  
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
        <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
        "></script>

        <script>

          $(document).ready(function() {
            var table = $('#example').DataTable( {
              rowReorder: {
                selector: 'td:nth-child(2)'
              },
              responsive: true
            } );
          } );

          $(document).ready(function() {
            var table = $('#example2').DataTable( {
              rowReorder: {
                selector: 'td:nth-child(2)'
              },
              responsive: true
            } );
          } );
          $(document).ready(function() {
            var table = $('#example3').DataTable( {
              rowReorder: {
                selector: 'td:nth-child(2)'
              },
              responsive: true
            } );
          } );

        </script>
      </body>
      </html>
