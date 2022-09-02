
<?php  
include('connection.php'); 
include 'session.php';  
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
if(isset($_POST["BranchCode"]))
{   
  $BranchCode=$_POST["BranchCode"];
  $query = "SELECT * FROM branchdetails WHERE BranchCode=$BranchCode";
  $result = $con->query($query);

}
?>

<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 
        <th style="min-width:150px">Bank</th>
        <th style="min-width:150px">Zone</th>           
        <th style="min-width:120px">Branch</th>
        <th style="min-width:120px">Branch Code</th>
        <th style="min-width:100px">Phone</th>        
        <th style="min-width:100px;">Email</th>   
        <th style="min-width:150px;">Mobile</th>            
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){

        print "<tr>";
        print "<td>".$row['BankName']."</td>";
        print "<td>".$row['ZoneRegionName']."</td>";             
        print "<td>".$row['BranchName']."</td>";
        print '<td>'.$row['Branch_code']."</td>"; 
        print '<td>'.$row['PhoneNo']."</td>";
        print '<td>'.$row['Email']."</td>";
        print '<td>'.$row['Mobile Number']."</td>";
        print "</tr>";
      }

    }
    ?>
  </tbody>
</table>
</div>

<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 
        <th style="min-width:50px">S. No.</th>
        <th style="min-width:50px">Bill ID</th>
        <th style="min-width:150px">Bill No.</th>           
        <th style="min-width:80px">Bill Date</th>
        <th style="min-width:80px">Total Billed Value</th>
        <th style="min-width:100px">Received Amount</th>        
        <th style="min-width:100px;">Pending Payment</th>            
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      $query = "SELECT * FROM billbook WHERE (TotalBilledValue - ReceivedAmount) >1
      and Cancelled=0 and BillDate <'$Date' and BranchCode=$BranchCode
      order by BillDate";

      $result = $con2->query($query);
      if (mysqli_num_rows($result)>0)
      {
        $Sn=1;
        while($row = mysqli_fetch_array($result)){

          print "<tr>";
          print "<td>".$Sn."</td>";
          print "<td>".$row['BillID']."</td>";
          print '<td><a target="blank" href=/cyrus/reporting/billView.php?billno='.base64_encode($row['BookNo']).'>'.$row['BookNo'].'</a></td>';             
          print "<td>".$row['BillDate']."</td>";
          print '<td>'.$row['TotalBilledValue']."</td>"; 
          print '<td>'.$row['ReceivedAmount']."</td>";
          print '<td style="color:Blue;" data-bs-toggle="modal" data-bs-target="#reminder" data-bs-Billno="'.$row['BookNo'].'" data-bs-BillID="'.$row['BillID'].'">'.sprintf('%0.2f', ($row['TotalBilledValue']-$row['ReceivedAmount']))."</td>";
          print "</tr>";
          $Sn++;
        }

      }
      ?>
    </tbody>
  </table>
</div>


<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive"> 
    <h5 align="center">Reminder History</h5>
    <thead> 
      <tr> 
        <th style="min-width:70px">S. No.</th>
        <th style="min-width:150px">User Name</th>
        <th style="min-width:120px">Bill No.</th>           
        <th style="min-width:170px">Reminder Date</th>
        <th style="min-width:300px">Description</th>
        <th style="min-width:150px">Next Reminder</th>        
        <th style="min-width:80px;">Action</th>
        <th style="min-width:150px;">Resolve Date</th>            
      </tr>                     
    </thead>                 
    <tbody>
      <?php 
      $query = "SELECT * FROM cyrusbilling.billbook
      left join cyrusbilling.reminders on billbook.BillID=cyrusbilling.reminders.BillID
      join cyrusbackend.pass on reminders.UserID=pass.ID
      WHERE billbook.BranchCode=$BranchCode order by billbook.BillDate desc";

      $result = $con2->query($query);
      if (mysqli_num_rows($result)>0)
      {
        $Sn=1;
        while($row = mysqli_fetch_array($result)){

          print "<tr>";
          print "<td>".$Sn."</td>";
          print "<td>".$row['UserName']."</td>";
          print '<td>'.$row['BookNo'].'</td>';             
          print "<td>".$row['ReminderDate']."</td>";
          print '<td>'.$row['Description']."</td>"; 
          print '<td>'.$row['NextReminderDate']."</td>";
          print '<td>'.$row['Action']."</td>";
          print '<td>'.$row['ResolvedDate']."</td>";
          print "</tr>";
          $Sn++;
        }

      }
      ?>
    </tbody>
  </table>
</div>