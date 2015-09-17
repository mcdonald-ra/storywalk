<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Log In | Story Walk</title>

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

if (isset($_REQUEST['userlogin'])){
	$encryptPass=md5($_POST['passwordlogin']); //encrypts password
	$sql="SELECT * FROM accounts WHERE username='" . $_POST['userlogin'] . "' AND password='" . $encryptPass . "'";
	$result=mysql_query($sql,$con);
	$count=mysql_num_rows($result);
	if ($count==1){
		$cookieusername = "saveuser";
		$cookieuservalue = $_POST['userlogin'];
		$cookiepassname = "savepass";
		$cookiepassvalue = $encryptPass;
		setcookie($cookieusername,$cookieuservalue,time() + (86400 * 30), "/"); //sets cookie for 30 days
		setcookie($cookiepassname,$userpassvalue,time() + (86400 * 30), "/");
		header("Location: login.php"); //Redirect to logged in page
	}
	else{
		echo "Login failed; username or password incorrect";
	}
}
?>

<?php include 'header.php';?>

	
<form method="post">
	<label for="userlogin">Username: </label>
	<input type="text" name="userlogin" id="userlogin"><br/>
	<label for="passwordlogin">Password: </label>
	<input type="password" name="passwordlogin" id="passwordlogin"><br/>
	<input type="submit" value="Submit">
</form>

<?php include 'footer.php';?>

</body>
</html>








