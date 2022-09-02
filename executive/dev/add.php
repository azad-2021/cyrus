<?php 
include 'connection.php';
include 'session.php';

$userID=$_SESSION['userid'];

$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;
$myfile = fopen("deleted.json", "w") or die("Unable to open file!");
fwrite($myfile, $Data);
fclose($myfile);
if (!empty($Data)){

  $obj = json_decode($Data);
  $OrderID=$obj->OrderID;
  $RateID=$obj->RateID;
  $ItemID=$obj->ItemID;
  $Qty=$obj->Qty;
  $Type=$obj->Type;

  if ($Type=="Add") {

    $sql = "SELECT * FROM cyrusbilling.add_product WHERE order_id=$OrderID and IttemID=$ItemID";
    $result = $con2->query($sql);

    $sql3 = "SELECT StatusID FROM cyrusbackend.demandbase WHERE OrderID=$OrderID and StatusID=3";
    $result3 = $con->query($sql3);


    $sql2 = "SELECT * FROM cyrusbilling.rates WHERE RateID=$RateID and ItemID=1654";
    $result2 = $con2->query($sql2);

    $sqlS = "SELECT * FROM cyrusbackend.demandextended WHERE ItemID=$ItemID and OrderID=$OrderID";
    $resultS = $con->query($sqlS);

    if ($result->num_rows > 0) {
      echo '<script>alert("Item already exist")</script>';
    }elseif($resultS->num_rows > 0) {
      echo '<script>alert("Item already exist")</script>';
    }elseif ($result2->num_rows > 0) {
      echo '<script>alert("Item is in undecided category. Please contact to store")</script>';
    }elseif ($result3->num_rows > 0) {
      echo '<script>alert("Order ID already assigned.")</script>';
    }else{  

      $sql = "INSERT INTO add_product (order_id, paRateID, IttemID, paqty)
      VALUES ('$OrderID', '$RateID', '$ItemID', '$Qty')";
    }
  }elseif ($Type=="Delete") {
    $sql= "DELETE FROM add_product WHERE paRateID=$RateID";
  }elseif ($Type=="DeleteItems") {
    $sqlI = "SELECT RateID, ItemQty FROM cyrusbackend.demandextended WHERE ItemID=$ItemID and OrderID=$OrderID";
    $resultI = $con->query($sqlI);
    $rowI=mysqli_fetch_assoc($resultI);
    $ItemQty=$rowI['ItemQty'];
    $RID=$rowI['RateID'];

    $sql = "INSERT INTO deletelogs (ItemID, RateID, ItemQty, DeletedByID, OrderID)
    VALUES ('$ItemID', '$RID', '$ItemQty', '$userID', '$OrderID')";
    if ($con->query($sql) === TRUE) {
      //$sql= "UPDATE cyrusbackend.demandextended SET ItemQty=0 WHERE ItemID=$ItemID";
      $sql= "DELETE FROM cyrusbackend.demandextended WHERE ItemID=$ItemID and OrderID=$OrderID";
    }else {
    //echo "Error: " . $sql . "<br>" . $con2->error;
      $myfile = fopen("error.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $con->error);
      fclose($myfile);
    }

    
  }



  if ($con2->query($sql) === TRUE) {
    //echo "New record created successfully";
  } else {
    //echo "Error: " . $sql . "<br>" . $con2->error;
    $myfile = fopen("error.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $con2->error);
    fclose($myfile);
  }
}


?>