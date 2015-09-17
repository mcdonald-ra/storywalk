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

$sql="SET @count = 0 UPDATE pages SET id = @count:= @count + 1 WHERE storyid=15";

if (!mysql_query($sql,$con)){
		die('Could not reorder: ' . mysql_error());
	}
?>