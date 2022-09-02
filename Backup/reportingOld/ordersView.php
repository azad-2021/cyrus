
<?php  
include('connection.php');   
if(isset($_POST["OrderID"]))
{
 $output = '';
 $OrderID=$_POST["OrderID"];

 $query = "SELECT * FROM orders join branchdetails on orders.BranchCode=branchdetails.BranchCode join gadget on orders.GadgetID=gadget.GadgetID WHERE OrderID = $OrderID";
 $result = mysqli_query($con, $query);
 $output .= '  
 <div class="table-responsive">  
 <table class="table table-hover table-bordered border-primary">';
 while($row = mysqli_fetch_array($result))
 {

    //$Gadget=$row['Gadget'];


    $AssignDate='';
    $AttendDate= '';
    if (!empty($row["AssignDate"])) {
       $AssignDate=date("d-m-Y", strtotime($row["AssignDate"]));
   }else{
    $AssignDate='';
   }
    //$date = str_replace('-"', '/', $row["DateOfInformation"]);  
   $InfoDate = date("d-m-Y", strtotime($row["DateOfInformation"]));

if (!empty($row["EmployeeCode"]))
{   
    $EmployeeID=$row["EmployeeCode"];
    $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
    $resultTech=mysqli_query($con,$query);
    if (mysqli_num_rows($resultTech)>0){
        $rowE=mysqli_fetch_assoc($resultTech);
        $Employee=$rowE["Employee Name"];
    }
}else{
    $Employee='';
}

   if ($row["Attended"]==1) {
    $Attended='Yes';
}else{
    $Attended='No';
}
if ($row["Call verified"]==1) {
    $Call='Yes';
}else{
    $Call='No';
}
echo '<input class="d-none" type="text" id="'. $row['OrderID'].'" value="'.$row['ZoneRegionCode'].'" name="">';
$output .= '

<tr>  
<td width="30%"><label>Order ID</label></td>  
<td width="70%" style="color: blue;" class="material" id="'. $row['OrderID'].'" data-bs-toggle="modal" data-bs-target="#ReleasedMaterials">'.$row["OrderID"].'</td>  
</tr>
<tr>  
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
<td width="70%">'.$row["Branch_code"].'</td>  
</tr>
<tr>  
<td width="30%"><label>Description</label></td>  
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
<td width="70%">'.$row["ReceivedBy"].'</td>  
</tr>
<tr>  
<td width="30%"><label>Ordered By</label></td>  
<td width="70%">'.$row["OrderedBy"].'</td>  
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
<td width="70%">'.$row['Gadget'].'</td>  
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
$output .= '</table></div>';
echo $output;
}
?>
