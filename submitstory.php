<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Submitting | Story Walk</title>
<?php include 'header.php';?>

<?php
// Try to connect with the MySQL Server
$con = mysql_connect('ajax.cs.mercer.edu',"story",'***********');

if (!$con)
  {
  die('Could not connect to mySQL: ' . mysql_error());
  }

// Try to open your DataBase
if (!mysql_select_db("story", $con))
  {
   die ('Could not open DB: ' . mysql_error());
  }

// Set page to PENDING
$storyid = $_GET["id"];
$sql = "UPDATE stories SET pending=1 WHERE id='$storyid'";

if (!mysql_query($sql,$con)){
	die('Error in Update Page: ' . mysql_error());
}

header('Location: mystories.php');
  
?>

<?php include 'footer.php';?>

</body>
</html>








