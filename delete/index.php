<?php

 $path = $_SERVER['DOCUMENT_ROOT'];
 $apiPath = $path."/api.php";
 include $apiPath;

 $formid = $_GET['id'];
 if($formid == ""){
    header("Location: /index.php");
}

 
  $delete= new formStackAPI();
  $result = $delete->deleteSubmission($formid);

  if($result == 1){
    session_start(); 
    $_SESSION["deleteID"] = $formid;
    header("Location: /index.php");

  }else{
    
    echo "Error deleting ticket...";
    
  }