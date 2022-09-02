<?php 

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

$BankData="SELECT * FROM cyrusbackend.vallamc";
$result3 = mysqli_query($con,$BankData);
$r=0;
while($row=mysqli_fetch_assoc($result3)){
	$r++;
	$Days=$row["Days"];
	$Visits=$row["Visits"];
	$StartDate=$row["StartDate"];
	$EndDate=$row["EndDate"];
	$Quarter=round($Days/$Visits);


	$SDate='';
	$EDate='';
	//echo $Quarter.'<br>';
	for ($i=1; $i <=$Visits ; $i++) { 
		;	

		if ($i==1) {
			$QSDate=$StartDate;
			$QEDate = date('Y-m-d', strtotime($QSDate. $Quarter.' days'));
		}elseif ($Visits>$i and $i>0) {
			$QSDate = date('Y-m-d', strtotime($EDate. $Quarter.' days'));
			$QEDate = date('Y-m-d', strtotime($QSDate. $Quarter.' days'));
		}elseif($i==$Visits){
			$QSDate = date('Y-m-d', strtotime($EDate. $Quarter.' days'));
			$QEDate=$EndDate;
		}

		$SDate=$QSDate;
		$EDate=$QEDate;


		if ($Date>=$SDate and $Date<$EDate) {

			$GadgetID=$row["GadgetID"];
			$Gadget=$row["Gadget"];
			$BranchCode=$row["BranchCode"];

			$query="SELECT * FROM cyrusbackend.orders WHERE Discription like '%AMC%' and DateOfInformation between '$SDate' and '$EDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
			$result = mysqli_query($con,$query);

			$query2="SELECT * FROM cyrusbackend.jobcardmain WHERE VisitDate between '$SDate' and '$EDate' and GadgetID=$GadgetID and BranchCode=$BranchCode";
			$result2 = mysqli_query($con,$query2);

			if ((mysqli_num_rows($result)>0) or (mysqli_num_rows($result2)>0))
			{
				$PostAMC=0;
			}else{

				$Description='Q'.$i.' Amc Visit of '.$Gadget.' is due, please complete the visit on or before'.$EDate;
				$sql = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
				VALUES ($BranchCode, '$Description', '$Date', '$EDate', 'Auto', 'System', $GadgetID)";
				if ($con->query($sql) === TRUE) {
					echo "inserted<br>";
				}else {
					echo "Error: " . $sql . "<br>" . $con->error;

				}
			}

		}
	}
}
echo $r;

?>