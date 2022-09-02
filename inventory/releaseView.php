<?php 
include 'connection.php';
include 'session.php';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;

if (!empty($Data)){

  $obj = json_decode($Data);
  $OrderID=$obj->OrderID;
  $ZoneCode=$obj->ZoneCode;


  $myfile = fopen("material.json", "w") or die("Unable to open file!");
  fwrite($myfile, $Data);
  fclose($myfile);

  $query="SELECT * FROM cyrusbackend.orders join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode WHERE OrderID=$OrderID";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);

  ?>


  <div class="col-lg-12" style="margin: 12px;">
   <table class="container table table-hover table-bordered border-primary table-responsive">
     <h5><?php echo 'Order ID: '.$OrderID.'&nbsp;&nbsp;&nbsp;&nbsp; Bank: '.$row['BankName'].' &nbsp;&nbsp;&nbsp;&nbsp;Zone:'.$row['ZoneRegionName'].' &nbsp;&nbsp;&nbsp;&nbsp;Branch: '.$row['BranchName'] ?></h5> 
     <thead> 
       <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:200px">Discription</th>
        <th style="min-width:150px">Quantity</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     $query2="SELECT * FROM cyrusbackend.demandextended join cyrusbackend.item on demandextended.ItemID=item.ItemID WHERE OrderID=$OrderID and demandextended.ItemQty!=0";
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