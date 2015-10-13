<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.office365.com';  // Specify main and backup server
$mail->Port = '587';
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'support@stat8.net';                            // SMTP username
$mail->Password = 'Cherokee@1';                           // SMTP password
                            // Enable encryption, 'ssl' also accepted

$mail->From = 'support@stat8.net';
$mail->FromName = 'Mailer';
$mail->addAddress('support@stat8.net', 'Sam Bush');  // Add a recipient
$mail->addAddress('samrbush@gmail.com');               // Name is optional


$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        // Add attachments
    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'HPTS Referral';
$mail->Body    = 'this is a referall! <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

header('location:adt/upload.php'); 
?>