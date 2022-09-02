
<?php  
include('connection.php');   
$TotalGST='0';
$BalanceGST='0';
$ReceivedGST='0';
if(isset($_POST["BranchCode"]))
{   
  $BranchCode=$_POST["BranchCode"];
  $query = "SELECT * FROM billbook WHERE BranchCode=$BranchCode and Cancelled=0";
  $result = $con2->query($query);

  $sqlGST = "SELECT BranchCode, SUM(TotalBilledValue), Sum(ReceivedAmount) FROM billbook WHERE BranchCode=$BranchCode and Cancelled!=1 GROUP BY BranchCode";
  $resultGST= $con2->query($sqlGST);
  if (mysqli_num_rows($resultGST)>0)
  {
   while($row = mysqli_fetch_array($resultGST)){
    $ReceivedGST=(sprintf('%0.2f', $row['Sum(ReceivedAmount)']));
    $TotalGST=(sprintf('%0.2f', $row['SUM(TotalBilledValue)']));
    $BalanceGST=(sprintf('%0.2f', $TotalGST-$ReceivedGST));


  }
}



}
?>

<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 
        <th style="min-width:150px">Bill Number</th>
        <th style="min-width:150px">Bill Date</th>           
        <th style="min-width:150px">Bill Amount</th>
        <th style="min-width:150px">Received Amount</th>
        <th style="min-width:150px">Received Date</th>        
        <th style="min-width: 500px;">Remark</th>             
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){
        $BillNo=$row['BookNo'];
        $BillAmount=$row['TotalBilledValue'];
        $BillDate=date("d-m-Y", strtotime($row['BillDate']));
        $Remark=$row['Remark'];
        if (!empty($row['ReceivedDate'])) {
          $ReceiveDate=date("d-m-Y", strtotime($row['ReceivedDate']));
        }else{
          $ReceiveDate='';
        }
        
        $ReceiveAmount=$row['ReceivedAmount'];
        $enBillNo=base64_encode($BillNo);
        print "<tr>";
        print '<td><a target="blank" href=/cyrus/reporting/billView.php?billno='.$enBillNo.'>'.$BillNo.'</a></td>';
        print "<td>".$BillDate."</td>";
        print '<td>'.$BillAmount."</td>"; 
        print "<td>".$ReceiveAmount."</td>";             
        print "<td>".$ReceiveDate."</td>";
        
        print '<td style="min-width: 500px;">'.$Remark."</td>"; 
        print "</tr>";
      }

      $con->close();
    }
    ?>
  </tbody>
</table>
</table>
<table class="table table-hover table-bordered border-primary table-responsive">
  <thead>
    <tr>
      <th scope="col">Total Billed Amount</th>
      <th scope="col">Total Received Amount</th>
      <th scope="col">Total Balance Amount</th>        
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $TotalGST; ?></td>
      <td><?php echo $ReceivedGST; ?></td>
      <td><?php echo $BalanceGST; ?></td>     
    </tr>
  </tbody>
</table>
</div>