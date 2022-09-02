
<?php  
include('connection.php'); 
include 'session.php';  
//echo $_GET["ComplaintID"];
if(isset($_POST["ComplaintID"]))
{
    //echo $_GET["ComplaintID"];
    $output = '';
    $query="SELECT EmployeeCode FROM complaints WHERE wincache_refresh_if_changed()EmployeeCode is not null and  ComplaintID='".$_POST["ComplaintID"]."'";
    $result = mysqli_query($con, $query);
    if (($result)>0) {
        $query = "SELECT * FROM complaints join branchdetails on complaints.BranchCode=branchdetails.BranchCode join gadget on complaints.GadgetID=gadget.GadgetID join employees on complaints.EmployeeCode = employees.EmployeeCode WHERE ComplaintID = '".$_POST["ComplaintID"]."'";
    }else{
        $query = "SELECT * FROM complaints join branchdetails on complaints.BranchCode=branchdetails.BranchCode join gadget on complaints.GadgetID=gadget.GadgetID WHERE ComplaintID = '".$_POST["ComplaintID"]."'";

    }

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
        $AssignDate='';

        if (!empty($row["AssignDate"])) {
           $AssignDate=date("d-m-Y", strtotime($row["AssignDate"]));
       }
    //$date = str_replace('-"', '/', $row["DateOfInformation"]);  
       $InfoDate = date("d-m-Y", strtotime($row["DateOfInformation"]));
       $AttendDate= '';
       if (!empty($EmployeeID))
       {
        $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
        $resultTech=mysqli_query($con,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
        }

        $Ref='<button class="btn btn-primary gen" data-bs-toggle="modal" data-bs-target="#Reference" id="'.$row["ComplaintID"].'" id2="Complaint">Close ID</button>';

    }else{
        $Ref='';
    }
    if (!empty($GadgetID))
    {

        $querygadget="SELECT * FROM gadget WHERE GadgetID=$GadgetID";
        $resultGadget=mysqli_query($con,$querygadget);
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

    if ($row["Attended"]==1 or $row["Attended"]==-1) {
        $Attended='Yes';
        if (!empty($row["AttendDate"])) {
           $AttendDate= date("d-m-Y", strtotime($row["AttendDate"]));
       }else{
        $AttendDate='';
    }

}else{
    $Attended='No';
    $AttendDate='';
}
if ($row["Call verified"]==1) {
    $Call='Yes';
}else{
    $Call='No';
}

if ($Attended=='No') {
    $output .= '
    <tr>  
    <td width="30%"><label>Complaint ID</label></td>  
    <td width="70%">'.$row["ComplaintID"].'</td>  
    </tr>
    <td width="30%"><label>Bank</label></td>  
    <td width="70%">'.$row["BankName"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Zone</label></td>  
    <td width="70%">'.$row["ZoneRegionName"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Branch</label></td>  
    <td width="70%">'.$row["BranchName"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Branch Code</label></td>  
    <td width="70%">'.$Branch_Code.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Discription</label></td>  
    <td width="70%">'.$row["Discription"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Date Of Information</label></td>  
    <td width="70%">'.$InfoDate.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Expected Completion</label></td>  
    <td width="70%">'.date("d-m-Y", strtotime($row["ExpectedCompletion"])).'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>ReceivedBy</label></td>  
    <td width="70%">'.$row["ReceivedBY"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Made By</label></td>  
    <td width="70%">'.$row["MadeBy"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Attended</label></td>  
    <td width="70%">'.$Attended.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Attened Date</label></td>  
    <td width="70%">'.$AttendDate.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Employee</label></td>  
    <td width="70%">'.$Employee.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Gadget</label></td>  
    <td width="70%">'.$Gadget.'</td>  
    </tr>
    <td width="30%"><label>Assign Date</label></td>  
    <td width="70%">'.$AssignDate.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Executive Remark</label></td>  
    <td width="70%">'.$row["Executive Remark"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Call Verified</label></td>  
    <td width="70%">'.$Call.'</td>  
    </tr>
    <td width="30%"><label>Action</label></td>  
    <td width="70%">'.$Ref.'</td>
    </tr>
    ';
}else{

    $output .= '
    <tr>  
    <td width="30%"><label>Complaint ID</label></td>  
    <td width="70%">'.$row["ComplaintID"].'</td>  
    </tr>
    <td width="30%"><label>Bank</label></td>  
    <td width="70%">'.$row["BankName"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Zone</label></td>  
    <td width="70%">'.$row["ZoneRegionName"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Branch</label></td>  
    <td width="70%">'.$row["BranchName"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Branch Code</label></td>  
    <td width="70%">'.$Branch_Code.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Discription</label></td>  
    <td width="70%">'.$row["Discription"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Date Of Information</label></td>  
    <td width="70%">'.$InfoDate.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Expected Completion</label></td>  
    <td width="70%">'.date("d-m-Y", strtotime($row["ExpectedCompletion"])).'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>ReceivedBy</label></td>  
    <td width="70%">'.$row["ReceivedBY"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Made By</label></td>  
    <td width="70%">'.$row["MadeBy"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Attended</label></td>  
    <td width="70%">'.$Attended.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Attened Date</label></td>  
    <td width="70%">'.$AttendDate.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Employee</label></td>  
    <td width="70%">'.$Employee.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Gadget</label></td>  
    <td width="70%">'.$Gadget.'</td>  
    </tr>
    <td width="30%"><label>Assign Date</label></td>  
    <td width="70%">'.$AssignDate.'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Executive Remark</label></td>  
    <td width="70%">'.$row["Executive Remark"].'</td>  
    </tr>
    <tr>  
    <td width="30%"><label>Call Verified</label></td>  
    <td width="70%">'.$Call.'</td>  
    </tr>
    ';

}
}
$output .= '</table></div>';
echo $output;
}
?>
