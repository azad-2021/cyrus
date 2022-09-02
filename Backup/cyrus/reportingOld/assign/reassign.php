<?php 
//echo "<alert>'test'</alert>";
include 'connection.php';
$User='USER';

$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$Data='{"EmployeeID":"176","ComplaintID":"89524","Date":"2021-12-20","Status":"Unassigned"}';
//$Data='{"EmployeeID":"176","OrderID":"186261","Date":"2021-12-22","Status":"Unassigned"}';
if (!empty($Data))
{

	date_default_timezone_set('Asia/Kolkata');
	$Date =date('Y-m-d');
	$obj=json_decode($Data);
	$EmployeeID=$obj->EmployeeID;
	
	$Status=$obj->Status;
	$Date=$obj->Date;

	$myfile = fopen("data.json", "w") or die("Unable to open file!");
	fwrite($myfile, $Data);
	fclose($myfile);

	if (!empty($obj->OrderID) and !empty($obj->EmployeeID)) {
		$OrderID=$obj->OrderID;

		$query="SELECT * FROM vallordersd WHERE OrderID=$OrderID";
		$result=mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		$Discription=$row['Discription'];
		$BANK=$row['BankName'];
		$Branch=$row['BranchName'];

		$query3="SELECT * FROM bank WHERE BankName='$BANK'";
		$result3=mysqli_query($con,$query3);
		$row3 = mysqli_fetch_array($result3);
		$BANKINI=$row3['BankInitial'];

		$query2="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
		$result2=mysqli_query($con,$query2);
		$row2 = mysqli_fetch_array($result2);
		$Phone=$row2['Phone'];
		echo var_dump($Discription);

		if ($Status=='Unassigned') {


			if((strpos($row['Discription'], 'AMC') !== false) or (strpos($row['Discription'], 'Amc') !== false) or (strpos($row['Discription'], 'amc') !== false)){
				$Type='A';
				$Message='A '.$OrderID.' '.$BANKINI.' '.$Branch.' '.$Discription;  
			}else{
				$Type='O';
				$Message='O '.$OrderID.' '.$BANKINI.' '.$Branch.' '.$Discription;
			}

			$sql = "UPDATE orders SET EmployeeCode= $EmployeeID, AssignDate='$Date' WHERE OrderID=$OrderID";

			$sql2 = "INSERT INTO sms (Type, ID, EmployeeID, Sent, AssignDate, AssignedBy, AssignType, `Number`, Message)
			VALUES ('$Type', '$OrderID', '$EmployeeID', '0', '$Date', '$User', 'N', '$Phone', '$Message')";

			if ($con2->query($sql2) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql2 . "<br>" . $con2->error;
				$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
				fwrite($myfile, $con2->error);
				fclose($myfile);
			}

		}elseif ($Status=='Assigned') {

			if((strpos($row['Discription'], 'AMC') !== false) or (strpos($row['Discription'], 'Amc') !== false) or (strpos($row['Discription'], 'amc') !== false)){
				$Type='a';
				$Message='a '.$OrderID.' '.$BANKINI.' '.$Branch.' '.$Discription;
			}else{
				$Type='o';
				$Message='o '.$OrderID.' '.$BANKINI.' '.$Branch.' '.$Discription;
			}
			$myfile = fopen("newfile2.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $Message);
			fclose($myfile);
			$sql = "UPDATE orders SET EmployeeCode= $EmployeeID WHERE OrderID=$OrderID";

			$sql2 = "INSERT INTO sms (Type, ID, EmployeeID, Sent, AssignDate, AssignedBy, AssignType, `Number`, Message)
			VALUES ('$Type', '$OrderID', '$EmployeeID', '0', '$Date', '$User', 'R', '$Phone', '$Message')";

			if ($con2->query($sql2) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql2 . "<br>" . $con2->error;
				$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
				fwrite($myfile, $con2->error);
				fclose($myfile);
			}
		}



	}
	
	if (!empty($obj->ComplaintID) and !empty($obj->EmployeeID)) {
		$ComplaintID=$obj->ComplaintID;

		if ($Status=='Unassigned') {

			$query="SELECT * FROM vallcomplaintsd WHERE ComplaintID=$ComplaintID";
			$result=mysqli_query($con,$query);
			$row = mysqli_fetch_array($result);
			$Discription=$row['Discription'];
			$BANK=$row['BankName'];
			$Branch=$row['BranchName'];
			$District=$row['Address3'];

			$query3="SELECT * FROM bank WHERE BankName='$BANK'";
			$result3=mysqli_query($con,$query3);
			$row3 = mysqli_fetch_array($result3);
			$BANKINI=$row3['BankInitial'];
			

			$query2="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
			$result2=mysqli_query($con,$query2);
			$row2 = mysqli_fetch_array($result2);
			$Phone=$row2['Phone'];

			$Message='C '.$ComplaintID.' '.$BANKINI.' '.$Branch.' '.$Discription;
			$sql = "UPDATE complaints SET EmployeeCode= $EmployeeID, AssignDate='$Date' WHERE ComplaintID=$ComplaintID";

			$sql2 = "INSERT INTO sms (Type, ID, EmployeeID, Sent, AssignDate, AssignedBy, AssignType, `Number`, Message)
			VALUES ('C', '$ComplaintID', '$EmployeeID', '0', '$Date', '$User', 'N', '$Phone', '$Message')";

			if ($con2->query($sql2) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql2 . "<br>" . $con2->error;
				$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
				fwrite($myfile, $con2->error);
				fclose($myfile);
			}
		}elseif ($Status=='Assigned') {
			$sql = "UPDATE complaints SET EmployeeCode= $EmployeeID WHERE ComplaintID=$ComplaintID";
		}

	}
/*
	if ($con->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $con->error;
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $con->error);
		fclose($myfile);
	}
*/
	$con->close();





}

?>