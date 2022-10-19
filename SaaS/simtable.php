
<?php
$query ="SELECT * FROM `simprovider` 
join production on simprovider.ID=production.SimID
join orders on production.OrderID=orders.OrderID 
join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
join gadget on orders.GadgetID=gadget.GadgetID
join operators on orders.OperatorID=operators.OperatorID
WHERE simprovider.ActivationDate is null and simprovider.IssueDate is not null and simprovider.SimProvider='Cyrus'";
$results = mysqli_query($con3, $query);

?>
 
    <h3 align="center">Total Non-Activated inused SIM Cards</h3>  
    <table class="table table-hover table-bordered border-primary nowrap" id="example" width="100%"> 
      <thead> 
          <tr>  
              <th>Bank</th> 
              <th>Zone</th> 
              <th>Branch</th>
              <th>Order Id</th> 
              <th>Gadget</th> 
              <th>Mobile No</th> 
              <th>Sim Type</th> 
              <th>Operator</th> 
              <th>Sim Release Date</th>
              <th>In Use Date</th>
              <th>Action</th>
          </tr>                     
      </thead>                 
      <tbody> 
          <?php  
          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){  
            $IssueDate=$row["IssueDate"];
            $Status=$row["Status"];
            $OperatorID=$row["OperatorID"];
            $SimType=$row["SimType"];
            $Branch=$row["BranchName"];           
            $Zone=$row["ZoneRegionName"];
            $Gadget=$row["Gadget"];
            $tr='<tr class="table-success">';
            if ($Status==2) {
              $tr='<tr class="table-danger">';
                //$Bank='<span style="color: red;">'.$row["BankName"].'</span>';
            }else{
               $Bank=$row["BankName"]; 
           }

           echo $tr.' 
            
           <td>'.$row["BankName"].'</td>
           <td>'.$Zone.'</td>  
           <td>'.$Branch.'</td>
           <td>'.$row["OrderID"].'</td>  
           <td>'.$Gadget.'</td>  
           <td>'.$row["MobileNumber"].'</td>
           <td>'.$row["SimType"].'</td>   
           <td>'.$row["Operator"].'</td>   
           <td>'.date('d-m-Y',strtotime($row["ReleaseDate"])).'</td>
           <td>'.date('d-m-Y',strtotime($row["IssueDate"])).'</td>
           <td><a target="blank" href=activate.php?id='.$row["SimID"].'&oid='.$row["OrderID"].'>Activate Now</a>&nbsp; &nbsp;<a target="blank" href=simdate.php?id='.$row["SimID"].'>Update Date</a></td> 
           </tr>  
           ';  
       }  
       ?> 

   </table>  

<br><br><br>
<h3 align="center">Total Non-Activated Unused SIM Cards</h3>  
<br />  
<div class="table-responsive">  
 <table class="table table-hover table-bordered border-primary nowrap" id="example3" width="100%"> 
  <thead> 
      <tr>  
          <th scope="col">Mobile No</th>
          <th>Sim Number</th>
          <th>Sim ID</th> 
          <th>Sim Type</th> 
          <th>Operator</th>
          <th>Sim Provider</th> 
          <th>Sim Release Date</th>
          <th>Action</th>
      </tr>                     
  </thead>   

  <tbody> 
    <?php 
    $query ="SELECT * FROM `simprovider` join operators on simprovider.OperatorID=operators.OperatorID
    WHERE `IssueDate` is null and `ActivationDate` is null";
    // $query ="SELECT * FROM `simprovider` join operators on simprovider.OperatorID=operators.OperatorID
    // join cyrusbackend.branchdetails on simprovider.ZoneRegionCode=branchdetails.ZoneRegionCode
    // WHERE `IssueDate` is null and `ActivationDate` is null";
    $results = mysqli_query($con, $query);
    while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
        $SimID=$row["ID"];
        echo '  
        <tr> 
        <td>'.$row["MobileNumber"].'</td>
        <td>'.$row["SimNo"].'</td>
        <td>'.$row["ID"].'</td> 
        <td>'.$row["SimType"].'</td>   
        <td>'.$row["Operator"].'</td>
        <td>'.$row["SimProvider"].'</td>   
        <td> <span class="d-none">'.$row["ReleaseDate"].'</span> '.date('d-m-Y',strtotime($row["ReleaseDate"])).'</td>
        <td><a target="blank" href=deletesim.php?id='.$SimID.'>Delete Number</a> &nbsp; &nbsp;<a target="blank" href=simdate.php?id='.$SimID.'>Update Date</a></td>  
        </tr>  
        ';  
    }  
    ?> 
</tbody>
</table>  
</div> 
<br><br>
<h3 align="center">Total Activated Returned SIM Cards</h3>  
<br/>  
<div class="table-responsive">  
 <table class="table table-hover table-bordered border-primary nowrap" id="example2" width="100%"> 
  <thead> 
      <tr>  
          <th>Mobile No</th>
          <th>Sim Number</th> 
          <th>Sim Type</th> 
          <th>Operator</th>
          <th>Sim Release Date</th>
          <th>Activation Date</th> 
      </tr>                     
  </thead>                 
  <tbody> 
      <?php
      $query ="SELECT * FROM `simprovider` join operators on simprovider.OperatorID=operators.OperatorID WHERE `RemarkUpdate` is not null and ActivationDate is not null and IssueDate is null and SimProvider='Cyrus'";
      $results = mysqli_query($con, $query);

      while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
        echo '  
        <tr> 

        <td>'.$row["MobileNumber"].'</td>
        <td>'.$row["SimNo"].'</td>
        <td>'.$row["SimType"].'</td>   
        <td>'.$row["Operator"].'</td>                                     
        <td>'.date('d-m-Y',strtotime($row["ReleaseDate"])).'</td>
        <td>'.date('d-m-Y',strtotime($row["ActivationDate"])).'</td>  
        </tr>  
        ';  
    }  
    ?>
</tbody>
</table>  
</div>   



