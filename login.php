<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Login | Story Walk</title>
<?php include 'header.php';?>

<?php
// Try to connect with the MySQL Server
$con = mysql_connect('ajax.cs.mercer.edu',"story",'melloyello1');

if (!$con)
  {
  die('Could not connect to mySQL: ' . mysql_error());
  }

// Try to open your DataBase
if (!mysql_select_db("story", $con))
  {
   die ('Could not open DB: ' . mysql_error());
  }
?>

<?php
	if(!isset($_COOKIE[saveuser]) && !isset($_COOKIE[savepass])){
		echo "Cookies failed to set!";
	}
	else{
		echo "Welcome, user " . $_COOKIE[saveuser] . "!";
		header("Location: index.php");
	}
?>

<?php include 'footer.php';?>

</body>
</html>








