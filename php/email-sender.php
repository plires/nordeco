<?php
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
header('Content-type: application/json');

$Recipient = 'info@nordeco.com.ar'; // <-- Set your email here

$subject = 'Formulario de contacto principal';

if($Recipient) {

	$Name = $_POST['name'];
	$Url = $_POST['url'];
	$Email = $_POST['email'];
	$Subject = $subject;
	$Message = $_POST['message'];

	$Email_body = "";
	$Email_body .= "From: " . $Name . "\n" .
				   "Email: " . $Email . "\n" .
				   "Envio desde: " . $Subject . "\n" .
				   "Mensaje: " . $Message . "\n" .
				   "Pagina donde se origino la consulta: " . $Url . "\n";

	$Email_headers = "";
	$Email_headers .= 'From: ' . $Name . ' <' . $Email . '>' . "\r\n".
					  "Reply-To: " .  $Email . "\r\n";

	$sent = mail($Recipient, $Subject, $Email_body, $Email_headers);

	if ($sent){
		//Comprobamos el reCaptcha
		include_once("php/recaptcha.php");

		$emailResult = array ('sent'=>'yes');
	} else{
		$emailResult = array ('sent'=>'no');
	}

	echo json_encode($emailResult);

} else {

	$emailResult = array ('sent'=>'no');
	echo json_encode($emailResult);

}
?>
