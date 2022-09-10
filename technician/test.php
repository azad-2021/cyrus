<?php 
include 'connection.php';
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Month = date('M-Y',strtotime($timestamp));


$FirstSat=date('d',strtotime('+1 week sat '.$Month));
$LastSat= date('d',strtotime('+3 week sat '.$Month));
$AssignDate='2022-10-02';

$query ="SELECT * FROM cyrusbackend.holidays WHERE StartDate between '2022-10-02' and '2022-10-02'";
$results = $con->query($query);

if(mysqli_num_rows($results)>0)
{

	$row=mysqli_fetch_array($results,MYSQLI_ASSOC);
	$StartDate=$row["StartDate"];
	$EndDate=$row["EndDate"];

	$interval = date_diff(date_create($StartDate), date_create($EndDate));
	echo (int)$interval.'<br>'; 

}
function AssignDateValidation ($AssignDate, $CurrentDate, $FSat, $LSat, $Type){


	if ($CurrentDate>=$FSat or $CurrentDate>=$LDate) {

		$ADate=date('Y-m-d', strtotime($AssignDate. ' + 2 days'));
	}

	return $ADate;

}

echo AssignDateValidation($AssignDate, $Date, $FirstSat, $LastSat, 'Order');
?>