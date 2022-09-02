<?php 


include 'connection.php';

include 'session.php';
$User=$_SESSION['user'];

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));



$AMCID=!empty($_POST['AMCID'])?$_POST['AMCID']:'';
$EmployeeID=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';

if (!empty($AMCID) and !empty($EmployeeID)){ 


	for ($i=0; $i < count($AMCID); $i++) { 


		$query="SELECT * FROM vallordersd WHERE OrderID=$AMCID[$i]";
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


	//echo $AMCID[$i].' '.$EmployeeID.'<br>';
		$Type='A';
		$Message='A '.$AMCID[$i].' '.$BANKINI.' '.$Branch.' '.$Discription;

		$sql = "UPDATE orders SET EmployeeCode=$EmployeeID, AssignDate='$Date' WHERE OrderID=$AMCID[$i]";

		$sql2 = "INSERT INTO sms (Type, ID, EmployeeID, Sent, AssignDate, AssignedBy, AssignType, `Number`, Message)
		VALUES ('$Type', '$AMCID[$i]', '$EmployeeID', '0', '$Date', '$User', 'N', '$Phone', '$Message')";

		if ($con->query($sql) === TRUE) {

			if ($con->query($sql2) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql2 . "<br>" . $con->error;
				$myfile = fopen("errorMultiamc.txt", "w") or die("Unable to open file!");
				fwrite($myfile, $con2->error);
				fclose($myfile);
			}

		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}

	}


}