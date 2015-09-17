<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Stories | Story Walk</title>

<?php
// Try to connect with the MySQL Server
$con = mysql_connect('ajax.cs.mercer.edu',"story",'melloyello1');

if (!$con){
  die('Could not connect to mySQL: ' . mysql_error());
}

// Try to open your DataBase
if (!mysql_select_db("story", $con)){
   die ('Could not open DB: ' . mysql_error());
}

?>

<?php include 'header.php';?>

<h1>List of Stories</h1>

<ul>
<?php
// Obtain the stories
$result = mysql_query("SELECT * FROM stories WHERE draft<1",$con);

// Display each story in a list
while($row = mysql_fetch_array($result))
  {
  echo '<li><em><a href="story.php?id=' . $row["id"] . '&page=0">' . $row["title"] . '</a></em>, written by ' . $row["author"] .
  '. (Uploaded by ' . $row["username"] . '.)</li>';
  }
mysql_close($con);
?>
</ul>

<?php include 'footer.php';?>

</body>
</html>






