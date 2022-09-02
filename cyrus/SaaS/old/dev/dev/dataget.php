<?php
include ('data.php');

$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
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


$BranchCode=!empty($_POST['BranchCode'])?$_POST['BranchCode']:'';
if (!empty($BranchCode))
{   
    //echo $BranchCode;
    $Data="SELECT * from jobcardmain WHERE BranchCode=$BranchCode";
    $results=mysqli_query($conn,$Data);
    if (mysqli_num_rows($results)>0)
    {

        while ($row=mysqli_fetch_assoc($results))
        {
           $BranchCode=$row["BranchCode"];
           $Jobcard=$row["Card Number"];
           $query ="SELECT * FROM `branchs` Where BranchCode='$BranchCode'";
           $result = mysqli_query($conn, $query);
           $row1=mysqli_fetch_array($result);
           $ZoneCode=$row1["ZoneRegionCode"];

           $orgDate = $row["VisitDat"];  
           $date = str_replace('-"', '/', $orgDate);  
           $Visit = date("d/m/Y", strtotime($date));

           $queryZone ="SELECT * FROM `zoneregions` WHERE ZoneRegionCode=$ZoneCode";
           $resultZone = mysqli_query($conn, $queryZone);
           $row2=mysqli_fetch_array($resultZone,MYSQLI_ASSOC);             
           $Zone=$row2["ZoneRegionName"];
           $BankCode=$row2["BankCode"];

           $queryBank ="SELECT * FROM `bank` WHERE BankCode=$BankCode";
           $resultBank = mysqli_query($conn, $queryBank);
           $row3=mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
           $Bank=$row3["BankName"];


           echo '  
           <td>'.$Bank.'</td>
           <td>'.$Zone.'</td>
           <td>'.$row1["BranchName"].'</td>
           <td>'.$row["Card Number"].'</td>
           <td>'.$Visit.'</td>                       
           </tr>  
           ';  
       } 
   }
}

?>