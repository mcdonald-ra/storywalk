<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>My Stories | Story Walk</title>

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

<h1>My Stories</h1>

<ul>
<?php
// Obtain the stories
$result = mysql_query("SELECT * FROM stories WHERE username='" . $_COOKIE['saveuser'] . "' ORDER BY draft DESC, pending ASC");

// Display each story in a list
while($row = mysql_fetch_array($result))
	{
	$status="";
	if(($row['draft']>0) && ($row['pending']<1)){
		$status="Draft";
	}
	if($row['pending']>0){
		$status="Pending";
	}
	if(($row['draft']<1)){
		$status="Published";
	}
	
	echo '<li><em><a href="editstory.php?id=' . $row["id"] . '">' . $row["title"] .
	'</a></em>, written by ' . $row["author"] . '. (' . $status . ')</li>';
	}
mysql_close($con);
?>
<li><a href="newstory.php">Create a new story here!</a></li>
</ul>

<?php include 'footer.php';?>
</body>
</html>








