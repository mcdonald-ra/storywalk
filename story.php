<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="pagestyle.css">

<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>
//Uses jQuery to grab the width of the screen, hopefully
function getAvail(){
	var availwidth = screen.availWidth;
	return availwidth;
};

var avail=getAvail();
</script>

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

$sql="SELECT title, author FROM stories WHERE id=" . $_GET["id"];
$query=mysql_query($sql,$con) or die(mysql_error());
$row=mysql_fetch_row($query);
if($row){
	echo '<title>"' . $row[0] . '" by ' . $row[1] . ' | Story Walk</title>';
}
?>

<?php include 'header.php';?>

<?php
$page=$_GET["page"];
$storyid=$_GET["id"];

//Displays the cover if page=0
if($page<1){

	//Sets 30-day cookie "savestory" to enable use of QR Codes
	$cookiestoryname = "savestory";
	$cookiestoryvalue = $_GET['id'];
	setcookie($cookiestoryname,$cookiestoryvalue,time() + (86400 * 30), "/");
	
	$sql="SELECT title, author FROM stories WHERE id=" . $storyid;
	$query=mysql_query($sql,$con) or die(mysql_error());
	$row=mysql_fetch_row($query);
	if($row){
		echo '<div id="bookwrap" style="position:relative;max-width:447px;max-height:673;display:block;margin-left:auto;margin-right:auto;padding-top:115px;">';
		echo '<div id="title" style="z-index:100; position:absolute; text-align:center; width:50%; top:25%; left:27%; color:white;">';
		echo '<h1 id="storytitle">"' . $row[0] . '"</h1>';
		echo '</div>';
		echo '<div id="author" style="z-index:100; position:absolute; text-align:center; width:50%; top:70%; left:27%; color:white;">';
		echo '<h2 id="storyauthor">' . $row[1] . '</h2>';
		echo '</div>';
		echo '<img src="book.png" alt="' . $row[0] . ' by ' . $row[1] . '" style="max-width:100%; height:auto;">';
		echo '</div>';
	}
}

//Displays the text and images
else{
$sql="SELECT pages.text, pages.end, pages.image1, pages.image2 FROM pages INNER JOIN stories ON pages.storyid=stories.id WHERE stories.id=" . $storyid .
" AND pages.id=" . $page;
$query=mysql_query($sql,$con) or die(mysql_error());
$row=mysql_fetch_row($query);
if($row){
	echo '<div id="storywrapper">';
	echo '<div id="book">';
	if($row[1]){
	echo '<script>';
			echo 'if (avail>1025){';
				echo 'document.write(\'<img src="openbook.png" style="max-width:100%;height:auto;">\');';
			echo '}';
	echo '</script>';
	}
	else{
		echo '<script>';
			echo 'if (avail>1025){';
				echo 'document.write(\'<img src="openbookRIGHT.png" style="max-width:100%;height:auto;">\');';
			echo '}';
	echo '</script>';
	}
	
	echo '</div>';
	
	if(!is_null($row[2])){
		echo '<div id="1image">';
            echo '<img id="image1" src="' . $row[2] . '" alt="Image 1">';
        echo'</div>';
	}
	
	echo '<div id="storytext">' . $row[0];
	
	if($row[1]){
		echo '<h1>The End.</h1>';
		$cookie = "savestory";
		unset($_COOKIE[$cookie]);
		$res = setcookie($cookie, '', time() - 3600, "/");
	}
	
	echo '</div>';

	
	echo "</div>";
	echo "</div>";
}
}
?>

<?php include 'footer.php';?>

</body>
</html>






