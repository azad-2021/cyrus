<?php
include ('connection.php');
include ('session.php');
include ('numbertowords.php');
$userid=$_SESSION['userid'];


date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Company='CYRUS ELECTRONICS PVT. LTD.';
$PAN='AACCC6555F';
//$GenInvoice=!empty($_POST['GenInvoice'])?$_POST['GenInvoice']:'';
$GenInvoice='Gen';
$Address1='';

require('../billing/fpdf/fpdf.php');
require('../billing/fpdf/html_table.php');
if (!empty($_SESSION['BillNO']) and !empty($GenInvoice))
{	

	$BillNo=$_SESSION['BillNO'];
	//echo $BillNo;
	//$BillNo='2223CEBH20383';
	$queryBankDetails = "SELECT * FROM cyrusbilling.`bank details` WHERE ID=2";
	$resultDetails = $con2->query($queryBankDetails);
	$Details=mysqli_fetch_assoc($resultDetails);
	$BanKAcc=$Details['Bank Name'].' A/C No. '.$Details['AcNumber'].' IFSC-'.$Details['IFSC'];

	$Query="SELECT * FROM cyrusbilling.billbook 
	join cyrusbackend.employees on billbook.EmployeeCode=employees.EmployeeCode
	join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode WHERE BookNo='$BillNo'";

	$result=mysqli_query($con2,$Query);
	if (mysqli_num_rows($result)>0)
	{
		$arr=mysqli_fetch_assoc($result);
		$Bank=$arr['BankName'];
		$Zone=$arr['ZoneRegionName'];
		$Branch=$arr['BranchName'];
		$District=$arr['Address3'];
		$BranchGST=$arr['GSTNo'];
		$TValue=$arr['TotalTaxableValue'];
		$AddDiscount=$arr['AdditionalDiscount'];
		$BranchCode=$arr['BranchCode'];
		$TAmount=$arr['TotalBilledValue']-$AddDiscount;
		

		$CGST=$arr['CGST'];
		$SGST=$arr['SGST'];
		$IGST=$arr['IGST'];
		$Employee=$arr['Employee Name'];


		$EIGST=0;
		if ($arr['IGST']>0) {
			$EIGST=1;
		}


		$SCode=substr($BranchGST, 0,2);

		$queryStates="SELECT * FROM states where StateCode=$SCode";
		$resultState=mysqli_query($con2,$queryStates);
		$dataState=mysqli_fetch_assoc($resultState);
		$State = $dataState['State Name'];


		$BillDate=date('d-M-Y',strtotime($arr['BillDate']));

		//$Address1='Regd. Off. : Cyrus House, B-44/69, Sector Q, Aliganj, Lucknow -24,';
		$Contact='Ph.(0522)-4026916, 2746916, Fax 4075916 mail- admin@cyruselectronics.co.in';



		if(strpos($BillNo, 'CEUP') !== false){

			$GSTIN='09AACCC6555F1ZM';   
		} elseif(strpos($BillNo, 'CEDL') !== false){
			$GSTIN='07AACCC6555F1ZQ';
			$Address1='Branch office: 3rd floor, 24-B, Garhi Main Market, East of Kailash, Delhi-110065';
		} elseif(strpos($BillNo, 'CEBH') !== false){
			$GSTIN='10AACCC6555F1Z3';

			$Address1='Bhushan & Sandeep Niwas, Sahjanand, Rewa Road, Bhagwanpur, Muzaffarpur-824001';
		} elseif(strpos($BillNo, 'CECH') !== false){
			$GSTIN='04AACCC6555F1ZW';

			$Address1='2nd floor, House No. 1147, Vikas Nagar, Mouli Jagran, Chandigrah(U.T.)-160101';
		}
		elseif(strpos($BillNo, 'CIUP') !== false){
			$GSTIN='09AACC7970L1Z4';
			$PAN='AACCC7970L';

			$Company='CYRUS INDIA SECURITIES PVT. LTD.';
			$queryBankDetails = "SELECT * FROM `bank details` WHERE ID=6";
			$resultDetails = $con2->query($queryBankDetails);
			$Details=mysqli_fetch_assoc($resultDetails);
			$BanKAcc=$Details['Bank Name'].' A/C No. '.$Details['AcNumber'].' IFSC-'.$Details['IFSC'];
		}


	}


	ob_end_clean();


	// Instantiate and use the FPDF class
	$pdf = new PDF();

	//Add a new page
	$pdf->AddPage();

	// Set the font for the text
	$pdf->AddFont('ArialNarrow','B','Arial Narrow.php');
	$pdf->AddFont('ArialNarrowB','B','ARIALNB.php'); //Bold
	$pdf->SetFont('ArialNarrow', 'B', 12);

	$pdf->Cell(5,1,'Original for Recepient');
	$pdf->Cell(70);
	$pdf->Cell(5,1,'Duplicate for Transporter/Supplier');
	$pdf->Cell(70);
	$pdf->Cell(5,1,'Triplicate for Supplier');
	$pdf->Cell(1,1,'',1,1);

	//$pdf->Image('cyrus.png',10,8,33);
	$pdf->Image('cyruslogo.jpg',10,15,8,0,'jpeg');

	//$pdf->SetFont('ArialNarrow', '', 20);

	
	$pdf->SetFont('ArialNarrowB', 'B', 24);
	$pdf->Cell(12);
	$pdf->SetTextColor(252, 35, 25 );
	$pdf->Cell(12,18, $Company);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(105);
	$pdf->SetFont('ArialNarrowB', 'B', 12);
	$pdf->Cell(15,15,'Invoice No.: '.$BillNo);
	$pdf->Cell(-5);
	$pdf->Cell(15,30,'Date : '.$BillDate);

	$pdf->SetFont('ArialNarrowB', 'B', 9.5);
	$pdf->Cell(-140);
	$pdf->Cell(10,29,$Address1);
	//$pdf->SetFont('ArialNarrow', 'B', 8);
	$pdf->Cell(-10);
	$pdf->SetFont('ArialNarrow', 'B', 10);
	$pdf->Cell(10,37,$Contact);
	$pdf->Cell(40);
	$pdf->SetFont('ArialNarrowB', 'B', 16);
	$pdf->Cell(2,51,'GSTIN: '.$GSTIN);

	$pdf->Cell(-25);
	$pdf->SetXY(55,41);
	$pdf->SetFont('ArialNarrowB', 'B', 18);
	$pdf->SetDrawColor(50,60,100);
	$pdf->Cell(100,10,'Tax Invoice',1,80,'C',0);
	$pdf->SetXY(1,1);

	$pdf->SetFont('ArialNarrowB', 'B', 13);
	$pdf->Cell(10);
	$pdf->Cell(10,115,'Billed To : '.$Bank.', '.$Zone.', '.$Branch);

	$pdf->Cell(115);
	$pdf->Cell(10,115,'State : '.$State);

	$pdf->Cell(30);
	$pdf->Cell(10,115,'State Code : '.$SCode);

	$pdf->Cell(-175);
	$pdf->Cell(10,125,'GSTIN '.' '.' '.' '.' : '.' '.$BranchGST);

	$pdf->SetXY(10,70);

//Table

	$pdf->SetWidths(Array(10,40,20,20,20,20,20,20,20));
	$pdf->SetFillColor(193,229,252);
	$pdf->SetLineHeight(5);
	$pdf->SetAligns(Array('','','','','',''));
	$pdf->SetFont('ArialNarrowB','B',12);
	$pdf->Cell(10,5,"S.No.",1,0);
	$pdf->Cell(40,5,"Description",1,0);
	$pdf->Cell(20,5,"HSN/SAC",1,0);
	$pdf->Cell(20,5,"GST %",1,0);
	$pdf->Cell(20,5,"Qty",1,0);
	$pdf->Cell(20,5,"Rate",1,0);
	$pdf->Cell(20,5,"Amount",1,0);
	$pdf->Cell(20,5,"Discount",1,0);
	$pdf->Cell(20,5,"Value",1,0);
//add a new line
	$pdf->Ln();
//reset font
	$pdf->SetFont('ArialNarrow', 'B', 12);


	$query="SELECT Description, HSNCode, GSTRate, Qty, Rate, Amount, AValue, Discount  FROM cyrusbilling.billdetail WHERE `BillNo`='$BillNo'";
	$result = mysqli_query($con2,$query);
	$d=0;
	while($arr=mysqli_fetch_assoc($result)){
		$d++;

		$pdf->Row(Array(
			$d,

			$arr['Description'],
			$arr['HSNCode'],
			$arr['GSTRate'],
			$arr['Qty'],
			$arr['Rate'],
			$arr['Amount'],
			$arr['Discount'],
			$arr['AValue'],
		));

	}

	$pdf->Ln();
	$pdf->SetFont('ArialNarrowB','B',12);
	$pdf->Cell(10,5,'Details of HSN/SAC');
	$pdf->Ln();

	$pdf->SetWidths(Array(22,30,30,30,30));
	$pdf->SetFillColor(193,229,252);
	$pdf->SetLineHeight(5);
	$pdf->SetAligns(Array('','R','C','','',''));
	

	$pdf->Cell(22,5,"GST Rate",1,0);
	$pdf->Cell(25,5,"Taxable Value",1,0);
	$pdf->Cell(30,5,"CGST",1,0);
	$pdf->Cell(30,5,"SGST",1,0);
	$pdf->Cell(30,5,"IGST",1,0);

	$pdf->Ln();
	$pdf->SetWidths(Array(10,10,26,30,30,30));
	$pdf->Cell(22,5,"",1,0);
	$pdf->Cell(25,5,"",1,0);
	$pdf->Cell(15,5,"Rate %",1,0);
	$pdf->Cell(15,5,"Amount",1,0);
	$pdf->Cell(15,5,"Rate %",1,0);
	$pdf->Cell(15,5,"Amount",1,0);
	$pdf->Cell(15,5,"Rate %",1,0);
	$pdf->Cell(15,5,"Amount",1,0);
	$pdf->Ln();

	$pdf->SetFont('ArialNarrow', 'B', 12);


	$query="SELECT sum(AValue), GSTRate, (sum(AValue)*GSTRate)/100 as GSTAmount FROM cyrusbilling.billdetail WHERE BillNo='$BillNo' group by GSTRate order by GSTRate";
	$result = mysqli_query($con2,$query);
	$Taxable=array();
	$CG=array();
	$SG=array();
	$IG=array();
	while($arr=mysqli_fetch_assoc($result)){

		$pdf->Cell(22,5,$arr['GSTRate'],1,0);
		$pdf->Cell(25,5,$arr['sum(AValue)'],1,0);
		//$EIGST=0;

		if ($EIGST==0) {

			$pdf->Cell(15,5,(int)$arr['GSTRate']/2,1,0);
			$pdf->Cell(15,5,$arr['GSTAmount']/2,1,0);
			$pdf->Cell(15,5,(int)$arr['GSTRate']/2,1,0);
			$pdf->Cell(15,5,$arr['GSTAmount']/2,1,0);
			$pdf->Cell(15,5,"",1,0);
			$pdf->Cell(15,5,"",1,0);

			$Taxable[]=$arr['sum(AValue)'];

			$CG[]=$arr['GSTAmount']/2;
			$SG[]=$arr['GSTAmount']/2;
			$IG[0]=0;

		}else{

			$pdf->Cell(15,5,'',1,0);
			$pdf->Cell(15,5,'',1,0);
			$pdf->Cell(15,5,"",1,0);
			$pdf->Cell(15,5,'',1,0);
			$pdf->Cell(15,5,$arr['GSTRate'],1,0);
			$pdf->Cell(15,5,$arr['sum(AValue)'],1,0);

			$CG[0]=0;
			$SG[0]=0;
			$IG[]=$arr['sum(AValue)'];

		}

		$pdf->Ln();

	}
	$pdf->SetFont('ArialNarrowB','B',12);
	$pdf->Cell(22,5,"Total",1,0);
	$pdf->Cell(25,5,array_sum($Taxable),1,0);

	$pdf->Cell(15,5,'',1,0);
	$pdf->Cell(15,5,array_sum($CG),1,0);
	$pdf->Cell(15,5,'',1,0);
	$pdf->Cell(15,5,array_sum($SG),1,0);
	$pdf->Cell(15,5,'',1,0);
	$pdf->Cell(15,5,array_sum($IG),1,0);


	//$pdf->SetXY(153,73);
	$pdf->Cell(8);
	$pdf->Cell(20,-35,'Total Taxable Value : '.$TValue);
//$pdf->Ln();
	$pdf->Cell(-1);
	$pdf->Cell(20,-25,'CGST : '.$CGST);
	$pdf->Cell(-20);
	$pdf->Cell(20,-15,'SGST : '.$SGST);
	$pdf->Cell(-19);
	$pdf->Cell(20,-5,'IGST : '.$IGST);

	$pdf->Cell(-40);
	$pdf->Cell(20,5,'Additional Discount : '.$AddDiscount);
	$pdf->Cell(-22);
	$pdf->Cell(20,15,'Grand Total with Tax : '.$TAmount);

	$pdf->Cell(-170);
	$pdf->SetFont('ArialNarrowB', 'B', 11.5);

	$obj=new IndianCurrency($TAmount);


	//$pdf->MultiCell(20,35,'Total Chargable Amount in words: '.$obj->get_words());
	
	$Y= $pdf->GetY();
	$pdf->SetY($Y+10);
	$pdf->setFillColor(255, 255, 255); 
	//$pdf->Cell(100,10,'Tax Invoice',1,80,'C',0);
	$pdf->MultiCell(138,8,'Total Chargable Amount in words:  '.$obj->get_words(),1,80,'C',0);
	//$pdf->Cell(187,10,'NA',1,80,'C',0);
	
	//$pdf->Cell(-15);
	$pdf->SetY($Y+8);

	$pdf->SetFont('ArialNarrowB', 'B', 12);
	$pdf->Cell(5,50,'PAN No. : '.$PAN);
	$pdf->Cell(-5);
	$pdf->Cell(5,60,'Our Bank : '.$BanKAcc);
	$pdf->Cell(-5);
	$pdf->Cell(5,70,'Employee : '.$Employee);

	$pdf->SetFont('ArialNarrow', 'B', 11);
	$pdf->Cell(-5);	
	$pdf->Cell(5,80,'Please make sure you have mentioned GSTN No in the bill If you need input credit.');

	$pdf->Cell(-5);	
	$pdf->Cell(5,90,'18% interest will be charged if payment is not made within 30 days from the date of bill.');
	$pdf->Cell(-5);	
	$pdf->Cell(5,100,'Please mention PAN if you are deducting TDS.');
	$pdf->Cell(-5);	
	$pdf->Cell(5,110,'All disputes will be settled to Lucknow Jurisdiction.');
	$pdf->Cell(-5);	
	$pdf->Cell(5,120,'This is a computer generated invoice.');

	$pdf->Cell(150);	
	$pdf->SetFont('ArialNarrow', 'B', 10);
	$pdf->Cell(5,70,'for Cyrus Electronics Pvt. Ltd.');
	//$pdf->Cell(160,135,"",0,0);
	$Y= $pdf->GetY();
	$pdf->Image('sign.jpg',170,$Y+40,30,0,'jpeg');
	$pdf->Cell(5,120,'Authorised Signatory');
	$pdf->Cell(-165);
	$Y= $pdf->GetY();	
	$pdf->Cell(5,$Y-12,'IT IS MANDATORY w.e.f 01-07-2021, TO DEDUCT TDS U/S 194Q ON BILL VALUE @ 0.1% AS PER GOI.');



	$BankDir='G:/InvoiceDemo/'.$Bank;
	$ZoneDir=$BankDir.'/'.$Zone;
	$BranchDir=$ZoneDir.'/'.$Branch;

	if (file_exists($BankDir)) {


		if (file_exists($ZoneDir)) {

			if (file_exists($BranchDir)) {

				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}else{
				mkdir($BranchDir);
				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}

		}else{
			mkdir($ZoneDir);


			if (file_exists($BranchDir)) {

				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}else{
				mkdir($BranchDir);
				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}


		}




	}else{
		mkdir($BankDir);

		if (file_exists($ZoneDir)) {

			if (file_exists($BranchDir)) {

				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}else{
				mkdir($BranchDir);
				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}

		}else{
			mkdir($ZoneDir);


			if (file_exists($BranchDir)) {

				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}else{
				mkdir($BranchDir);
				$filename="$BranchDir/$BillNo$BranchCode.pdf";
				$pdf->Output($filename,'F');
			}


		}

	}

	
	$pdf->Output();


}


?>