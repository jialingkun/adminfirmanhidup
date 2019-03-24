<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
//echo $_POST['email']." ".$_POST['nama']." ".$_POST['saksi'];

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->Host = 'mail.cmcsurabaya.org';
$mail->Port = 587;
//$mail->SMTPAuth = true;
$mail->Username = 'firmanhidup@cmcsurabaya.org';
$mail->Password = 'qwer@1234';
$mail->addAddress("firmanhidup@cmcsurabaya.org");

$mail->setFrom($_POST['email']);
$mail->Subject = "Kesaksian dari ".$_POST['nama'];
$mail->msgHTML('<b>Isi Kesaksian :</b><br><table><tr><td align="justify">'. $_POST['saksi'].'</td></tr></table>');

//$mail->setFrom($_POST['email'], $_POST['nama']);
//$mail->Subject = $_POST['nama'];
//$mail->msgHTML('<b>Kesaksian dari : '.$_POST['nama'].'</b><br><div align="justify">'. $_POST['saksi'].'<div>');
//$mail->AltBody = 'This is a plain text message body';
//if (!$mail->send()) {
  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
  //  echo 'Message sent!';
//}
?>
