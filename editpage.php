<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

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

if ($_GET["page"] != "info"){
	$sql="SELECT stories.title FROM stories JOIN pages ON stories.id=pages.storyid
	WHERE pages.storyid=" . $_GET["id"];

	$query=mysql_query($sql,$con) or die(mysql_error());
	$row=mysql_fetch_row($query);
	if($row){
		echo '<title>Editing Page ' . $_GET["page"] . ' of "' . $row[0] . '" | Story Walk</title>';
	}
}
else{
	$sql="SELECT title FROM stories WHERE id=" . $_GET["id"];
	$query=mysql_query($sql,$con) or die(mysql_error());
	$row=mysql_fetch_row($query);
	if($row){
		echo '<title>Editing Basic Information For ' .  $row[0] . '</title>';
	}
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
echo '<h1>Editing your story</h1>';
if (!mysql_query($sql,$con))
{
die('Error editing Pages: ' . mysql_error());
}
?>

<?php
// Update a page
if (isset($_REQUEST['storytext']))
{
	
	if ($_FILES)
	{
		echo "files selected\n\n\n<br><br>";

		print_r($_FILES) or die("NOPE");

		$name = $_FILES['pic']['name'];
		move_uploaded_file($_FILES['pic']['tmp_name'], "../Box/latham/uploads/".$name);
		$filepath = "/www/Box/latham/uploads/".$name;
	}
	
	$text=normalize($_REQUEST['storytext']);
	$escapetext = mysql_real_escape_string($text);
	$page = $_GET["page"];
	$storyid = $_GET["id"];
	$sql = "UPDATE pages p JOIN stories s ON (p.storyid=s.id)
	SET p.text='$escapetext', p.image1='$filepath', s.draft=1, s.pending=0
	WHERE p.id='$page' AND p.storyid='$storyid'";
	
	if (!mysql_query($sql,$con)){
		die('Error in Update Page: ' . mysql_error());
	}
	
	header('Location: editstory.php?id=' . $_GET['id']);
}

// Update the story information
if (isset($_REQUEST['storytitle'])){
	$title = $_REQUEST['storytitle'];
	$escapetitle = mysql_real_escape_string($title);
	$author = $_REQUEST['storyauthor'];
	$storyid = $_GET["id"];
	$sql = "UPDATE stories
	SET  title='$escapetitle', author='$author', draft=1 
	WHERE id='$storyid'";	
	if (!mysql_query($sql,$con))
	  {
	  die('Error in Update Page: ' . mysql_error());
	  }
	
	header('Location: editstory.php?id=' . $_GET[id]);
}
?>

<form method="post" enctype="multipart/form-data">
	<?php
	if ($_GET["page"] != "info"){
	$sql="SELECT text FROM pages WHERE storyid=" . $_GET["id"] . " AND id=" .$_GET["page"];
	$result=mysql_query($sql,$con);
	while($row = mysql_fetch_array($result)){
		echo '<textarea name="storytext">' . $row[0] . '</textarea><br/>';
		echo '<label for="pic">Select image:</label><br/>';
		echo '<input type="file" name="pic" size="10" /><br/>';
	}
	}
	else{
		$sql="SELECT title, author FROM stories WHERE id=" . $_GET["id"];
		$result=mysql_query($sql,$con);
		while($row = mysql_fetch_array($result)){
			echo '<textarea name="storytitle">' . $row[0] . '</textarea><br/>';
			echo '<textarea name="storyauthor">' . $row[1] . '</textarea><br/>';
		}
	}
	echo '<br/>';
	echo '<input type="submit" value="Update" onclick="return confirm(\'Making changes will revert this story to a non-pending draft. Are you sure you want to submit?\')">';
	?>
</form>

<?php include 'footer.php';?>

</body>
</html>