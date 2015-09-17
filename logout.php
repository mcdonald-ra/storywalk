<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Story Walk--Logout</title>
<?php include 'header.php';?>

<?php
// Try to connect with the MySQL Server
$con = mysql_connect('ajax.cs.mercer.edu',"story",'**********');

if (!$con)
  {
  die('Could not connect to mySQL: ' . mysql_error());
  }

// Try to open your DataBase
if (!mysql_select_db("story", $con))
  {
   die ('Could not open DB: ' . mysql_error());
  }
  
$cookie1 = "saveuser";
unset($_COOKIE[$cookie1]);
$res = setcookie($cookie1, '', time() - 3600, "/");
$cookie2 = "savepass";
unset($_COOKIE[$cookie2]);
$res2 = setcookie($cookie2, '', time() - 3600, "/");
?>

<?php
	if(!isset($_COOKIE[saveuser]) && !isset($_COOKIE[savepass])){
		echo "Successfully logged out.";
		header("Location: index.php");
	}
	else{
		echo "Log out unsuccessful!";
	}
?>

<?php include 'footer.php';?>

</body>
</html>








