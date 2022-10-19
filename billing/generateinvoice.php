<?php
include ('connection.php');
include ('session.php');
$userid=$_SESSION['userid'];


$query="SELECT * FROM cyrusbilling.billingseries WHERE ExecutiveID=$userid";
$result = mysqli_query($con2,$query);
if(mysqli_num_rows($result)>0)
{

	$arr=mysqli_fetch_assoc($result);
	$FSeries=$arr['Series'];
	$Series=substr($FSeries, 0, 1);


}

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$m=date('m',strtotime($timestamp));
$y=date('y',strtotime($timestamp));

if ($m<=3) {
	$FY=($y-1).$y;

}else{
	$FY=$y.($y+1);
}


$BranchCode=!empty($_POST['BranchCode'])?$_POST['BranchCode']:'';
$BillingFrom=!empty($_POST['BillingFrom'])?$_POST['BillingFrom']:'';
$BillingTo=!empty($_POST['BillingTo'])?$_POST['BillingTo']:'';
$EmployeeCode=!empty($_POST['EmployeeCode'])?$_POST['EmployeeCode']:'';
$BranchGST=!empty($_POST['BranchGST'])?$_POST['BranchGST']:'';

$AddDiscount=!empty($_POST['AddDiscount'])?$_POST['AddDiscount']:0;
$EIGST=0;

if (!empty($BranchCode) and !empty($BillingFrom) and !empty($BillingTo) and !empty($BranchGST) and !empty($EmployeeCode)){	

	$SBillingFrom='%'.$BillingFrom.$Series.'%';
	//echo $BranchGST;
	$query="SELECT * FROM cyrusbilling.billbook WHERE BookNo like '$SBillingFrom' order by BillID desc limit 1;";
	$result = mysqli_query($con2,$query);
	if(mysqli_num_rows($result)>0)
	{
		$arr=mysqli_fetch_assoc($result);
		$LastBook=$arr['BookNo'];
		$NewBook=substr($LastBook, 8)+1;
		$NewBook= $FY.$BillingFrom.$NewBook;
	}else{
		$NewBook= $FY.$BillingFrom.$FSeries;
	}


	if ($BillingFrom=='CEUP' and $BillingTo!=9) {
		$EIGST=1;
	}else if ($BillingFrom=='CEBH' and $BillingTo!=10) {
		$EIGST=1;
	}else if ($BillingFrom=='CECH' and $BillingTo!=4) {
		$EIGST=1;
	}else if ($BillingFrom=='CEDL' and $BillingTo!=7) {
		$EIGST=1;
	}else if ($BillingFrom=='CIUP' and $BillingTo!=9) {
		$EIGST=1;
	}

	//echo $EIGST;

	$GSTAmountArr=array();
	$AvalueArr=array();
	$GSTArr=array();

	$GSTAmountArr2=array();
	$AvalueArr2=array();
	$GSTArr2=array();


	$Query="SELECT ItemName, BarCode, tempbilling.Rate, Qty, Discount,  HSNCode, FullHSNCode, `gst rates`.Rate as GSTRate, (tempbilling.Rate*Qty) as Amount, AValue, tempbilling.ID as ID FROM cyrusbilling.tempbilling
	join cyrusbilling.`gst rates` on tempbilling.CategoryID=`gst rates`.ItemID WHERE BranchCode=$BranchCode and EmployeeCode=$EmployeeCode";

	$result=mysqli_query($con2,$Query);
	if (mysqli_num_rows($result)>0)
	{   

		while($arr=mysqli_fetch_assoc($result)){


			$Description=$arr['ItemName']. ' ( '.$arr['BarCode'].' )';
			$ID=$arr['ID'];
			$Rate=$arr['Rate'];
			$FullHSN=$arr['FullHSNCode'];
			$Qty=$arr['Qty'];
			$Discount=$arr['Discount'];
			$HSNCode=$arr['HSNCode'];
			$GST=$arr['GSTRate'].' %';
			$Amount=$arr['Amount'];
			$AValue=$arr['AValue'];

			$GSTArr[]=(($AValue*$arr['GSTRate'])/100);
			$AvalueArr[]=$AValue;
			$GSTAmountArr[]=($AValue+($AValue*$arr['GSTRate'])/100);

			$sql = "INSERT INTO cyrusbilling.billdetail (Description, Rate, ItemID, Qty, Discount, HSNCode, GSTRate, Amount, AValue, BillNo)
			VALUES ('$Description', $Rate, $FullHSN, $Qty, $Discount, '$HSNCode', '$GST', $Amount, $AValue, '$NewBook')";

			if ($con2->query($sql) === TRUE) {
					//echo 1;
			} else {
				echo "Error: " . $sql . "<br>" . $con2->error;
			}


			$sql2 = "DELETE FROM cyrusbilling.tempbilling WHERE ID=$ID";

			if ($con2->query($sql2) === TRUE) {
				//echo 1;
			} else {
				echo "Error: " . $sql2 . "<br>" . $con2->error;
			}


		}

	}




	$GSTAmount=array_sum($GSTAmountArr);
	$TaxableValue=array_sum($AvalueArr);
	$GST=array_sum($GSTArr);
		//echo $GSTAmount1;

	if ($EIGST==0) {
		$SGST=$GST/2;
		$CGST=$GST/2;
		$IGST=0;
	}else if ($EIGST==1) {
		$SGST=0;
		$CGST=0;
		$IGST=$GST;
	}

	$sql = "INSERT INTO cyrusbilling.billbook (BookNo, BranchCode, BillDate, SGST, CGST, IGST, TotalTaxableValue, EmployeeCode, TotalBilledValue, AdditionalDiscount, GSTNo)
	VALUES ('$NewBook', $BranchCode, '$Date', $SGST, $CGST, $IGST, $TaxableValue, $EmployeeCode, $GSTAmount, $AddDiscount, '$BranchGST')";

	if ($con2->query($sql) === TRUE) {


		$_SESSION['BillNO']=$NewBook;
		echo 1;
	} else {
		echo "Error: " . $sql . "<br>" . $con2->error;
	}


}


?>