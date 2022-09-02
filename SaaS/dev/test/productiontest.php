<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$ID = $_GET['id'];


date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
//$Date = date('Y-m-d',strtotime($timestamp));
//echo $Date;

$queryOrders ="SELECT * FROM `orders` WHERE OrderID=$ID";
 $resultsOrders = mysqli_query($con,$queryOrders);
$row1=mysqli_fetch_array($resultsOrders,MYSQLI_ASSOC);
$SimType=$row1["SimType"];
$OperatorID=$row1["OperatorID"];
$BranchCode=$row1["BranchCode"];
$GadgetID=$row1["GadgetID"];
$Provider=$row1["SimProvider"];

if ($Provider=='Bank') {
 $query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType' and SimProvider='Bank'";
}else{
  $query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType' and SimProvider='Cyrus'";   
}
//$query ="SELECT * FROM `simprovider` WHERE IssueDate is null and OperatorID=$OperatorID and SimType='$SimType' and SimProvider='Cyrus'";
 $results = mysqli_query($con,$query);
//$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
//$SimID=$row["ID"];

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

$queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
$resultsO = mysqli_query($con, $queryO);
$row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
$Operator=$row7["Operator"];

if(isset($_POST['submit'])){


      $SimID=$_POST['SimID'];
      $Remark=$_POST['Remark'];
//echo $SimID;
      $Date=$_POST['Date'];
      $queryAdd="INSERT INTO `production`( `OrderID`, `SimID`, `IssueDate`, `Remark`) VALUES ('$ID', '$SimID', '$Date', 'Remark')" ;
      $resultAdd = mysqli_query($con,$queryAdd);
      if ($resultAdd) {
        echo '<script>alert("Your response recorded successfully")</script>';

        $sql = "UPDATE orders SET Status='1' WHERE OrderID=$ID";
        $sql2 = "UPDATE simprovider SET IssueDate='$Date' WHERE ID=$SimID";
        if ($con->query($sql) === TRUE) {
           //header("location:protable.php?");
          echo '<script>alert("Your response recorded successfully")</script>';
        }else {
          echo "Error updating record: " . $con->error;
        }

        if ($con->query($sql2) === TRUE) {
           header("location:protable.php?");
          //echo '<script>alert("Your response recorded successfully")</script>';
        }else {
          echo "Error updating record: " . $con->error;
        }
}
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Anant Singh Suryavanshi">
        <title>Production</title>
        <link rel="icon" href="cyrus logo.png" type="image/icon type">
        <!-- Bootstrap core CSS -->
            <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
        <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
    <style>
      fieldset {
        background-color: #eeeeee;
        margin: 5px;
        padding: 10px;
      }

      legend {
        background-color: #26082F;
        color: white;
        padding: 5px 5px;
      }

      .r {
        margin: 5px;
      }
    </style>
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
          <a class="nav-link" aria-current="page" href="protable.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Production</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="viewproduction.php">View Filled Data</a>
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
                <h3 align="center">Orders Data for <?php echo $username; ?></h3>  
                <br />  
                <div class="table-responsive">  
                     <table class="table-hover table-sm border" id="example" class="display nowrap"> 
                          <thead> 
                              <tr> 
                                  <th>Bank</th> 
                                  <th>Zone</th> 
                                  <th>Branch</th> 
                                  <th>Gadget</th> 
                                  <th>Sim Type</th> 
                                  <th>Operator</th>
                                  <th>Sim Provider</th> 
                              </tr>                     
                          </thead>                 
                          <tbody> 
                          <?php  
                               echo '  
                               <tr> 
                                    <td>'.$Bank.'</td>
                                    <td>'.$Zone.'</td>  
                                    <td>'.$Branch.'</td>  
                                    <td>'.$Gadget.'</td>  
                                    <td>'.$SimType.'</td>   
                                    <td>'.$Operator.'</td>
                                    <td>'.$Provider.'</td>  
                               ';  

                          ?> 

                     </table>  
                </div>  

<legend style="text-align: center;">Select Number</legend>
<fieldset>

<form method="POST" action="">
  
<center>
    <div class="form-group col-md-3">
      <input type="text" id="input" class="form-control" placeholder="search number">
     <select class="form-control" name="SimID" id="phone">
      <option value="">Select</option>
      <?php
      while ($arr=mysqli_fetch_assoc($results)){
      ?>
      <option value="<?php echo $arr['ID']; ?>"><?php echo $arr['MobileNumber']; ?></option>
                         
         <?php } ?>                
    </select>

    </div>

    <div class="form-group col-md-3" align="center">
      <label>Production Date</label>
      <input type="date" name="Date" class="form-control" required>
    </div>
</center>
      <div class="form-group col-md-12" align="center">

      <label for="Remark">Remark</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" cols="4" rows="4" name="Remark"></textarea>


</div>  
  <br><br>
  <center>

  <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
  </center>      
</form>

</fieldset>
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

<script>

$('#input').keyup(function () {
    select_search($('#input').val(),$('#phone option'));
});
</script>
<script  src="livesearch/select_search.js"></script>

</body>
</html>
<?php 
  $con -> close();
  $con2 -> close();
 ?>