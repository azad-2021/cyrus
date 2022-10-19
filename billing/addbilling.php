<?php
include ('connection.php');
include ('session.php');
$userid=$_SESSION['userid'];
$Material=!empty($_POST['Material'])?$_POST['Material']:'';
$ItemAA=!empty($_POST['ItemAA'])?$_POST['ItemAA']:'';
$BranchCode=!empty($_POST['BranchCodeAdd'])?$_POST['BranchCodeAdd']:'';
$EmployeeCode=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
$Rate=!empty($_POST['Rate'])?$_POST['Rate']:'';
$BarCode=!empty($_POST['BarCode'])?$_POST['BarCode']:'';
$DiscountType=!empty($_POST['DiscountType'])?$_POST['DiscountType']:'';
//echo 1;
if (!empty($BranchCode) and (!empty($Material) or !empty($ItemAA)))
{       
    $CategoryID=!empty($_POST['CategoryID'])?$_POST['CategoryID']:'';
    $DiscAdd=!empty($_POST['DiscAdd'])?$_POST['DiscAdd']:0;
    $RateA=!empty($_POST['RateA'])?$_POST['RateA']:0;
    $Qty=!empty($_POST['Qty'])?$_POST['Qty']:'';

    $query="SELECT ID from cyrusbilling.tempbilling WHERE BranchCode=$BranchCode and ItemName='$Material' and EmployeeCode=$EmployeeCode";
    $result=mysqli_query($con2,$query);

    $query2="SELECT ID from cyrusbilling.tempbilling WHERE BranchCode=$BranchCode and ItemName='$ItemAA' and EmployeeCode=$EmployeeCode";
    $result2=mysqli_query($con2,$query2);

    if (mysqli_num_rows($result)>0)
    {

        echo "Material alredy exist";

    }else if(mysqli_num_rows($result2)>0){

        echo "Material alredy exist";

    }else{


        if ($DiscountType=='Percent') {
            $AValue = (($Rate*$Qty)*100)/(100+$DiscAdd);
        }else if ($DiscountType=='Rupees') {

            $AValue=($Rate*$Qty)-$DiscAdd;
        }else{

            $AValue=($Rate*$Qty);
        }

        if (!empty($Material)) {

            //$Material=$Material. ' ( '.$BarCode.' )';

            $sql = "INSERT INTO cyrusbilling.tempbilling (ItemName, Rate, Qty, Discount, BranchCode, CategoryID, BilledByID, EmployeeCode, BarCode, AValue)
            VALUES ('$Material', $Rate, $Qty, $DiscAdd, $BranchCode, $CategoryID, $userid, $EmployeeCode, '$BarCode', $AValue)";
        }else if (!empty($ItemAA)) {

           //$ItemAA=$ItemAA. '( '.$BarCode.' )';
         $sql = "INSERT INTO cyrusbilling.tempbilling (ItemName, Rate, Qty, Discount, BranchCode, CategoryID, BilledByID, EmployeeCode, BarCode, AValue)
         VALUES ('$ItemAA', $RateA, $Qty, $DiscAdd, $BranchCode, $CategoryID, $userid, $EmployeeCode, '$BarCode', $AValue)";
     }

     if ($con2->query($sql) === TRUE) {
        echo 1;
    } else {
      echo "Error: " . $sql . "<br>" . $con2->error;
  } 

}


}


$BranchCodeAmount=!empty($_POST['BranchCodeAmount'])?$_POST['BranchCodeAmount']:'';
$EmployeeCodeAmount=!empty($_POST['EmployeeCodeAmount'])?$_POST['EmployeeCodeAmount']:'';

if (!empty($BranchCodeAmount) and !empty($EmployeeCodeAmount))
{ 

    $query="SELECT sum(AValue) as Value, `gst rates`.Rate as GSTRate FROM cyrusbilling.tempbilling
    join cyrusbilling.`gst rates` on tempbilling.CategoryID=`gst rates`.ItemID
    WHERE EmployeeCode=$EmployeeCodeAmount and BranchCode=$BranchCodeAmount
    group by `gst rates`.Rate";

    $result=mysqli_query($con2,$query);

    if (mysqli_num_rows($result)>0)
    {
        $Amountarr=array();
        while ($arr=mysqli_fetch_assoc($result))
        {
            $Amountarr[]=$arr['Value']+(($arr['Value']*$arr['GSTRate'])/100);

        }

        $Amount=array_sum($Amountarr);

        echo number_format((float)$Amount, 2, '.', '');


    }

}