<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$query ="SELECT * FROM `orders` WHERE Installed='1' and `SimProvider`='Cyrus' ORDER BY OrderID DESC";
$results = mysqli_query($con, $query); 
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
 <title>Completed Orders</title>
 <link rel="icon" href="cyrus logo.png" type="image/icon type">
 <!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
 <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
 <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>  
<body>   

  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
    <div class="container-fluid" align="center">
      <a class="navbar-brand" href="index.html"><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="simtable.php">Home</a>
          </li>
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" target="blank" href="simpending.php?">Pending Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="blank" href="sim.php?">Release Sim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" target="blank" href="viewsim.php?">Active Sim Cards</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/cyrus/executive/changepass.php">Change Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br> 
  <div class="container">  
    <h3 align="center">Completed Orders</h3>  
    <br />  
    <div class="table-responsive">  
     <table class="table table-hover table-bordered border-primary" id="example" class="display nowrap"> 
      <thead> 
        <tr> 
          <th>Bank</th> 
          <th>Zone</th> 
          <th>Branch</th> 
          <th>Gadget</th>
          <th>Order Id</th>
          <th>Sim Provider</th>
          <th>Sim Type</th>
          <th>Mobile No</th> 
          <th>Sim No</th>
          <th>Operator</th> 
          <th>Sim Release Date</th>
          <th>In Use Date</th>
          <th>Activation Date</th>
          <th>Expiry Date</th>
          <th>Validity Days Left</th>
        </tr>                     
      </thead>                 
      <tbody> 
        <?php  
        while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 

          $BranchCode=$row["BranchCode"];
          $GadgetID=$row["GadgetID"];
          $Status=$row["Status"];
          $PlanLimit=$row["ValidityRecharge"];
          $OperatorID=$row["OperatorID"];
          $OrderID=$row["OrderID"];
          $SimType=$row["SimType"];
          $PlanLimit=$row["ValidityRecharge"];

          $queryP ="SELECT * FROM `production` WHERE OrderID=$OrderID";
          $resultsP = mysqli_query($con, $queryP);
          $row8=mysqli_fetch_array($resultsP,MYSQLI_ASSOC);
          $SimID=$row8["SimID"];

          $querySim ="SELECT * FROM `simprovider` WHERE ID=$SimID";
          $resultsSim = mysqli_query($con, $querySim);
          $row6=mysqli_fetch_array($resultsSim,MYSQLI_ASSOC);
          $Mobile=$row6["MobileNumber"];
          $SimNo=$row6["SimNo"];
          $ReleaseDate=$row6["ReleaseDate"];
          $IssueDate=$row6["IssueDate"];
          $Activation=$row6["ActivationDate"];
          $ExpDate=$row6["ExpDate"];

          $queryBranch ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
          $resultBranch = mysqli_query($con2, $queryBranch);
          $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
          $Branch=$row4["BranchName"];
                                //$BranchCode=$row4["BranchCode"];
          $ZoneCode= $row4["ZoneRegionCode"];

          $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
          $resultZone = mysqli_query($con2, $queryZone);
          $row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
          $Zone=$row2["ZoneRegionName"];
          $BankCode=$row2["BankCode"];

          $queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
          $resultBank = mysqli_query($con2, $queryBank);
          $row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
          $Bank=$row3["BankName"];


          $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
          $resultGadget = mysqli_query($con, $queryGadget);
          $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
          $Gadget=$row5["Gadget"];

          $dedline = date('Y-m-d', strtotime($Activation. ' + '.$PlanLimit.' months'));
          $date = str_replace('-"', '/', $dedline);  
          $dedline = date("d/m/Y", strtotime($date));

          $date = str_replace('-"', '/', $row["Date"]);  
          $Date = date("d/m/Y", strtotime($date));

          $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
          $resultsO = mysqli_query($con, $queryO);
          $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
          $Operator=$row7["Operator"];

          date_default_timezone_set('Asia/Kolkata');
          $timestamp =date('y-m-d H:i:s');
          $newtimestamp = date('Y-m-d',strtotime($timestamp));

          $datetime1 = date_create($newtimestamp);
          $datetime2 = date_create($ExpDate);

          $days = date_diff($datetime1, $datetime2);
          $d= $days->format('%R%a');
                               // echo $d;
          $Days = (int)$d;

          echo '  
          <tr>
          <td>'.$Bank.'</td> 
          <td>'.$Zone.'</td>  
          <td>'.$Branch.'</td>  
          <td>'.$Gadget.'</td>
          <td>'.$row["OrderID"].'</td>
          <td>'.$row["SimProvider"].'</td>
          <td>'.$row["SimType"].'</td>
          <td>'.$Mobile.'</td>
          <td>'.$SimNo.'</td>
          <td>'.$Operator.'</td>
          <td>'.$ReleaseDate.'</td>
          <td>'.$IssueDate.'</td>
          <td>'.$Activation.'</td> 
          <td>'.$ExpDate.'</td>
          <td>'.$Days.'</td>    
          </tr>  
          ';  
        }
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