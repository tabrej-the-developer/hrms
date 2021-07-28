<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.zoho.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = "true";                                   //Enable SMTP authentication
    $mail->Username   = 'demo@todquest.com';                     //SMTP username
    $mail->Password   = 'K!ddz1ng';                               //SMTP password
    $mail->SMTPSecure = "ssl";            //Enable implicit TLS encryption
    $mail->Port       = "465";                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('demo@todquest.com', 'Mailer');
    $mail->addAddress('dheerajreddynannuri1709@gmail.com','Great Spirits');     //Add a recipient
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    if($mail->send()){
        echo $mail->ErrorInfo;
    }else{
        echo $mail->ErrorInfo;
    }
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
