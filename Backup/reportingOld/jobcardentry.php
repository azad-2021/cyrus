<?php

include('connection.php'); 
include 'session.php';
$Date="2021-10-07 00:00:00";
$EXEID=$_SESSION['userid'];

$EmployeeID=base64_decode($_GET['empid']);
$query ="SELECT * FROM `jobcardmain` Where EmployeeCode='$EmployeeID' and ServiceDone is null and VisitDate>='$Date'";

$results = mysqli_query($con, $query); 

$query2 ="SELECT * FROM `employees` Where EmployeeCode='$EmployeeID'";
$results2 = mysqli_query($con, $query2);
$row2=mysqli_fetch_array($results2);
$EmployeeName = $row2["Employee Name"]; 


?>

<!DOCTYPE html>  
<html>  
<head>   
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="Anant Singh Suryavanshi">
 <title><?php echo $EmployeeName; ?></title>
 <link rel="icon" href="cyrus logo.png" type="image/icon type">
 <!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
 <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
 <script src="bootstrap/js/bootstrap.bundle.min.js"></script> 
</head>  
<body>  

    <?php 
    include 'navbar.php';

    ?>
    <br /><br />


    <div class="container"> 

        <h3 align="center">Jobcard Details of <?php echo$EmployeeName; ?></h3>  
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
                  <th>Action</th>
              </tr>                     
          </thead>                 
          <tbody> 
              <?php  
              while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
                $BranchCode=$row["BranchCode"];
                $enBranchCode=base64_encode($BranchCode);
                $enJobcard=base64_encode($row["Card Number"]);
                $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
                $result = mysqli_query($con, $query);
                $row1=mysqli_fetch_array($result);
                $ZoneCode=$row1["ZoneRegionCode"];

                $orgDate = $row["VisitDate"];   
                $Visit = date("d/m/Y", strtotime($orgDate));

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
                <td>'.$row["Card Number"].'</td>
                <td>'.$Visit.'</td>                       
                <td style="text-align:center"><a href=jobcard.php?cardno='.$enJobcard.'&brcode='.$enBranchCode.'>Fill Details </a></td>  
                </tr>  
                ';  
                $Visit='';}  


                ?> 

            </table>  
        </div>  
    </div>  

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
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

    </script>
</body>
</html>
<?php 
$con -> close();
$con2 -> close();
?>