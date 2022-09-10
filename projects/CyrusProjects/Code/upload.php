<?php 
include"session.php";

if ( 0 < $_FILES['file']['error'] ) {
	echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {

	$file_name = $_FILES['file']['name'];

	$file_size =$_FILES['file']['size'];
	$file_tmp =$_FILES['file']['tmp_name'];
	$file_type=$_FILES['file']['type'];
	$tmp = explode('.', $_FILES['file']['name']);
	$file_ext = strtolower(end($tmp));    
	$newfilename=$_SESSION["NewOrderID"].'.'.$file_ext;         
	move_uploaded_file($file_tmp, 'LOA/' . $newfilename);
}

?>