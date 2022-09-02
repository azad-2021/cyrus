<?php 
include 'connection.php';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;
//$Data='{"Qty":"2","ItemID":"1626","Type":"update","OrderID":"187611"}';
$myfile = fopen("add.json", "w") or die("Unable to open file!");
fwrite($myfile, $Data);
fclose($myfile);
if (!empty($Data)){

  $obj = json_decode($Data);
  $OrderID=$obj->OrderID;
  $ItemID=$obj->ItemID;
  $Qty=$obj->Qty;
  $Type=$obj->Type;
  //$OrderID=38305;
  //$ZoneCode=259

  if ($Type=="update") {

    $sql = "UPDATE demandextended SET ItemQty=$Qty  WHERE ItemID=$ItemID and OrderID=$OrderID";

    $result = $con->query($sql);

  }elseif ($Type=="Delete") {
    $sql= "DELETE FROM add_product WHERE paRateID=$RateID";
  }


  if ($con2->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $con2->error;
    $myfile = fopen("error.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $con2->error);
    fclose($myfile);
  }
}


?>