<table class="table table-hover table-bordered border-primary display nowrap" id="myTable" width="100%"> 
  <thead> 
    <tr> 
      <th>Bank</th> 
      <th>Zone</th> 
      <th>Branch</th> 
      <th>Gadget</th>
      <th>Sim Provider</th>                                 
      <th>Order Date</th> 
      <th>Order Id</th>
      <th>Order By</th>
      <th>Operator</th>
      <th>Validity of Recharge</th>
      <th>Voice Message</th>                                  
      <th>Remark</th>
      <th>Pending Status</th>
      <th>Action</th>
    </tr>                     
  </thead>                 
  <tbody> 
    <?php  

    if ($Type=='Super User') {
      $query ="SELECT * FROM saas.orders
      join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
      join gadget on orders.GadgetID=gadget.GadgetID
      WHERE Installed=0 order by OrderID Desc";
    }else{
      $query ="SELECT * FROM saas.orders
      join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
      join gadget on orders.GadgetID=gadget.GadgetID
      WHERE Executive='$user' and Installed=0 order by OrderID Desc";
    }
    $results = mysqli_query($con3, $query);

    while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
      {  

        $Branch=$row["BranchName"];
        $Zone=$row["ZoneRegionName"];
        $BranchCode=$row["BranchCode"];
        $Gadget=$row["Gadget"];
        $Status=$row["Status"];
        $OrderID=$row["OrderID"];
        $Provider=$row["SimProvider"];
        $OperatorID=$row["OperatorID"];

        if (empty($OperatorID)==false) {
          $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
          $resultsO = mysqli_query($con, $queryO);
          $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
          $Operator=$row7["Operator"];
        }else{
          $Operator='';
        }

        if ($Status=='1') {
          $Pending='Pending from Store';
        }elseif($Status=='2'){

          $query ="SELECT SimID FROM `production` WHERE OrderID=$OrderID";
          $result = mysqli_query($con, $query);
          $rowP=mysqli_fetch_array($result,MYSQLI_ASSOC);
          if (!empty($rowP)) {

            $SimID=$rowP["SimID"];

            $queryS ="SELECT * FROM `simprovider` WHERE ID=$SimID";
            $resultS = mysqli_query($con, $queryS);
            if (empty($resultS)==false) {

              $rowS=mysqli_fetch_array($resultS,MYSQLI_ASSOC);
              $Activation=$rowS["ActivationDate"];

            }else{
              $Activation='';                                    
            }
          }
          if (empty($Activation)==true and $Provider=='Cyrus') {
                                    // code...
                                    //echo 'No Activation';
            $Pending='<span style="color: red;">Pending at Installation Stage and Sim is Not Activated Yet</span>';
          }else{
            $Pending='Pending at Installation Stage';
          }

        }else{
          $Pending='Pending at Production Stage';

        }

        if($Status=='0'){
          $Cancel='<a href=ordercancel.php?id='.$OrderID.'>Cancel Order</a>';
        }else{
          $Cancel='';
        }

        if (empty($Activation)==true and $Provider=='Cyrus' and $Status=='2') {
          $Bank='<span style="color: red;">'.$row["BankName"].'</span>';
        }else{
          $Bank=$row["BankName"];
        }

        echo '  
        <tr>
        <td>'.$Bank.'</td> 
        <td>'.$Zone.'</td>  
        <td>'.$Branch.'</td>  
        <td>'.$Gadget.'</td>
        <td>'.$row["SimProvider"].'</td>
        <td>'.$row["Date"].'</td>
        <td>'.$row["OrderID"].'</td>
        <td>'.$row["Executive"].'</td>
        <td>'.$Operator.'</td>                                    
        <td>'.$row["ValidityRecharge"].'</td>   
        <td>'.$row["VoiceMessage"].'</td>
        <td>'.$row["Remark"].'</td> 
        <td>'.$Pending.'</td>
        <td>'.$Cancel.'</td> 
        </tr>  
        ';  
      }}  


      ?> 
    </tbody>
  </table>  