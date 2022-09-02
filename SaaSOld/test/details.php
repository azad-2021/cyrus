<?php

include('connection.php'); 
include 'session.php';
$ID = $_GET['id'];
$username = $_SESSION['user'];

$query ="SELECT * FROM `orders` WHERE OrderID=$ID";
$results = mysqli_query($con, $query);
$row=mysqli_fetch_array($results);
$BranchCode = $row["BranchCode"];
$Date = $row["Date"];
$Provider = $row["SimProvider"];
$SimType = $row["SimType"];
$PlanLimit = $row["ValidityRecharge"];
$OperatorID = $row["OperatorID"];
$GadgetID = $row["GadgetID"];

$dedline = date('Y-m-d', strtotime($row["Date"]. ' + '.$PlanLimit.' months'));
$date = str_replace('-"', '/', $dedline);  
$dedline = date("d/m/Y", strtotime($date));

$date = str_replace('-"', '/', $Date);  
$Date = date("d/m/Y", strtotime($date));

$queryBank="SELECT * FROM branchs where BranchCode=$BranchCode";
$resultBank=mysqli_query($con2,$queryBank);
$dataBank=mysqli_fetch_assoc($resultBank);
$BranchName = $dataBank['BranchName'];
$District = $dataBank['Address3'];
$Zone = $dataBank['ZoneRegionCode'];
//echo $Zone;

$queryzone="SELECT * FROM zoneregions where ZoneRegionCode=$Zone";
$resultzone=mysqli_query($con2,$queryzone);
$datazone=mysqli_fetch_assoc($resultzone);
$BankCode = $datazone['BankCode'];
$ZoneName = $datazone['ZoneRegionName'];

$queryBankName="SELECT * FROM Bank where BankCode=$BankCode";
$resultBankName=mysqli_query($con2,$queryBankName);
$dataBankName=mysqli_fetch_assoc($resultBankName);
$BankName = $dataBankName['BankName'];



$queryP ="SELECT * FROM `production` WHERE OrderID=$ID";
$resultsP = mysqli_query($con, $queryP);
$row8=mysqli_fetch_array($resultsP,MYSQLI_ASSOC);
$SimID=$row8["SimID"];

$queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
$resultGadget = mysqli_query($con, $queryGadget);
$row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
$Gadget=$row5["Gadget"];

$querySim ="SELECT * FROM `simprovider` WHERE ID=$SimID";
$resultsSim = mysqli_query($con, $querySim);
$row6=mysqli_fetch_array($resultsSim,MYSQLI_ASSOC);
$Mobile=$row6["MobileNumber"];
$SimNo=$row6["SimNo"];
$ReleaseDate=$row6["ReleaseDate"];
$IssueDate=$row6["IssueDate"];
$Activation=$row6["ActivationDate"];
$ExpDate=$row6["ExpDate"];

$queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
$resultsO = mysqli_query($con, $queryO);
$row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
$Operator=$row7["Operator"];

$queryS ="SELECT * FROM `store` WHERE OrderID=$ID";
$resultsS = mysqli_query($con, $queryS);
$row9=mysqli_fetch_array($resultsS,MYSQLI_ASSOC);
$EmployeeID=$row9["EmployeeCode"];

$queryE ="SELECT * FROM `employees` WHERE `EmployeeCode`=$EmployeeID";
$resultsE = mysqli_query($con2, $queryE);
$row10=mysqli_fetch_array($resultsE,MYSQLI_ASSOC);
$ReleaseTo=$row10["Employee Name"];

$queryIS ="SELECT * FROM `installation` WHERE OrderID=$ID";
$resultsIS = mysqli_query($con, $queryIS);
$rowIS=mysqli_fetch_array($resultsIS,MYSQLI_ASSOC);
$InstalledByID=$rowIS["InstalledBy"];
$InstallationDate=$rowIS["InstallationDate"];

$queryI ="SELECT * FROM `employees` WHERE `EmployeeCode`=$InstalledByID";
$resultsI = mysqli_query($con2, $queryI);
$rowI=mysqli_fetch_array($resultsI,MYSQLI_ASSOC);
$InstalledBy=$rowI["Employee Name"];
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

   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>

   <style type="text/css">
   body {
    padding: 50px;      
    font-family: Verdana;
    font-size: 16px;
}

div.invoice {
    /*border:1px solid Black;*/
    padding:1px;
    height:900pt;
    width:700pt;
}

div.company-address {
    /*border:1px solid #ccc;*/
    float:left;
    width:800pt;
}

div.invoice-details {
    border:1px solid #ccc;
    float:right;
    width:200pt;
}

div.customer-address {
    border:1px solid #ccc;
    float:right;
    margin-bottom:50px;
    margin-top:100px;
    width:200pt;
}

div.clear-fix {
    clear:both;
    float:none;
}

table {
    width:100%;
}

th {
    text-align: center;
}

td {
    text-align: center;
    margin: 5px;
}

.text-left {
    text-align:center;
}

.text-center {
    text-align:center;
}

.text-right {
    text-align:right;
}



</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
    function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>

</head>
<div id="invoice">

    <div class="container" align="center">
        <h1><img src="cyrus logo.png" alt="Cyrus Electronics Pvt. Ltd." style="width:50px;height:60px;">
            <strong>Cyrus Electronics Pvt. Ltd.</strong></h1>
        </div>
        <br>
        
        <div class="container">
            <div>
                <strong>Bank: </strong> <?php echo $BankName; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Zone: </strong> <?php echo $ZoneName; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Branch: </strong> <?php echo $BranchName; ?>&nbsp;&nbsp;&nbsp;
                <strong>District: </strong><?php echo $District; ?>&nbsp;&nbsp;&nbsp;
                <strong>Order Date: </strong><?php echo $Date; ?>&nbsp;&nbsp;&nbsp;
            </div>
            <br>
            <div>
                <strong>Sim Provider: </strong> <?php echo $Provider; ?>&nbsp;&nbsp;&nbsp;
                <strong>Sim Type: </strong> <?php echo $SimType; ?>&nbsp;&nbsp;&nbsp;
                <strong>Plan Limit: </strong> <?php echo $PlanLimit.' Months'; ?>&nbsp;&nbsp;
                <strong>Plan Expiry Date: </strong><?php echo $dedline; ?>&nbsp;&nbsp;
                <strong>Gadget: </strong><?php echo $Gadget; ?>
            </div>
            <br>
            <div>
                <strong>Mobile No.: </strong> <?php echo $Mobile; ?>&nbsp;&nbsp;&nbsp;
                <strong>Sim No.: </strong> <?php echo $SimNo; ?>&nbsp;&nbsp;&nbsp;
                <strong>Sim Activation Date: </strong> <?php echo $Activation; ?>&nbsp;&nbsp;
                <strong>Sim Release Date: </strong><?php echo $IssueDate; ?>                    
            </div>
            <br>
            <div>
               <strong>Recharge Exp. Date: </strong><?php echo $ExpDate; ?>&nbsp;&nbsp;
               <strong>Panel Release To: </strong> <?php echo $ReleaseTo; ?>&nbsp;&nbsp;&nbsp;
               <strong>Installed By: </strong> <?php echo $InstalledBy; ?>&nbsp;&nbsp;&nbsp;
               <strong>Installation Date: </strong> <?php echo $InstallationDate; ?>&nbsp;&nbsp;
               
           </div>
       </div>

   </div>

</fieldset>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>


</html>

<?php 
$con -> close();
$con2 -> close();
?>