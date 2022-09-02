
<?php  
include('connection.php');   

if(isset($_POST["EmployeeID"]))
{   
  $exEmployeeID=$_POST["EmployeeID"];
  //echo $EmployeeID;
  $query="SELECT * FROM cyrusbackend.allorders WHERE AssignDate is not null and Attended=0 and Discription not like '%AMC%' and EmployeeCode=$exEmployeeID";
  $result=mysqli_query($con,$query);
  $rowN = mysqli_fetch_array($result);
  /*
  if ($con->query($query) === TRUE) {

  } else {
    echo "Error: " . $query . "<br>" . $con->error;
  }
*/
}
?>

<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive">
    <h4><?php if(isset($rowN['Employee NAME'])){echo $rowN['Employee NAME'];} ?></h4> 
    <thead> 
      <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:150px">Bank</th>
        <th style="min-width:150px">Zone</th>
        <th style="min-width:150px">Branch</th> 
        <th style="min-width:150px">OrderID</th>
        <th style="min-width:500px">Discription</th>
        <th style="min-width:150px">Information Date</th>
        <th style="min-width:150px">Assigned Date</th> 
        <th style="min-width:150px">Reassign Date</th>           
        <th style="min-width:150px">Reassign To</th>  
        <th style="min-width:150px">Count</th>
        <!--<th style="min-width:150px">Action</th>  -->        
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      if (mysqli_num_rows($result)>0)
      {
        $Sn=1;

        $query2="SELECT * FROM cyrusbackend.allorders WHERE AssignDate is not null and Attended=0 and `Discription` not like '%AMC%' and EmployeeCode=$exEmployeeID";
        $result2=mysqli_query($con,$query2);
        while($row = mysqli_fetch_array($result2)){
          $OrderID=$row['OrderID'];
          $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$OrderID and Type='o' and AssignType='R'";
          $result3=mysqli_query($con,$query3);
          $row3 = mysqli_fetch_array($result3);
          ?>

          <tr>
            <th><?php echo $Sn; ?></th>
            <td><?php echo $row['BankName']; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            
            <td><input type="date" id="<?php print $row['OrderID'];?>" name="Date" class="form-control" align="center"></td>
            <td>
              <form id="resetAO">
              <select class="form-control" id="AO">
               <option value="">Select</option>        
               <?php
               $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
               $resultTech=mysqli_query($con,$queryTech);
               while($data=mysqli_fetch_assoc($resultTech)){
                $json = array("EmployeeID"=>$data['EmployeeCode'], "OrderID"=>$row['OrderID'], "Status"=>"Assigned", "Count"=>$row3['count(ID)'], "exEmployeeID"=>$exEmployeeID);
                $Data=json_encode($json);
                echo "<option value=".$Data.">".$data['Employee Name']."</option>";
              }  
              ?>
            </select>
            </form>
          </td>
          <td><?php echo $row3['count(ID)']; ?></td> 
          <!--<td><button class="btn btn-primary" id="ReAssignAO" value="Reassign" name="Assign">Reassign</button></td>-->         
        </tr>
        <?php
        $Sn++;
      }

      $con->close();
    }
    ?>
  </tbody>
</table>
</table>

</div>