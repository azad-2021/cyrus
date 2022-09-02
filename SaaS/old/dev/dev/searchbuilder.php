
<?php 

include 'connection.php';
//include 'session.php';

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));
$querygadget="SELECT * FROM gadget";
$resultGadget=mysqli_query($con,$querygadget);
/*
$query="SELECT * FROM employees WHERE Inservice=1 Order By `Employee Name`";
$resultTech=mysqli_query($con,$query);
*/
$Date="2021-08-20 00:00:00";
$query ="SELECT * FROM `reference table` Where VisitDate>='$Date'";
$results = mysqli_query($con, $query); 
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
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.0/css/searchBuilder.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">





</head>

<body>
  <?php 
  include 'navbar.php';
  ?>
  <br><br>
  <div class="container">
    <h4 class="mb-3" align="center">Details</h4> 
    <div class="table-responsive">  
      <table class="table table-hover table-bordered border-primary" id="example"> 
        <thead> 
          <tr> 
            <th>Bank</th>
            <th>Zone</th>
            <th>Branch</th>
            <th>Reference</th>
            <th>ID</th>
            <th>Jobcard Number</th>
            <th>Date of Visit</th>
            <th>Action</th>   
          </tr>                     
        </thead>                 
        <tbody> 
          <?php  
          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){
            $Reference=$row["Reference"];
            $ID=$row["ID"]; 
            $BranchCode=$row["BranchCode"];
            $enBranchCode=base64_encode($BranchCode);
            $enJobcard=base64_encode($row["Card Number"]);
            $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
            $result = mysqli_query($con, $query);
            $row1=mysqli_fetch_array($result);
            $ZoneCode=$row1["ZoneRegionCode"];

            $orgDate = $row["VisitDate"];  
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
            <td>'.$Reference.'</td> 
            <td>'.$ID.'</td> 
            <td>'.$row["Card Number"].'</td>
            <td>'.$Visit.'</td>
            <td><a target="blank" href=details.php?id='.base64_encode($ID).'&ref='.base64_encode($Reference).'>View Details</a></td>                        
            </tr>  
            ';  
            $Visit='';}  


            ?> 

          </table>  
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
        <script type="text/javascript">
          $(document).ready(function() {
            $('#example').DataTable( {
              buttons:[
              {
                extend: 'searchBuilder',
                config: {
                  depthLimit: 2
                }
              }
              ],
              dom: 'Bfrtip',
              responsive: true,
            });
          });
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/searchbuilder/1.3.0/js/dataTables.searchBuilder.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
      </body>
      </html>
      <?php 
      $con -> close();
      $con2 -> close();
    ?> 