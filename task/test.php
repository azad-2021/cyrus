<?php 

/*
$myfile = fopen("test.txt", "w") or die("Unable to open file!");
fwrite($myfile, "TEST");
fclose($myfile);
*/

$host = "localhost";  
$user = "root";  
$password = '';
$db_2 = "cyrusbackend";
$con = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
	die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

date_default_timezone_set('Asia/Kolkata');
$newtimestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($newtimestamp));

$BankData="SELECT * FROM cyrusbackend.vallamc Limit 5";
$result3 = mysqli_query($con,$BankData);
$r=0;
while($row=mysqli_fetch_assoc($result3)){
	$r++;
	$Days=$row["Days"];
	$Visits=$row["Visits"];
	$StartDate=$row["StartDate"];
	$EndDate=$row["EndDate"];
	$Quarter=round($Days/$Visits);

	$FSDate=$StartDate;
	$FEDate = date('Y-m-d', strtotime($FSDate. $Quarter.' days'));
	//echo $FSDate.' '.$FEDate.' '.$Quarter.'<br>';

	$SSDate=$FEDate;
	$SEDate = date('Y-m-d', strtotime($SSDate. $Quarter.' days'));
	//echo $SSDate.' '.$SEDate.' '.$Quarter.'<br>';

	$TSDate=$SEDate;
	$TEDate = date('Y-m-d', strtotime($TSDate. $Quarter.' days'));
	//echo $TSDate.' '.$TEDate.' '.$Quarter.'<br>';

	$FrSDate=$TEDate;
	$FrEDate = $EndDate;
	//echo $FrSDate.' '.$FrEDate.' '.$Quarter.'<br>';
	$QDate=0;
	for ($i=0; $i <=$Visits ; $i++) { 
		$QSDate=$StartDate;	

		if ($i>1) {
			$QEDate = date('Y-m-d', strtotime($QDate. $Quarter.' days'));
		}elseif($i==$Visits){
			$QEDate=$EndDate;
		}else{
			$QEDate = date('Y-m-d', strtotime($QDate. $Quarter.' days'));
		}

		$QDate=$QEDate;
		$SDate[]=$QSDate;
		$EDate[]=$QEDate;
	}

/*
	if ($Date>=$FSDate and $Date<$FEDate) {
		//echo '1';

		$GadgetID=$row["GadgetID"];
		$Gadget=$row["Gadget"];
		$BranchCode=$row["BranchCode"];

		$query="SELECT * FROM cyrusbackend.orders WHERE Discription like '%AMC%' and DateOfInformation between '$FSDate' and '$FEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result = mysqli_query($con,$query);

		$query2="SELECT * FROM cyrusbackend.jobcardmain WHERE VisitDate between '$FSDate' and '$FEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result2 = mysqli_query($con,$query2);

		if ((mysqli_num_rows($result)>0) or (mysqli_num_rows($result2)>0))
		{
			$PostAMC=0;
		}else{

			$Description='Q1 Amc Visit of '.$Gadget.' is due, please complete the visit on or before'.$FEDate;
			$sql = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
			VALUES ($BranchCode, '$Description', '$Date', '$FEDate', 'Auto', 'System', $GadgetID)";
			if ($con->query($sql) === TRUE) {
			}else {
				echo "Error: " . $sql . "<br>" . $con->error;

			}

		}
	}elseif ($Date>=$SSDate and $Date<$SEDate) {
		//echo '2';

		$GadgetID=$row["GadgetID"];
		$Gadget=$row["Gadget"];
		$BranchCode=$row["BranchCode"];

		$query="SELECT * FROM cyrusbackend.orders WHERE Discription like '%AMC%' and DateOfInformation between '$SSDate' and '$SEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result = mysqli_query($con,$query);

		$query2="SELECT * FROM cyrusbackend.jobcardmain WHERE VisitDate between '$SSDate' and '$SEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result2 = mysqli_query($con,$query2);

		if ((mysqli_num_rows($result)>0) or (mysqli_num_rows($result2)>0))
		{
			$PostAMC=0;
		}else{

			$Description='Q2 Amc Visit of '.$Gadget.' is due, please complete the visit on or before'.$SEDate;
			$sql = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
			VALUES ($BranchCode, '$Description', '$Date', '$SEDate', 'Auto', 'System', $GadgetID)";
			if ($con->query($sql) === TRUE) {
			}else {
				echo "Error: " . $sql . "<br>" . $con->error;

			}

		}

	}elseif ($Date>=$TSDate and $Date<$TEDate) {
		//echo '3';

		$GadgetID=$row["GadgetID"];
		$Gadget=$row["Gadget"];
		$BranchCode=$row["BranchCode"];

		$query="SELECT * FROM cyrusbackend.orders WHERE Discription like '%AMC%' and DateOfInformation between '$TSDate' and '$TEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result = mysqli_query($con,$query);

		$query2="SELECT * FROM cyrusbackend.jobcardmain WHERE VisitDate between '$SSDate' and '$TEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result2 = mysqli_query($con,$query2);

		if ((mysqli_num_rows($result)>0) or (mysqli_num_rows($result2)>0))
		{
			$PostAMC=0;
		}else{

			$Description='Q3 Amc Visit of '.$Gadget.' is due, please complete the visit on or before'.$TEDate;
			$sql = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
			VALUES ($BranchCode, '$Description', '$Date', '$TEDate', 'Auto', 'System', $GadgetID)";
			if ($con->query($sql) === TRUE) {
			}else {
				echo "Error: " . $sql . "<br>" . $con->error;

			}

		}


	}elseif ($Date>=$FrSDate and $Date<$FrEDate) {
		//echo '4';

		$GadgetID=$row["GadgetID"];
		$Gadget=$row["Gadget"];
		$BranchCode=$row["BranchCode"];

		$query="SELECT * FROM cyrusbackend.orders WHERE Discription like '%AMC%' and DateOfInformation between '$FrSDate' and '$FrEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result = mysqli_query($con,$query);

		$query2="SELECT * FROM cyrusbackend.jobcardmain WHERE VisitDate between '$FrSDate' and '$FrEDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
		$result2 = mysqli_query($con,$query2);

		if ((mysqli_num_rows($result)>0) or (mysqli_num_rows($result2)>0))
		{
			$PostAMC=0;
		}else{

			$Description='Q4 Amc Visit of '.$Gadget.' is due, please complete the visit on or before'.$FrEDate;
			$sql = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
			VALUES ($BranchCode, '$Description', '$Date', '$FrEDate', 'Auto', 'System', $GadgetID)";
			if ($con->query($sql) === TRUE) {
			}else {
				echo "Error: " . $sql . "<br>" . $con->error;

			}

		}

	}*/
}
print_r($SDate);
echo "<br><br>";
print_r($EDate);
?>
