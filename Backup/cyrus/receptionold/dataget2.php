<?php
include ('data.php');
include 'session.php';
$Employee='';
$Gadget='';
$AssignDate='';
$AttendDate= '';
$BankCode=!empty($_POST['Bank'])?$_POST['Bank']:'';
if (!empty($BankCode))
{
    $BankData="SELECT ZoneRegionCode,ZoneRegionName from zoneregions WHERE BankCode=$BankCode order by ZoneRegionName";
    $result = mysqli_query($conn,$BankData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Zone</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['ZoneRegionCode']."'>".$arr['ZoneRegionName']."</option><br>";
        }
    }
    
}

$ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';
if (!empty($ZoneCode))
{
    $ZoneData="SELECT BranchCode,BranchName from branchs WHERE ZoneRegionCode=$ZoneCode order by BranchName";
    $result=mysqli_query($conn,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Branch</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {

            echo "<option value='".$arr['BranchCode']."'>".$arr['BranchName']."</option><br>";
        }
    }
}


$Br=!empty($_POST['Br'])?$_POST['Br']:'';
if (!empty($Br))
{
    $BrData="SELECT BranchCode,BranchName from branchs WHERE BranchCode=$Br";
    $result=mysqli_query($conn,$BrData);
    if (mysqli_num_rows($result)>0)
    {
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['BranchCode']."'>".$arr['BranchName']."</option><br>";
        }
    }
}


$BranchCode=!empty($_POST['Branch'])?$_POST['Branch']:'';
$BranchCode=17603;
if (!empty($BranchCode))
{   
    
    $DataCard="SELECT * from jobcardmain WHERE BranchCode=$BranchCode order by VisitDate desc";
    $resultsCard=mysqli_query($conn,$DataCard);


    if (mysqli_num_rows($resultsCard)>0)
    {

        while ($row=mysqli_fetch_assoc($resultsCard))
        {
            $GadgetID=$row['GadgetID'];
            $EmployeeID=$row["EmployeeCode"];
            if (!empty($EmployeeID))
            {
                $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
                $resultTech=mysqli_query($conn,$query);
                if (mysqli_num_rows($resultTech)>0){
                    $rowE=mysqli_fetch_assoc($resultTech);
                    $Employee=$rowE["Employee Name"];
                }
            }
            if (!empty($GadgetID))
            {

                $querygadget="SELECT * FROM gadget WHERE GadgetID=$GadgetID";
                $resultGadget=mysqli_query($conn,$querygadget);
                if (mysqli_num_rows($resultGadget)>0){
                    $rowG=mysqli_fetch_assoc($resultGadget);
                    $Gadget=$rowG["Gadget"];
                }
            }

            print "<tr>";
            print '<td style="min-width: 150px;">'
            ?>

            <a href="" data-bs-toggle="modal" class="nav-link view_jobcard" id="<?php print $row["Card Number"]; ?>" data-bs-target="#exampleModal"><?php print $row["Job_Card_No"]; ?></a>
            <?php
            "</td>";
            //print "<td>".$row["Job_Card_No"]."</td>";
            print '<td style="min-width: 170px;">'.$row["Card Number"]."</td>";
            print '<td style="min-width: 800px;">'.$row["ServiceDone"]."</td>";
            print '<td style="min-width: 800px;">'.$row["WorkPending"]."</td>";
            print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row["VisitDate"]))."</td>";
            print '<td style="min-width: 150px;">'.$Gadget."</td>";
            print '<td style="min-width: 150px;">'.$Employee."</td>"; 
            print '</tr>';
        } 
        $con->close();
    }
    
}

$BrCode=!empty($_POST['BrCode'])?$_POST['BrCode']:'';
if (!empty($BrCode))
{   

    $DataComplaints="SELECT * FROM `complaints` WHERE BranchCode=$BrCode order by ComplaintID desc";
    $resultsComplaints=mysqli_query($conn,$DataComplaints);
    if (mysqli_num_rows($resultsComplaints)>0)
    {

        while ($row2=mysqli_fetch_assoc($resultsComplaints))
        {
            $GadgetID=$row2['GadgetID'];
            $EmployeeID=$row2["EmployeeCode"];
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
        $resultTech=mysqli_query($conn,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
        }
    }
    if (!empty($GadgetID))
    {

        $querygadget="SELECT * FROM gadget WHERE GadgetID=$GadgetID";
        $resultGadget=mysqli_query($conn,$querygadget);
        if (mysqli_num_rows($resultGadget)>0){
            $rowG=mysqli_fetch_assoc($resultGadget);
            $Gadget=$rowG["Gadget"];
        }
    }
    print "<tr>";
    print '<td style="min-width: 150px;">'
    ?>

    <a href="" data-bs-toggle="modal" class="nav-link view_complaint" id="<?php print $row2["ComplaintID"]; ?>" data-bs-target="#exampleModal"><?php print $row2["ComplaintID"]; ?></a>
    <?php
    "</td>";
            //print '<td>'.$row2["ComplaintID"]."</td>";
    print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row2["DateOfInformation"]))."</td>";
    print '<td style="min-width: 500px;">'.$row2["Discription"]."</td>";
    print '<td style="min-width: 150px;">'.$Attended."</td>";
    print '<td style="min-width: 150px;">'.$AttendDate."</td>";
    print '<td style="min-width: 500px;">'.$row2["Executive Remark"]."</td>";

    print '<td style="min-width: 150px;">'.$Gadget."</td>";

    print '<td style="min-width: 150px;">'.$AssignDate."</td>";            
    print '<td style="min-width: 150px;">'.$Call."</td>";
    print '<td style="min-width: 150px;">'.$Employee."</td>"; 
    print "</tr>";
}
$conn->close(); 
}
}


$Branch=!empty($_POST['BranchCode'])?$_POST['BranchCode']:'';
if (!empty($Branch))
{   
    //echo $BranchCode;
    $BranchCode=6132;
    $DataOrders="SELECT * FROM `orders` WHERE BranchCode=$Branch order by OrderID desc";
    $resultsOrders=mysqli_query($conn,$DataOrders);
    if (mysqli_num_rows($resultsOrders)>0)
    {

        while ($row3=mysqli_fetch_assoc($resultsOrders))
        {
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
        $resultTech=mysqli_query($conn,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
            $enEmployee=base64_encode($rowE["Employee Name"]);
        }
    }
    if (!empty($GadgetID))
    {

        $querygadget="SELECT * FROM gadget WHERE GadgetID=$GadgetID";
        $resultGadget=mysqli_query($conn,$querygadget);
        if (mysqli_num_rows($resultGadget)>0){
            $rowG=mysqli_fetch_assoc($resultGadget);
            $Gadget=$rowG["Gadget"];
        }
    }

    print "<tr>";
    print '<td style="min-width: 150px;">'
    ?>

    <a href="" data-bs-toggle="modal" class="nav-link view_data" id="<?php print $row3["OrderID"]; ?>" data-bs-target="#exampleModal"><?php print $row3["OrderID"]; ?></a>
    <?php
    "</td>";
    print '<td style="min-width: 150px;">'.date("d-m-Y", strtotime($row3["DateOfInformation"]))."</td>"; 
    print '<td style="min-width: 500px;">'.$row3["Discription"]."</td>";
    print '<td style="min-width: 150px;">'.$Attended."</td>";
    print '<td style="min-width: 150px;">'.$AttendDate."</td>"; 
    print '<td style="min-width: 500px;">'.$row3["Executive Remark"]."</td>";
    print '<td style="min-width: 150px;">'.$Gadget."</td>";            
    print '<td style="min-width: 150px;">'.$AssignDate."</td>";            
    print '<td style="min-width: 150px;">'.$Call."</td>";
    print '<td style="min-width: 150px;">'.$Employee."</td>";
    print "</tr>";
}

$conn->close(); 
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
    $resultsBranch=mysqli_query($conn,$DataBranch);
    if (mysqli_num_rows($resultsBranch)>0)
    {

     $sqlVAT = "SELECT BranchCode, SUM(BillAmount), Sum(ReceivedAmount) FROM bills1 WHERE BranchCode=$BCode and Remark!='bill cancelled' GROUP BY BranchCode";
     $resultVAT = $conn->query($sqlVAT);
     if (mysqli_num_rows($resultVAT)>0)
     {
         while($row = mysqli_fetch_array($resultVAT)){
            $ReceivedVAT=$row['Sum(ReceivedAmount)'];
            $TotalVAT=$row['SUM(BillAmount)'];
            $BalanceVAT=$TotalVAT-$ReceivedVAT;

        }
    }

    $sqlGST = "SELECT BranchCode, SUM(TotalBilledValue), Sum(ReceivedAmount) FROM billbook WHERE BranchCode=$BCode and Cancelled!=1 GROUP BY BranchCode";
    $resultGST= $conn2->query($sqlGST);
    if (mysqli_num_rows($resultGST)>0)
    {
     while($row = mysqli_fetch_array($resultGST)){
        $ReceivedGST=$row['Sum(ReceivedAmount)'];
        $TotalGST=$row['SUM(TotalBilledValue)'];
        $BalanceGST=$TotalGST-$ReceivedGST;

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
$resultsDistrict=mysqli_query($conn,$DataDistrict);
if (mysqli_num_rows($resultsDistrict)>0)
{

    $rowDistrict=mysqli_fetch_assoc($resultsDistrict);
    $EmployeeID=$rowDistrict['Assign To'];
    if (!empty($EmployeeID))
    {
        $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
        $resultTech=mysqli_query($conn,$query);
        if (mysqli_num_rows($resultTech)>0){
            $rowE=mysqli_fetch_assoc($resultTech);
            $Employee=$rowE["Employee Name"];
        }
    }
}
?>


<div class="col-lg-6">
 <p class="details">Branch Name</p>
</div>
<div class="col-lg-6">
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
    <div class="col-sm-6">
        <p class="details">District</p>
    </div>
    <div class="col-sm-6">
        <p class="show"><?php echo $District; ?></p>
    </div>
    <div class="col-sm-6">
        <p class="show"><a href="" data-bs-toggle="modal" data-bs-target="#PhoneUpdate" data-bs-phone="<?php print $Phone; ?>" class="nav-link">Phone</a></p>
    </div>
    <div class="col-sm-6">
        <p class="show"><?php echo $Phone; ?></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><a data-bs-mobile="<?php echo $Mobile; ?>" data-bs-toggle="modal" data-bs-target="#MobileUpdate" class="nav-link">Mobile</a></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><?php echo $Mobile; ?></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><a href="" data-bs-email="<?php echo $Email; ?>" data-bs-toggle="modal" data-bs-target="#EmailUpdate" class="nav-link">Email</a></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><?php echo $Email; ?></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><a href="" data-bs-toggle="modal" data-bs-target="#GSTUpdate" class="nav-link">GST No.</a></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><?php echo $GST; ?></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><a href="" data-bs-toggle="modal" data-bs-target="#UpdateBranchCode" class="nav-link">Branch Code</a></p>
    </div>
    <div class="col-lg-6">
        <p class="show"><?php echo $Branch_Code; ?></p>
    </div>
    <div class="col-lg-6">
        <p class="details">Assign To</p>
    </div>
    <div class="col-lg-6">
        <p class="show"><?php echo $Employee; ?></p>
    </div>

    <div class="col-lg-12" style="margin-bottom: 12px; overflow: auto; font-size: 15px">
        <table class="scrolldown table-hover table-bordered border-primary table-responsive">
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

