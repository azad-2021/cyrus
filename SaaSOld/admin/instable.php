<table class="table table-hover table-bordered border-primary nowrap" id="example" width="100%"> 
  <thead> 
      <tr>  
          <th>Bank</th> 
          <th>Zone</th> 
          <th>Branch</th> 
          <th>Order ID</th>
          <th>Gadget</th> 
          <th>Mobile No</th> 
          <th>Sim NO</th> 
          <th>Sim Type</th> 
          <th>Operator</th> 
          <th>Sim Provider</th>
          <th>Validity of Recharge</th>
          <th>Executive</th>
          <th>Remark Orders</th>
          <th>Remark Sim Provider</th>
          <th>Panel Issue Date</th>
          <th>Panel Issue To</th>
          <th>Remark Store</th>
          <th>Action</th>
      </tr>                     
  </thead>                 
  <tbody> 
      <?php  
      $query ="SELECT * FROM `orders`
      join cyrusbackend.branchdetails on orders.BranchCode=branchdetails.BranchCode
      join SaaS.gadget on orders.GadgetID=gadget.GadgetID
      WHERE Status='2' and Installed='0'";
      $results = mysqli_query($con, $query);
      while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
          {  
            $Branch=$row["BranchName"];          
            $Zone=$row["ZoneRegionName"];
            $Gadget=$row["Gadget"];
            $OrderID=$row["OrderID"];
            $OperatorID=$row["OperatorID"];
            $Status=$row["Status"];
            $queryP ="SELECT * FROM `production` WHERE OrderID=$OrderID";
            $resultsP = mysqli_query($con, $queryP);
            $row8=mysqli_fetch_array($resultsP,MYSQLI_ASSOC);
            if (!empty($row8)) {
                $SimID=$row8["SimID"];
            }
            if (empty($SimID)==false) {
                $querySim ="SELECT * FROM `simprovider` WHERE ID=$SimID";
                $resultsSim = mysqli_query($con, $querySim);
                $row6=mysqli_fetch_array($resultsSim,MYSQLI_ASSOC);
                $Mobile=$row6["MobileNumber"];
                $SimNo=$row6["SimNo"];
                $ReleaseDate=$row6["ReleaseDate"];
                $IssueDate=$row6["IssueDate"];
                $Remark=$row6["Remark"];
                $ActivationDate=$row6["ActivationDate"];
            }else{
                $Mobile='';
                $SimNo='';
                $ReleaseDate='';
                $IssueDate='';
                $Remark='';
            }

            if (empty($OperatorID)==false) {
                $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
                $resultsO = mysqli_query($con, $queryO);
                $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
                $Operator=$row7["Operator"];
            }else{
                $Operator='';
            }



            if ($Status==2 and empty($ActivationDate)==true and $row["SimProvider"]=='Cyrus') {
                $Bank='<span style="color: red;">'.$row["BankName"].'</span>';
            }else{
               $Bank=$row["BankName"]; 
           }


           $queryS ="SELECT * FROM `store` WHERE OrderID=$OrderID";
           $resultsS = mysqli_query($con, $queryS);
           $row9=mysqli_fetch_array($resultsS,MYSQLI_ASSOC);
           $EmployeeID=$row9["EmployeeCode"];
           $queryE ="SELECT * FROM `employees` WHERE `EmployeeCode`=$EmployeeID";
           $resultsE = mysqli_query($con2, $queryE);
           $row10=mysqli_fetch_array($resultsE,MYSQLI_ASSOC);

           echo '  
           <tr> 
           <td>'.$Bank.'</td>
           <td>'.$Zone.'</td>  
           <td>'.$Branch.'</td>
           <td>'.$row["OrderID"].'</td>  
           <td>'.$Gadget.'</td>  
           <td>'.$Mobile.'</td>
           <td>'.$SimNo.'</td> 
           <td>'.$row["SimType"].'</td>   
           <td>'.$Operator.'</td>  
           <td>'.$row["SimProvider"].'</td> 
           <td>'.$row["ValidityRecharge"].' Months</td> 
           <td>'.$row["Executive"].'</td>
           <td>'.$row["Remark"].'</td>
           <td>'.$Remark.'</td>
           <td>'.$row9["ReleaseDate"].'</td>
           <td>'.$row10["Employee Name"].'</td>
           <td>'.$row9["Remark"].'</td>
           <td><a target="blank" href=installation.php?id='.$row["OrderID"].'>Fill Details </a>&nbsp;&nbsp;&nbsp; <a target="blank" href=update.php?id='.$row["OrderID"].'> Update</a>&nbsp;&nbsp;&nbsp; <a target="blank" href=cancel.php?id='.$row["OrderID"].'> Cancel Order</a></td> 
           </tr>  
           ';  
       }}  


       ?> 

   </table>