
<?php

include 'connection.php';
include 'session.php';
$ID=$_SESSION['userid'];
if(isset($_POST["Data"]))
{

  $obj = json_decode($_POST["Data"]);
  $BranchCode = $obj->BranchCode;
  $Type = $obj->Type;
  $GadgetID = $obj->Device;
  $ReceivedBy = $obj->ReceivedBy;
  $MadeBy = $obj->MadeBy;
  $InfoDate = $obj->InfoDate;
  $ExpDate = $obj->Expected;
  $Discription = $obj->Discription;

  if ($Type=='AMC') {
    $Type='Order';
  }


  if (strpos($Discription, "'") !== FALSE){

    $Discription= str_replace("'","\'",$Discription);

  }



  if ($Type=='Complaint') {
    $sql = "INSERT INTO complaints (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBY, MadeBy, GadgetID)
    VALUES ('$BranchCode', '$Discription', '$InfoDate', '$ExpDate', '$ReceivedBy', '$MadeBy', '$GadgetID')";
    $msg='<script>alert("Complaint added")</script>';
  }elseif ($Type=='Order') {
    $sql2 = "INSERT INTO orders (BranchCode, Discription, DateOfInformation, ExpectedCompletion, ReceivedBy, OrderedBy, GadgetID)
    VALUES ('$BranchCode', '$Discription', '$InfoDate', '$ExpDate', '$ReceivedBy', '$MadeBy', '$GadgetID')";
    $msg='<script>alert("Order added")</script>';
    if ($con->query($sql2) === TRUE) {
      if(strpos($Discription, 'AMC') !== false){
        $Status=5;   
      }else{
        $Status=1;
      }
      $OrderID=$con->insert_id;
      $sql = "INSERT INTO demandbase (StatusID, OrderID, GeneratedByID, DemandGenDate)
      VALUES ('$Status', '$OrderID', '$ID', '$InfoDate')";
      $msg='<script>alert("order added")</script>';
    }else {
      echo "Error: " . $sql2 . "<br>" . $con->error;

    }
    
    $OrderID = $con->insert_id;

  }


  if ($con->query($sql) === TRUE) {

  }else {
    echo "Error: " . $sql . "<br>" . $con->error;
    $myfile = fopen("error.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $con->error);
    fclose($myfile);
  }

}
?>
