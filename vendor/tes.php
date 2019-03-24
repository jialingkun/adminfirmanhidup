<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'mail.abcdefg.id';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'info@abcdefg.id';
$mail->Password = 'info123456';
$mail->setFrom('info@abcdefg.id', 'Trade');
$mail->addReplyTo('reply-box@abcdefg.id', 'Trade');
$mail->addAddress('info@abcdefg.id', 'Receiver Name');
$mail->Subject = 'TESTING';
$mail->msgHTML("<b>Abizar</b>");
$mail->AltBody = 'This is a plain text message body';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}?>
