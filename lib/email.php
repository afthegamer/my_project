<?php
//function that will tell how the email should be sent
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
function sendMailContact($name, $email, $message){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.fr';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'webmaster@galactic-space.site';
    $mail->Password = 'B1r9a9d8';
    $mail->setFrom('webmaster@galactic-space.site', 'webmaster');
    $mail->addAddress('brad.dsp@gmail.com', 'contact page');
    if ($mail->addReplyTo($email, $name)) {
        $mail->Subject = 'Formulaire de contact test';
        $mail->isHTML(false);
        $mail->Body = <<<EOT
E-mail: {$email}
Nom: {$name}
Message: {$message}
EOT;
        if (!$mail->send()) 
            $errors[] = 'Sorry, something went wrong. please try again later.';
        else 
            $errors[] = 'Message sent ! Thanks for contacting us.';
        
    }
}