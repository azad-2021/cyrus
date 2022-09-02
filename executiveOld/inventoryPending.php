    <div class="col-lg-12" style="margin: 12px;">
     <table class="container table table-hover display table-bordered border-primary responsive">
      <h4 align="center">Material Confirmation from Inventory</h4> 
      <thead> 
       <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:50px">Item ID</th>
        <th style="min-width:150px">Rate ID</th>
        <th style="min-width:250px">Discription</th>
        <th style="min-width:20px">Quantity</th>
        <th style="min-width:20px">Action</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     include 'connection.php';
     $Data=!empty($_POST['Data'])?$_POST['Data']:'';
     if (!empty($Data))
     {
      $Sn=1;
      $obj=json_decode($Data);
      $OrderID=$obj->OrderID;
      $ZoneCode=$obj->ZoneCode;
      //echo $ZoneCode;
      $query3="SELECT * FROM cyrusbackend.demandextended WHERE OrderID=$OrderID and demandextended.ItemQty!=0";
      $result3=mysqli_query($con,$query3);
      while($row3 = mysqli_fetch_array($result3)){
        /*
        if ($row3['RateID']>0) {
          $_SESSION['RateID']=$row3['RateID'];
          $NRateID=$_SESSION['RateID'];
        }else{
          $NRateID=1.1;
        }*/

        //echo $NRateID.'<br>';
        if ($row3['ItemQty']!=0) {
          // code...

          if($row3['RateID']>0){
          //echo $row3['RateID'];
            $RateIDS=$row3['RateID'];
            $query="SELECT * FROM cyrusbackend.demandbase 
            join cyrusbackend.demandextended on demandbase.OrderID=demandextended.OrderID 
            join cyrusbilling.rates on demandextended.RateID=rates.RateID 
            where demandbase.StatusID=2 and demandbase.OrderID=$OrderID
            and rates.Zone=$ZoneCode and demandextended.RateID=$RateIDS";

          }elseif($row3['RateID']==0){
            $ItemIDS=$row3['ItemID'];
            $query="SELECT * FROM cyrusbackend.demandbase 
            join cyrusbackend.demandextended on demandbase.OrderID=demandextended.OrderID 
            join cyrusbilling.rates on demandextended.ItemID=rates.ItemID 
            where demandbase.StatusID=2 and demandbase.OrderID=$OrderID
            and rates.Zone=$ZoneCode and demandextended.ItemID=$ItemIDS";
          }
        //$result2=mysqli_query($con,$query2);
        /*$row = mysqli_fetch_array($result2);
        if(empty($row)==true){


        }else{
          $query=$query2;
        }*/
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {


          while($row = mysqli_fetch_array($result)){
            echo '<input class="d-none" type="text" id="Order" value="'.$OrderID.'" name="">';
            echo '<input class="d-none" type="text" id="Zone" value="'.$ZoneCode.'" name="">';
            if ($ItemID !=$row['ItemID']) {
            // code...

              ?>

              <tr>
                <th><?php echo $Sn; ?></th>
                <td ><?php echo $row['ItemID']; ?></td>
                <td ><?php echo $row['RateID']; ?></td>
                <td><?php echo $row['Description']; ?></td>
                <td data-bs-toggle="modal" data-bs-ItemID="<?php echo $row['ItemID']; ?>" data-bs-target="#editQty"><?php echo $row['ItemQty']; ?></td>
                <td><button class="btn btn-danger deleteItemData" id="<?php echo $row['ItemID']; ?>">Delete</button></td>

              </tr>
              <?php
              $Sn++;
            }
            $ItemID=$row['ItemID'];
          }
        }

      }
    }
  }
  ?>
</tbody>
</table>


</div>