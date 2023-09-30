<?php
	session_cache_limiter('nocache');
	header('Expires: ' . gmdate('r', 0));
	header('Content-type: application/json');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Comprobamos el reCaptcha
	// include_once("./recaptcha.php");

	//Load Composer's autoloader
	require_once( __DIR__ . '/../vendor/autoload.php' );

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/../landing-2018/');
	$dotenv->safeLoad();

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	$email = $_POST['email'];
	$subject = 'Suscripcion al newsletter';

	$email_body = "";
	$email_body .= "Seccion de origen: Contacto-Newsletter" ."<br />" .
					"Email del solicitante: " . $email . "<br />";

	try {
		
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;               
		
		if ($_ENV['ENVIRONMENT'] === 'local') {
			$mail->isSendmail();
		} else {
			$mail->isSMTP();
		}

		$mail->Host       = $_ENV['SMTP'];
		$mail->SMTPAuth   = true;              
		$mail->Username   = $_ENV['USERNAME'];
		$mail->Password   = $_ENV['PASSWORD'];          
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = $_ENV['EMAIL_PORT'];

		//Recipients
		$mail->setFrom($email);
		$mail->addAddress($_ENV['EMAIL_CLIENT'], $_ENV['NAME_CLIENT']);
		$mail->addReplyTo($email);

		//Content
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $email_body;
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$sent = $mail->send();
	} catch (Exception $e) {
		echo "message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

	if ($sent){
		$emailResult = array ('sent'=>'yes');
		header('Location: ../gracias-newsletter.php');
	} else{
		$emailResult = array ('sent'=>'no');
		header('Location: ../404.php');
	}

	echo json_encode($emailResult);
	
?>