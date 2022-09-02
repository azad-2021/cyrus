<?php 
include 'connection.php';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;

if (!empty($Data)){

  $obj = json_decode($Data);
  $OrderID=$obj->OrderID;
  $ZoneCode=$obj->ZoneCode;
  //$OrderID=38305;
  //$ZoneCode=259

  $myfile = fopen("material.json", "w") or die("Unable to open file!");
  fwrite($myfile, $Data);
  fclose($myfile);

  $query="SELECT * FROM cyrusbackend.orders join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
  join cyrusbackend.gadget on orders.GadgetID=gadget.GadgetID
   WHERE OrderID=$OrderID";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);

  ?>


  <div class="col-lg-12" style="margin: 12px;">
   <table class="container table table-hover table-bordered border-primary table-responsive">
     <h5><?php echo 'Order ID: '.$OrderID.'&nbsp;&nbsp;&nbsp;&nbsp; Bank: '.$row['BankName'].' &nbsp;&nbsp;&nbsp;&nbsp;Zone:'.$row['ZoneRegionName'].' &nbsp;&nbsp;&nbsp;&nbsp;Branch: '.$row['BranchName'].'<br>Gadget: '.$row['Gadget'] ?></h5> 
     <thead> 
       <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:200px">Discription</th>
        <th style="min-width:150px">Quantity</th>
        <th style="min-width:150px">Alternative Items</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     $query2="SELECT * FROM cyrusbackend.demandextended join cyrusbackend.item on demandextended.ItemID=item.ItemID WHERE OrderID=$OrderID and demandextended.ItemQty !=0";
     $result2=mysqli_query($con,$query2);
     if (mysqli_num_rows($result2)>0)
     {
      $Sn=1;

      while($row = mysqli_fetch_array($result2)){
        $ItemID=$row['ItemID'];
        ?>

        <tr>
          <th><?php echo $Sn; ?></th>
          <td><?php echo $row['ItemName']; ?></td>
          <td ><?php echo $row['ItemQty']; ?></td>
          <td>
            <select id="alt" class="form-control rounded-corner">
              <?php 
              $query="SELECT * FROM item";
              //$query="SELECT * FROM item join cyrusbilling.rates on item.ItemID=rates.ItemID WHERE Zone=$ZoneCode";
              $result=mysqli_query($con,$query);
              if (mysqli_num_rows($result)>0)
              {
               echo '<option value="">Select</option><br>';
               while ($arr=mysqli_fetch_assoc($result))
               {

                $NewItemID=$arr['ItemID'];
                $en = array("ItemID"=>$ItemID, "NewItemID"=>$NewItemID, "OrderID"=>$OrderID);

                $data= json_encode($en);
                
                echo "<option value='".$data."'>".$arr['ItemName']."</option><br>";
              }
            }
            ?>
          </select>
        </td>
      </tr>
      <?php
      $Sn++;
    }

    $con->close();
    $con2->close();
  }
  ?>
</tbody>
</table>


</div>

<?php 
}
?>