
<?php  
include('connection.php');  
include 'session.php';  

date_default_timezone_set('Asia/Kolkata');
$newtimestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($newtimestamp));

$ThirtyDays = date('Y-m-d', strtotime($Date. ' - 30 days'));

$SDate=!empty($_POST['SDate'])?$_POST['SDate']:'';
$EDate=!empty($_POST['EDate'])?$_POST['EDate']:'';

if(isset($_POST["EmployeeCodeO"]))
{   
  $EmployeeID=$_POST["EmployeeCodeO"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive displayO">

      <thead> 
        <tr>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:100px">Order ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:180px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px">Attend Date</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT * FROM cyrusbackend.allorders
        WHERE AttendDate is not null and Attended=1 and Discription not like '%AMC%' and EmployeeCode=$EmployeeID and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['OrderID'];
            $AssignDate = $row["AssignDate"];

            $datetime1 = date_create($AssignDate);
            $datetime2 = date_create($row['AttendDate']);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
            //echo $de;
            $int = (int)$de;

            if ($int>10) { 
              $tr='<tr class="table-danger">';
            }else{
              $tr='<tr class="table-success">';
            }
            
            echo $tr;
            ?>
            <td><?php echo $row['BankName']; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AttendDate'])); ?></td>                     
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
if(isset($_POST["EmployeeCodeA"]))
{   
  $EmployeeID=$_POST["EmployeeCodeA"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive">

      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:100px">AMC ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:180px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px">Attend Date</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT * FROM cyrusbackend.allorders
        WHERE AttendDate is not null and Attended=1 and Discription like '%AMC%' and EmployeeCode=$EmployeeID and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['OrderID'];
            $AssignDate = $row["AssignDate"];

            $datetime1 = date_create($AssignDate);
            $datetime2 = date_create($row['AttendDate']);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
            //echo $de;
            $int = (int)$de;

            if ($int>60) { 
              $tr='<tr class="table-danger">';
            }else{
              $tr='<tr class="table-success">';
            }
            
            echo $tr;
            ?>
            <td><?php echo $Sn; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AttendDate'])); ?></td>                     
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

if(isset($_POST["EmployeeCodeC"]))
{   
  $EmployeeID=$_POST["EmployeeCodeC"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive">

      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:150px">Complaint ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:180px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px">Attend Date</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT * FROM cyrusbackend.allcomplaint
        WHERE AttendDate is not null and Attended=1 and EmployeeCode=$EmployeeID and month(AttendDate)=month(current_date()) and year(AttendDate)=year(current_date())";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['ComplaintID'];
            $AssignDate = $row["AssignDate"];

            $datetime1 = date_create($AssignDate);
            $datetime2 = date_create($row['AttendDate']);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
            //echo $de;
            $int = (int)$de;

            if ($int>2) { 
              $tr='<tr class="table-danger">';
            }else{
              $tr='<tr class="table-success">';
            }
            
            echo $tr;
            ?>
            <td><?php echo $Sn; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['ComplaintID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AttendDate'])); ?></td>                     
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


if(isset($_POST["EmployeeCodeB"]))
{   
  $EmployeeID=$_POST["EmployeeCodeB"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive">

      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:150px">Invoice No.</th>
          <th style="min-width:150px">Bill Date</th>
          <th style="min-width:150px">Bill Amount</th>
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT BankName, ZoneRegionName, BranchName, TotalBilledValue, BillDate, BookNo FROM cyrusbilling.billbook
        join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
        WHERE EmployeeCode=$EmployeeID and Cancelled=0 and month(BillDate)=month(current_date()) and year(BillDate)=year(current_date())";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          $SubAmount=array();
          while($row = mysqli_fetch_array($result)){  
            

            ?>
            <tr>
              <td><?php echo $Sn; ?></td>
              <td><?php echo $row['BankName']; ?></td>
              <td ><?php echo $row['ZoneRegionName']; ?></td>
              <td><?php echo $row['BranchName']; ?></td>
              <td><a href="/cyrus/reporting/billView.php?billno=<?php echo base64_encode($row['BookNo']); ?>" target="_blank"><?php echo $row['BookNo']; ?></a></td>
              <td><?php echo date("d-m-Y", strtotime($row['BillDate'])); ?></td>  
              <td><?php echo $row['TotalBilledValue']; ?></td>                 
            </tr>
            <?php
            $Sn++;
            $SubAmount[]=$row['TotalBilledValue'];
          }
        }
        $Amount=array_sum($SubAmount);
        ?>

      </tbody>
    </table>
    <h4 align="right">Total Amount : <?php echo $Amount; ?></h4>
  </div>

  <?php 
}

// Past Data


if(isset($_POST["EmployeeCodeOP"]))
{   
  $EmployeeID=$_POST["EmployeeCodeOP"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive">

      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:100px">Order ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:180px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px">Attend Date</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT * FROM cyrusbackend.allorders
        WHERE AttendDate is not null and Attended=1 and Discription not like '%AMC%' and EmployeeCode=$EmployeeID and AttendDate between '$SDate' and '$EDate'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['OrderID'];
            $AssignDate = $row["AssignDate"];

            $datetime1 = date_create($AssignDate);
            $datetime2 = date_create($row['AttendDate']);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
            //echo $de;
            $int = (int)$de;

            if ($int>10) { 
              $tr='<tr class="table-danger">';
            }else{
              $tr='<tr class="table-success">';
            }
            
            echo $tr;
            ?>
            <td><?php echo $Sn; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AttendDate'])); ?></td>                     
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
if(isset($_POST["EmployeeCodeAP"]))
{   
  $EmployeeID=$_POST["EmployeeCodeAP"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive">

      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:100px">AMC ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:180px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px">Attend Date</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT * FROM cyrusbackend.allorders
        WHERE AttendDate is not null and Attended=1 and Discription like '%AMC%' and EmployeeCode=$EmployeeID and AttendDate between '$SDate' and '$EDate'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['OrderID'];
            $AssignDate = $row["AssignDate"];

            $datetime1 = date_create($AssignDate);
            $datetime2 = date_create($row['AttendDate']);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
            //echo $de;
            $int = (int)$de;

            if ($int>60) { 
              $tr='<tr class="table-danger">';
            }else{
              $tr='<tr class="table-success">';
            }
            
            echo $tr;
            ?>
            <td><?php echo $Sn; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AttendDate'])); ?></td>                     
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

if(isset($_POST["EmployeeCodeCP"]))
{   
  $EmployeeID=$_POST["EmployeeCodeCP"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive">

      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:150px">Complaint ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:180px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px">Attend Date</th>  
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT * FROM cyrusbackend.allcomplaint
        WHERE AttendDate is not null and Attended=1 and EmployeeCode=$EmployeeID and AttendDate between '$SDate' and '$EDate'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          while($row = mysqli_fetch_array($result)){
            $OrderID=$row['ComplaintID'];
            $AssignDate = $row["AssignDate"];

            $datetime1 = date_create($AssignDate);
            $datetime2 = date_create($row['AttendDate']);
            $interval = date_diff($datetime1, $datetime2);
            $de= $interval->format('%R%a');
            //echo $de;
            $int = (int)$de;

            if ($int>2) { 
              $tr='<tr class="table-danger">';
            }else{
              $tr='<tr class="table-success">';
            }
            
            echo $tr;
            ?>
            <td><?php echo $Sn; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td ><?php echo $row['ZoneRegionName']; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['ComplaintID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AssignDate'])); ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['AttendDate'])); ?></td>                     
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


if(isset($_POST["EmployeeCodeBP"]))
{   
  $EmployeeID=$_POST["EmployeeCodeBP"];

  ?>

  <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover table-bordered border-primary table-responsive">

      <thead> 
        <tr>
          <th style="min-width:20px">SNo.</th>
          <th style="min-width:150px">Bank</th>
          <th style="min-width:150px">Zone</th>
          <th style="min-width:150px">Branch</th> 
          <th style="min-width:150px">Invoice No.</th>
          <th style="min-width:150px">Bill Date</th>
          <th style="min-width:150px">Bill Amount</th>
        </tr>                     
      </thead>                 
      <tbody>

        <?php 
        $query="SELECT BankName, ZoneRegionName, BranchName, TotalBilledValue, BillDate, BookNo FROM cyrusbilling.billbook
        join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
        WHERE EmployeeCode=$EmployeeID and Cancelled=0 and BillDate between '$SDate' and '$EDate'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          $SubAmount=array();
          while($row = mysqli_fetch_array($result)){  
            

            ?>
            <tr>
              <td><?php echo $Sn; ?></td>
              <td><?php echo $row['BankName']; ?></td>
              <td ><?php echo $row['ZoneRegionName']; ?></td>
              <td><?php echo $row['BranchName']; ?></td>
              <td><a href="/cyrus/reporting/billView.php?billno=<?php echo base64_encode($row['BookNo']); ?>" target="_blank"><?php echo $row['BookNo']; ?></a></td>
              <td><?php echo date("d-m-Y", strtotime($row['BillDate'])); ?></td>  
              <td><?php echo $row['TotalBilledValue']; ?></td>                 
            </tr>
            <?php
            $Sn++;
            $SubAmount[]=$row['TotalBilledValue'];
          }
        }
        $Amount=array_sum($SubAmount);
        ?>

      </tbody>
    </table>
    <h4 align="right">Total Amount : <?php echo $Amount; ?></h4>
  </div>

  <?php 
}


$con->close();
$con2->close();