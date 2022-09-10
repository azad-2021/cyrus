<?php 
include"connection.php";
include"session.php";
date_default_timezone_set('Asia/Kolkata');
$Date =date('y-m-d H:i:s');
$NewOrg=!empty($_POST['NewOrg'])?$_POST['NewOrg']:'';
if (!empty($NewOrg))
{

	$sql = "INSERT INTO $org (Organization)
	VALUES ('$NewOrg')";

	if ($con->query($sql) === TRUE) {
		echo 1;
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}


$NewDiv=!empty($_POST['NewDiv'])?$_POST['NewDiv']:'';
$OrgCode=!empty($_POST['OrgCodeNDiv'])?$_POST['OrgCodeNDiv']:'';
if (!empty($NewDiv))
{

	$sql = "INSERT INTO $div (OrganizationCode, DivisionName)
	VALUES ($OrgCode, '$NewDiv')";

	if ($con->query($sql) === TRUE) {
		echo 1;
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}



$DivisionCodeO=!empty($_POST['DivisionCodeO'])?$_POST['DivisionCodeO']:'';
$LOADate=!empty($_POST['LOADate'])?$_POST['LOADate']:'';
if (!empty($DivisionCodeO) and !empty($LOADate))
{

	$Completion=!empty($_POST['Completion'])?$_POST['Completion']:'';
	$BGAmount=!empty($_POST['BGAmount'])?$_POST['BGAmount']:'';
	$BGDate=!empty($_POST['BGDate'])?$_POST['BGDate']:'';
	$Warranty=!empty($_POST['Warranty'])?$_POST['Warranty']:'';
	$OderingAuth=!empty($_POST['OderingAuth'])?$_POST['OderingAuth']:'';
	$BillingAuth=!empty($_POST['BillingAuth'])?$_POST['BillingAuth']:'';
	$LOANumber=!empty($_POST['LOANumber'])?$_POST['LOANumber']:'';
	$Description=!empty($_POST['Description'])?$_POST['Description']:'';


	$sql = "INSERT INTO $orders (DivisionCode, Description, LOANo, LOADate, CompletionDate, BGAmount, BGDate, Warranty, OrderingAuth, BillingAuth)
	VALUES ($DivisionCodeO, '$Description', '$LOANumber', '$LOADate', '$Completion', $BGAmount, '$BGDate', $Warranty, '$OderingAuth', '$BillingAuth')";

	if ($con->query($sql) === TRUE) {
		$_SESSION["NewOrderID"]=$con->insert_id;
		$OrderID=$con->insert_id;

		$sql = "INSERT INTO $demands (OrderID, OrderDate)
		VALUES ($OrderID, '$Date')";


		if ($con->query($sql) === TRUE) {

			echo 1;

		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}

?>
