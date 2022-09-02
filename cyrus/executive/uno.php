
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
  $query="SELECT * FROM cyrusbackend.vallordersd WHERE AssignDate is null and Attended=0 and Discription not like '%AMC%' and vallordersd.EmployeeCode=$exEmployeeID";
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
          <th style="min-width:150px">District</th>  
          <th style="min-width:150px">OrderID</th>
          <th style="min-width:500px">Discription</th>
          <th style="min-width:150px">Information Date</th>          
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        if (mysqli_num_rows($result)>0)
        {
          $Sn=1;
          $query2="SELECT * FROM cyrusbackend.vallordersd
          join districts on vallordersd.Address3=districts.District
          join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
          WHERE AssignDate is null and Attended=0 and Discription not like '%AMC%' and vallordersd.EmployeeCode=$exEmployeeID and ControlerID=$EXEID";
          $result2=mysqli_query($con,$query2);
          while($row = mysqli_fetch_array($result2)){

            ?>

            <tr>
              <th><?php echo $Sn; ?></th>
              <td><?php echo $row['BankName']; ?></td>
              <td ><?php echo $row['ZoneRegionName']; ?></td>
              <td><?php echo $row['BranchName']; ?></td>
              <td><?php echo $row['Address3']; ?></td>
              <td><?php echo $row['OrderID']; ?></td>
              <td><?php echo $row['Discription']; ?></td>
              <td><?php echo date("d-m-Y", strtotime($row['DateOfInformation'])); ?></td>             
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

          <!--<th style="min-width:150px">Action</th>  -->        
        </tr>                     
      </thead>                 
      <tbody>
        <?php 
        $Zone=$_POST["Zone"];
        $Bank=$_POST["Bank"];
        $Sn=1;

        $query2="SELECT * FROM vallordersd
        join districts on vallordersd.EmployeeCode=districts.`Assign To`
        join `cyrus regions` on districts.RegionCode=`cyrus regions`.RegionCode
        WHERE ControlerID=$EXEID and vallordersd.AssignDate is null and vallordersd.Discription not like '%AMC%' and BankName='$Bank' and ZoneRegionName='$Zone' group by OrderID order by OrderID";
        $result2=mysqli_query($con,$query2);
        while($row = mysqli_fetch_array($result2)){


          ?>

          <tr>
            <td><?php echo $Sn; ?></td>
            <td><?php echo $Bank; ?></td>
            <td ><?php echo $Zone; ?></td>
            <td><?php echo $row['BranchName']; ?></td>
            <td><?php echo $row['OrderID']; ?></td>
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