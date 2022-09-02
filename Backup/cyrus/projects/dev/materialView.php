<?php 
include 'connection.php';
$OrderID=!empty($_POST['OrderID'])?$_POST['OrderID']:'';
//$ItemZone=295;

if (!empty($OrderID)){


   $myfile = fopen("materialview.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $OrderID);
  fclose($myfile);

  ?>


  <div class="col-lg-12" style="margin: 12px;">
   <table class="container table table-hover table-bordered border-primary table-responsive">
     <h4><?php echo $OrderID; ?></h4> 
     <thead> 
       <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:200px">Discription</th>
        <th style="min-width:150px">Quantity</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     $query2="SELECT * FROM cyrusbackend.demandextended join cyrusbackend.item on demandextended.ItemID=item.ItemID WHERE OrderID=$OrderID";
     //$query2="SELECT * FROM cyrusbackend.demandextended join cyrusbilling.rates on demandextended.ItemID=rates.ItemID WHERE OrderID=$OrderID and Zone = $ZoneCode";
     $result2=mysqli_query($con,$query2);
     if (mysqli_num_rows($result2)>0)
     {
      $Sn=1;

      while($row = mysqli_fetch_array($result2)){

       ?>

       <tr>
        <th><?php echo $Sn; ?></th>
        <td><?php echo $row['ItemName']; ?></td>
        <td ><?php echo $row['ItemQty']; ?></td>
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