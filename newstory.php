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

<?php

	if(isset($_POST['title'])){
		$sql="INSERT INTO stories (title, author, username, draft)
		VALUES
		('$_POST[title]','$_POST[author]','$_COOKIE[saveuser]','1')";

		if (!mysql_query($sql,$con))
		{
		die('Error adding Story: ' . mysql_error());
		}
	}
?>


<h1>Create a Story</h1>

<form method="post">
	<label for="title">Title: </label><input type="text" name="title" id="title">
	<span class="error" id="titleerror">* </span><br/>
	
	<label for="author">Author: </label><input type="text" name="author" id="author">
	<span class="error" id="authorerror">* </span><br/>
	<input type="submit">
</form>

<?php include 'footer.php';?>
</body>
</html>








