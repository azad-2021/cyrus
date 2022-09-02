<?php
include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
$Branch=!empty($_POST['BranchCode'])?$_POST['BranchCode']:'';
if (!empty($Branch))
{   

    $DataOrders="SELECT * FROM `orders` WHERE BranchCode=$Branch order by OrderID desc";
    $resultsOrders=mysqli_query($con,$DataOrders);
    if (mysqli_num_rows($resultsOrders)>0)
    {
        $queryZone="SELECT ZoneRegionCode FROM branchdetails WHERE BranchCode=$Branch";
        $resultZone=mysqli_query($con,$queryZone);
        $rowZ=mysqli_fetch_assoc($resultZone);
        while ($row3=mysqli_fetch_assoc($resultsOrders))
        {
            //$AssignDate= date("d-m-Y", strtotime($row3["AssignDate"]));
            if (!empty($row3["AssignDate"])) {
               $AssignDate= date("d-m-Y", strtotime($row3["AssignDate"]));
           }else{
            $AssignDate='';
        }
        if ($row3["Attended"]==1) {
            $Attended='Yes';
            if (!empty($row3["AttendDate"])) {
             $AttendDate= date("d-m-Y", strtotime($row3["AttendDate"]));
         }else{
            $AttendDate='';
        }
    }else{
        $Attended='No';
        $AttendDate='';
    }
    if ($row3["Call verified"]==1) {
        $Call='Yes';
    }else{
        $Call='No';
    }
    $GadgetID=$row3['GadgetID'];
    $EmployeeID=$row3["EmployeeCode"];
    $enOrderID=base64_encode($row3["OrderID"]);

    if (!empty($EmployeeID))
    {
        $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
        $resultTech=mysqli_query($con,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
            $enEmployee=base64_encode($rowE["Employee Name"]);
        }
    }else{
        $Employee='';
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
    echo '<input class="d-none" type="text" id="'. $row3['OrderID'].'" value="'.$rowZ['ZoneRegionCode'].'" name="">';
    print "<tr>";
    print '<td style="color: blue;" class="material" id="'. $row3['OrderID'].'" data-bs-toggle="modal" data-bs-target="#ReleasedMaterials">'.$row3["OrderID"]."</td>";
    print '<td>'.date("d-m-Y", strtotime($row3["DateOfInformation"]))."</td>"; 

    print '<td>'.$Attended."</td>";
    print '<td>'.$AttendDate."</td>"; 
    print '<td>'.$Gadget."</td>";            
    print '<td>'.$AssignDate."</td>";            
    print '<td>'.$Call."</td>";
    print '<td>'.$Employee."</td>";
    print '<td style="min-width:500px">'.$row3["Discription"]."</td>";
    print '<td style="min-width:500px">'.$row3["Executive Remark"]."</td>";

    print "</tr>";
}

}

}

$BrCode=!empty($_POST['BrCode'])?$_POST['BrCode']:'';
if (!empty($BrCode))
{   

    $DataComplaints="SELECT * FROM `complaints` WHERE BranchCode=$BrCode order by ComplaintID desc";
    $resultsComplaints=mysqli_query($con,$DataComplaints);
    if (mysqli_num_rows($resultsComplaints)>0)
    {

        while ($row2=mysqli_fetch_assoc($resultsComplaints))
        {
            $GadgetID=$row2['GadgetID'];
            $EmployeeID=$row2["EmployeeCode"];
            //$AssignDate= date("d-m-Y", strtotime($row2["AssignDate"]));


            if (!empty($row2["AssignDate"])) {
               $AssignDate= date("d-m-Y", strtotime($row2["AssignDate"]));
           }else{
            $AssignDate='';
        }

        if ($row2["Attended"]==1) {
            $Attended='Yes';
            if (!empty($row2["AttendDate"])) {
               $AttendDate= date("d-m-Y", strtotime($row2["AttendDate"]));
           }else{
            $AttendDate='';
        }
    }else{
        $Attended='No';
        $AttendDate='';
    }
    if ($row2["Call verified"]==1) {
        $Call='Yes';
    }else{
        $Call='No';
    }

    if (!empty($EmployeeID))
    {
        $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
        $resultTech=mysqli_query($con,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
        }
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
    print "<tr>";

    print '<td>'.$row2["ComplaintID"]."</td>";
    print '<td >'.date("d-m-Y", strtotime($row2["DateOfInformation"]))."</td>";
    print '<td >'.$Attended."</td>";
    print '<td >'.$AttendDate."</td>";
    print '<td >'.$Gadget."</td>";
    print '<td >'.$AssignDate."</td>";            
    print '<td >'.$Call."</td>";
    print '<td >'.$Employee."</td>"; 
    print '<td style="min-width:500px">'.$row2["Discription"]."</td>";
    print '<td style="min-width:500px">'.$row2["Executive Remark"]."</td>";

    print "</tr>";
}
$con->close(); 
}
}


$BranchCode=!empty($_POST['Branch'])?$_POST['Branch']:'';
if (!empty($BranchCode))
{   
    //echo $BranchCode;
    $DataCard="SELECT * from jobcardmain WHERE BranchCode=$BranchCode order by VisitDate desc";
    $resultsCard=mysqli_query($con,$DataCard);


    if (mysqli_num_rows($resultsCard)>0)
    {

        while ($row=mysqli_fetch_assoc($resultsCard))
        {
            $GadgetID=$row['GadgetID'];
            $EmployeeID=$row["EmployeeCode"];
            if (!empty($EmployeeID))
            {
                $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
                $resultTech=mysqli_query($con,$query);
                if (mysqli_num_rows($resultTech)>0){
                    $rowE=mysqli_fetch_assoc($resultTech);
                    $Employee=$rowE["Employee Name"];
                }
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

            print "<tr>";
            print '<td>'
            ?>

            <a href="/technician/view.php?card=<?php print base64_encode($row["Card Number"]); ?>" target="_blank"><?php print $row["Card Number"]; ?></a>
            <?php
            "</td>";
            print '<td>'.date("d-m-Y", strtotime($row["VisitDate"]))."</td>";
            print '<td>'.$Gadget."</td>";
            print '<td>'.$Employee."</td>";
            print '<td style="min-width: 800px;">'.$row["ServiceDone"]."</td>";
            print '<td style="min-width: 800px;">'.$row["WorkPending"]."</td>"; 
            print '</tr>';
        } 
        $con->close();
    }
    
}

$BCode=!empty($_POST['BCode'])?$_POST['BCode']:'';
if (!empty($BCode))
{   

    $ReceivedVAT='0';
    $TotalVAT='0';
    $BalanceVAT='0';
    $TotalGST='0';
    $BalanceGST='0';
    $ReceivedGST='0';

    $DataBranch="SELECT * from branchs WHERE BranchCode=$BCode";
    $resultsBranch=mysqli_query($con,$DataBranch);
    if (mysqli_num_rows($resultsBranch)>0)
    {

     $sqlVAT = "SELECT BranchCode, SUM(BillAmount), Sum(ReceivedAmount) FROM bills1 WHERE BranchCode=$BCode and Remark!='bill cancelled' GROUP BY BranchCode";
     $resultVAT = $con->query($sqlVAT);
     if (mysqli_num_rows($resultVAT)>0)
     {
         while($row = mysqli_fetch_array($resultVAT)){
            $ReceivedVAT=(sprintf('%0.2f', $row['Sum(ReceivedAmount)']));
            $TotalVAT=(sprintf('%0.2f', $row['SUM(BillAmount)']));
            $BalanceVAT=(sprintf('%0.2f', $TotalVAT-$ReceivedVAT));

        }
    }

    $sqlGST = "SELECT BranchCode, SUM(TotalBilledValue), Sum(ReceivedAmount) FROM billbook WHERE BranchCode=$BCode and Cancelled!=1 GROUP BY BranchCode";
    $resultGST= $con2->query($sqlGST);
    if (mysqli_num_rows($resultGST)>0)
    {
     while($row = mysqli_fetch_array($resultGST)){
        $ReceivedGST=(sprintf('%0.2f', $row['Sum(ReceivedAmount)']));
        $TotalGST=(sprintf('%0.2f', $row['SUM(TotalBilledValue)']));
        $BalanceGST=(sprintf('%0.2f', $TotalGST-$ReceivedGST));

    }
}

$rowBranch=mysqli_fetch_assoc($resultsBranch);
$BranchN=$rowBranch['BranchName'];
$Branch_Code=$rowBranch['Branch_code'];
$District=$rowBranch['Address3'];
$Phone=$rowBranch['PhoneNo'];
$Mobile=$rowBranch['Mobile Number'];
$Email=$rowBranch['Email'];
$GST=$rowBranch['GSTNo'];
        //print $BranchN;
$DataDistrict="SELECT * from districts WHERE District='$District'";
$resultsDistrict=mysqli_query($con,$DataDistrict);
if (mysqli_num_rows($resultsDistrict)>0)
{

    $rowDistrict=mysqli_fetch_assoc($resultsDistrict);
    $EmployeeID=$rowDistrict['Assign To'];
    if (!empty($EmployeeID))
    {
        $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
        $resultTech=mysqli_query($con,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
        }
    }else{
        $Employee='';
    }
}
?>


<div class="col-lg-3">
 <p class="show">Branch Name:</p>
</div>
<div class="col-lg-3">
    <p class="show"><?php echo $BranchN; ?></p>
</div>
        <!--
        <div class="col-lg-6">
            <label for="staticEmail2"  class="details" id="BranchData">Address</label>
        </div>
        <div class="col-lg-6">
            <label for="inputPassword2" class="details"><?php ?></label>
        </div>
    -->
    <div class="col-sm-3">
        <p class="show">District:</p>
    </div>
    <div class="col-sm-3">
        <p class="show"><?php echo $District; ?></p>
    </div>
    <div class="col-sm-3">
        <p class="show">Phone:</a></p>
    </div>
    <div class="col-sm-3">
        <p class="show"><?php echo $Phone; ?></p>
    </div>
    <div class="col-lg-3">
        <p class="show">Mobile:</p>
    </div>
    <div class="col-lg-3">
        <p class="show"><?php echo $Mobile; ?></p>
    </div>
    <div class="col-lg-3">
        <p class="show">Email:</p>
    </div>
    <div class="col-lg-3">
        <p class="show"><?php echo $Email; ?></p>
    </div>
    <div class="col-lg-3">
        <p class="show">GST No.:</p>
    </div>
    <div class="col-lg-3">
        <p class="show"><?php echo $GST; ?></p>
    </div>
    <div class="col-lg-3">
        <p class="show">Branch Code:</p>
    </div>
    <div class="col-lg-3">
        <p class="show"><?php echo $Branch_Code; ?></p>
    </div>
    <div class="col-lg-3">
        <p class="show">Assign To:</p>
    </div>
    <div class="col-lg-3">
        <p class="show"><?php echo $Employee; ?></p>
    </div>

    <div class="col-lg-12" style="margin-bottom: 12px; overflow: auto; font-size: 15px">
        <table class="table table-hover table-bordered border-primary table-responsive">
          <thead>
            <tr>
              <th scope="col" style="min-width: 150px;">Type</th>
              <th scope="col" style="min-width: 150px;">Balance Payment</th>
              <th scope="col" style="min-width: 150px;">Total Billing</th>
              <th scope="col" style="min-width: 150px;">Total Payment</th>

          </tr>
      </thead>
      <tbody>
        <tr>
            <th style="min-width: 150px;" scope="row" data-bs-toggle="modal" class="nav-link view_vat" id="<?php echo $BCode; ?>" data-bs-target="#ViewVAT">VAT</th>
            <td style="min-width: 150px;"><?php echo $BalanceVAT; ?></td>        
            <td style="min-width: 150px;" ><?php echo $TotalVAT; ?></td>
            <td style="min-width: 150px;"><?php echo $ReceivedVAT; ?></td>

        </tr>
        <tr>
            <th style="min-width: 150px;" scope="row" data-bs-toggle="modal" class="nav-link view_gst" id="<?php echo $BCode; ?>" data-bs-target="#ViewGST">GST</th>
            <td style="min-width: 150px;"><?php echo $BalanceGST; ?></td>
            <td style="min-width: 150px;"><?php echo $TotalGST; ?></td>
            <td style="min-width: 150px;"><?php echo $ReceivedGST; ?></td>

        </tr>
    </tbody>
</table>
</div>
<?php 
}
}

?>

