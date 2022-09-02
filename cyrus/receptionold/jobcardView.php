
<?php  
include('connection.php');   
if(isset($_POST["ID"]))
{
 $output = '';
 $query = "SELECT * FROM jobcardmain WHERE `Card Number` = '".$_POST["ID"]."'";
 $result = mysqli_query($con, $query);
 $output .= '  
 <div class="table-responsive">  
 <table class="table table-hover table-bordered border-primary">';
 while($row = mysqli_fetch_array($result))
 {

    $GadgetID=$row['GadgetID'];
    $EmployeeID=$row["EmployeeCode"];
    $Employee='';
    $Gadget='';
    if (!empty($EmployeeID))
    {
        $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
        $resultTech=mysqli_query($con2,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
        }
    }
    if (!empty($GadgetID))
    {

        $querygadget="SELECT * FROM gadget WHERE GadgetID=$GadgetID";
        $resultGadget=mysqli_query($con2,$querygadget);
        if (mysqli_num_rows($resultGadget)>0){
            $rowG=mysqli_fetch_assoc($resultGadget);
            $Gadget=$rowG["Gadget"];
        }
    }

    if (!empty($row["BranchCode"]))
    {
        $BranchCode=$row['BranchCode'];
        $queryBranch="SELECT * FROM branchs WHERE BranchCode=$BranchCode";
        $resultsBranch=mysqli_query($con,$queryBranch);
        if (mysqli_num_rows($resultsBranch)>0){
            $rowBranch=mysqli_fetch_assoc($resultsBranch);
            $Branch_Code=$rowBranch["Branch_code"];
        }
    }
    $output .= '
    <tr>  
    <td width="30%"><label>Jobcard Card</label></td>  
    <td width="70%">'.$row["Card Number"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Branch Code</label></td>  
    <td width="70%">'.$Branch_Code.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Service Done</label></td>  
    <td width="70%">'.$row["ServiceDone"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Pending Work</label></td>  
    <td width="70%">'.$row["WorkPending"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Attened Date</label></td>  
    <td width="70%">'.date("d-m-Y", strtotime($row["VisitDate"])).'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Remark</label></td>  
    <td width="70%">'.$row["Remark"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Arrival Time</label></td>  
    <td width="70%">'.$row["TimeofArrivial"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Departure Time</label></td>  
    <td width="70%">'.$row["TimeofDeparture"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Verified By</label></td>  
    <td width="70%">'.$row["VerifiedBy"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Employee</label></td>  
    <td width="70%">'.$Employee.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Gadget</label></td>  
    <td width="70%">'.$Gadget.'</td>  
    </tr>
    ';
}
$output .= '</table></div>';
echo $output;
}
?>
