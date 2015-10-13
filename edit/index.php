<script type="text/javascript">
	//function after delete is clicked
	function verify() {
    if (confirm("Are you want to delete this trouble ticket?")) {
        
    }
    return false;
}	
</script>
  
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$apiPath = $path."/api.php";
$headerPath = $path."/header.php";
include $apiPath;
include $headerPath;
    
 
$formid = $_GET["id"];
if($formid == ""){
    header("Location: /index.php");
}
//get form data
$getForm = new formStackAPI();
$result = $getForm->getFormData($formid);
  
  //set variables from array
  $name = $result[0];
  $email = $result[1];
  $dateTime = $result[2];
  $problem = $result[3];
  $urlPic = $result[4];
  $status = $result[5];
  $comments = $result[6];
    ?>

	
    <p align="center"><b>Trouble Ticket ID - </b><?php echo $formid?></p>
	<br>
<!--Trello Form -->	
<center><form name="trello"  action="/../trello/?id=<?php echo $formid; ?>" method="post"  data-ajax="false" enctype="multipart/form-data" class="">
<input type="submit" name="Submit" value="Add Ticket To Help Desk Trello Board!" class="form-btn" ></form></center>
<p align="center"><font size="2"><i>Disable Popups for Trello</i></font></p>
<center><form name="trello"  action="/../twillio/?id=<?php echo $formid; ?>" method="post"  data-ajax="false" enctype="multipart/form-data" class="general">

<!--Text Message Form -->	
<label for="select">Select Technician</label>
<div class="select-wrapper">  
<select name = "phone" class="" data-native-menu="false">
<option value="18122251849">Sam Bush</option>
<option value="18122251849">Sam Bush</option>
</select>
</div>

<label>Comments</label>
<input value="" name="comments" class="form-input">

<input type="submit" name="Submit" value="Send Ticket Via Text Message" class="form-btn" ></form></center>

<!--Edit Ticket Form -->	
<form name="uploadForm"  action="/../put/?id=<?php echo $formid ?>" method="post"  data-ajax="false" enctype="multipart/form-data" class="general">

<label>Name</label>
<input value="<?php echo $name?>" name="name" class="form-input" readonly>

<label>Detected</label>
<input value="<?php echo $dateTime?>" name="detected" class="form-input" readonly>

<label>Email</label>
<input value="<?php echo $email?>" name="email" class="form-input" readonly>

<label>Problem Description</label>
<input value="<?php echo $problem?>" name="problem" class="form-input" readonly>

<label for="select">Status - <i>edit</i></label>
<div class="select-wrapper">  
<select name = "status" class="" data-native-menu="false">
<option value="<?php echo $status?>"><?php echo $status?></option>
<option value="Open">Open</option>
<option value="Assigned">Assigned</option>
<option value="On Hold">On Hold</option>
<option value="Complete">Complete</option>
</select>
</div>
  
<label>Resolution Comments - <i>edit</i></label>
<input name="comments" value="<?php echo $comments ?>" class="form-input">

<?php
//changes form depending upon if image is available
if ($urlPic == ""){
	echo "<label>Attached Image</label>";
	echo "<input value='No Image Attached' class='form-input' readonly>";
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
}else{
echo "<label>Attached Image</label>";
echo "<span>";
echo "<a href=".$urlPic."><img src=".$urlPic."></a>";
echo "</span>";

}
?>
<br>
<br>
<br>

<center><input type="submit" id="submit" name="Submit" value="Submit Changes" class="form-btn" ></center>
<br>
<!--Please wait message generated with jQuery -->	
<div id="wait"></div>



<br>
</form>
<!--Delete Button -->	
<p align="center"><a href="/../delete/?id=<?php echo $formid ?>" onClick="verify(); "class="myButton">Delete Ticket</a></p>
<br>
<br>
    
   
</html>