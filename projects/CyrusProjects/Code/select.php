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


?>