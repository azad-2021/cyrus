
<?php  
include('connection.php');   
$TotalGST='0';
$BalanceGST='0';
$ReceivedGST='0';
if(isset($_POST["BranchCode"]))
{   
  $BranchCode=$_POST["BranchCode"];
  $query = "SELECT * FROM billbook WHERE BranchCode=$BranchCode and Cancelled!=1 and Cancelled!=-1";
  $result = $con2->query($query);

  $sqlGST = "SELECT BranchCode, SUM(TotalBilledValue), Sum(ReceivedAmount) FROM billbook WHERE BranchCode=$BranchCode and Cancelled!=1 and Cancelled!=-1 GROUP BY BranchCode";
  $resultGST= $con2->query($sqlGST);
  if (mysqli_num_rows($resultGST)>0)
  {
   while($row = mysqli_fetch_array($resultGST)){
    $ReceivedGST=sprintf('%0.2f', ($row['Sum(ReceivedAmount)']));
    $TotalGST=sprintf('%0.2f', ($row['SUM(TotalBilledValue)']));
    $BalanceGST=$TotalGST-$ReceivedGST;

  }
}



}
?>
<br>
<div class="col-lg-12" style="margin: 12px;">
  <h5 align="center">GST Bill Details</h5>
  <table class="container table table-hover table-bordered border-primary "> 
    <thead> 
      <tr> 
        <th style="min-width:100px">Bill Number</th>
        <th style="min-width:80px">Bill Date</th>           
        <th style="min-width:100px">Bill Amount</th>
        <th style="min-width:100px">Received Amount</th>
        <th style="min-width:80px">Received Date</th>        
        <th style="min-width: 400px;">Remark</th>             
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){
        $BillNo=$row['BookNo'];
        $SGST=$row['SGST'];
        $CGST=$row['CGST'];
        $IGST=$row['IGST'];
        $BillAmount=sprintf('%0.2f', ($row['TotalBilledValue']));
        $BillDate=date("d-m-Y", strtotime($row['BillDate']));
        $Remark=$row['Remark'];
        if (!empty($row['ReceivedDate'])) {
          $ReceiveDate=date("d-m-Y", strtotime($row['ReceivedDate']));
        }else{
          $ReceiveDate='';
        }
        


        $ReceiveAmount=sprintf('%0.2f', ($row['ReceivedAmount']));
        $enBillNo=base64_encode($BillNo);
        print "<tr>";
        print '<td><a target="blank" href=/cyrus/reporting/billView.php?billno='.$enBillNo.'>'.$BillNo.'</a></td>';
        print "<td>".$BillDate."</td>";

        print '<td style="color:blue" data-bs-toggle="modal" data-bs-billdate="'.$BillDate.'" data-bs-SGST="'.$SGST.'" data-bs-CGST="'.$CGST.'" data-bs-IGST="'.$IGST.'"  data-bs-Billno="'.$BillNo.'" data-bs-Totalamount="'.$BillAmount.'" data-bs-Receiveamount="'.$ReceiveAmount.'" data-bs-DD="'.$row['DD/Online'].'" data-bs-SAmount="'.$row['SecurityAmt'].'" data-bs-SDt="'.$row['SecurityDt'].'" data-bs-SRAmount="'.$row['SecurityRcdAmt'].'" data-bs-SRDt="'.$row['SecurityRcdDt'].'" data-bs-Remark="'.$row['Remark'].'" data-bs-ReceiveDate="'.$ReceiveDate.'" " data-bs-target="#GSTPayment">&#x20B9 '.$BillAmount."</td>"; 

        print "<td>&#x20B9 ".$ReceiveAmount."</td>";             
        print "<td>".$ReceiveDate."</td>";
        
        print '<td style="min-width: 400px;">'.$Remark."</td>"; 
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
      <td>&#x20B9 <?php echo $TotalGST; ?></td>
      <td>&#x20B9 <?php echo $ReceivedGST; ?></td>
      <td>&#x20B9 <?php echo $BalanceGST; ?></td>     
    </tr>
  </tbody>
</table>
</div>