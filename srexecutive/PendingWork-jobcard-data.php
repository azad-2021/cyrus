
<?php  
include('connection.php'); 
include 'session.php';  
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
?>
<table width="100%" class="table display text-start align-middle table-bordered border-primary table-hover mb-0">
  <thead id="unhead">
    <tr>
      <th style="min-width: 150px">Bank</th>
      <th style="min-width: 120px">Zone</th>
      <th style="min-width: 150px">Branch</th>
      <th style="min-width: 120px">Jobcard Number</th>
      <th style="min-width: 100px">Visit Date</th>
      <th style="min-width: 80px">Gadget</th>
      <th style="min-width: 180px">Pending Work</th>
      <th style="min-width: 80px">Estimate</th>
      <th style="min-width: 120px">Action</th>
    </tr>
  </thead>
  <tbody >
    <?php 
    $query="SELECT DISTINCT BranchCode FROM cyrusbackend.jobcardmain WHERE length(WorkPending)>2 and VisitDate>='2022-01-01'";

    $result=mysqli_query($con,$query);

    while($row = mysqli_fetch_array($result)){

      $BranchCode=$row["BranchCode"];

      $queryG="SELECT * from gadget";

      $resultG=mysqli_query($con,$queryG);

      while($rowG = mysqli_fetch_array($resultG)){
        $GadgetID=$rowG["GadgetID"];

        $query1="SELECT * FROM cyrusbackend.jobcardmain 
        join branchdetails on jobcardmain.BranchCode=branchdetails.BranchCode
        WHERE NOT exists (SELECT * FROM cyrusbackend.`jobcard reminder` WHERE `jobcard reminder`.`Card Number`=jobcardmain.`Card Number`) and length(WorkPending)>10 and VisitDate>='2022-01-01' and jobcardmain.BranchCode=$BranchCode and GadgetID=$GadgetID order by Job_Card_No desc limit 1";
        $result1=mysqli_query($con,$query1);
        while($row1 = mysqli_fetch_array($result1)){
          $Jobcard=$row1["Card Number"];

          $query2="SELECT * FROM cyrusbackend.approval
          join cyrusbilling.estimates on approval.ApprovalID=estimates.ApprovalID
          WHERE Vremark not like '%REJECTED%' and JobCardNo='$Jobcard'";
          $result2=mysqli_query($con,$query2);
          if (mysqli_num_rows($result2)>0){
            $row2 = mysqli_fetch_array($result2);
            $Estimate='<td><a target="_blank" href="viewe.php?apid='.$row2["ApprovalID"].'">Print Estimate</a></td>';
          }else{
            $Estimate='<td>No Estimate Given</td>';
          }

          ?>
          <tr>
            <td><?php echo $row1["BankName"]; ?></td>
            <td><?php echo $row1["ZoneRegionName"]; ?></td>
            <td><?php echo $row1["BranchName"]; ?></td>
            <td><a href="/technician/view.php?card=<?php echo base64_encode($row1["Card Number"]); ?>" target="_blank"><?php echo $row1["Card Number"]; ?></a></td>
            <td><?php echo $row1["VisitDate"]; ?></td>
            <td><?php echo $rowG["Gadget"]; ?></td>
            <td><?php echo $row1["WorkPending"]; ?></td>

            <?php echo $Estimate ?>
            <td><button class="btn btn-primary JobcardReminder" id="<?php print $Jobcard ?> " data-bs-toggle="modal" data-bs-target="#JobcardReminder">Add Remark</button></td>

          <?php } }
        }?>
      </tbody>
    </table>
