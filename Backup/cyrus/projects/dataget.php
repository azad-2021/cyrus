<?php
include ('connection.php');
include 'session.php';

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));


$Organization=!empty($_POST['Organization'])?$_POST['Organization']:'';
if (!empty($Organization))
{
  $BankData="SELECT DivisionCode, DivisionName from projects.division WHERE OrganizationCode=$Organization order by DivisionName";
  $result = mysqli_query($con,$BankData);
  if(mysqli_num_rows($result)>0)
  {
    echo "<option value=''>Division</option>";
    while ($arr=mysqli_fetch_assoc($result))
    {
      echo "<option value='".$arr['DivisionCode']."'>".$arr['DivisionName']."</option><br>";
    }
  }

}


$DivisionCodeM=!empty($_POST['DivisionCodeM'])?$_POST['DivisionCodeM']:'';
if (!empty($DivisionCodeM))
{
  //$Material='%'.$_POST['MaterialNameS'].'%';
  $Data="SELECT * from projects.rates WHERE DivisionCode=$DivisionCodeM order by Description";
  $result = mysqli_query($con,$Data);
  if(mysqli_num_rows($result)>0)
  {
    while ($arr=mysqli_fetch_assoc($result))
    {
      print '<tr>';
      print '<td>'.$arr["Description"]."</td>";
      print '<td >'.$arr["Rate"]."</td>";
      print '<td ><input class="form-control rounded-corner" min=0 name="Qty[]" type="number" id="'.$arr["RateID"].'"></td>';
      print '<td ><input class="form-check-input checkb" name="select" type="checkbox" value="'.$arr["RateID"].'"></td>';
      print '</tr>';

    }
  }

}



$Division=!empty($_POST['Division'])?$_POST['Division']:'';

if (!empty($Division))
{  
  $query="SELECT * FROM projects.site WHERE DivisionCode=$Division";
  $result=mysqli_query($con,$query);

  while($row=mysqli_fetch_assoc($result)){

    ?>
    <tr>
      <td><?php echo $row["SiteName"] ?></td>
      <td>
        <input class="form-check-input checkb" name="select" type="checkbox" value="<?php echo $row["SiteCode"]; ?>">
      </td>
    </tr>
    <?php 
  }
}

if (isset($_POST['GetItem']))
{
  $query="SELECT * from cyrusbackend.item order by ItemName";
  $result=mysqli_query($con,$query);
  if (mysqli_num_rows($result)>0)
    { echo "<option value=''>Select</option><br>";
  while ($arr=mysqli_fetch_assoc($result))
  {
    echo "<option value='".$arr['ItemID']."'>".$arr['ItemName']."</option><br>";
  }
}

}


$DivisionName=!empty($_POST['DivisionName'])?$_POST['DivisionName']:'';

if (!empty($DivisionName))
{  


  $OrganizationCode=$_POST['OrganizationCode'];
  $BGDate=$_POST['BGDate'];
  $BGAmount=$_POST['BGAmount'];
  $LOADate=$_POST['LOADate'];
  $CompletionDate=$_POST['ComplitionDate'];
  $Rate=$_POST['DivRate'];
  $Material=$_POST['DivMaterial'];
  $Description=$_POST['Description'];
  //echo $BGDate;
  $err=0;
  for ($i=0; $i <count($Material) ; $i++) { 


    $query="SELECT * from projects.division WHERE DivisionName='$DivisionName' and OrganizationCode=$OrganizationCode";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    { 
      echo 'Division '.$DivisionName.' already exist';
      $err=1;
    }

    if ($err==0) {


      $sql = "INSERT INTO division (DivisionName, OrganizationCode)
      VALUES ('$DivisionName', $OrganizationCode)";

      if ($con->query($sql) === TRUE) {
       $DivisionCode = $con->insert_id;

       $sql = "INSERT INTO projects.orders (DivisionCode, Description, LOADate, DateOfCompletion, BGAmount, BGDate)
       VALUES ($DivisionCode, '$Description', '$LOADate','$CompletionDate', $BGAmount, '$BGDate')";

       if ($con->query($sql) === TRUE) {

       }else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }


      for ($i=0; $i <count($Material) ; $i++) { 


        $sql = "INSERT INTO projects.rates (DivisionCode, Description, Rate)
        VALUES ($DivisionCode, '$Material[$i]', $Rate[$i])";

        if ($con->query($sql) === TRUE) {

        }else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }


      }
      echo 1;
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }

  }

}

}


$SiteName=!empty($_POST['SiteName'])?$_POST['SiteName']:'';
if (!empty($SiteName))
{

  $err=0;
  $err2=0;
  $DivisionCode=$_POST['DivisionCode'];

  $query="SELECT * from projects.site WHERE SiteName='$SiteName'";
  $result=mysqli_query($con,$query);
  if (mysqli_num_rows($result)>0)
  { 
    echo ' Site '.$SiteName.' already exist ! ';

    $err=1;
  }

  if (isset($_POST['Material'])) {

    $NewMaterial=$_POST['Material'];
    for ($i=0; $i < count($NewMaterial); $i++) { 

      $query="SELECT * from projects.rates WHERE Description='$NewMaterial[$i]' and DivisionCode=$DivisionCode";
      $result=mysqli_query($con,$query);
      if (mysqli_num_rows($result)>0)
      { 
        echo ' Material '.$NewMaterial[$i].' already exist ! ';

        $err2=1;
        break;
      }
    }
  }

  if ($err==0 and $err2==0) {

    $query="SELECT * from projects.orders WHERE DivisionCode=$DivisionCode order by OrderID desc limit 1";
    $result=mysqli_query($con,$query);
    if (mysqli_num_rows($result)>0)
    { 
      $arr=mysqli_fetch_assoc($result);
      $OrderID=$arr['OrderID'];

    }


    $sql = "INSERT INTO projects.site (DivisionCode, SiteName)
    VALUES ($DivisionCode, '$SiteName')";

    if ($con->query($sql) === TRUE) {
      $SiteCode = $con->insert_id;
    }else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }

    if (isset($_POST['Material'])) {
      $NewMaterial=$_POST['Material'];
      $NewRate=$_POST['NewRate'];
      $NewQty=$_POST['NewQty'];

      for ($i=0; $i < count($NewMaterial); $i++) { 

        $sql = "INSERT INTO projects.rates (Description, DivisionCode, Rate)
        VALUES ('$NewMaterial[$i]', $DivisionCode, $NewRate[$i])";

        if ($con->query($sql) === TRUE) {
          $RateID = $con->insert_id;


          $sql = "INSERT INTO projects.demandextended (OrderID, RateID, Qty)
          VALUES ($OrderID, $RateID, $NewQty[$i])";
          if ($con->query($sql) === TRUE) {

          }else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }

        }else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }

      }

    }

    $SiteRateID=$_POST['SiteRateID'];
    $SiteQty=$_POST['SiteQty'];

    for ($i=0; $i < count($SiteRateID); $i++) { 

      $sql = "INSERT INTO projects.demandextended (OrderID, RateID, Qty)
      VALUES ($OrderID, $SiteRateID[$i], $SiteQty[$i])";
      if ($con->query($sql) === TRUE) {

      }else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }

    }
    echo 1;

  }
}


$DivisionCodeO=!empty($_POST['DivisionCodeO'])?$_POST['DivisionCodeO']:'';
if (!empty($DivisionCodeO))
{   
    //echo $BranchCode;
  $DataOrders="SELECT datediff(DateOfCompletion, Current_date()) as LeftDays, OrderID, Description, LOADate, DateOfCompletion, BGAmount, BGDate FROM projects.orders WHERE DivisionCode=$DivisionCodeO order by OrderID desc";
  $resultsOrders=mysqli_query($con,$DataOrders);
  if (mysqli_num_rows($resultsOrders)>0)
  {

    while ($row3=mysqli_fetch_assoc($resultsOrders))
    {

      if (($row3["LeftDays"]<45) and ($row3["LeftDays"]>0)) {
        $tr='<tr class="table-danger">';

        echo '<script>swal("warning","you have '.$row3["LeftDays"].' left on this site","warning")</script>';

      }else{
        $tr='<tr class="table-success">';
      }

      $enOrderID=base64_encode($row3["OrderID"]);

      print $tr;
      print '<td style="min-width: 100px;">'.$row3["OrderID"].'</a>';
      print '<td style="min-width: 120px;">'.date("d-M-Y", strtotime($row3["LOADate"]))."</td>";
      print '<td style="min-width: 160px;">'.date("d-M-Y", strtotime($row3["DateOfCompletion"]))."</td>"; 
      print '<td style="min-width: 500px;">'.$row3["Description"]."</td>";
      print '<td style="min-width: 150px;">'.$row3["BGAmount"]."</td>";
      print '<td style="min-width: 120px;">'.date("d-M-Y", strtotime($row3["BGDate"]))."</td>";
      print "</tr>";
    }


  }
}


?>

