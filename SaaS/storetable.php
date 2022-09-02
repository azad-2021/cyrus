<table class="table table-hover table-bordered border-primary" id="example" width="100%"> 
  <thead> 
      <tr>  
          <th>Bank</th> 
          <th>Zone</th> 
          <th>Branch</th>
          <th>Order Id</th> 
          <th>Gadget</th>
          <th>Sim Provider</th> 
          <th>Mobile No</th> 
          <th>Sim NO</th> 
          <th>Sim Type</th> 
          <th>Operator</th> 
          <th>Productio Release Date</th>
          <th>Action</th>
      </tr>                     
  </thead>                 
  <tbody> 
      <?php  
      $query ="SELECT * FROM `orders` WHERE Status='1' and Installed='0'";
      $results = mysqli_query($con, $query);
      while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){

        $BranchCode=$row["BranchCode"];
        $GadgetID=$row["GadgetID"];
        $OrderID=$row["OrderID"];
        $OperatorID=$row["OperatorID"];

        $queryP ="SELECT * FROM `production` WHERE OrderID=$OrderID";
        $resultsP = mysqli_query($con, $queryP);
        $row8=mysqli_fetch_array($resultsP,MYSQLI_ASSOC);
        $SimID=$row8["SimID"];

        $queryBranch ="SELECT * FROM branchdetails WHERE `BranchCode`='$BranchCode'";
        $resultBranch = mysqli_query($con2, $queryBranch);
        $row4=mysqli_fetch_array($resultBranch,MYSQLI_ASSOC);
        $Branch=$row4["BranchName"];       
        $Zone=$row4["ZoneRegionName"];
        $Bank=$row4["BankName"];

        $queryGadget ="SELECT Gadget FROM `gadget` WHERE GadgetID=$GadgetID";
        $resultGadget = mysqli_query($con, $queryGadget);
        $row5=mysqli_fetch_array($resultGadget,MYSQLI_ASSOC);
        $Gadget=$row5["Gadget"];

        if (empty($SimID)==false) {
            $querySim ="SELECT * FROM `simprovider` WHERE ID=$SimID";
            $resultsSim = mysqli_query($con, $querySim);
            $row6=mysqli_fetch_array($resultsSim,MYSQLI_ASSOC);
            $Mobile=$row6["MobileNumber"];
            $SimNo=$row6["SimNo"];
            $ReleaseDate=$row6["ReleaseDate"];
            $IssueDate=$row6["IssueDate"];

        }else{
            $Mobile='';
            $SimNo='';
            $ReleaseDate='';
            $IssueDate='';
        }


        if (empty($OperatorID)==false) {

            $queryO ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
            $resultsO = mysqli_query($con, $queryO);
            $row7=mysqli_fetch_array($resultsO,MYSQLI_ASSOC);
            $Operator=$row7["Operator"];

        }else{
            $Operator='';
        }







        echo '  
        <tr> 
        <td>'.$Bank.'</td>
        <td>'.$Zone.'</td>  
        <td>'.$Branch.'</td>
        <td>'.$row["OrderID"].'</td>  
        <td>'.$Gadget.'</td>
        <td>'.$row["SimProvider"].'</td>  
        <td>'.$Mobile.'</td>
        <td>'.$SimNo.'</td> 
        <td>'.$row["SimType"].'</td>   
        <td>'.$Operator.'</td>    
        <td>'.$IssueDate.'</td>
        <td><a target="blank" href=store.php?id='.$row["OrderID"].'>Fill Details</a></td> 
        </tr>  
        ';  
    }  
    ?> 

</table>  
</div>  
</div>  

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
"></script>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
<script>

    $(document).ready(function() {
        $('#example').DataTable( {
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal( {
                        header: function ( row ) {
                            var data = row.data();
                            return 'Details for '+data[0]+' '+data[1];
                        }
                    } ),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                        tableClass: 'table'
                    } )
                }
            },
            stateSave: true,

        } );
    } );

</script>
</body>
</html>