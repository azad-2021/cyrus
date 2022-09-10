<?php 
include"connection.php";
//include"query.php";


$OrgCode=!empty($_POST['OrgCode'])?$_POST['OrgCode']:'';
if (!empty($OrgCode))
{
	$Query="SELECT DivisionCode, DivisionName FROM $div WHERE OrganizationCode=$OrgCode order by DivisionName";
	$result=mysqli_query($con,$Query);
	if (mysqli_num_rows($result)>0)
	{
		echo "<option value=''>Select Division</option>";
		while ($arr=mysqli_fetch_assoc($result))
		{
			echo '<option value="'.$arr['DivisionCode'].'">'.$arr['DivisionName']."</option>";

		}
	}

}


$DivisionCodeRequirement=!empty($_POST['DivisionCodeRequirement'])?$_POST['DivisionCodeRequirement']:'';
if (!empty($DivisionCodeRequirement))
{
	$Query="SELECT $orders.OrderID FROM $orders
	inner join $demands on $orders.OrderID=$demands.OrderID
	WHERE DivisionCode=$DivisionCodeRequirement and ConfirmationDate is null order by $orders.OrderID";
	$result=mysqli_query($con,$Query);
	if (mysqli_num_rows($result)>0)
	{
		echo "<option value=''>Order ID</option>";
		while ($arr=mysqli_fetch_assoc($result))
		{
			echo '<option value="'.$arr['OrderID'].'">'.$arr['OrderID']."</option>";

		}
	}

}


$OrderIDRequirement=!empty($_POST['OrderIDRequirement'])?$_POST['OrderIDRequirement']:'';
if (!empty($OrderIDRequirement))
{
	$Query="SELECT $orders.Description FROM $orders
	WHERE OrderID=$OrderIDRequirement";
	$result=mysqli_query($con,$Query);
	if (mysqli_num_rows($result)>0)
	{
		$arr=mysqli_fetch_assoc($result);
		echo $arr['Description'];

	}

}

?>