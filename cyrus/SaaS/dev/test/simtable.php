
<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
//$query ="SELECT DISTINCT `OperatorID` FROM `orders` WHERE Status='0' ORDER BY OrderID DESC";
//$results = mysqli_query($con, $query);
$query ="SELECT * FROM `simprovider` WHERE `ActivationDate` is null and `IssueDate` is not null and SimProvider='Cyrus'";
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
    <title><?php echo $username; ?></title>
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
              <a class="nav-link active" aria-current="page" href="simtable.php">Home</a>
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
            <a class="nav-link" target="blank" href="viewsim.php?">Active Sim Cards</a>
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
    <h3 align="center">Total Non-Activated Inused Sim Cards</h3>  
    <br />  

    <div class="table-responsive">  
       <table class="table-hover table-sm bordered table-secendory" id="example" class="display nowrap"> 
          <thead> 
              <tr>  
                  <th>Bank</th> 
                  <th>Zone</th> 
                  <th>Branch</th>
                  <th>Order Id</th> 
                  <th>Gadget</th> 
                  <th>Mobile No</th> 
                  <th>Sim Type</th> 
                  <th>Operator</th> 
                  <th>Sim Release Date</th>
                  <th>In Use Date</th>
                  <th>Action</th>
              </tr>                     
          </thead>                 
          <tbody> 
              <?php  
              while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){  


                $SimID=$row["ID"];
                $IssueDate=$row["IssueDate"];

                $query2 ="SELECT * FROM `production` WHERE SimID=$SimID";
                $results2 = mysqli_query($con, $query2);
                $row2=mysqli_fetch_array($results2,MYSQLI_ASSOC);
                $OrderID=$row2["OrderID"];

                $query3 ="SELECT * FROM `orders` WHERE OrderID=$OrderID and SimProvider='Cyrus'";
                $result3 = mysqli_query($con, $query3);
                $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
                $Status=$row3["Status"];
                $BranchCode=$row3["BranchCode"];
                $GadgetID=$row3["GadgetID"];
                $OperatorID=$row3["OperatorID"];
                $SimType=$row3["SimType"];

                $queryBranch ="SELECT * FROM `branchs` WHERE BranchCode=$BranchCode";
                $resultBranch = mysqli_query($con2, $queryBranch);
                $row2=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
                $Branch=$row2["BranchName"];
                $ZoneCode= $row2["ZoneRegionCode"];


                $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
                $resultZone = mysqli_query($con2, $queryZone);
                $row5=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
                $Zone=$row5["ZoneRegionName"];
                $BankCode=$row5["BankCode"];


                $query4 ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
                $result4 = mysqli_query($con2, $query4);
                $row4=mysqli_fetch_array($result4,MYSQLI_ASSOC);


                if ($Status==2) {
                    $Bank='<span style="color: red;">'.$row4["BankName"].'</span>';
                }else{
                 $Bank=$row4["BankName"]; 
             }

             $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
             $resultGadget = mysqli_query($con, $queryGadget);
             $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
             $Gadget=$row5["Gadget"];

             $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
             $resultsO = mysqli_query($con, $queryO);
             $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);

             echo '  
             <tr> 
             <td>'.$Bank.'</td>
             <td>'.$Zone.'</td>  
             <td>'.$Branch.'</td>
             <td>'.$OrderID.'</td>  
             <td>'.$Gadget.'</td>  
             <td>'.$row["MobileNumber"].'</td>
             <td>'.$row["SimType"].'</td>   
             <td>'.$row7["Operator"].'</td>   
             <td>'.$row["ReleaseDate"].'</td>
             <td>'.$row["IssueDate"].'</td>
             <td><a target="blank" href=activate.php?id='.$SimID.'&oid='.$OrderID.'>Activate Now</a>&nbsp; &nbsp;<a target="blank" href=simdate.php?id='.$SimID.'>Update Date</a></td> 
             </tr>  
             ';  
         }  


         ?> 

     </table>  
 </div>
 <br><br><br>

 <h3 align="center">Total Non-Activated Unused Sim Cards</h3>  
 <br />  

 <div class="table-responsive">  
   <table class="table-hover table-sm bordered" id="example3" class="display nowrap"> 
      <thead> 
          <tr>  
              <th scope="col">Mobile No</th>
              <th>Sim Number</th>
              <th>Sim ID</th> 
              <th>Sim Type</th> 
              <th>Operator</th>
              <th>Sim Provider</th> 
              <th>Sim Release Date</th>
              <th>Action</th>
          </tr>                     
      </thead>                 
      <tbody> 
          <?php 


          $query2 ="SELECT * FROM `simprovider` WHERE `IssueDate` is null and `ActivationDate` is null";

          $results2 = mysqli_query($con, $query2);

          while ($row=mysqli_fetch_array($results2,MYSQLI_ASSOC)){ 


            $SimID=$row["ID"];
            $OperatorID=$row["OperatorID"];      
            $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
            $resultsO = mysqli_query($con, $queryO);
            $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);

            echo '  
            <tr> 

            <td>'.$row["MobileNumber"].'</td>
            <td>'.$row["SimNo"].'</td>
            <td>'.$row["ID"].'</td> 
            <td>'.$row["SimType"].'</td>   
            <td>'.$row7["Operator"].'</td>
            <td>'.$row["SimProvider"].'</td>   
            <td>'.$row["ReleaseDate"].'</td>
            <td><a target="blank" href=deletesim.php?id='.$SimID.'>Delete Number</a> &nbsp; &nbsp;<a target="blank" href=simdate.php?id='.$SimID.'>Update Date</a></td>  
            </tr>  
            ';  
        }  


        ?> 

    </table>  
</div> 

<br><br>
<h3 align="center">Total Activated Returned Sim Cards</h3>  
<br />  

<div class="table-responsive">  
   <table class="table-hover table-sm bordered" id="example2" class="display nowrap"> 
      <thead> 
          <tr>  
              <th>Mobile No</th>
              <th>Sim Number</th> 
              <th>Sim Type</th> 
              <th>Operator</th>
              <th>Sim Release Date</th>
              <th>Activation Date</th> 

          </tr>                     
      </thead>                 
      <tbody> 
          <?php 


          $query2 ="SELECT * FROM `simprovider` WHERE `RemarkUpdate` is not null and ActivationDate is not null";

          $results2 = mysqli_query($con, $query2);

          while ($row=mysqli_fetch_array($results2,MYSQLI_ASSOC)){ 



            $OperatorID=$row["OperatorID"];      
            $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
            $resultsO = mysqli_query($con, $queryO);
            $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);

            echo '  
            <tr> 

            <td>'.$row["MobileNumber"].'</td>
            <td>'.$row["SimNo"].'</td>
            <td>'.$row["SimType"].'</td>   
            <td>'.$row7["Operator"].'</td>                                     
            <td>'.$row["ReleaseDate"].'</td>
            <td>'.$row["ActivationDate"].'</td>  
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

<?php 
$con -> close();
$con2 -> close();
?>


