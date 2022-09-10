<?php 
  include 'connection.php';
  include 'session.php';

  $EmployeeID = $_SESSION['empid'];

  if(isset($_GET['tech']))
  {
$tech=$_GET['tech'];

echo $tech;
}

if (isset($_SESSION['apid'])) {

    $approvalID=$_SESSION['apid'];

    $query ="SELECT * FROM `approval` WHERE ApprovalID=$approvalID";
    $results = mysqli_query($con2, $query);
    $dataName=mysqli_fetch_assoc($results);
    if (empty($dataName)==false) {

    $OrderID = $dataName['OrderID'];
    if (empty($OrderID)==true) {
      $ComplaintID=$dataName['ComplaintID'];
      $sql = "UPDATE  `complaints` SET Attended='0' WHERE ComplaintID=$ComplaintID";
      $result2=mysqli_query($con2,$sql);
      $sql = "DELETE FROM approval WHERE ComplaintID=$ComplaintID and posted=0";
     }else{
      $sql3 = "UPDATE  `orders` SET Attended='0' WHERE OrderID=$OrderID";
      $queryV3=mysqli_query($con2,$sql3);
      $sql = "DELETE FROM approval WHERE OrderID=$OrderID and posted=0";
     }

    }

$sql2 = "DELETE FROM add_product WHERE paEmployeeID=$EmployeeID";

if ($con3->query($sql2) === TRUE) {
  echo "Record deleted successfully";

}


$sql3 = "DELETE FROM add_estimate WHERE EmployeeUID=$EmployeeID";

if ($con3->query($sql3) === TRUE) {
  echo "Record deleted successfully";

}

$sql4 = "DELETE FROM pbills WHERE ApprovalID=$approvalID";

if ($con3->query($sql4) === TRUE) {
  echo "Record deleted successfully";

}

$sql5 = "DELETE FROM estimates WHERE ApprovalID=$approvalID";

if ($con3->query($sql5) === TRUE) {
  echo "Record deleted successfully";

}



if ($con2->query($sql) === TRUE) {
  echo "Record deleted successfully";
  header("location:redirect.php?eid=$EmployeeID");
} else {
  echo "Error deleting record: " . $con2->error;
}

unset($_SESSION['apid']);

}

?>