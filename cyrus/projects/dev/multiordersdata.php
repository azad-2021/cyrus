<?php 
include 'connection.php';
$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
$ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';
$ZoneCodeM=!empty($_POST['ZoneCodeM'])?$_POST['ZoneCodeM']:'';
//$BranchCode=15615;


if (!empty($ZoneCode))
{  
  $query="SELECT * FROM cyrusbackend.branchdetails
  join orders on branchdetails.BranchCode=orders.BranchCode
  join demandbase on orders.OrderID=demandbase.OrderID
  WHERE ZoneRegionCode=$ZoneCode and BankCode=$BankCode and AssignDate is null and Attended=0 and StatusID=1;";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($result)){

    ?>
    <tr>
      <th><?php echo $row["BranchName"] ?></th>
      <th><?php echo $row["OrderID"] ?></th>
      <td><?php print $row["Discription"]; ?></td>
      <td><input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $row["OrderID"]; ?>"></td>
    </tr>
    <?php 
  }
}


if (!empty($ZoneCodeM))
{  
  $query="SELECT * FROM rates WHERE Zone=$ZoneCodeM";
  $result=mysqli_query($con2,$query);
  if (mysqli_num_rows($result)>0)
  {
    echo '<option value="">select</option><br>';
    while ($arr=mysqli_fetch_assoc($result))
    {

      $d = array("RateID"=>$arr['RateID'], "ItemID"=>$arr['ItemID'], "Name"=>$arr['Description']);
      $data = json_encode($d);
      echo "<option value='".$data."'>".$arr['Description']."</option><br>";
    }
  }


}
?>