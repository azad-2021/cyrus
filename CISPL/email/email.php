<?php
$name = $_POST['name'];
$Sender = $_POST['email'];
$sub = $_POST['subject'];
$body = $_POST['message'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'help.cyrusgroup@gmail.com';				
	$mail->Password = 'help@cyrus123';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;

	$mail->setFrom($Sender, 'Cyrus');		
	$mail->addAddress('help.cyrusgroup@gmail.com');
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
