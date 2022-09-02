<?php 
include 'connection.php';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
if (!empty($Data))
{
   $obj=json_decode($Data);
   $EmployeeCode=$obj->EmployeeCode;
   $SDate=$obj->SDate;
   $EDate=$obj->EDate;
   $Employee=$obj->Employee;

   ?>

   <div class="col-lg-12" style="margin: 12px;">
    <table class="container table table-hover display table-bordered border-primary responsive">
      <h4 align="center">Work Details of <?php echo $Employee?></h4> 
       <thead> 
          <tr>
             <th style="min-width:20px">SNo.</th>
             <th style="min-width:150px">Bank</th>
             <th style="min-width:150px">Zone</th>
             <th style="min-width:150px">Branch</th>
             <th style="min-width:150px">Jobcard Number</th>
             <th style="min-width:150px">Branch Status</th>
             <th style="min-width:100px">Visit Date</th>
             <th style="min-width:400px">Service Done</th>
             <th style="min-width:300px">Pending Work</th>

          </tr>                     
       </thead>                 
       <tbody>
        <?php 
        $query2="SELECT * FROM cyrusbackend.jobcardmain
        join branchdetails on jobcardmain.BranchCode=branchdetails.BranchCode
        where EmployeeCode=$EmployeeCode and VisitDate between '$SDate' and '$EDate' order by BankName";
        $result2=mysqli_query($con,$query2);
        if (mysqli_num_rows($result2)>0)
        {
           $Sn=1;

           while($row = mysqli_fetch_array($result2)){

              ?>

              <tr>
                 <th><?php echo $Sn; ?></th>
                 <td ><?php echo $row['BankName']; ?></td>
                 <td ><?php echo $row['ZoneRegionName']; ?></td>
                 <td><?php echo $row['BranchName']; ?></td>
                 <td ><a href="/technician/view.php?card=<?php echo base64_encode($row['Card Number']);?>" target="_blank"><?php echo $row['Card Number']; ?></a></td>
                 <td ><?php echo $row['Remark']; ?></td>
                 <td ><?php echo $row['VisitDate']; ?></td>
                 <td ><?php echo $row['ServiceDone']; ?></td>
                 <td ><?php echo $row['WorkPending']; ?></td>
                 

              </tr>
              <?php
              $Sn++;
           }
        }

        $con->close();
        $con2->close();
     }
     ?>
  </tbody>
</table>


</div>