<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$query ="SELECT * FROM `orders` WHERE Installed='0' ORDER BY OrderID DESC";
$results = mysqli_query($con, $query);

 //$xml=simplexml_load_file("xml/branchs.xml");
//print_r($xml); 



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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">


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
          <a class="nav-link active" aria-current="page" href="ordertable.php">Home</a>
        </li>
      <li class="nav-item">
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.php">Add Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="released.php">Completed Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cancelorders.php">Canceled Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </li>
      </ul>
    </div>
  </div>
</nav>


<br>
           <div class="container">
           <br>

                <h3 align="center">Orders Data for <?php echo $username; ?></h3>  
                <br />  
                <div class="table-responsive">  
                     <table class="table-hover table-sm bordered table-secendory" id="example" class="display nowrap"> 
                          <thead> 
                              <tr> 
                                  <th>Bank</th> 
                                  <th>Zone</th> 
                                  <th>Branch</th> 
                                  <th>Gadget</th>
                                  <th>Sim Provider</th>
                                  <th>Operator</th> 
                                  <th>Order Id</th>
                                  <th>Order Date</th>
                                  <th>Validity of Recharge</th>
                                  <th>Voice Message</th>                                  
                                  <th>Remark</th>
                                  <th>Pending Status</th>
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
                                $OrderID=$row["OrderID"];
                                $Provider=$row["SimProvider"];
                                $OperatorID=$row["OperatorID"];

                                if (empty($OperatorID)==false) {
                                $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
                                $resultsO = mysqli_query($con, $queryO);
                                $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
                                $Operator=$row7["Operator"];
                                }else{
                                    $Operator='';
                                }

                                if ($Status=='1') {
                                    // code...
                                    $Pending='Pending from Store';
                                    
                                }elseif($Status=='2'){
                                    

                                $query ="SELECT SimID FROM `production` WHERE OrderID=$OrderID";
                                $result = mysqli_query($con, $query);
                                $rowP=mysqli_fetch_array($result,MYSQLI_ASSOC);
                                $SimID=$rowP["SimID"];

                                $queryS ="SELECT * FROM `simprovider` WHERE ID=$SimID";
                                $resultS = mysqli_query($con, $queryS);
                                if (empty($resultS)==false) {

                                $rowS=mysqli_fetch_array($resultS,MYSQLI_ASSOC);
                                $Activation=$rowS["ActivationDate"];

                                }else{
                                    $Activation='';                                    
                                }
                                if (empty($Activation)==true and $Provider=='Cyrus') {
                                    // code...
                                    //echo 'No Activation';
                                    $Pending='<span style="color: red;">Pending at Installation Stage and Sim is Not Activated Yet</span>';
                                }else{
                                    $Pending='Pending at Installation Stage';
                                }

                                }else{
                                    $Pending='Pending at Production Stage';

                                }

                                if($Status=='0'){
                                    $Cancel='<a href=ordercancel.php?id='.$OrderID.'>Cancel Order</a>';
                                }else{
                                    $Cancel='';
                                }

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

                                if (empty($Activation)==true and $Provider=='Cyrus' and $Status=='2') {
                                    // code...
                                    //echo 'No Activation';
                                    $Bank='<span style="color: red;">'.$Bank.'</span>';
                                }


                               echo '  
                               <tr>
                                    <td>'.$Bank.'</td> 
                                    <td>'.$Zone.'</td>  
                                    <td>'.$Branch.'</td>  
                                    <td>'.$Gadget.'</td>
                                    <td>'.$row["SimProvider"].'</td>
                                    <td>'.$Operator.'</td>
                                    <td>'.$row["OrderID"].'</td>
                                    <td>'.$row["Date"].'</td>
                                    <td>'.$row["ValidityRecharge"].'</td>   
                                    <td>'.$row["VoiceMessage"].'</td>
                                    <td>'.$row["Remark"].'</td> 
                                    <td>'.$Pending.'</td>
                                    <td>'.$Cancel.'</td> 
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