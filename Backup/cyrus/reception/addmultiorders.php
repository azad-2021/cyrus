<?php 

include 'connection.php';
include 'session.php';
$ID=$_SESSION['userid'];


date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));


if(isset($_POST["Data"]) and  isset($_POST["branch"]))
{

	$Branch= json_decode($_POST["branch"]);
	$obj = json_decode($_POST["Data"]);

	//print_r($Branch);
	//print_r($obj);
	$Type = $obj->Type;
	$GadgetID = $obj->Device;
	$ReceivedBy = $obj->ReceivedBy;
	$MadeBy = $obj->MadeBy;
	$InfoDate = $obj->InfoDate;
	$ExpDate = $obj->Expected;
	$Discription = $obj->Discription;


	if ($Type=='AMC') {
		$Type='Order';
	}


	if (strpos($Discription, "'") !== FALSE){

		$Discription= str_replace("'","\'",$Discription);

	}


	$OrderIDA=array();
	for ($i=0; $i < count($Branch); $i++) { 
		//echo $Branch[$i].'<br>';


		if ($Type=='Complaint') {
			$sql = "INSERT INTO complaints (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBY, MadeBy, GadgetID)
			VALUES ($Branch[$i], '$Discription', '$InfoDate', '$ExpDate', '$ReceivedBy', '$MadeBy', '$GadgetID')";

		}elseif ($Type=='Order') {
			$sql2 = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
			VALUES ($Branch[$i], '$Discription', '$InfoDate', '$ExpDate', '$ReceivedBy', '$MadeBy', '$GadgetID')";

			if ($con->query($sql2) === TRUE) {
				if(strpos($Discription, 'AMC') !== false){
					$Status=5;   
				}else{
					$Status=1;
				}
				$OrderID=$con->insert_id;
				$OrderIDA[$i] = $con->insert_id;
				$sql = "INSERT INTO demandbase (StatusID, OrderID, GeneratedByID, DemandGenDate)
				VALUES ('$Status', '$OrderID', '$ID', '$InfoDate')";

			}else {
				echo "Error: " . $sql2 . "<br>" . $con->error;

			}

			

		}


		if ($con->query($sql) === TRUE) {
			if ($Type=='Complaint') {
				$OrderIDA[$i] = $con->insert_id;
			}
		}else {
			echo "Error: " . $sql . "<br>" . $con->error;
			$myfile = fopen("errorM.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $con->error);
			fclose($myfile);
		}



	}




	for ($i=0; $i < count($OrderIDA); $i++) { 
		$OID= $OrderIDA[$i];

		if ($Type=='Order') {
			$query="SELECT OrderID, BranchName, Discription, Branch_code FROM orders join branchdetails on orders.BranchCode=branchdetails.BranchCode
			WHERE OrderID=$OID";
		}else{

			$query="SELECT ComplaintID, BranchName, Discription, Branch_code FROM complaints join branchdetails on complaints.BranchCode=branchdetails.BranchCode
			WHERE ComplaintID=$OID";
		}
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_assoc($result);

		?>
		<tr>
			<td><?php print $row["BranchName"]; ?></td>
			<td><?php print $row["Branch_code"]; ?></td>
			<td><?php print $OID; ?></td>
			<td><?php print $row["Discription"]; ?></td>
		</tr>
		<?php 
	}


}



if(isset($_POST["GST"]) and  isset($_POST["BranchCodeGST"]))
{

	$Branch=$_POST["BranchCodeGST"];
	$GST=$_POST["GST"];


	for ($i=0; $i < count($Branch); $i++) { 
		$sql = "UPDATE branchs SET GSTNo='$GST' WHERE BranchCode=$Branch[$i]";

		if ($con->query($sql) === TRUE) {

		}else {
			echo "Error: " . $sql . "<br>" . $con->error;
			$myfile = fopen("errorM.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $con->error);
			fclose($myfile);
		}
	}


	for ($i=0; $i < count($Branch); $i++) { 

		$query="SELECT * FROM  branchdetails WHERE BranchCode=$Branch[$i]";
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_assoc($result);

		?>
		<tr>
			<td><?php print $row["BranchName"]; ?></td>
			<td><?php print $row["Branch_code"]; ?></td>
			<td><?php print $row["GSTNo"]; ?></td>
		</tr>
		<?php 
	}


}