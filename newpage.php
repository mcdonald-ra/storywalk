<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>My Stories | Story Walk</title>

<?php
date_default_timezone_set('America/New_York');

// Try to connect with the MySQL Server
$con = mysql_connect('ajax.cs.mercer.edu',"story",'***********');

if (!$con){
  die('Could not connect to mySQL: ' . mysql_error());
}

// Try to open your DataBase
if (!mysql_select_db("story", $con)){
   die ('Could not open DB: ' . mysql_error());
}

//Function to normalize carriage returns to HTML
function normalize($string){
	$string = preg_replace('/\n(\s*\n)+/', '</p><p>', $string);
	$string = preg_replace('/\n/', '<br>', $string);
	$string = '<p>' . $string . '</p>';
	return $string;
}
?>

<?php include 'header.php';?>

<?php

function pagenum(){
	global $num;
	$num=0;
	
	$sql = "SELECT MAX(id) AS max FROM pages WHERE storyid=" . $_GET['id'];
	$query=mysql_query($sql);
	$row = mysql_fetch_row($query);
	$maxnum = $row[0];
	if (is_null($maxnum)){
		$num=1;
	}
	else{
		$num=++$maxnum;
	}
}

if (isset($_REQUEST['storytext'])){
	$end=0;
	if (isset($_POST['ending'])){
		$end=1;
	}
	pagenum();
	$text=normalize($_REQUEST['storytext']);
	$escapetext = mysql_real_escape_string($text);
	
	if ($_FILES)
	{
		echo "files selected\n\n\n<br><br>";

		print_r($_FILES) or die("NOPE");

		$name = $_FILES['filename']['name'];
		move_uploaded_file($_FILES['filename']['tmp_name'], "../Box/latham/uploads/".$name);
		$filepath = "/www/Box/latham/uploads/".$name;
	}
	
	$sql="INSERT INTO pages (id, storyid, text, image1, end)
	VALUES
	('$num','$_GET[id]','$escapetext','$filepath','$end')";

	if (!mysql_query($sql,$con))
	{
		die('Error adding Story: ' . mysql_error());
	}
		header('Location: editstory.php?id=' . $_GET[id]);
}

?>


<h1>Add a New Page</h1>

<form method="post" enctype="multipart/form-data">
	<textarea name="storytext"></textarea><br/>	
	<label for="pic">Select image:</label><br/>
	<input type='file' name='pic' size='10' /><br/>
	<label for="ending">Is this the end of the story? </label>
	<input type="checkbox" name="ending" id="ending">
	<br/>
	<input type="submit">
</form>

<?php include 'footer.php';?>
</body>
</html>








