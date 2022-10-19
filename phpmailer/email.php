
<?php
include"connection.php";
include"session.php";
$UserID=$_SESSION['userid'];
$user=$_SESSION['user'];
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('d-M-Y h:i A',strtotime($timestamp));

$EmailID = $_POST['EmailID'];
$Mobile1 = intval($_POST['Mobile1']);
$Mobile2 = $_POST['Mobile2'];
$Mobile3 = $_POST['Mobile3'];
$BranchCode=$_POST['BranchCode'];
$BranchPhone=$_POST['BranchPhone'];
$Mobile=$Mobile1.' '.$Mobile2.' '.$Mobile3.' '.$BranchPhone;
if (empty($Mobile1)) {
	$Mobile1=0;
}

if (empty($Mobile2)) {
	$Mobile2=0;
}

if (empty($Mobile3)) {
	$Mobile3=0;
}



$query="SELECT BankName, ZoneRegionName, BranchName, Branch_code, `Mobile Number`, Email from cyrusbackend.branchdetails WHERE BranchCode=$BranchCode";
$result = mysqli_query($con,$query);

if(mysqli_num_rows($result)>0)
{   

	$arr=mysqli_fetch_assoc($result);

	$Bank= $arr['BankName'];
	$Zone= $arr['ZoneRegionName'];
	$Branch= $arr['BranchName'];
	$Branch_Code= $arr['Branch_code'];
	$CCMail1= Null;
	$CCMail12= Null;

	if (empty($arr['Mobile Number'])==true) {

		$sql ="UPDATE branchs SET `Mobile Number`='$Mobile1' WHERE BranchCode=$BranchCode";

		if ($con->query($sql) === TRUE) {

		} else {
			echo "Error: " . $sql . "<br>" . $con->error;

			$myfile = fopen("updateNumber.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $con->error);
			fclose($myfile);
		}
	}


	if (empty($arr['Email'])==true) {

		$sql ="UPDATE branchs SET Email='$EmailID' WHERE BranchCode=$BranchCode";

		if ($con->query($sql) === TRUE) {

		} else {
			echo "Error: " . $sql . "<br>" . $con->error;

			$myfile = fopen("updateEmail.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $con->error);
			fclose($myfile);
		}
	}


}


$query="SELECT (TotalBilledValue-ReceivedAmount) as PendingAmount from cyrusbilling.billbook WHERE BranchCode=$BranchCode and (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0";
$result = mysqli_query($con2,$query);

if(mysqli_num_rows($result)>0)
{   
	$pendingarray=array();
	while($arr=mysqli_fetch_assoc($result)){
		$pendingarray[]=$arr['PendingAmount'];
	}

}

$Pending=number_format(array_sum($pendingarray),2);


$sql = "INSERT INTO branchmail (BranchCode, Mobile1, Mobile2, Mobile3, BranchEmail, CCEmail1, CCEmail2, UserID)
VALUES ($BranchCode, $Mobile1, $Mobile2, $Mobile3, '$EmailID', '$CCMail11', '$CCMail12',  $UserID)";

if ($con->query($sql) === TRUE) {
	$last_id = $con->insert_id;
} else {
	echo "Error: " . $sql . "<br>" . $con->error;

	$myfile = fopen("mailerr.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $con->error);
	fclose($myfile);
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function SendMail(){
	global $Date;
	global $Bank;
	global $Zone;
	global $Branch;
	global $Branch_Code;
	global $BranchCode;
	global $Mobile;
	global $con;
	global $con2;
	global $Pending;
	global $last_id;
	global $EmailID;
	global $user;
	$mail = new PHPMailer(true);

	try {

		$mail->SMTPDebug = 2;									
		$mail->isSMTP();											
		$mail->Host	 = 'smtp.gmail.com;';					
		$mail->SMTPAuth = true;							
		$mail->Username = 'reminder@cyruselectronics.co.in';				
		$mail->Password = 'sgbgludyfmguzexh';						
		$mail->SMTPSecure = 'ssl';							
		$mail->Port	 = 465;

		$mail->setFrom('reminder@cyruselectronics.co.in', 'Cyrus');		
		$mail->addAddress('suryavanshianantsingh@gmail.com');
			//$mail->AddCC('suryavanshianantsingh@gmail.com');
			//$mail->addAddress('receiver2@gfg.com', 'Name');

		$mail->isHTML(true);								
		$mail->Subject = 'SUBject';
		$mail->Body = "<p><strong>To <br>
		Branch Manager
		<br>Barnch Name: ".$Branch."<br>Zone / Region: ".
		$Zone."<br> Bank: ".
		$Bank."<br".
		"</strong></p>".
		"<p>&nbsp;Dear Sir/Ma'am,</p><br/>".
		"<p style='font-size:15px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Today ".$Date." hours we tried calling your mobile number ".$Mobile." registered with us, however we could not establish a contact since it was not picked up.</p>".

		"<p style='font-size:15px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to bring to your notice that an amount of &#8377; ".$Pending." is pending with your branch against work done by us despite several reminders sent by us.</p>".

		"<p style='font-size:15px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pending bill details are as follows -</p>".

		"<table width='100%' style='margin-top:15px; font-size:15px; border: 2px solid #4154f1;' align='left class='table table-hover table-bordered border-primary'>". 
		"<thead><tr>".
		"<th nowrap='nowrap' style='min-width:50px'>SN</th>".
		"<th nowrap='nowrap' style='min-width:200px'>Bill No.</th>".
		"<th nowrap='nowrap' style='min-width:100px'>Bill Date</th>".
		"<th nowrap='nowrap' style='min-width:100px'>Bill Amount</th>".
		"<th nowrap='nowrap' style='min-width:100px'>Pending Amount (&#8377;)</th>".
		"</tr></thead><tbody><br>";


		$query="SELECT BookNo, BillDate, TotalBilledValue, (TotalBilledValue-ReceivedAmount) as PendingAmount from cyrusbilling.billbook WHERE BranchCode=$BranchCode and (TotalBilledValue-ReceivedAmount)>1 and Cancelled=0";
		$result = mysqli_query($con2,$query);

		if(mysqli_num_rows($result)>0)
		{   
			$d=0;
			while($arr=mysqli_fetch_assoc($result)){
				$d++;
				$mail->Body.= "<tr>".
				"<td nowrap='nowrap' style='min-width:50px; text-align: center;'>".$d."</td>".
				"<td nowrap='nowrap' style='min-width:200px; text-align: center;'> ".$arr['BookNo']."</td>".
				"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".date('d-M-Y',strtotime($arr['BillDate']))."</td>".
				"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".number_format($arr['TotalBilledValue'],2)."</td>".
				"<td nowrap='nowrap' style='min-width:100px; text-align: center;'> ".number_format($arr['PendingAmount'],2)."</td>".
				"</tr>";
			}
		}

		$mail->Body.= "</tbody></table>";

		$mail->Body.= "<p style='font-size:15px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It is requested that this pending amount of &#8377;  ".$Pending." may be released immediately so that we could continue to provide prompt and satisfactory services for maintenance of security equipment installed at the branch.</p><br/>".
		"<p style='font-size:15px'><strong> Thanks and Regards<br>".$user."<br>For any query of complaint and order<br>Contact Number: 0552-4026916, 2746916<br>Email: admin@cyruselectronics.co.in</strong></p>";

		

			//echo $Body;
		$mail->AltBody = 'A';
		$mail->send();

		$sql ="UPDATE branchmail SET Sent=1 WHERE ID=$last_id";

		if ($con->query($sql) === TRUE) {

		} else {
			echo "Error: " . $sql . "<br>" . $con->error;

			$myfile = fopen("update.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $con->error);
			fclose($myfile);
		}

	} catch (Exception $e) {
		$sql ="UPDATE branchmail SET Sent=0 WHERE ID=$last_id";

		if ($con->query($sql) === TRUE) {

		} else {
			echo "Error: " . $sql . "<br>" . $con->error;

			$myfile = fopen("update.txt", "w") or die("Unable to open file!");
			fwrite($myfile, $con->error);
			fclose($myfile);
		}
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

		$myfile = fopen("senterr.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $mail->ErrorInfo);
		fclose($myfile);
	}
}

if ($EmailID!='no email') {
	SendMail();
}




$con->close();
$con2->close();


?>
