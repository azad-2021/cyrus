
<?php  
include('connection.php');   
$timestamp =date('y-m-d H:i:s');
$newtimestamp = date('Y-m-d',strtotime($timestamp));
if(isset($_POST["EmployeeID"]))
{   
  $exEmployeeID=$_POST["EmployeeID"];
  //echo $EmployeeID;
  $query="SELECT * FROM cyrusbackend.allcomplaint WHERE AssignDate is not null and Attended=0 and EmployeeCode=$exEmployeeID";
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
        <th style="min-width:150px">Complaint ID</th>
        <th style="min-width:500px">Discription</th>
        <th style="min-width:150px">Information Date</th>
        <th style="min-width:150px">Assigned Date</th>
        <th style="min-width:150px">Count</th>            
        <th style="min-width:150px">Reassign Date</th>
        <th style="min-width:150px">Reassign To</th>
        <!--<th>Action</th> -->          
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      if (mysqli_num_rows($result)>0)
      {
        $Sn=1;
        $query2="SELECT * FROM cyrusbackend.allcomplaint WHERE AssignDate is not null and Attended=0 and EmployeeCode=$exEmployeeID";
        $result2=mysqli_query($con,$query2);
        while($row = mysqli_fetch_array($result2)){
          $org = $row["AssignDate"];

          $ComplaintID=$row['ComplaintID'];
          $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$ComplaintID and Type='c' and AssignType='R'";
          $result3=mysqli_query($con,$query3);
          $row3 = mysqli_fetch_array($result3);

          $ded = date('Y-m-d', strtotime($org. ' + 2 days'));

          $datetime1 = date_create($newtimestamp);
          $datetime2 = date_create($ded);
                        //echo $datetime1.'..';
                        //echo $datetime2.'....';

          $interva = date_diff($datetime1, $datetime2);
          $de= $interva->format('%R%a');
                        //echo $de;
          $int = (int)$de;
          if ($int<0) { 
            $BANK= '<span style="color: red;">'.$row['BankName'].'</span>';
          }elseif ($int<1) { 
            $BANK= '<span style="color: blue;">'.$row['BankName'].'</span>';
          }else{
            $BANK=$row['BankName'];
          }
          ?>

          <tr>
            <th><?php echo $Sn; ?></th>
            <td><?php echo $BANK; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['ComplaintID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo $row3['count(ID)']?></td>
            <td><input type="date" id="<?php print $row['ComplaintID'];?>" name="Date" class="form-control" align="center"></td>
            <td ALIGN="center">
              <select class="form-control" style="text-align: center;" id="AC">
               <option value="">Select</option>        
               <?php
               $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
               $resultTech=mysqli_query($con,$queryTech);
               while($data=mysqli_fetch_assoc($resultTech)){
                $json = array("EmployeeID"=>$data['EmployeeCode'], "ComplaintID"=>$row['ComplaintID'], "Status"=>"Assigned", "Count"=>$row3['count(ID)'], "exEmployeeID"=>$exEmployeeID);
                $Data=json_encode($json);

                echo "<option value=".$Data.">".$data['Employee Name']."</option>";
              }  
              ?>
            </select>
          </td>
          <!--<td><button type="buttun" class="btn btn-primary" id="ReAssignC" value="Reassign" name="Assign">Reassign</button></td> -->            
        </tr>
      </td>              
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