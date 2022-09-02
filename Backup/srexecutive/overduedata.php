
<?php  
include('connection.php'); 
include 'session.php';  
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
if(isset($_POST["ZoneCode"]))
{   
  $ZoneCode=$_POST["ZoneCode"];
  $BankCode=$_POST["BankCode"];
  $query = "SELECT * FROM branchdetails WHERE ZoneRegionCode=$ZoneCode and BankCode=$BankCode";
  $result = $con->query($query);
  $row = mysqli_fetch_array($result);
}
?>

<div class="col-lg-12" style="margin: 12px;">
  <h4 align="center">Bank: <?php echo $row['BankName'].' '; ?> Zone: <?php echo $row['ZoneRegionName'] ?></h4>
  <table class="container table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 

        <th style="min-width:120px">Branch</th>
        <th style="min-width:120px">Branch Code</th>
        <th style="min-width:100px">Bill No</th> 
        <th style="min-width:100px">Bill Date</th>  
        <th style="min-width:150px">Total Billed Amount</th> 
        <th style="min-width:100px">Received Amount</th> 
        <th style="min-width:100px">Pending Payment</th>      
        <th style="min-width:100px;">Email</th>   
        <th style="min-width:150px;">Phone</th>
        <th style="min-width:150px;">Mobile</th>
        <th style="min-width:100px;">Reminders</th>             
      </tr>                     
    </thead>                 
    <tbody>
      <?php 

      $query = "SELECT Branch_code, Email, `Mobile Number`, PhoneNo, billbook.BillID, BranchName, BookNo, BillDate, ReceivedAmount, TotalBilledValue, (billbook.TotalBilledValue - billbook.ReceivedAmount) as PendingPayment, billbook.BranchCode, subquery.rem  FROM cyrusbilling.billbook
      join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
      join (
      SELECT count(reminders.ID) as rem, reminders.BillID FROM cyrusbilling.reminders group by reminders.BillID
      ) as subquery on billbook.BillID=subquery.BillID
      WHERE (billbook.TotalBilledValue - billbook.ReceivedAmount) >1 and Cancelled=0 and BankCode=$BankCode and ZoneRegionCode=$ZoneCode and ((datediff(current_date(), BillDate)>45) or subquery.rem>10) group by BookNo";
      $result = $con2->query($query);

      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){

        print "<tr>";
                    
        print "<td>".$row['BranchName']."</td>";
        print '<td>'.$row['Branch_code']."</td>";
        print "<td>".$row['BookNo']."</td>";
        print "<td>".$row['BillDate']."</td>";
        print "<td>".$row['TotalBilledValue']."</td>";  
        print "<td>".$row['ReceivedAmount']."</td>";
        print "<td>".$row['PendingPayment']."</td>";
        print '<td>'.$row['Email']."</td>";
        print '<td>'.$row['PhoneNo']."</td>";
        print '<td>'.$row['Mobile Number']."</td>";
        print "<td>".$row['rem']."</td>";
        print "</tr>";
      }

    }
    ?>
  </tbody>
</table>
</div>
