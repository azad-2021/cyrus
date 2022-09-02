<?php 
include 'connection.php';
$BranchCode=!empty($_POST['Branch'])?$_POST['Branch']:'';
//$BranchCode=15615;


if (!empty($BranchCode))
{  
  $query="SELECT * FROM cyrusbilling.estimates join cyrusbackend.approval on estimates.ApprovalID=approval.ApprovalID where approval.BranchCode=$BranchCode group by approval.ApprovalID";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($result)){
          //$Employee=$rowE["Employee Name"];

    $EmployeeID=$row["EmployeeID"];

    //$BranchCode=$row["BranchCode"];
    $query2="SELECT * FROM branchs WHERE BranchCode=$BranchCode";
    $result2=mysqli_query($con,$query2);
    $row2=mysqli_fetch_assoc($result2);
    $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
    $resultTech=mysqli_query($con,$query);
    $rowE=mysqli_fetch_assoc($resultTech);
    $Employee=$rowE["Employee Name"];
    ?>
    <tr>
      <th scope="row"><?php echo $row["ApprovalID"] ?></th>
      <td><?php echo $Employee; ?></td>
      <td style="color:blue;" class="EstimateDetails" data-bs-zone="<?php print $row2["ZoneRegionCode"]; ?>" id="<?php print $row["ApprovalID"]; ?>" data-bs-target="#AddItems">View</td>
    </tr>
    <?php 
  }
}
?>