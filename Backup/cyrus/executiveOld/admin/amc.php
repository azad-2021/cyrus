
<?php  
include('connection.php');  
include 'session.php';  
$Type=$_SESSION['usertype']; 
$EXEID=$_SESSION['userid'];



date_default_timezone_set('Asia/Kolkata');
$newtimestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($newtimestamp));
if(isset($_POST["EmployeeID"]))
{   
  $exEmployeeID=$_POST["EmployeeID"];
  //echo $EmployeeID;
  $query="SELECT * FROM cyrusbackend.allorders WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$exEmployeeID";
  $result=mysqli_query($con,$query);
  $rowN = mysqli_fetch_array($result);

  /*
  if ($con->query($query) === TRUE) {

  } else {
    echo "Error: " . $query . "<br>" . $con->error;
  }
*/

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
        <th style="min-width:150px">AMC ID</th>
        <th style="min-width:500px">Discription</th>
        <th style="min-width:150px">Information Date</th>
        <th style="min-width:150px">Assigned Date</th>
        <th style="min-width:150px">Reassigned Times</th>  
      </tr>                     
    </thead>                 
    <tbody>

      <?php 
      if (mysqli_num_rows($result)>0)
      {
        $Sn=1;
        $query2="SELECT * FROM cyrusbackend.allorders WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and EmployeeCode=$exEmployeeID";
        $result2=mysqli_query($con,$query2);
        while($row = mysqli_fetch_array($result2)){
          $OrderID=$row['OrderID'];
          $AssignDate = $row["AssignDate"];
          $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$OrderID and Type='a' and AssignType='R'";
          $result3=mysqli_query($con,$query3);
          $row3 = mysqli_fetch_array($result3);

          $ded = date('Y-m-d', strtotime($AssignDate. ' + 90 days'));

          $datetime1 = date_create($newtimestamp);
          $datetime2 = date_create($ded);
                        //echo $datetime1.'..';
                        //echo $datetime2.'....';

          $interval = date_diff($datetime1, $datetime2);
          $de= $interval->format('%R%a');
                        //echo $de;
          $int = (int)$de;

          if ($int<0) { 
            $BANK= '<span style="color: red;">'.$row['BankName'].'</span>';
          }elseif ($int<59) { 
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
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo $row3['count(ID)']?></td>                     
        </tr>
        <?php
        $Sn++;
      }
    }
    ?>
    
  </tbody>
</table>
</div>

<?php 
}
if(isset($_POST["Zone"]))
{ 


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
          <th style="min-width:150px">OrderID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th> 
          <th style="min-width:150px">Reassigned Times</th>  

          <!--<th style="min-width:150px">Action</th>  -->        
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        $Zone=$_POST["Zone"];
        $Bank=$_POST["Bank"];
        $Sn=1;

        $query2="SELECT * FROM cyrusbackend.orders 
        join branchdetails on orders.BranchCode=branchdetails.BranchCode
        join districts on branchdetails.Address3=districts.District
        join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode 
        WHERE BankCode=$Bank and ZoneRegionCode=$Zone and Discription like '%AMC%' and AssignDate is not null and Attended=0 and ControlerID=$EXEID";
        $result2=mysqli_query($con,$query2);
        while($row = mysqli_fetch_array($result2)){
          $OrderID=$row['OrderID'];
          $AssignDate = $row["AssignDate"];
          $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$OrderID and Type='o' and AssignType='R'";
          $result3=mysqli_query($con,$query3);
          $row3 = mysqli_fetch_array($result3);

          $ded = date('Y-m-d', strtotime($AssignDate. ' + 90 days'));

          $datetime1 = date_create($newtimestamp);
          $datetime2 = date_create($ded);
          $interval = date_diff($datetime1, $datetime2);
          $de= $interval->format('%R%a');
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
            <td><?php echo $Sn; ?></td>
            <td><?php echo $BANK; ?></td>
            <td ><?php echo $Zone; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-M-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-M-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo $row3['count(ID)']; ?></td> 
          </td>      
        </tr>
        <?php
        $Sn++;
      }
      
      ?>
    </tbody>
  </table>
</div>
<?php 
}

$con->close();
$con2->close();