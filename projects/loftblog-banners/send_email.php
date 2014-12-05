<?php

require "mailer/PHPMailerAutoload.php";
require "auth.php";

//Get all values
$htmlResult = $_POST['htmlResult'];
$cssResult = $_POST['cssResult'];
$senderEmail = $_POST['senderEmail'];

$htmlResult = stripslashes($htmlResult);

//Then lets configure mail
$mail = new PHPMailer;

$mail->IsSMTP();

$mail->Host = 'smtp.yandex.ru';
$mail->CharSet="UTF-8";
$mail->SMTPDebug = 1;
$mail->Port = 465;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication// SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

include 'auth.php';

$mail->FromName = 'Button Generator';

$mail->AddAddress($senderEmail);               // Name is optional

$mail->IsHTML(true);                                  // Set email format to HTML

//Paste our message
$mail->Subject = 'Generated Button';
$mail->Body    = 'Your HTML Code: <br> ' . nl2br($htmlResult) .' <br> and CSS Code <br> ' . nl2br($cssResult);

if(!$mail->Send())
{
    return "Message could not be sent.";
}

return "Message has been sent";
//The end
?>