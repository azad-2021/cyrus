
<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$query ="SELECT * FROM `orders` WHERE Installed!=2 and Status=1";;
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
              <a class="nav-link active" aria-current="page" href="protable.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="viewproduction.php">View Filled Data</a>
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

    <h3 align="center">Production Details</h3>  
    <br />  
    <div class="table-responsive">  
     <table class="table table-hover table-bordered border-primary" id="example"> 
      <thead> 
          <tr>  
              <th>Bank</th> 
              <th>Zone</th> 
              <th>Branch</th>
              <th>Order Id</th> 
              <th>Order Date</th>
              <th>Gadget</th> 
              <th>Mobile No</th>
              <th>Sim No</th> 
              <th>Sim Type</th>
              <th>Sim Provider</th> 
              <th>Operator</th> 
              <th>Sim Release Date</th>
              <th>In Use Date</th>
              <th>Update Date</th>
          </tr>                     
      </thead>                 
      <tbody> 
          <?php  
          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 

            $OrderID=$row["OrderID"];

            $query3 ="SELECT * FROM `production` WHERE OrderID=$OrderID";
            //$results3 = mysqli_query($con, $query);
            

            //$query3 ="SELECT * FROM `orders` WHERE OrderID=$OrderID and Installed!=2";
            $result3 = mysqli_query($con, $query3);
            $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
                //$OrderID=$row3["OrderID"];
            $SimID=$row3["SimID"];
            if (empty($SimID)==false) {
                $query2 ="SELECT * FROM `simprovider` WHERE ID=$SimID";
                $results2 = mysqli_query($con, $query2);
                $row2=mysqli_fetch_array($results2,MYSQLI_ASSOC);
                $Mobile=$row2["MobileNumber"];
                $SimNo=$row2["SimNo"];
                $ReleaseDate=$row2["ReleaseDate"];
                $ActivationDate=$row2["ActivationDate"];
            }else{
                $Mobile='';
                $ReleaseDate='';
                $ActivationDate='';
            }


            $BranchCode=$row["BranchCode"];
            $GadgetID=$row["GadgetID"];
            $OperatorID=$row["OperatorID"];
            $SimType=$row["SimType"];
            $Status=$row["Status"];
            $Provider=$row["SimProvider"];

            $queryBranch ="SELECT * FROM branchdetails WHERE `BranchCode`='$BranchCode'";
            $resultBranch = mysqli_query($con2, $queryBranch);
            $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
            $Branch=$row4["BranchName"];
                                //$BranchCode=$row4["BranchCode"];
            $ZoneCode= $row4["ZoneRegionCode"];             
            $Zone=$row4["ZoneRegionName"];
            $Bank=$row4["BankName"];

            if ($Status==2 and empty($ActivationDate)==true) {
                $Bank='<span style="color: red;">'.$row4["BankName"].'</span>';
            }else{
               $Bank=$row4["BankName"]; 
           }

           $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
           $resultGadget = mysqli_query($con, $queryGadget);
           $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
           $Gadget=$row5["Gadget"];

           if (empty($OperatorID)==false) {

            $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
            $resultsO = mysqli_query($con, $queryO);
            $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
            $Operator=$row7["Operator"];                                
        }else{
            $Operator='';
        }                                    
        $Action='<a target="blank" href=proupdate.php?id='.$row["SimID"].'>Update Date</a>';

        echo '  
        <tr> 
        <td>'.$Bank.'</td>
        <td>'.$Zone.'</td>  
        <td>'.$Branch.'</td>
        <td>'.$OrderID.'</td> 
        <td>'.$row["Date"].'</td>  
        <td>'.$Gadget.'</td>  
        <td>'.$Mobile.'</td>
        <td>'.$SimNo.'</td>
        <td>'.$SimType.'</td>
        <td>'.$Provider.'</td>    
        <td>'.$Operator.'</td>   
        <td>'.$ReleaseDate.'</td>
        <td>'.$row["IssueDate"].'</td>
        <td>'.$Action.'</td> 
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
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>

<script>

    $(document).ready(function() {
        $('#example').DataTable( {
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal( {
                        header: function ( row ) {
                            var data = row.data();
                            return 'Details for '+data[0]+' '+data[1];
                        }
                    } ),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                        tableClass: 'table'
                    } )
                }
            },
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


