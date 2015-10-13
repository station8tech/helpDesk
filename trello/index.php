
 <?php
   $path = $_SERVER['DOCUMENT_ROOT'];
   $apiPath = $path."/api.php";
   include $apiPath;
     $formid = $_GET["id"];
     $getForm = new formStackAPI();
     $result = $getForm->getFormData($formid);
     
         $name = $result[0];
         $email = $result[1];
         $dateTime = $result[2];
         $problem = $result[3];
         $urlPic = $result[4];
         
    //added space to variable - javascript issue
    $name=preg_replace('/\s+/', ' ', $name);
    session_start(); 
    $_SESSION["formID"] = $formid;
    ?>
    <html>
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://api.trello.com/1/client.js?key=f0fc211d3340b140f45bf8492b03c964"></script>

<script type="text/javascript">

    
    var name = '<?php echo $name ?>';
    var email = '<?php echo $email ?>';
    var dateTime = '<?php echo $dateTime ?>';
    var problem = '<?php echo $problem ?>';
    var urlPic = '<?php echo $urlPic ?>';
    var formID = <?php echo $formid ?>;

   
var authenticationSuccess = function() { console.log("Successful authentication"); };
var authenticationFailure = function() { console.log("Failed authentication"); };
  Trello.authorize({
  type: "popup",
  name: "Getting Started Application",
  scope: {
    read: true,
    write: true },
  expiration: "never",
  authenticationSuccess,
  authenticationFailure
});
  
  var description =  "Name - " + name + " | Email - " + email + " | Detected - " + dateTime + " | Problem - " + problem;
  
  Trello.addCard({  
  url:"https://developers.trello.com/add-card",
  name: "Ticket ID - " + formID,
  desc: description
});
  


window.location.href = '/../index.php';
</script>

    </html>