
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
    $ReceivedVAT=$row['Sum(ReceivedAmount)'];
    $TotalVAT=$row['SUM(BillAmount)'];
    $BalanceVAT=$TotalVAT-$ReceivedVAT;

  }
}


}
?>

<div class="col-lg-12" style="margin: 12px;">
  <table class="table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 
        <th style="min-width: 150px;">Bill Number</th>
        <th style="min-width: 500px;">Discription</th> 
        <th style="min-width: 500px;">Remark</th>
        <th style="min-width: 150px;">Bill Date</th>           
        <th style="min-width: 150px;">Bill Amount</th>
        <th style="min-width: 100px;">Company</th>
        <th style="min-width: 150px;">Received Date</th>  
        <th style="min-width: 150px;">Received Amount</th>             
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){
        $BillNo=$row['BillNo'];
        $BillAmount=$row['BillAmount'];
        $BillDate=date("d-m-Y", strtotime($row['BillDate']));
        $Discription=$row['Discription'];
        $Remark=$row['Remark'];
        $Company=$row['Company'];
        $ReceiveDate=date("d-m-Y", strtotime($row['ReceivedDate']));
        $ReceiveAmount=$row['ReceivedAmount'];

        print "<tr>";
        print '<td>'.$BillNo."</td>";
        print '<td style="min-width: 500px;">'.$Discription."</td>";
        print '<td style="min-width: 500px;">'.$Remark."</td>";
        print "<td>".$BillDate."</td>";
        print '<td>'.$BillAmount."</td>";              
        print "<td>".$Company."</td>";
        print "<td>".$ReceiveDate."</td>";
        print "<td>".$ReceiveAmount."</td>"; 
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
      <td><?php echo $TotalVAT; ?></td>
      <td><?php echo $ReceivedVAT; ?></td>
      <td><?php echo $BalanceVAT; ?></td>        
    </tr>
  </tbody>
</table>
</div>
