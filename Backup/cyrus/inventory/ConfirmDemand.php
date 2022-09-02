<?php 
include 'connection.php';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;

if (!empty($Data)){


  $myfile = fopen("item.json", "w") or die("Unable to open file!");
  fwrite($myfile, $Data);
  fclose($myfile);
  $obj = json_decode($Data);
  $OrderID=$obj->OrderID;
  $ItemID=$obj->ItemID;
  $NewItemID=$obj->NewItemID;
  //$OrderID=38305;
  //$ZoneCode=259


  $sql = "UPDATE demandextended SET AltItemID=$NewItemID WHERE ItemID=$ItemID";

  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";

  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

  $con->close();
  $con2->close();

}
?>