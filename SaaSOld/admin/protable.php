 <h3 align="center">Orders Data for Production</h3>  
 <table class="table table-hover table-bordered border-primary" id="example" class="display nowrap"> 
  <thead> 
      <tr> 
          <th>Bank</th> 
          <th>Zone</th> 
          <th>Branch</th>
          <th>Operator</th> 
          <th>Order Date</th> 
          <th>Gadget</th>
          <th>Sim Provider</th> 
          <th>Sim Type</th> 
          <th>Order ID</th>
          <th>Voice Message</th>
          <th>Executive</th>
          <th>Remark</th>
          <th>Action</th>
      </tr>                     
  </thead>                 
  <tbody> 
      <?php  
      $query ="SELECT * FROM `orders` WHERE Status='0' and Installed='0'";
      $results = mysqli_query($con, $query);
      while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
          {  

            $BranchCode=$row["BranchCode"];
            $GadgetID=$row["GadgetID"];
            $OrderID=$row["OrderID"];
            $OperatorID=$row["OperatorID"];
            $Provider=$row["SimProvider"];

            $queryBranch ="SELECT * FROM branchdetails WHERE `BranchCode`='$BranchCode'";
            $resultBranch = mysqli_query($con2, $queryBranch);
            $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
            $Branch=$row4["BranchName"];
                                //$BranchCode=$row4["BranchCode"];
            $ZoneCode= $row4["ZoneRegionCode"];             
            $Zone=$row4["ZoneRegionName"];
            $Bank=$row4["BankName"];


            $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
            $resultGadget = mysqli_query($con, $queryGadget);
            $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
            $Gadget=$row5["Gadget"];

            $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
            $resultsO = mysqli_query($con, $queryO);
            if (empty($resultsO)==false) {
                $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
                $Operator = $row7["Operator"];

            }elseif(empty($resultsO)==true){
                $Operator='';
            }

            if ($Provider=='Bank' and empty($OperatorID)==true) {
                $Action='<a target="blank" href=production2.php?id='.$row["OrderID"].'>Fill Details</a>';
            }elseif($Provider=='Bank' and empty($OperatorID)==false){

                $Action='<a target="blank" href=production.php?id='.$row["OrderID"].'>Fill Details</a>';
            }elseif ($Provider=='No SIM' and empty($OperatorID)==true) {
                $Action='<a target="blank" href=production2.php?id='.$row["OrderID"].'>Fill Details</a>';
            }else{

                $Action='<a target="blank" href=production.php?id='.$row["OrderID"].'>Fill Details</a>';
            }

            echo '  
            <tr> 
            <td>'.$Bank.'</td>
            <td>'.$Zone.'</td>  
            <td>'.$Branch.'</td>
            <td>'.$Operator.'</td> 

            <td>'.$row["Date"].'</td>  
            <td>'.$Gadget.'</td> 
            <td>'.$Provider.'</td>
            <td>'.$row["SimType"].'</td>   
            <td>'.$row["OrderID"].'</td>
            <td>'.$row["VoiceMessage"].'</td>  
            <td>'.$row["Executive"].'</td>
            <td>'.$row["Remark"].'</td>
            <td>'.$Action.'</td>
            </tr>  
            ';  
        }}  


        ?> 

    </table>   
