    <div class="col-lg-12" style="margin: 12px;">
     <table class="container table table-hover display table-bordered border-primary responsive">
        <h4 align="center">Material Confirmation from Inventory</h4> 
        <thead> 
           <tr>
              <th style="min-width:20px">SNo.</th>
              <th style="min-width:200px">Bank</th>
              <th style="min-width:150px">Zone</th>
              <th style="min-width:150px">Branch</th>
              <th style="min-width:150px">Order ID</th>
              <th style="min-width:120px">Assign Date</th>
              <th style="min-width:150px">Gadget</th>
              <th style="min-width:250px">Discription</th>
              <th style="min-width:100px">Release</th>
           </tr>                     
        </thead>                 
        <tbody>
          <?php 
          include 'connection.php';
          $EmployeeID=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
          $OrderID=!empty($_POST['OrderID'])?$_POST['OrderID']:'';

          if (!empty($EmployeeID) or !empty($OrderID))
          {

            if (!empty($EmployeeID)) {
               $query2="SELECT * FROM cyrusbackend.demandbase join orders on demandbase.OrderID=orders.OrderID join branchdetails on orders.BranchCode=branchdetails.BranchCode
               join gadget on orders.GadgetID = gadget.GadgetID WHERE orders.EmployeeCode=$EmployeeID and StatusID=3";
            }else{
            $query2="SELECT * FROM cyrusbackend.demandbase join orders on demandbase.OrderID=orders.OrderID join branchdetails on orders.BranchCode=branchdetails.BranchCode
            join gadget on orders.GadgetID = gadget.GadgetID WHERE demandbase.OrderID=$OrderID and StatusID=3";
         }
           //$query2="SELECT * FROM demandbase join orders on demandbase.OrderID=orders.OrderID join branchdetails on orders.BranchCode=branchdetails.BranchCode where StatusID=2 Order By demandbase.OrderID";
            $result2=mysqli_query($con,$query2);
            if (mysqli_num_rows($result2)>0)
            {
             $Sn=1;

             while($row = mysqli_fetch_array($result2)){
               echo '<input class="d-none" type="text" id="Employee" value="'.$EmployeeID.'" name="">';
               echo '<input class="d-none" type="text" id="ZoneCode" value="'.$row['ZoneRegionCode'].'" name="">';
               ?>

               <tr>
                <th><?php echo $Sn; ?></th>
                <td ><?php echo $row['BankName']; ?></td>
                <td ><?php echo $row['ZoneRegionName']; ?></td>
                <td ><?php echo $row['BranchName']; ?></td>
                <td style="color:blue;" class="showReleaseView"  data-bs-toggle="modal" data-bs-target="#ReleaseOrders" id="<?php print $row['OrderID']; ?>" ><?php echo $row['OrderID']; ?></td>
                <td ><?php echo $row['AssignDate']; ?></td>
                <td ><?php echo $row['Gadget']; ?></td>
                <td ><?php echo $row['Discription']; ?></td>
                <td><button id="<?php print $row['OrderID']; ?>"  class="btn btn-primary Release">Release</button></td>
             </tr>
             <?php
             $Sn++;
          }
       }

       $con->close();
       $con2->close();
    }
    ?>
 </tbody>
</table>


</div>