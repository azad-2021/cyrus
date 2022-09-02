<?php 
include 'connection.php';
$ID=1;
//$ID=$_SESSION['userid'];

$AddData=!empty($_POST['AddData'])?$_POST['AddData']:'';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
$EstimateID=!empty($_POST['EstimateID'])?$_POST['EstimateID']:'';
//$EstimateID=4129;

if (!empty($EstimateID) or !empty($Data))
{



	if (!empty($Data)) {

		
		$myfile = fopen("qty.json", "w") or die("Unable to open file!");
		fwrite($myfile, $Data);
		fclose($myfile);

		$obj=json_decode($Data);
		$EstimateID=$obj->EstimateID;
		$Qty=$obj->newQty;

		$sql = "UPDATE estimates SET Qty=$Qty, OldQty=$Qty, ExecutiveID=$ID WHERE EstimateID=$EstimateID";
	}else{

		$myfile = fopen("delete.json", "w") or die("Unable to open file!");
		fwrite($myfile, $EstimateID);
		fclose($myfile);

		$query="SELECT * FROM estimates WHERE EstimateID=$EstimateID";
		$result=mysqli_query($con4,$query);
		$row = mysqli_fetch_array($result);
		$Qty=$row['Qty'];
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $Qty);
		fclose($myfile);

		$sql = "UPDATE estimates SET Qty=0, OldQty=$Qty, ExecutiveID=$ID WHERE EstimateID=$EstimateID";

	}




}elseif (!empty($AddData)) {
	$myfile = fopen("add.json", "w") or die("Unable to open file!");
	fwrite($myfile, $AddData);
	fclose($myfile);

	$obj=json_decode($AddData);
	$RateID=$obj->RateID;
	$Qty=$obj->Qty;
	$ApprovalID=$obj->ApprovalID;

	$sql = "INSERT INTO estimates (ApprovalID, RateID, Qty, ExecutiveID)
	VALUES ('$ApprovalID', '$RateID', '$Qty', '$ID')";
}

/*
if ($con4->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql4 . "<br>" . $con4->error;
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $con4->error);
	fclose($myfile);
}

*/
?>