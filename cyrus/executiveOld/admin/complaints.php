
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
  $query="SELECT * FROM cyrusbackend.allcomplaint WHERE AssignDate is not null and Attended=0 and EmployeeCode=$exEmployeeID";
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
          <th style="min-width:150px">Complaint ID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>
          <th style="min-width:150px">Reassigned Times</th>            
          <!--<th>Action</th> -->          
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          $query2="SELECT * FROM cyrusbackend.allcomplaint WHERE AssignDate is not null and Attended=0 and EmployeeCode=$exEmployeeID";
          $result2=mysqli_query($con,$query2);
          while($row = mysqli_fetch_array($result2)){
            $org = $row["AssignDate"];

            $ComplaintID=$row['ComplaintID'];
            $query3="SELECT count(ID) FROM cyrusbackend.sms WHERE ID=$ComplaintID and Type='c' and AssignType='R'";
            $result3=mysqli_query($con,$query3);
            $row3 = mysqli_fetch_array($result3);

            $ded = date('Y-m-d', strtotime($org. ' + 2 days'));

            $datetime1 = date_create($newtimestamp);
            $datetime2 = date_create($ded);
                        //echo $datetime1.'..';
                        //echo $datetime2.'....';

            $interva = date_diff($datetime1, $datetime2);
            $de= $interva->format('%R%a');
                        //echo $de;
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
              <th><?php echo $Sn; ?></th>
              <td><?php echo $BANK; ?></td>
              <td ><?php echo $row['ZoneRegionName']; ?></td>
              <td><?php echo $row['BranchName']; ?></td>
              <td><?php echo $row['ComplaintID']; ?></td>
              <td><?php echo $row['Discription']; ?></td>
              <td><?php echo date("d-M-Y", strtotime($row['DateOfInformation'])); ?></td>
              <td><?php echo date("d-M-Y", strtotime($row['AssignDate'])); ?></td>
              <td><?php echo $row3['count(ID)']?></td>
              <!--<td><button type="buttun" class="btn btn-primary" id="ReAssignC" value="Reassign" name="Assign">Reassign</button></td> -->            
            </tr>
          </td>              
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
          <th style="min-width:150px">Complaint ID</th>
          <th style="min-width:500px">Description</th>
          <th style="min-width:150px">Information Date</th>
          <th style="min-width:150px">Assigned Date</th>   
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        $Zone=$_POST["Zone"];
        $Bank=$_POST["Bank"];
        $Sn=1;

        $query2="SELECT * FROM cyrusbackend.complaints 
        join branchdetails on complaints.BranchCode=branchdetails.BranchCode
        join districts on branchdetails.Address3=districts.District
        join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode 
        WHERE BankCode=$Bank and ZoneRegionCode=$Zone and Discription not like '%AMC%' and AssignDate is not null and Attended=0 and ControlerID=$EXEID";
        $result2=mysqli_query($con,$query2);
        while($row = mysqli_fetch_array($result2)){

          $ded = date('Y-m-d', strtotime($row['DateOfInformation']. ' + 2 days'));

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
            <td><?php echo $row['ComplaintID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-M-Y", strtotime($row['DateOfInformation'])); ?></td>
            <td><?php echo date("d-M-Y", strtotime($row['AssignDate'])); ?></td>
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