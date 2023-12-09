<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function send_mail($email,$subject,$template)
{
	$mail = new PHPMailer(true);
try {
	$frommail='geofence@horizonapartments.co.uk';
	//$mail->SMTPDebug = 3;									
	$mail->isSMTP();											
	$mail->Host	 = 'mail.horizonapartments.co.uk';					
	$mail->SMTPAuth = true;							
	$mail->Username = $frommail;
	$mail->Password ='Raza@123456';
	$mail->SMTPSecure = 'ssl';							
	$mail->Port	 = 465;
	$mail->setFrom($frommail,'Geofence');		
	$mail->addAddress($email);
	//$mail->addAddress($email, $name);
	$mail->addAddress($email, 'Hello');
	
	$mail->isHTML(true);								
	$mail->Subject = $subject;
	$mail->Body = $template;
	$mail->AltBody = strip_tags($template);
	$mail->send();

	//echo "SUCCESS-".$email.'_sender_'.$frommail;
	return "sent";
	
} catch (Exception $e) {
	$vartest=$frommail."_Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	$tru=$mail->ErrorInfo;

	if(strpos($vartest,"sending quota exceeded") || strpos($vartest,"Could not authenticate")){
 		//echo "all";
 		
	}
	return $vartest;
}


}

//echo send_mail("projraza@gmail.com","Base Matter","<h3>Hello from Shubham</h3>");


			




?>
