
<?php  
include('connection.php'); 
$ReceivedVAT='0';
$TotalVAT='0';
$BalanceVAT='0';  
if(isset($_POST["BranchCode"]))
{   
  $BranchCode=$_POST["BranchCode"];
  $query = "SELECT * FROM bills1 WHERE BranchCode=$BranchCode and Remark!='bill cancelled'";
  $result = $con->query($query);

  $sqlVAT = "SELECT BranchCode, SUM(BillAmount), Sum(ReceivedAmount) FROM bills1 WHERE BranchCode=$BranchCode and Remark!='bill cancelled' GROUP BY BranchCode";
  $resultVAT = $con->query($sqlVAT);
  if (mysqli_num_rows($resultVAT)>0)
  {
   while($row = mysqli_fetch_array($resultVAT)){
    $ReceivedVAT=sprintf('%0.2f', ($row['Sum(ReceivedAmount)']));
    $TotalVAT=sprintf('%0.2f', ($row['SUM(BillAmount)']));
    $BalanceVAT=$TotalVAT-$ReceivedVAT;

  }
}


}
?>
<br>
<div class="col-lg-12" style="margin: 12px;">
  <h5 align="center">VAT Bill Details</h5>
  <table class="table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 
        <th style="min-width: 100px;">Bill Number</th>
        <th style="min-width: 80px;">Bill Date</th>           
        <th style="min-width: 100px;">Bill Amount</th>
        <th style="min-width: 80px;">Company</th>
        <th style="min-width: 80px;">Received Date</th>  
        <th style="min-width: 100px;">Received Amount</th>  
        <th style="min-width: 400px;">Remark</th>           
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){
        $BillNo=$row['BillNo'];
        $BillAmount=sprintf('%0.2f', ($row['BillAmount']));
        $BillDate=date("d-m-Y", strtotime($row['BillDate']));
        //$Discription=$row['Discription'];
        
        $Company=$row['Company'];
        $ReceiveDate=date("d-m-Y", strtotime($row['ReceivedDate']));
        $ReceiveAmount=sprintf('%0.2f', ($row['ReceivedAmount']));
        $Remark=$row['Remark'];

        print "<tr>";
        print '<td>'.$BillNo."</td>";
        //print '<td style="min-width: 500px;">'.$Discription."</td>";
        
        print "<td>".$BillDate."</td>";
        print '<td>&#x20B9 '.$BillAmount."</td>";              
        print "<td>".$Company."</td>";
        print "<td>".$ReceiveDate."</td>";
        print "<td>&#x20B9 ".$ReceiveAmount."</td>"; 
        print '<td style="min-width: 400px;">'.$Remark."</td>";
        print "</tr>";
      }

      $con->close();
    }
    ?>
  </tbody>
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
      <td>&#x20B9 <?php echo $TotalVAT; ?></td>
      <td>&#x20B9 <?php echo $ReceivedVAT; ?></td>
      <td>&#x20B9 <?php echo $BalanceVAT; ?></td>        
    </tr>
  </tbody>
</table>
</div>
