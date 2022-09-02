
<?php  
include('connection.php');  
include 'session.php';  
$Type=$_SESSION['usertype']; 
if (isset($_GET['user'])) {
  $EXEID=$_GET['user'];
  $_SESSION['query']=$EXEID;
}if (isset($_SESSION['query'])) {
  $EXEID=$_SESSION['query'];
}else{
  $EXEID=$_SESSION['userid'];
}


date_default_timezone_set('Asia/Kolkata');
$newtimestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($newtimestamp));
if(isset($_POST["EmployeeID"]))
{   
  $EmployeeID=$_POST["EmployeeID"];

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
          <th style="min-width:150px">District</th>  
          <th style="min-width:150px">AMC ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px;">Reassigned Times</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        if (isset($_POST["delayed"])) {
          $query="SELECT * FROM cyrusbackend.allorders
          join cyrusbackend.districts on allorders.Address3=districts.District
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and ControlerID=$EXEID and EmployeeCode=$EmployeeID and datediff(Current_date(), AssignDate)>60";
        }else{
          $query="SELECT * FROM cyrusbackend.allorders
          join cyrusbackend.districts on allorders.Address3=districts.District
          join cyrusbackend.`cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE AssignDate is not null and Attended=0 and Discription like '%AMC%' and ControlerID=$EXEID and EmployeeCode=$EmployeeID";
        }
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['OrderID'];
            $AssignDate = $row["AssignDate"];
            $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$OrderID and Type='a' and AssignType='R'";
            $result3=mysqli_query($con,$query3);
            $row3 = mysqli_fetch_array($result3);

            $ded = date('Y-m-d', strtotime($AssignDate. ' + 90 days'));

            $datetime1 = date_create($newtimestamp);
            $datetime2 = date_create($ded);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
                        //echo $de;
            $int = (int)$de;
            $BANK=$row['BankName'];
            if ($int<0) { 
              $tr='<tr class="table-danger">';
              //$BANK= '<span style="color: red;">'.$row['BankName'].'</span>';
            }elseif ($int<59) { 
              $tr='<tr style="min-width:150px; background-color:#C2E4EF">';
              //$BANK= '<span style="color: blue;">'.$row['BankName'].'</span>';
            }else{
              $tr="<tr>";
            }
            echo $tr;
            ?>

            
            <th><?php echo $Sn; ?></th>
            <td><?php echo $BANK; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['Address3']; ?></td>
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

if(isset($_POST["CompletedAMC"]))
{   
  $EmployeeID=$_POST["EmployeeIDC"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive display2">
      <h4><?php if(isset($rowN['Employee NAME'])){echo $rowN['Employee NAME'];} ?></h4> 
      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:150px">District</th> 
          <th style="min-width:150px">AMC ID</th>
          <th style="min-width:150px">Assigned Date</th> 
          <th style="min-width:150px">Attend Date</th>
          <th style="min-width:150px">Jobcard No.</th>
          <th style="min-width:150px">Reassigned Times</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT * FROM cyrusbackend.orders
        join branchdetails on orders.BranchCode=branchdetails.BranchCode
        join `reference table` on orders.OrderID=`reference table`.ID
        join districts on branchdetails.Address3=districts.District
        join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
        where AttendDate is not null and Attended=1 and datediff(AttendDate, AssignDate)>90 and ControlerID=$EXEID and Discription like '%AMC%'and orders.EmployeeCode=$EmployeeID and Reference='Order' and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";

        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['OrderID'];
            $AssignDate = $row["AssignDate"];
            $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$OrderID and Type='a' and AssignType='R'";
            $result3=mysqli_query($con,$query3);
            $row3 = mysqli_fetch_array($result3);

            $ded = date('Y-m-d', strtotime($AssignDate. ' + 90 days'));

            $datetime1 = date_create($newtimestamp);
            $datetime2 = date_create($ded);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
                        //echo $de;
            $int = (int)$de;
            $BANK=$row['BankName'];
            if ($int<0) { 
              $tr='<tr class="table-danger">';
              
            }elseif ($int<59) { 
              $tr='<tr style="min-width:150px; background-color:#C2E4EF">';

            }else{
              $tr="<tr>";
            }
            echo $tr;
            ?>

            
            <td><?php echo $Sn; ?></td>
            <td><?php echo $BANK; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['Address3']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo date("d-M-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo date("d-M-Y", strtotime($row['AttendDate'])); ?></td>
            <td><a href="/technician/view.php?card=<?php echo base64_encode($row['Card Number']);?>" target="_blank"><?php echo $row['Card Number']; ?></a></td>
            <td><?php echo $row3['count(ID)']; ?></td>                 
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

$con->close();
$con2->close();