<?php

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'estagflix@gmail.com';
    $mail->Passowrd = 'estag@flix4848*';
    $mail->Port = 587;

    $mail->setFrom('estagflix@gmail.com');
    $mail->addAddress('estagflix@gmail.com');
    
    $mail->isHTML(true);
    $mail->Subject = 'Teste de Email';
    $mail->Body = 'Isso é apenas um teste <br> Obrigado';
    $mail->AltBody = 'Isso é apenas um teste';

    if($mail->send()){
        echo 'Email enviado com sucesso';
    }else{
        echo 'Email não enviado';
    }
    

} catch (Exception $e) {
    echo "erro ao enviar mensagem";
} 