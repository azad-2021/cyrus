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
           </tr>                     
        </thead>                 
        <tbody>
          <?php 
          include 'connection.php';
          $Data=!empty($_POST['Data'])?$_POST['Data']:'';
          if (!empty($Data))
          {
            $obj=json_decode($Data);
            $OrderID=$obj->OrderID;
            $ZoneCode=$obj->ZoneCode;
            $query2="SELECT * FROM cyrusbackend.demandbase join demandextended on demandbase.OrderID=demandextended.OrderID join cyrusbilling.rates on demandextended.ItemID=rates.ItemID where demandbase.StatusID=3 and rates.ItemID !=1654 and demandbase.OrderID=$OrderID and rates.Zone=$ZoneCode";
           //$query2="SELECT * FROM demandbase join orders on demandbase.OrderID=orders.OrderID join branchdetails on orders.BranchCode=branchdetails.BranchCode where StatusID=2 Order By demandbase.OrderID";
            $result2=mysqli_query($con,$query2);
            if (mysqli_num_rows($result2)>0)
            {
             $Sn=1;

             while($row = mysqli_fetch_array($result2)){
               if ($row['ItemQty']>0) {
                  // code...
                  

                ?>

                <tr>
                   <th><?php echo $Sn; ?></th>
                   <td ><?php echo $row['ItemID']; ?></td>
                   <td ><?php echo $row['RateID']; ?></td>
                   <td><?php echo $row['Description']; ?></td>
                   <td ><?php echo $row['ItemQty']; ?></td>

                </tr>
                <?php
                $Sn++;
             }
          }
       }

       $con->close();
       $con2->close();
    }
    ?>
 </tbody>
</table>


</div>