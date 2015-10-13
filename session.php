<?php
 session_start();
 //session checks for ticket changes on index page
if (isset($_SESSION['id'])) {
   $id = $_SESSION['id'];
	$update = "<p align= 'center'><font color = 'gray'>Trouble Ticket ID - ". $id ." updated successfully</font></p><br>";
    echo $update;
	 unset($_SESSION['id']);
 }
 //session checks for Trello Board update on index page
 if (isset($_SESSION['formID'])) {
   $id = $_SESSION['formID'];
	$update = "<p align= 'center'><font color = 'gray'>Trouble Ticket ID - ". $id ." added to Trello Board</font></p><br>";
    echo $update;
	 unset($_SESSION['formID']);
 }
 //session check for sent text message on index page
  if (isset($_SESSION['formIDText'])) {
   $id = $_SESSION['formIDText'];
	$update = "<p align= 'center'><font color = 'gray'>Trouble Ticket ID - ". $id ." sent via Text Message</font></p><br>";
    echo $update;
	 unset($_SESSION['formIDText']);
 }
 //session check for delete on index page
   if (isset($_SESSION['deleteID'])) {
   $id = $_SESSION['deleteID'];
	$update = "<p align= 'center'><font color = 'gray'>Trouble Ticket ID - ". $id ." successfully deleted</font></p><br>";
    echo $update;
	 unset($_SESSION['deleteID']);
 }
 
 
 