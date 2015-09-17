<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<?php
// Try to connect with the MySQL Server
$con = mysql_connect('ajax.cs.mercer.edu',"story",'***********');

if (!$con){
  die('Could not connect to mySQL: ' . mysql_error());
}

// Try to open your DataBase
if (!mysql_select_db("story", $con)){
   die ('Could not open DB: ' . mysql_error());
}

$sql="SELECT title, author FROM stories WHERE id=" . $_GET["id"];
$query=mysql_query($sql,$con) or die(mysql_error());
$row=mysql_fetch_row($query);
if($row){
	echo '<title>Editing "' . $row[0] . '" by ' . $row[1] . ' | Story Walk</title>';
}
?>

<?php include 'header.php';?>

<?php
echo '<h1>Editing your story</h1>';
if (!mysql_query($sql,$con))
{
die('Error adding Pages: ' . mysql_error());
}
?>

<ul>
	<?php
		$sql="SELECT id FROM pages WHERE storyid=" . $_GET["id"];
		$result=mysql_query($sql,$con);
		
		echo '<li><a href="editpage.php?id=' .  $_GET["id"]	. '&page=info">Edit Basic Information</a></li>';
		
		while($row = mysql_fetch_array($result)){
			echo '<li><a href="editpage.php?id=' . $_GET["id"] . '&page=' .
			$row[0] . '">Edit page ' . $row[0] . '</a></li>';
		}
		
		echo '<li></li>';
		echo '<li><a href="newpage.php?id=' .  $_GET["id"]	. '">Add a new page</a></li>';
		echo '<li><a href="submitstory.php?id=' . $_GET["id"] . '">Submit story for approval</a></li>';
	?>
</ul>

<?php include 'footer.php';?>

</body>
</html>






