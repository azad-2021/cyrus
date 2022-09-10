<?php 
include"connection.php";
include"session.php";
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
/*
$_FILES=!empty($_POST['LoaFile'])?$_POST['LoaFile']:'';
if (!empty($_FILES))
{


	$file_name = $_FILES['LoaFile']['name'];

	$file_size =$_FILES['LoaFile']['size'];
	$file_tmp =$_FILES['LoaFile']['tmp_name'];
	$file_type=$_FILES['LoaFile']['type'];
	$tmp = explode('.', $_FILES['LoaFile']['name']);
	$file_ext = strtolower(end($tmp));    
	$newfilename="ABC.".$file_ext;         
	$extensions= array("jpeg","jpg","pdf");

	$Upload=move_uploaded_file($file_tmp,"LOA/".$newfilename);

	echo 1;
}
*/





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
		echo 1;
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}

?>
