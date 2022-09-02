
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
  $exEmployeeID=$_POST["EmployeeID"];
  //echo $EmployeeID;
  $query="SELECT * FROM cyrusbackend.vallcomplaintsd WHERE AssignDate is null and Attended=0 and EmployeeCode=$exEmployeeID";
  $result=mysqli_query($con,$query);
  $rowN = mysqli_fetch_array($result);

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
          <th style="min-width:150px">Assign Date</th>           
          <th style="min-width:150px">Assign To</th>           
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          $query2="SELECT * FROM cyrusbackend.vallcomplaintsd
          join districts on vallcomplaintsd.Address3=districts.District
          join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE AssignDate is null and Attended=0 and EmployeeCode=$exEmployeeID and districts.SubControllerID=$EXEID";
          $result2=mysqli_query($con,$query2);
          while($row = mysqli_fetch_array($result2)){
            ?>

            <tr>
              <th><?php echo $Sn; ?></th>
              <td><?php echo $row['BankName']; ?></td>
              <td ><?php echo $row['ZoneRegionName']; ?></td>
              <td><?php echo $row['BranchName']; ?></td>
              <td><?php echo $row['ComplaintID']; ?></td>
              <td><?php echo $row['Discription']; ?></td>
              <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>
              <td><input type="date" value="<?php echo $Date; ?>" id="<?php print $row['ComplaintID'];?>" name="Date" class="form-control my-select3" align="center"></td>
              <td>
                <select class="form-control my-select3" id="unc">
                 <option value="">Select</option>        
                 <?php
                 if ($Type!="Executive") {
                   $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
                   $resultTech=mysqli_query($con,$queryTech);
                   while($data=mysqli_fetch_assoc($resultTech)){
                    $json = array("EmployeeID"=>$data['EmployeeCode'], "ComplaintID"=>$row['ComplaintID'], "Status"=>"Unassigned", "exEmployeeID"=>$exEmployeeID);
                    $Data=json_encode($json);
                    echo "<option value=".$Data.">".$data['Employee Name']."</option>";
                  }
                }  
                ?>
              </select>
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
          <th style="min-width:500px">Discription</th>
          <th style="min-width:150px">Information Date</th>  

          <!--<th style="min-width:150px">Action</th>  -->        
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        $Zone=$_POST["Zone"];
        $Bank=$_POST["Bank"];
        $Sn=1;

        $query2="SELECT * FROM vallcomplaintsd
        join districts on vallcomplaintsd.Address3=districts.District
        join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
        WHERE districts.SubControllerID=$EXEID and AssignDate is null and Attended=0 and BankName='$Bank' and ZoneRegionName='$Zone' group by ComplaintID order by ComplaintID";
        $result2=mysqli_query($con,$query2);
        while($row = mysqli_fetch_array($result2)){


          ?>

          <tr>
            <td><?php echo $Sn; ?></td>
            <td><?php echo $Bank; ?></td>
            <td ><?php echo $Zone; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['ComplaintID']; ?></td>
            <td><?php echo $row['Discription']; ?></td>
            <td><?php echo date("d-M-Y", strtotime($row['DateOfInformation'])); ?></td>
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