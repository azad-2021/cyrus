    <div class="col-lg-12" style="margin: 12px;">
     <table class="container table table-hover display table-bordered border-primary responsive">

      <thead> 
       <tr>
        <th style="min-width:20px">SNo.</th>
        <th style="min-width:50px">Bank</th>
        <th style="min-width:150px">Zone</th>
        <th style="min-width:250px">Branch</th>
        <th style="min-width:150px">District</th>       
        <th style="min-width:150px">Bill No.</th>
        <th style="min-width:20px">Pending Payment</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 
     include 'connection.php';
     include 'session.php';
     $EXEID=$_SESSION['userid'];
     $Zone=!empty($_POST['Zone'])?$_POST['Zone']:'';
     if (!empty($Zone))
     { 

      $Sn=1;
      $Bank=!empty($_POST['Bank'])?$_POST['Bank']:'';
      $Type=!empty($_POST['Type'])?$_POST['Type']:'';
      if ($Type=='ControllerID') {

        $query3="SELECT BankName,ZoneRegionName, BranchName, (TotalBilledValue-ReceivedAmount) as PendingPayment, BookNo, Address3 FROM cyrusbilling.billbook 
        join branchdetails on billbook.BranchCode=branchdetails.BranchCode
        WHERE ZoneRegionCode=$Zone and BankCode=$Bank and Cancelled=0 and (TotalBilledValue-ReceivedAmount)>1 and BankName!='Cyrus' Order By 'BankName'";
      }else{

        $query3="SELECT BankName,ZoneRegionName, BranchName, (TotalBilledValue-ReceivedAmount) as PendingPayment, BookNo, Address3 FROM cyrusbilling.billbook 
        join branchdetails on billbook.BranchCode=branchdetails.BranchCode
        WHERE ZoneRegionCode=$Zone and BankCode=$Bank and Cancelled=0 and (TotalBilledValue-ReceivedAmount)>1 and Address3='Reserved' Order By 'BankName'";
      }
      $result3=mysqli_query($con,$query3);     
      $sub=0;
      $Total=array();
      while($row = mysqli_fetch_array($result3)){

        ?>

        <tr>
          <th><?php echo $Sn; ?></th>
          <td ><?php echo $row['BankName']; ?></td>
          <td ><?php echo $row['ZoneRegionName']; ?></td>
          <td><?php echo $row['BranchName']; ?></td>
          <td><?php echo $row['Address3']; ?></td>
          <td><a href="/cyrus/reporting/billView.php?billno=<?php echo base64_encode($row['BookNo']); ?>" target="_blank"><?php echo $row['BookNo']; ?></a></td>
          <td><?php echo $row['PendingPayment']; ?></td>
        </tr>
        <?php
        $Sn++;
        $Total[]=$row['PendingPayment'];

      }
    }
    $con->close();
    $con2->close();
    //print_r($Total);
    ?>
  </tbody>
</table>

<h5 align="right">Total: <?php echo number_format(array_sum($Total),2); ?></h5>


</div>