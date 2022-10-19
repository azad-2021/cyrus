<?php
include ('connection.php');
include ('session.php');
$userid=$_SESSION['userid'];


date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Company='CYRUS ELECTRONICS PVT. LTD.';
$PAN='AACCC6555F';
//$GenInvoice=!empty($_POST['GenInvoice'])?$_POST['GenInvoice']:'';
$GenInvoice='Gen';

require('../billing/fpdf/fpdf.php');
require('../billing/fpdf/html_table.php');
if (!empty($_SESSION['BillNO']) and !empty($GenInvoice))
{	

	$BillNo=$_SESSION['BillNO'];
	//echo $BillNo;


	$Query="SELECT * FROM cyrusbilling.billbook 
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



	$html='<table width="100%" border="1">'. 
	'<thead><tr>'.
	'<th >S.No.</th>'.
	"<th style='min-width:50px;'>Description</th>".
	"<th style='min-width:50px;'>HSN/SAC</th>".
	"<th style='min-width:50px;'>GST %</th>".
	"<th style='min-width:50px;'>Quantity</th>".
	"<th style='min-width:200px;'>Rate</th>".
	"<th style='min-width:100px;'>Amount</th>".
	"<th style='min-width:100px;'>Value</th>".
	"</tr></thead><tbody>";


	$query="SELECT Description, HSNCode, GSTRate, Qty, Rate, Amount, AValue, Discount  FROM cyrusbilling.billdetail WHERE `BillNo`='$BillNo'";
	$result = mysqli_query($con2,$query);

	if(mysqli_num_rows($result)>0)
	{   
		$d=0;
		while($arr=mysqli_fetch_assoc($result)){
			$d++;
			$html.= "<tr>".
			"<td nowrap='nowrap' style='min-width:10px; text-align: center;'>".$d."</td>".
			"<td nowrap='nowrap' style='min-width:200px; text-align: center;'> ".$arr['Description']."</td>".
			"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".$arr['Description']."</td>".
			"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".$arr['Description']."</td>".
			"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".$arr['Description']."</td>".
			"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".$arr['Description']."</td>".
			"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".$arr['Description']."</td>".
			"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".$arr['Description']."</td>".
			"</tr>";
		}
	}

	$html.= "</tbody></table>";
	



	
	ob_end_clean();


	// Instantiate and use the FPDF class
	$pdf = new PDF();

	//Add a new page
	$pdf->AddPage();

	// Set the font for the text
	$pdf->SetFont('Arial', 'B', 8);

	$pdf->Cell(5,1,'Original for Recepient');
	$pdf->Cell(70);
	$pdf->Cell(5,1,'Duplicate for Transporter/Supplier');
	$pdf->Cell(70);
	$pdf->Cell(5,1,'Triplicate for Supplier');
	$pdf->Cell(1,1,'',1,1);

	//$pdf->Image('cyrus.png',10,8,33);
	$pdf->Image('cyruslogo.jpg',10,15,8,0,'jpeg');
	$pdf->SetFont('Arial', 'B', 18);
	$pdf->Cell(12);
	$pdf->SetTextColor(255,49,49);
	$pdf->Cell(12,18, $Company);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(105);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(15,15,'Invoice No.: '.$BillNo);
	$pdf->Cell(-5);
	$pdf->Cell(15,30,'Date : '.$BillDate);

	$pdf->SetFont('Arial', 'B', 8);
	$pdf->Cell(-140);
	$pdf->Cell(10,29,$Address1);
	$pdf->SetFont('Arial', '', 8);
	$pdf->Cell(-10);
	$pdf->Cell(10,37,$Contact);
	$pdf->Cell(50);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(2,51,'GSTIN: '.$GSTIN);

	$pdf->Cell(-25);
	$pdf->SetXY(55,41);
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->SetDrawColor(50,60,100);
	$pdf->Cell(100,10,'Tax Invoice',1,80,'C',0);
	$pdf->SetXY(1,1);

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(10);
	$pdf->Cell(10,115,'Billed To : '.$Branch.' '.$Zone.' '.$Bank);

	$pdf->Cell(85);
	$pdf->Cell(10,115,'State : '.$State);

	$pdf->Cell(50);
	$pdf->Cell(10,115,'State Code : '.$SCode);

	$pdf->Cell(-165);
	$pdf->Cell(10,125,'GSTIN '.' '.' '.' '.' : '.' '.$BranchGST);

	$pdf->SetXY(10,70);

//Table

	$width_cell=array(12,50,20,15,15,20,20,20,20);
$pdf->SetFillColor(193,229,252); // Background color of header 

// Header starts /// 
$pdf->Cell($width_cell[0],10,'S.No.',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'Description',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'HSN/SAC',1,0,'C',true); // Third header column 
$pdf->Cell($width_cell[3],10,'GST %',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[4],10,'Qty',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[5],10,'Rate',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[6],10,'Amount',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[7],10,'Discount',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[8],10,'Value',1,1,'C',true); // Fourth header column
//// header is over ///////

$pdf->SetFont('Arial','',9);

$query="SELECT Description, HSNCode, GSTRate, Qty, Rate, Amount, AValue, Discount  FROM cyrusbilling.billdetail WHERE `BillNo`='2122CEUP24267'";
$result = mysqli_query($con2,$query);

if(mysqli_num_rows($result)>0)
{   
	$d=0;
	while($arr=mysqli_fetch_assoc($result)){
		$d++;
//$nb=$pdf->WordWrap($arr['Description'],120);
$pdf->Cell($width_cell[0],10,$d,1,0,'C',false); // First column of row 1 
$pdf->Cell($width_cell[1],10,$arr['Description'],1,0,'C',false); // Second column of row 1 
$pdf->Cell($width_cell[2],10,$arr['HSNCode'],1,0,'C',false); // Third column of row 1 
$pdf->Cell($width_cell[3],10,$arr['GSTRate'],1,0,'C',false); // Fourth column of row 1 
$pdf->Cell($width_cell[4],10,$arr['Qty'],1,0,'C',false); // Second column of row 1 
$pdf->Cell($width_cell[5],10,$arr['Rate'],1,0,'C',false); // Second column of row 1 
$pdf->Cell($width_cell[6],10,$arr['Amount'],1,0,'C',false); // Third column of row 1 
$pdf->Cell($width_cell[7],10,$arr['Discount'],1,0,'C',false); // Third column of row 1 
$pdf->Cell($width_cell[8],10,$arr['AValue'],1,1,'C',false); // Fourth column of row 1

}
}
	//Save File to a specific destination
	// $filename="invoice.pdf";
	// $pdf->Output($filename,'F');



$pdf->Output();


}


?>