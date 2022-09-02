
<?php

include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
if(isset($_POST["Zone"]))
{

  $ZoneCode = $_POST["Zone"];
  $InfoDate = $_POST["InfoDate"];
  $ExpDate = $_POST["Expected"];
  $Warranty = $_POST["Waranty"];
  $BGAmount = $_POST["BGAmount"];
  $BGValidity = $_POST["BGValidity"];
  $Description = $_POST["Description"];
  //$BGValidity = date('Y-m-d', strtotime($InfoDate. ' + '.$_POST["BGValidity"].' days'));
  if (strpos($Description, "'") !== FALSE){

    $Description= str_replace("'","\'",$Description);

  }

    $sql = "INSERT INTO `project orders` (ZoneRegionCode, Description, DateOfInformation, DateOfCompletion, BGAmount, BGDate, Warranty, OrderedByID)
    VALUES ($ZoneCode, '$Description', '$InfoDate', '$ExpDate', $BGAmount, '$BGValidity', $Warranty, $EXEID)";

  if ($con->query($sql) === TRUE) {

  }else {
    echo "Error: " . $sql . "<br>" . $con->error;
    $myfile = fopen("error.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $con->error);
    fclose($myfile);
  }

}
?>
