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

if ($Provider=='No SIM') {
    $dedline='';
}else{
    $dedline = date('Y-m-d', strtotime($row["Date"]. ' + '.$PlanLimit.' months'));
    $date = str_replace('-"', '/', $dedline);  
    $dedline = date("d/m/Y", strtotime($date));
}
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
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="Anant Singh Suryavanshi">
 <title>Completed Orders</title>
 <link rel="icon" href="cyrus logo.png" type="image/icon type">
 <!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
 <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

 <style type="text/css">
 body {
    padding: 50px;      
    font-family: Verdana;
    font-size: 16px;
}


table {
    width:100%;
}

th,td {
    text-align: center;
    font-size: 16px;
}





</style>


</head>


<div class="container" align="center">
    <h1><img src="cyrus logo.png" alt="Cyrus Electronics Pvt. Ltd." style="width:50px;height:60px;">
        <strong>Cyrus Electronics Pvt. Ltd.</strong></h1>
    </div>
    <br>


    <fieldset>
        <div class="container">
            <table class="table table-hover table-bordered border-primary">
                <?php  

                $output = '';


                $output .= '

                <tr>  
                <td width="30%"><label>Order ID</label></td>  
                <td width="70%">'.$ID.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Bank</label></td>  
                <td width="70%">'.$BankName.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Zone</label></td>  
                <td width="70%">'.$ZoneName.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Branch</label></td>  
                <td width="70%">'.$BranchName.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>District</label></td>  
                <td width="70%">'.$District.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Order Date</label></td>  
                <td width="70%">'.$Date.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>SIM Provider</label></td>  
                <td width="70%">'.$Provider.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>SIM Type</label></td>  
                <td width="70%">'.$SimType.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Plan Limit</label></td>  
                <td width="70%">'.$PlanLimit.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Plan Expiry Date</label></td>  
                <td width="70%">'.$dedline.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Gadget</label></td>  
                <td width="70%">'.$Gadget.'</td>  
                </tr> 

                <tr>  
                <td width="30%"><label>Mobile Number</label></td>  
                <td width="70%">'.$Mobile.'</td>  
                </tr>
                <td width="30%"><label>SIM Number</label></td>  
                <td width="70%">'.$SimNo.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Activation Date</label></td>  
                <td width="70%">'.$Activation.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Issue Date</label></td>  
                <td width="70%">'.$IssueDate.'</td>  
                </tr>
                <td width="30%"><label>Recharge Expiry Date</label></td>  
                <td width="70%">'.$ExpDate.'</td>  
                </tr>
                <tr>  
                <tr>  
                <td width="30%"><label>Panel Release To</label></td>  
                <td width="70%">'.$ReleaseTo.'</td>  
                </tr>
                <td width="30%"><label>Installe dBy</label></td>  
                <td width="70%">'.$InstalledBy.'</td>  
                </tr>
                <tr>  
                <td width="30%"><label>Installation Date</label></td>  
                <td width="70%">'.$InstallationDate.'</td>  
                </tr>
                ';
                $output .= '</table></div>';
                echo $output;

                ?>
            </table>
        </div>


    </fieldset>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>


</html>

<?php 
$con -> close();
$con2 -> close();
?>