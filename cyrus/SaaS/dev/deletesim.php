<?php
include('connection.php'); 
include 'session.php';
$SimID = $_GET['id'];

$sql = "DELETE FROM simprovider WHERE ID=$SimID";

if ($con->query($sql) === TRUE) {
  echo "Record deleted successfully";
  header("location:simtable.php");
} else {
  echo "Error deleting record: " . $con->error;
  
}

$con -> close();
$con2 -> close();

?>