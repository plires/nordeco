<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once( __DIR__ . '/../vendor/autoload.php' );

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

  class App 
  {

    public function saveInBDD($dsn, $db_user, $db_pass, $post)
    {

      try {
        $db = new PDO($dsn, $db_user, $db_pass);

        $date = date("d-M-y H:i");
        if(!isset($post['newsletter'])) 
        {
          $newsletter ="No";
        } else{
          $newsletter ="Si";
        }

        $sql = "INSERT INTO consultas values(default, :nombre, :email, :telefono, :consulta, :suscribe, :fecha, :rubro, :origen)";
        $stmt = $db->prepare($sql);

        $stmt->bindValue(":nombre", $post['name'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $post['email'], PDO::PARAM_STR);
        $stmt->bindValue(":telefono", $post['phone'], PDO::PARAM_STR);
        $stmt->bindValue(":consulta", $post['comments'], PDO::PARAM_STR);
        $stmt->bindValue(":suscribe", $newsletter, PDO::PARAM_STR);
        $stmt->bindValue(":fecha", $date, PDO::PARAM_STR);
        $stmt->bindValue(":rubro", $post['rubro'], PDO::PARAM_STR);
        $stmt->bindValue(":origen", $post['origin'], PDO::PARAM_STR);

        $stmt->execute();

        $db = null; 
      } catch (\Throwable $th) {
        throw $th;
      }
      
    }

    public function registerEmailContactsInPerfit($api, $list, $post) 
    {

      $date = date("d-M-y H:i");

      $perfit = new PerfitSDK\Perfit( ['apiKey' => $api ] );
      $listId = $list;
      $interest = PERFIT_INTEREST;

      $response = $perfit->post('/lists/' .$listId. '/contacts', 
        [
          'firstName' => $post['name'], 
          'email' => $post['email'],
          'customFields' => 
            [
              [
                'id' => 10, 
                'value' => 'google'
              ],
              [
                'id' => 12, 
                'value' => $post['phone']
              ],
              [
                'id' => 16, 
                'value' => $_ENV['EMAIL_CLIENT']
              ],
              [
                'id' => 14, 
                'value' => $post['origin'] . ' - ' . $date
              ],
              [
                'id' => 17, 
                'value' => $_ENV['PERFIT_ACCOUNT']
              ]
            ],
          'interests' => 
            [
              [
                'id' => $interest, 
                'value' => $post['rubro']
              ]
            ]
        ]          
      );

      return $response;
        
    }
    
    public function sendEmail($post, $sendTo, $subject)
    {

      $date = date("d-M-y H:i");
      $name = $post["name"];
      $email = $post["email"];
      $phone = $post["phone"];
      $comments = $post["comments"];
      $rubro = $post["rubro"];
      $origin = $post["origin"];
      $path = $post["path"];
      $ip = $_SERVER["REMOTE_ADDR"];

      if(!isset($post['newsletter'])) 
      {
          $newsletter ="No";
      } else{
          $newsletter ="Si";
      }

      $mail = new PHPMailer(true);

      if ($sendTo === 'cliente') {
        $template = file_get_contents( __DIR__ . '/../includes/emails/email-to-client.php');
        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress($_ENV['EMAIL_CLIENT'], $_ENV['NAME_CLIENT']);
        $mail->addReplyTo($email, $name);

        if ($_ENV['CC_USER'] != '') {
          $mail->addCC($_ENV['CC_USER']);
        }
      } else {
        $template = file_get_contents( __DIR__ . '/../includes/emails/email-to-user.php');
        //Recipients
        $mail->setFrom($_ENV['EMAIL_CLIENT'], $_ENV['NAME_CLIENT']);
        $mail->addAddress($email, $name);
        $mail->addReplyTo($_ENV['EMAIL_CLIENT'], $_ENV['NAME_CLIENT']);
      }

      //configuro las variables a remplazar en el template
      $vars = array(
        '{name_client}',
        '{email_client}',
        '{whatsapp_client}',
        '{whatsapp_show_client}',
        '{origin}',
        '{name_user}',
        '{email_user}',
        '{comments_user}',
        '{date}',
        '{path}',
        '{base}',
        '{site}'
      );

      $values = array( 
        $_ENV['NAME_CLIENT'],
        $_ENV['EMAIL_CLIENT'],
        $_ENV['WHATSAPP_CLIENT'],
        $_ENV['WHATSAPP_SHOW_CLIENT'],
        $origin,
        $name,
        $email,
        $comments,
        $date,
        $_ENV['ROOT'] . $path,
        $_ENV['ROOT'],
        $_ENV['SITE']
      );

      //Remplazamos las variables por las marcas en los templates
      $template_final = str_replace($vars, $values, $template);

      try {

        if ($_ENV['ENVIRONMENT'] === 'local') {
          $mail->isSendmail();
        } else {
          $mail->isSMTP();
        }
        
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->Host       = $_ENV['SMTP'];
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = $_ENV['USERNAME'];
        $mail->Password   = $_ENV['PASSWORD'];
        $mail->CharSet    = $_ENV['EMAIL_CHARSET'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       =  $_ENV['EMAIL_PORT'];
        
        // content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $template_final;

        return $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
      }
    }

  }

?>