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

  $query="SELECT Discription, BankName, ZoneRegionName, BranchName from orders join branchdetails on orders.BranchCode=branchdetails.BranchCode WHERE OrderID=$OrderID";
  $result=mysqli_query($con,$query);
  $row = mysqli_fetch_array($result);
  $Description=$row['Discription'];

  ?>


  <div class="col-lg-12" style="margin: 12px;">
   <table class="container table table-hover table-bordered border-primary table-responsive">
     <h5><?php echo 'Bank : '.$row['BankName'].' &nbsp;&nbsp;&nbsp;&nbsp;Zone : '.$row['ZoneRegionName'].' &nbsp;&nbsp;&nbsp;&nbsp;Branch : '.$row['BranchName'].' &nbsp;&nbsp;&nbsp;&nbsp;Order ID :'.$OrderID.'<br>Description :'.$Description; ?></h5> 
     <thead> 
       <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:200px">Discription</th>
        <th style="min-width:150px">Quantity</th>
        <th style="min-width:150px">Action</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     $query2="SELECT * FROM cyrusbilling.add_product join cyrusbilling.rates on add_product.paRateID=rates.RateID WHERE order_id=$OrderID";
     $result2=mysqli_query($con2,$query2);
     if (mysqli_num_rows($result2)>0)
     {
      $Sn=1;

      while($row = mysqli_fetch_array($result2)){

       ?>

       <tr>
        <th><?php echo $Sn; ?></th>
        <td><?php echo $row['Description']; ?></td>
        <td ><?php echo $row['paqty']; ?></td>
        <td><button class="btn btn-danger deleteItems" value="<?php echo $row['paRateID']; ?>">Delete</button></td>
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