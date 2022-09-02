
<?php

include 'connection.php';



$BranchCode = $_POST['branch'];


if(isset($_POST['phone'])){
	$Phone = $_POST['phone'];
	$sql = "UPDATE branchs SET `PhoneNo`= '$Phone' WHERE BranchCode=$BranchCode";
	$msg='<script>alert("Phone Number Updated")</script>';
}elseif (isset($_POST['mobile'])) {

	$Mobile=$_POST['mobile'];
	$sql = "UPDATE branchs SET `Mobile Number` = '$Mobile' WHERE BranchCode=$BranchCode";
	$msg='<script>alert("Mobile Number Updated")</script>';

}elseif (isset($_POST['email'])) {

	$Email=$_POST['email'];
	$sql = "UPDATE branchs SET Email = '$Email' WHERE BranchCode=$BranchCode";
	$msg='<script>alert("Mobile Number Updated")</script>';

}elseif (isset($_POST['gst'])) {

	$GST=$_POST['gst'];

	$sql = "UPDATE branchs SET GSTNo = '$GST' WHERE BranchCode=$BranchCode";

}elseif (isset($_POST['branch_code'])) {

	$Branch_code=$_POST['branch_code'];

	$sql = "UPDATE branchs SET Branch_code = '$Branch_code' WHERE BranchCode=$BranchCode";
}

if ($con->query($sql) === TRUE) {

} else {
	echo "Error: " . $sql . "<br>" . $con->error;
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $con->error);
	fclose($myfile);
}


?>
