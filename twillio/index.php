
<?php

session_start(); 
    
$path = $_SERVER['DOCUMENT_ROOT'];
$apiPath = $path."/api.php";
$twillioPath = $path."/twillio/Services/Twilio.php";
require_once($twillioPath);
include $apiPath;

$formid = $_GET["id"];
//checks for empty form id
if($formid == ""){
    header("Location: /index.php");
}
$phone = $_POST["phone"];
$comments = $_POST["comments"];
//get form data
$getForm = new formStackAPI();
$result = $getForm->getFormData($formid);
  
  //set variables from array
  $name = $result[0];
  $problem = $result[3];
  $urlPic = $result[4];
  $status = $result[5];
  
  
  
  //removes admin comments from text message if blank
  if($comments == ""){
     $textMessage = "Name - ".$name."| Problem - ".$problem."| Status - ".$status;
  }else{
     $textMessage = "Name - ".$name."| Problem - ".$problem."| Status - ".$status."| Admin Comments - ".$comments;
  }



$sid = 'AC25bfd9fd4e52e3e99a22b0cc415ca567';
$token = '8d969ca5555447be0d5e6dac7e29a5b3';

$client = new Services_Twilio($sid, $token);

//sends text message with out url if blank
if($urlPic ==""){
$client->account->messages->sendMessage("+15024389275", $phone, $textMessage);
}else{
$client->account->messages->sendMessage("+15024389275", $phone, $textMessage, $urlPic);
}

$_SESSION["formIDText"] = $formid;
header("Location: /index.php");


