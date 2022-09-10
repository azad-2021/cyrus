<?php 
include"connection.php";

$query="SELECT EmployeeCode FROM cyrusbackend.employees WHERE Inservice=1";
$result=mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
	$EmployeeCode=$row["EmployeeCode"];

	$query="SELECT OrderID, AssignDate FROM cyrusbackend.orders
	WHERE month(DateOfInformation)<month(current_date()) and AssignDate<'2022-08-30' and month(AttendDate)=month(current_date()) and Attended=1 and year(AttendDate)=year(current_date()) and Discription not like '%Reference%' and Discription like '%AMC%' and EmployeeCode=$EmployeeCode and AttendDate>ExpectedCompletion";
	$result2=mysqli_query($con,$query);
	if (mysqli_num_rows($result2)>0)
	{
		while($row2 = mysqli_fetch_array($result2)){
			$COrder=$row2["OrderID"];

			$AssignDate=$row2["AssignDate"];
			$sql = "INSERT INTO `monthly_pending_work` (OrderID, EmployeeCode, `AssignDate`, `Date`)
			VALUES ($COrder, $EmployeeCode, '$AssignDate', '2022-09-01')";

			if ($con3->query($sql) === TRUE) {
			} else {
				echo "Error: " . $sql . "<br>" . $con3->error;


			}

		}
	}


	$query="SELECT OrderID, AssignDate FROM cyrusbackend.orders
	join branchs on orders.BranchCode=branchs.BranchCode
	WHERE AssignDate<'2022-08-30' and Attended=0 and EmployeeCode=$EmployeeCode and Address3 not like '%Reserved%' and year(DateOfInformation)=year(current_date()) and Discription like '%AMC%' and current_date()>ExpectedCompletion";
	$result2=mysqli_query($con,$query);
	if (mysqli_num_rows($result2)>0)
	{
		while($row2 = mysqli_fetch_array($result2)){
			$COrder=$row2["OrderID"];


			$AssignDate=$row2["AssignDate"];
			$sql = "INSERT INTO `monthly_pending_work` (OrderID, EmployeeCode, `AssignDate`, `Date`)
			VALUES ($COrder, $EmployeeCode, '$AssignDate', '2022-08-31')";

			if ($con3->query($sql) === TRUE) {
			} else {
				echo "Error: " . $sql . "<br>" . $con3->error;


			}

		}
	}

/*
	$query="SELECT count(OrderID) FROM cyrusbackend.orders
	WHERE month(DateOfInformation)<month(current_date()) and month(AttendDate)=month(current_date()) and Attended=1 and year(AttendDate)=year(current_date()) and Discription like '%AMC%' and Discription not like '%Reference%' and EmployeeCode=$EmployeeCode";
	$result2=mysqli_query($con,$query);
	$row2 = mysqli_fetch_array($result2);
	$CAMC=$row2["count(OrderID)"];


	$query="SELECT count(ComplaintID) FROM cyrusbackend.complaints
	WHERE month(DateOfInformation)<month(current_date()) and month(AttendDate)=month(current_date()) and Attended=1 and year(AttendDate)=year(current_date()) and Discription not like '%Reference%' and EmployeeCode=$EmployeeCode";
	$result2=mysqli_query($con,$query);
	$row2 = mysqli_fetch_array($result2);
	$CComplaint=$row2["count(ComplaintID)"];
	
	



	$query="SELECT count(OrderID) FROM cyrusbackend.orders WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeCode and Discription not like '%AMC%'";
	$result2=mysqli_query($con,$query);
	$row2 = mysqli_fetch_array($result2);
	$POrder=$row2["count(OrderID)"];

	$query="SELECT count(OrderID) FROM cyrusbackend.orders WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeCode and Discription like '%AMC%'";
	$result2=mysqli_query($con,$query);
	$row2 = mysqli_fetch_array($result2);
	$PAMC=$row2["count(OrderID)"];


	$query="SELECT count(ComplaintID) FROM cyrusbackend.complaints WHERE AssignDate is not null and Attended=0 and EmployeeCode=$EmployeeCode";
	$result2=mysqli_query($con,$query);
	$row2 = mysqli_fetch_array($result2);
	$PComplaint=$row2["count(ComplaintID)"];

	echo $POrder.' | '.$PAMC.' | '.$PComplaint.'<br>';

	$PendingOrders=$COrder+$POrder;
	$PendingComplaints=$CComplaint+$PComplaint;
	$PendingAMC=$CAMC+$PAMC;

	*/

}

?>