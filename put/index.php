<?php

 $path = $_SERVER['DOCUMENT_ROOT'];
 $apiPath = $path."/api.php";
 $emailPath = $path."/email/PHPMailerAutoload.php";
 include $apiPath;
 //path to PHPMailer
 include  $emailPath;

 $formid = $_GET['id'];
 if($formid == ""){
    header("Location: /index.php");
}
 $status = $_POST['status'];
 $comments = $_POST['comments'];
 $name = $_POST['name'];
 $detected = $_POST['detected'];
 $email = $_POST['email'];
 $problem = $_POST['problem'];
 //create email contents
 $subject = "Status Update Trouble Ticket ID - ".$formid;
 $body = $name.",<br><br>This email is to inform you of a status update to the trouble ticket issue you detected on ".$detected.".<br><br>Status - ".$status."<br>Problem - ".$problem."<br>Resolution Comments - ".$comments."<br><br>Thank You!,<br>Help Desk Support";
 //generates email
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.office365.com';  // Specify main and backup server
$mail->Port = '587';
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'samb@stat8.net';                            // SMTP username
$mail->Password = '';                           // SMTP password
$mail->From = 'samb@stat8.net';
$mail->FromName = 'Help Desk Support';
$mail->addAddress($email, $name);  // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $body;
$mail->send();

 
 
 //put data to formstack api
 $putData= new formStackAPI();
 $result = $putData->putFormData($formid, $status, $comments);
 
 
  if($result == 1){
    session_start(); 
    $_SESSION["id"] = $formid;
    header("Location: /index.php");
  }else{
    
    echo "Error createing Put Request";
    
  }