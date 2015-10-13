

<?php
include 'header.php';
include 'api.php';
include 'session.php';
?>

<center><b>Select to edit status, resolution comments, and add to Trello Board.</b></center>
<br />
 
<table>

<tr><th>Edit</th></th><th>Status</th><th>Ticket ID</th><th>Name</th><th>Detected</th><th>Problem Description</th></tr>

<?php
$get = new formStackAPI();
$get->getSubmissionsTable();
?>

</table>
</body>
</html>










