<?php
//$name = $_POST['name'];
//$Sender = $_POST['email'];
//$sub = $_POST['subject'];
//$body = $_POST['message'];

$name='Anant';
$Sender='noreply@starlaboratories.in';
$sub='OTP';
$body='OTP TEST';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.hostinger.com';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'noreply@starlaboratories.in';				
	$mail->Password = '1@Starlaboratories';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 465;

	$mail->setFrom($Sender, 'Cyrus');		
	$mail->addAddress('suryavanshianantsingh@gmail.com');
	//$mail->addAddress('receiver2@gfg.com', 'Name');
	
	$mail->isHTML(true);								
	$mail->Subject = $sub;
	$mail->Body = 'This mail is from '.$name.' via '.$Sender.'<br>'. $body;
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
	header('Location: success.php');
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
