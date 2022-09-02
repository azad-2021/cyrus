<?php 
include 'connection.php';
$BranchCode=!empty($_POST['Branch'])?$_POST['Branch']:'';
//$BranchCode=15615;


if (!empty($BranchCode))
{  
  $query="SELECT * FROM cyrusbilling.estimates join cyrusbackend.approval on estimates.ApprovalID=approval.ApprovalID where approval.BranchCode=$BranchCode group by approval.ApprovalID";
  $result=mysqli_query($con2,$query);
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
      <td><?php echo $Employee; ?></td>
      <th scope="row"><?php echo date('d-M-y',strtotime($row["VisitDate"])) ?></th>
      <td><a href="viewe.php?apid=<?php echo $row["ApprovalID"];?>" target="_blank">Print</a></td>
    </tr>
    <?php 
  }
}
?>