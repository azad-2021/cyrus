<?php 
include 'connection.php';
include 'session.php';
$User=$_SESSION['userid'];
$OrderID=!empty($_POST['OrderID'])?$_POST['OrderID']:'';
date_default_timezone_set('Asia/Kolkata');

$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));

if (!empty($OrderID)){

  $sql = "SELECT * FROM cyrusbilling.add_product WHERE order_id=$OrderID";
  $result = $con2->query($sql);

  if ($result->num_rows > 0) {
    $myfile = fopen("confirm.json", "w") or die("Unable to open file!");
    while($row = $result->fetch_assoc()) {

      //echo "id: " . $row["order_id"]. " - Name: " . $row["ItemID"]. " " . $row["paqty"]. "<br>";

      $order_id=$row["order_id"];
      $ItemID=$row["IttemID"];
      $RateID=$row["paRateID"];
      $Qty=$row["paqty"];

      $data = array("OrderID"=>$order_id, "ItemID"=>$ItemID, "RateID"=>$RateID, "Quantity"=>$Qty);

      $Data=json_encode($data);

      
      fwrite($myfile, $Data);
      

      $sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
      VALUES ('$order_id', '$ItemID', $RateID, '$Qty')";

      if ($con->query($sql) === TRUE) {
        //echo "New record created successfully";

        $sql2 = "UPDATE demandbase SET StatusID=2, ConfirmationDate='$Date', ConfirmedByID=$User  WHERE OrderID=$OrderID";

        if ($con->query($sql2) === TRUE) {
          //echo "Record updated successfully";
          $sql = "DELETE FROM cyrusbilling.add_product WHERE order_id=$OrderID";
          
          if ($con2->query($sql) === TRUE) {
            echo "Record deleted successfully";
          } else {
            echo "Error deleting record: " . $con2->error;
          }
        } else {
          echo "Error updating record: " . $con->error;
        }

      } else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }
    }
    fclose($myfile);
  } else {
   $sql2 = "UPDATE demandbase SET StatusID=2, ConfirmationDate='$Date', ConfirmedByID=$User  WHERE OrderID=$OrderID";
   if ($con->query($sql2) === TRUE) {
    
   } else {
    echo "Error deleting record: " . $con->error;
  }
}







$con->close();
$con2->close();

}
?>