<?php 
include 'connection.php';
$EmployeeCodeAMC=!empty($_POST['EmployeeCodeAMC'])?$_POST['EmployeeCodeAMC']:'';

if (!empty($EmployeeCodeAMC))
{  //echo $EmployeeCodeAMC;
  $query="SELECT * FROM cyrusbackend.vallordersd WHERE AssignDate is null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$EmployeeCodeAMC";
  $result=mysqli_query($con,$query);
  $Sr=1;
  while($row=mysqli_fetch_assoc($result)){

    ?>
    <tr>
      <td><?php echo $Sr; ?></td>
      <td><?php echo $row["BankName"] ?></td>
      <td><?php echo $row["ZoneRegionName"] ?></td>
      <td><?php echo $row["BranchName"] ?></td>
      <td><?php echo $row["Address3"] ?></td>
      <td><?php echo $row["OrderID"] ?></td>
      <td><?php print $row["Discription"]; ?></td>
      <td>
        <input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $row["OrderID"]; ?>">
      </td>
    </tr>
    <?php 
    $Sr++;
  }
}

$AMCID=!empty($_POST['OrderID'])?$_POST['OrderID']:'';
if (!empty($AMCID))
{ 
  $EmployeeID=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
  $AssignDate=!empty($_POST['AssignDate'])?$_POST['AssignDate']:'';
  $sql2 = "UPDATE orders SET EmployeeCode=$EmployeeID, AssignDate='$AssignDate' WHERE OrderID=$AMCID";

  if ($con->query($sql2) === TRUE) {


  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

}

?>