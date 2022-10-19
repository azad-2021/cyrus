<?php
include ('connection.php');
include ('session.php');
$userid=$_SESSION['userid'];

if ($userid==31) {
	$Series='2';
}else if($userid==27){
	$Series='1';
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
$BillingID=!empty($_POST['BillingID'])?$_POST['BillingID']:'';
$BarCode=!empty($_POST['BarCode'])?$_POST['BarCode']:'';
$HSN=!empty($_POST['HSN'])?$_POST['HSN']:'';
$Discount=!empty($_POST['Discount'])?$_POST['Discount']:0;
$Consumed=!empty($_POST['Consumed'])?$_POST['Consumed']:'';
$BranchGST=!empty($_POST['BranchGST'])?$_POST['BranchGST']:'';
$AddDiscount=!empty($_POST['AddDiscount'])?$_POST['AddDiscount']:0;
$EIGST=0;

$APID=!empty($_POST['APID'])?$_POST['APID']:'';
$APIDErr=0;
$EmployeeCode=0;
for ($i=0; $i < count($APID); $i++) { 
	$query="SELECT EmployeeID FROM cyrusbackend.approval WHERE ApprovalID=$APID[$i]";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result)>0)
	{	
		$arr=mysqli_fetch_assoc($result);
		if (($EmployeeCode==$arr['EmployeeID']) or $EmployeeCode==0) {

			
			$EmployeeCode=$arr['EmployeeID'];
		}else{
			echo 'More than one employee selected';
			$APIDErr=1;
			break;
		}
	}
}
//echo $APIDErr;
if (!empty($BranchCode) and !empty($BillingFrom) and !empty($BillingTo) and !empty($BranchGST) and $APIDErr==0)
{	
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

	if(!empty($BillingID)){


		for ($i=0; $i < count($BillingID); $i++) { 
			//echo $BillingID[$i].'<br>';
			$query="SELECT * FROM cyrusbilling.pbills
			inner join cyrusbilling.rates on pbills.RateID=rates.RateID 
			WHERE BillingID=$BillingID[$i] and BillNo is null";
			$result = mysqli_query($con2,$query);
			if(mysqli_num_rows($result)>0)
			{
				$arr=mysqli_fetch_assoc($result);
				$Description=$arr['Description'].' ('.$BarCode[$i].')';
				$Qty=$arr['Qty'];
				$Rate=$arr['Rate'];
				$Amount=$Rate*$Qty;
				$DAmount=$Amount-(($Amount*$Discount[$i])/100);
				$AvalueArr[]=$DAmount;
				$HSNCode=$HSN[$i];

				$query2="SELECT * FROM cyrusbilling.`gst rates` WHERE HSNCode=$HSNCode";
				$result2 = mysqli_query($con2,$query2);
				if(mysqli_num_rows($result2)>0)
				{
					$arr2=mysqli_fetch_assoc($result2);
					$GST=$arr2['Rate'].'%';
					$FullHSN=$arr2['FullHSNCode'];
					$GSTAmountArr[]=$DAmount+(($DAmount*$arr2['Rate'])/100);
					$GSTArr[]=(($DAmount*$arr2['Rate'])/100);
				}

				
				$sql = "INSERT INTO cyrusbilling.billdetail (Description, Rate, ItemID, Qty, Discount, HSNCode, GSTRate, Amount, AValue, BillNo)
				VALUES ('$Description', $Rate, $FullHSN, $Qty, $Discount[$i], '$HSNCode', '$GST', $Amount, $DAmount, '$NewBook')";

				if ($con2->query($sql) === TRUE) {
					//echo 1;

					$sql2 = "UPDATE cyrusbilling.pbills SET BillNo='$NewBook' WHERE BillingID=$BillingID[$i]";

					if ($con2->query($sql2) === TRUE) {
					//echo 1;
					} else {
						echo "Error: " . $sql2 . "<br>" . $con2->error;
					}

				} else {
					echo "Error: " . $sql . "<br>" . $con2->error;
				}


			}


				//echo $Description.' '.$Qty.' '.$Rate.' '.$Amount.' '.$HSNCode.' '.$GSTAmount.'</br>';

		}

	}



	$Query="SELECT ItemName, tempbilling.Rate, Qty, Discount,  HSNCode, FullHSNCode, `gst rates`.Rate as GSTRate, (tempbilling.Rate*Qty) as Amount, (tempbilling.Rate*Qty)-ROUND((((tempbilling.Rate*Qty)*Discount)/100),2) As AValue FROM cyrusbilling.tempbilling
	join cyrusbilling.`gst rates` on tempbilling.CategoryID=`gst rates`.ItemID WHERE BranchCode=$BranchCode";

	$result=mysqli_query($con2,$Query);
	if (mysqli_num_rows($result)>0)
	{   

		while($arr=mysqli_fetch_assoc($result)){


			$Description=$arr['ItemName'];
			$Rate=$arr['Rate'];
			$FullHSN=$arr['FullHSNCode'];
			$Qty=$arr['Qty'];
			$Discount=$arr['Discount'];
			$HSNCode=$arr['HSNCode'];
			$GST=$arr['GSTRate'].' %';
			$Amount=$arr['Amount'];
			$AValue=$arr['AValue'];

			$GSTArr2[]=(($AValue*$arr['GSTRate'])/100);
			$AvalueArr2[]=$AValue;
			$GSTAmountArr2[]=($AValue+($AValue*$arr['GSTRate'])/100);

			$sql = "INSERT INTO cyrusbilling.billdetail (Description, Rate, ItemID, Qty, Discount, HSNCode, GSTRate, Amount, AValue, BillNo)
			VALUES ('$Description', $Rate, $FullHSN, $Qty, $Discount, '$HSNCode', '$GST', $Amount, $AValue, '$NewBook')";

			if ($con2->query($sql) === TRUE) {
					//echo 1;
			} else {
				echo "Error: " . $sql . "<br>" . $con2->error;
			}


			$sql2 = "DELETE FROM cyrusbilling.tempbilling WHERE BranchCode=$BranchCode";

			if ($con2->query($sql2) === TRUE) {
				//echo 1;
			} else {
				echo "Error: " . $sql2 . "<br>" . $con2->error;
			}


		}

	}




	$GSTAmount=array_sum($GSTAmountArr) + array_sum($GSTAmountArr2);
	$TaxableValue=array_sum($AvalueArr)+array_sum($AvalueArr2);
	$GST=array_sum($GSTArr)+array_sum($GSTArr2);
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


		for ($i=0; $i < count($APID); $i++) { 
			$query="SELECT COUNT(BillingID) FROM cyrusbilling.pbills WHERE ApprovalID=$APID[$i] and BillNo is null";
			$result = mysqli_query($con,$query);
			if(mysqli_num_rows($result)>0)
			{	
				$arr=mysqli_fetch_assoc($result);
				if ($arr['COUNT(BillingID)']>0) {

				}else{

					$ApprovalID=$APID[$i];
					$query2="SELECT OrderID FROM cyrusbackend.approval WHERE ApprovalID=$ApprovalID";
					$result2 = mysqli_query($con,$query2);
					$arr2=mysqli_fetch_assoc($result2);
					$ID=$arr2['OrderID'];

					if ($arr2['OrderID']>0) {
						$sql2 = "UPDATE cyrusbackend.approval SET Billed=1, BillDate='$Date' WHERE OrderID=$ID and Vremark not like '%Rejected%'";
					}else if ($arr2['ComplaintID']>0) {
						$sql2 = "UPDATE cyrusbackend.approval SET Billed=1, BillDate='$Date' WHERE ComplaintID=$ID and Vremark not like '%Rejected%'";
					}

					if ($con->query($sql2) === TRUE) {

					} else {
						echo "Error: " . $sql2 . "<br>" . $con->error;
					}

				}
			}
		}


		$_SESSION['BillNO']=$NewBook;
		echo 1;
	} else {
		echo "Error: " . $sql . "<br>" . $con2->error;
	}


}


?>