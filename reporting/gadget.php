<?php 
include"connection.php";
include"session.php";
$jobcard=!empty($_POST['jobcard'])?$_POST['jobcard']:'';
if (!empty($jobcard))
{   
	//echo $jobcard;
	$query="SELECT Gadget, TimeofArrivial, TimeofDeparture, VerifiedBy, jobcardmain.GadgetID, jobcardmain.GadgetID FROM cyrusbackend.jobcardmain
	join gadget on jobcardmain.GadgetID=gadget.GadgetID WHERE `Card Number`='$jobcard'";

	$results=mysqli_query($con,$query);


	if (mysqli_num_rows($results)>0)
	{
		$row=mysqli_fetch_assoc($results);
		$Gadget=$row["Gadget"];
		$Arrival=$row["TimeofArrivial"];
		$Departure=$row["TimeofDeparture"];
		$VerifiedBy=$row["VerifiedBy"];
		$GadgetID=$row["GadgetID"];
	}


	$query="SELECT * FROM cyrusbackend.jobcardcctv WHERE `Card Number`='$jobcard'";

	$results=mysqli_query($con,$query);


	if (mysqli_num_rows($results)>0)
	{
		$row2=mysqli_fetch_assoc($results);

		$Make=$row2["CCTVMake"];

		if (!empty($row2["CCTVModel4"])) {
			$Model='4';
		}elseif (!empty($row2["CCTVModel8"])) {
			$Model='8';
		}elseif (!empty($row2["CCTVModel16"])) {
			$Model='16';
		}


		$CameraNumber=$row2["CamerNumber"];
		$StartDate=$row2["RecordingFrom"];
		$EndDate=$row2["RecordingUpto"];
		$NoRecording=$row2["NoRecording"];


		$OC='No';
		$CB='No';
		$CP='No';
		if ($row2["Openingcleaning"]==1) {
			$OC='Yes';
		}

		if ($row2["CheckingBNC"]==1) {
			$CB='Yes';
		}

		if ($row2["CheckingPowerSupply"]==1) {
			$CP='Yes';
		}

	}



}

?>


<table style="width:100%" class="table table-hover table-bordered border-primary">
	<tr>
		<th>Arrival Time:</th>
		<td><?php echo $Arrival;  ?></td>
	</tr>
	<tr>
		<th>Departure Time:</th>
		<td><?php echo $Departure; ?></td>
	</tr>
	<th>Verified By</th>
	<td><?php echo $VerifiedBy; ?></td>
	<?php 

	if ($GadgetID==1) {
		?>
		<tr>
			<th>Total HDD</th>
			<td><?php echo $row2["HDDTotal"] ?></td>
		</tr>
		<tr>
			<th>Allocated HDD</th>
			<td><?php echo $row2["HDDAllocated"] ?></td>
		</tr>

		<tr>
			<th>Channel</th>
			<td><?php echo $Model;  ?></td>
		</tr>

		<tr>
			<th>Opening and cleaning of DVR/PC</th>
			<td><?php echo $OC; ?></td>
		</tr>
		<tr>
			<th>Checking of Connectors</th>
			<td><?php echo $CB; ?></td>
		</tr>
		<tr>
			<th>Checking Power Supply</th>
			<td><?php echo $CP; ?></td>
		</tr>

		<tr>
			<th>DVR Make</th>
			<td><?php echo $Make; ?></td>
		</tr>
		<tr>
			<th>Types Of Camera Installed</th>
			<td><?php echo $CameraNumber; ?></td>
		</tr>
		<tr>
			<th>Days of No Recording</th>
			<td><?php echo $NoRecording; ?></td>
		</tr>

		<tr>
			<th>First Stored Recording Date</th>
			<td><?php echo date('d-M-Y',strtotime($StartDate)); ?></td>
		</tr>
		<tr>
			<th>Last Stored Recording Date</th>
			<td><?php echo date('d-M-Y',strtotime($EndDate)); ?></td>
		</tr>
		

	<?php }
	?>
</table>