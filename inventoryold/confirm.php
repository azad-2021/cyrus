<?php 
include 'connection.php';
include 'session.php';
$user=$_SESSION['userid'];
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
if (!empty($Data)){


  $myfile = fopen("item.json", "w") or die("Unable to open file!");
  fwrite($myfile, $Data);
  fclose($myfile);
  $obj = json_decode($Data);
  $OrderID2=$obj->OrderID;


  $sql = "UPDATE demandbase SET StatusID=3, ReadyDate='$Date', ReadyByID=$user WHERE OrderID=$OrderID2";

  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";

  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    $myfile = fopen("error.json", "w") or die("Unable to open file!");
    fwrite($myfile, $con->error);
    fclose($myfile);
  }

}

$OrderID=!empty($_POST['OrderID'])?$_POST['OrderID']:'';
//$ItemZone=295;

if (!empty($OrderID)){


  $myfile = fopen("release.json", "w") or die("Unable to open file!");
  fwrite($myfile, $OrderID);
  fclose($myfile);


  $sql = "UPDATE demandbase SET StatusID=4, DeliveryOrderedByID=$user, DeliveryDate='$Date' WHERE OrderID=$OrderID";

  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";

  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

}
?>