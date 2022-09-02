
<?php

include 'connection.php';
include 'session.php';
// Fetching Values From URL
/*
$BranchCode = $_POST['branch'];
$Phone = $_POST['phone'];
$Mobile = $_POST['mobile'];
$Email = $_POST['email'];
$GST = $_POST['gst'];
*/

if(isset($_POST['Data'])){
	$obj = json_decode($_POST["Data"]);
	$ComplaintID = $obj->ComplaintID;
	$Discription=$obj->discription;
	$sql = "UPDATE complaints SET `Discription`= '$Discription' WHERE ComplaintID=$ComplaintID";
}elseif (isset($_POST['infodate'])) {

	$Date=$_POST['infodate'];
	$ComplaintID = $_POST['ComplaintID'];
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $Date);
	fclose($myfile);
	$sql = "UPDATE complaints SET `DateOfInformation`= '$Date' WHERE ComplaintID=$ComplaintID";

}elseif (isset($_POST['ReceivedBy'])) {

	$ReceivedBy=$_POST['ReceivedBy'];
	$ComplaintID = $_POST['ComplaintID'];
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $ComplaintID);
	fclose($myfile);
	
	$sql = "UPDATE complaints SET `ReceivedBY`= '$ReceivedBy' WHERE ComplaintID=$ComplaintID";

}elseif (isset($_POST['MadeBy'])) {

	$MadeBy=$_POST['MadeBy'];
	$ComplaintID = $_POST['ComplaintID'];
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $OrderedBy);
	fclose($myfile);
	$sql = "UPDATE complaints SET `MadeBy`= '$MadeBy' WHERE ComplaintID=$ComplaintID";

}elseif (isset($_POST['gadget'])) {

	$GadgetID=$_POST['gadget'];
	$ComplaintID = $_POST['ComplaintID'];
	//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	//fwrite($myfile, $OrderedBy);
	//fclose($myfile);
	$sql = "UPDATE complaints SET `GadgetID`= $GadgetID WHERE ComplaintID=$ComplaintID";

}elseif(isset($_POST['Data2'])){

	$Data=$_POST['Data2'];
	$obj = json_decode($Data);

	$ComplaintID= $obj->ComplaintID;
	$ExpDate= $obj->ExpectedDate;
	$sql = "UPDATE complaints SET `ExpectedCompletion`= '$ExpDate' WHERE ComplaintID=$ComplaintID";

}

/*
$BranchCode = 3317;
$Type = 'Order';
$GadgetID = 1;
$ReceivedBy = 'ABC';
$MadeBy = 'DEF';
$InfoDate = '2021-12-07';
$ExpDate = '2021-12-09';
$Discription ='Hello';
*/
//$data = $BranchCode.'...'.$Type.'...'.$Device.'...'.$ReceivedBy.'...'.$MadeBy.'...'.$InfoDate.'...'.$ExpDate.'...'.$Discription;




if ($con->query($sql) === TRUE) {
	echo $msg;
    //echo "<meta http-equiv='refresh' content='0'>";
} else {
	echo "Error: " . $sql . "<br>" . $con->error;

	//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	//fwrite($myfile, $con->error);
	//fclose($myfile);
}


?>
