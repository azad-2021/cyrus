<?php 
include 'connection.php';
include 'session.php';
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Month = date('M-Y',strtotime($timestamp));


$FirstSat=date('Y-m-d',strtotime('+1 week sat '.$Month));
$LastSat= date('Y-m-d',strtotime('+3 week sat '.$Month));
$AssignDate='2022-09-09';

$interval=0;
$StartDate='';
$EndDate='';

/*
function GetHolidays($AssignDate){

	global $con

	$query ="SELECT * FROM cyrusbackend.holidays WHERE StartDate between $AssignDate and current_date()";
	$results = $con->query($query);

	if(mysqli_num_rows($results)>0)
	{

		$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
		$StartDate=$row["StartDate"];
		$EndDate=$row["EndDate"];

		$intervalV = date_diff(date_create($StartDate), date_create($EndDate));
		$intervalV= $intervalV->format('%d days');
		if ((int)$intervalV==0) {
			$intervalV=1;
		}else{
			$intervalV=(int)$intervalV;
		}

  //echo $interval.'<br>'; 

	}

}
*/
function AssignDateValidation ($AssignDate, $CurrentDate, $FSat, $LSat, $Type){

	global $StartDate;
	global $EndDate;
	global $con;

	$query ="SELECT * FROM cyrusbackend.holidays WHERE StartDate between $AssignDate and current_date()";
	$results = $con->query($query);

	if(mysqli_num_rows($results)>0)
	{

		$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
		$StartDate=$row["StartDate"];
		$EndDate=$row["EndDate"];

		$intervalV = date_diff(date_create($StartDate), date_create($EndDate));
		$intervalV= $intervalV->format('%d days');
		if ((int)$intervalV==0) {
			$intervalV=1;
		}else{
			$intervalV=(int)$intervalV;
		}

  //echo $interval.'<br>'; 

	}

	//echo $EndDate.'<br>';
	if ($intervalV>0) {
		$AssignDate=date('Y-m-d', strtotime($AssignDate. ' + '.$intervalV.' days'));
	}

	//echo $AssignDate.'<br>';
	if ($Type=='Order') {
		$Dedline=date('Y-m-d', strtotime($AssignDate. ' + 7 days'));
	}elseif($Type=='Complaint'){
		$Dedline=date('Y-m-d', strtotime($AssignDate. ' + 2 days'));
	}


	if ($AssignDate<=$FSat and $Dedline>=$FSat and ($StartDate<$FSat and $EndDate<$FSat)) {

		$ADate=date('Y-m-d', strtotime($AssignDate. ' + 2 days'));
	}elseif ($AssignDate<=$LSat and $Dedline>=$LSat and ($StartDate<$LSat and $EndDate<$LSat)) {
		$ADate=date('Y-m-d', strtotime($AssignDate. ' + 2 days'));
	}else{
		$ADate=$AssignDate;
	}

	return $ADate;

}

echo AssignDateValidation($AssignDate, $Date, $FirstSat, $LastSat, 'Order');
?>