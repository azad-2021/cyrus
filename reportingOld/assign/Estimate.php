<?php 
include 'connection.php';
$ApprovalID=!empty($_POST['ApprovalID'])?$_POST['ApprovalID']:'';
$userid=12;
?>



<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive">
    <h4></h4> 
    <thead> 
      <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:150px">Estimate ID</th>
        <th style="min-width:500px">Item</th>
        <th style="min-width:150px">Rate</th> 
        <th style="min-width:150px">Quantity</th>
        <th style="min-width:150px">Amount</th> 
        <th style="min-width:150px">Action</th>           
        <!--<th style="min-width:150px">Action</th>  -->        
      </tr>                     
    </thead>                 
    <tbody>
      <?php
      if (!empty($ApprovalID))
      {  
        $query="SELECT * FROM cyrusbilling.rates join cyrusbilling.estimates on rates.RateID=estimates.RateID WHERE estimates.ApprovalID=$ApprovalID and estimates.Qty != 0";
        $result=mysqli_query($con4,$query);  
        $Sn=0;       
        
        While($row = mysqli_fetch_array($result)){
          $Sn++;

          print "<tr>";
          print "<td>".$Sn."</td>";
          print '<td>'.$row["EstimateID"]."</td>";
          print '<td>'.$row["Description"]."</td>";
          print '<td>'.$row["Rate"]."</td>";

          print '<td style="color:blue;" data-bs-toggle="modal" data-bs-target="#editQty" data-bs-Qty="'.$row["Qty"].'" data-bs-estid="'.$row["EstimateID"].'" data-bs-ap="'.$row["ApprovalID"].'">'.$row["Qty"]."</td>";

          print '<td>'.$row["Qty"]*$row["Rate"]."</td>";
          print '<td class="d-none"><input type="text" id="apid" name="" value="'.$ApprovalID.'"></td>';
          echo '<td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteItems" data-bs-esid="'.$row["EstimateID"].'" data-bs-appid="'.$row["ApprovalID"].'">Delete</button></td>'; 
          print '</tr>';
        }
      }
      $con4->close();
      ?>
    </tbody>
  </table>
</div>
<p align="right" style="margin-right: -130px;">Total Amount: <strong><?php?></strong></p>