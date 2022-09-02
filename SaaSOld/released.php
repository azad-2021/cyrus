<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$query ="SELECT * FROM `orders` WHERE Installed='1' ORDER BY OrderID DESC";
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
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">
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
              <a class="nav-link " aria-current="page" href="ordertable.php">Home</a>
          </li>
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" href="orders.php">Add Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="released.php">Completed Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cancelorders.php">Canceled Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/cyrus/executive/changepass.php">Change Password</a>
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
              <th>Sim Provider</th>
              <th>Order Id</th>
              <th>Mobile No</th>
              <th>Sim No</th>
              <th>Order Date</th>
              <th>Order Expiry Date</th> 
              <th>Action</th>
          </tr>                     
      </thead>                 
      <tbody> 
          <?php  
          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
              {  


                $BranchCode=$row["BranchCode"];
                $GadgetID=$row["GadgetID"];
                $Status=$row["Status"];
                $PlanLimit=$row["ValidityRecharge"];
                $OrderID=$row["OrderID"];
                $Provider=$row["SimProvider"];

                $query ="SELECT SimID FROM `production` WHERE OrderID=$OrderID";
                $result = mysqli_query($con, $query);
                $rowP=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $SimID=$rowP["SimID"];

                $queryS ="SELECT * FROM `simprovider` WHERE ID=$SimID";
                $resultS = mysqli_query($con, $queryS);

                $rowS=mysqli_fetch_array($resultS,MYSQLI_ASSOC);
                $Activation=$rowS["ActivationDate"];
                $Mobile=$rowS["MobileNumber"];
                $SimNo=$rowS["SimNo"];

                if ($Status=='1') {
                                    // code...
                    $Pending='Pending On Production Stage';
                }elseif($Status=='2'){
                    $Pending='Pending from Store';
                }elseif($Status=='3'){
                    $Pending='Pending On Installation State';
                }else{
                    $Pending='Pending from Sim Provider';
                }

                $queryBranch ="SELECT * FROM branchdetails WHERE `BranchCode`='$BranchCode'";
                $resultBranch = mysqli_query($con2, $queryBranch);
                $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
                $Branch=$row4["BranchName"];
                                //$BranchCode=$row4["BranchCode"];
                $ZoneCode= $row4["ZoneRegionCode"];             
                $Zone=$row4["ZoneRegionName"];
                $Bank=$row4["BankName"];


                $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
                $resultGadget = mysqli_query($con, $queryGadget);
                $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
                $Gadget=$row5["Gadget"];

                if ($Provider=='No SIM') {
                    $dedline='';
                }else{
                    $dedline = date('Y-m-d', strtotime($row["Date"]. ' + '.$PlanLimit.' months'));
                    $date = str_replace('-"', '/', $dedline);  
                    $dedline = date("d/m/Y", strtotime($date));

                    $date = str_replace('-"', '/', $row["Date"]);  
                    $Date = date("d/m/Y", strtotime($date));
                }


                echo '  
                <tr>
                <td>'.$Bank.'</td> 
                <td>'.$Zone.'</td>  
                <td>'.$Branch.'</td>  
                <td>'.$Gadget.'</td>
                <td>'.$Provider.'</td>
                <td>'.$row["OrderID"].'</td>
                <td>'.$Mobile.'</td>
                <td>'.$SimNo.'</td>

                <td>'.$Date.'</td>
                <td>'.$dedline.'</td>  
                <td><a target="blank" href=details.php?id='.$row["OrderID"].'>View Details</a></td> 
                </tr>  
                ';  
            }}  


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
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
<script>

    $(document).ready(function() {
        var table = $('#example').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,
            stateSave: true,
        } );
    } );

</script>


</body>
</html>

<?php 
$con -> close();
$con2 -> close();
?>