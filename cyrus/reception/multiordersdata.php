<?php 
include 'connection.php';
$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
$ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';
$BankCodeGST=!empty($_POST['BankCodeGST'])?$_POST['BankCodeGST']:'';
$ZoneCodeGST=!empty($_POST['ZoneCodeGST'])?$_POST['ZoneCodeGST']:'';
//$BranchCode=15615;
//echo $BankCode;

if (!empty($ZoneCode))
{  
  $query="SELECT * FROM cyrusbackend.branchdetails
  WHERE ZoneRegionCode=$ZoneCode and BankCode=$BankCode and Address3!='Reserved' order by BranchName";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($result)){

    ?>
    <tr>
      <td><?php print $row["BranchName"]; ?></td>
      <td><?php print $row["Branch_code"]; ?></td>
      <td><?php print $row["Address3"]; ?></td>
      <td><input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $row["BranchCode"]; ?>"></td>
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


if (!empty($ZoneCodeGST))
{  
  $query="SELECT * FROM cyrusbackend.branchdetails
  WHERE ZoneRegionCode=$ZoneCodeGST and BankCode=$BankCodeGST order by BranchName";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($result)){

    ?>
    <tr>
      <td><?php print $row["BranchName"]; ?></td>
      <td><?php print $row["Branch_code"]; ?></td>
      <td><?php print $row["Address3"]; ?></td>
      <td><?php print $row["GSTNo"]; ?></td>
      <td><input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $row["BranchCode"]; ?>"></td>
    </tr>
    <?php 
  }
}

?>