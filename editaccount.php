<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Edit Account Information | Story Walk</title>

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

//Login function 
if (isset($_REQUEST['userlogin'])){
	$encryptPass=md5($_POST[passwordlogin]); //encrypts password
	$sql="SELECT * FROM accounts WHERE username='" . $_POST[userlogin] . "' AND password='" . $encryptPass . "'";
	$result=mysql_query($sql,$con);
	$count=mysql_num_rows($result);
	if ($count==1){
		$cookieusername = "saveuser";
		$cookieuservalue = $_POST[userlogin];
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

// Update account information
if (isset($_REQUEST['currpassword'])){
	$name = $_REQUEST['name'];
	$user = $_REQUEST['username'];
	$currpass = $_REQUEST['currpassword'];
	$curruser = $_COOKIE['saveuser'];
	$oldpass = md5($currpass);
	if($_REQUEST['newPassword'] === $_REQUEST['passwordVerify']){
		$newPass = md5($_REQUEST['newPassword']);
	}
	else{
		$newPass = md5($currpass);
	}
	$mail = $_REQUEST['email'];
	$sql = "UPDATE accounts
	SET name='$name', username='$user', password='$newPass', email='$mail'
	WHERE username='$curruser' AND password='$oldpass'";	
	if (!mysql_query($sql,$con))
	  {
	  die('Error in Update Account: ' . mysql_error());
	  }
	
	$cookie1 = "saveuser";
	unset($_COOKIE[$cookie1]);
	$res = setcookie($cookie1, '', time() - 3600, "/");
	$cookieusername = "saveuser";
	$cookieuservalue = $_POST['username'];
	setcookie($cookieusername,$cookieuservalue,time() + (86400 * 30), "/"); //sets cookie for 30 days
	
	header('Location: account.php');
}
?>

<?php include 'header.php';?>

<h1>My Account</h1>

<?php
	//Get the account info of the currently-logged-in account 
	$result = mysql_query("SELECT * FROM accounts WHERE username='" . $_COOKIE['saveuser'] . "'");

	
	while($row = mysql_fetch_array($result)){
		echo '<form method="post">';
		echo '<label for="name">Name: </label>';
		echo '<input type="text" name="name" id="name" value="' . $row['name'] . '">';
		echo '<br/>';
	
		echo '<label for="username">Username: </label>';
		echo '<input type="text" name="username" id="username" value="' . $row['username'] . '" readonly>';
		echo '<br/>';
	
		echo '<label>Current password: </label>';
		echo '<input type="password" name="currpassword" id="currpassword">';
		echo '<span>* Password is required for any account changes!</span>';
		echo '<br/>';
		
		echo '<label>New Password: </label>';
		echo '<input type="password" name="newPassword" id="newPassword">';
		echo '<br/>';
	
		echo '<label>Repeat New Password: </label>';
		echo '<input type="password" name="passwordVerify" id="passwordVerify">';
		echo '<br/>';
	
		echo '<label for="email">Email: </label>';
		echo '<input type="text" name="email" id="email" value="' . $row['email'] . '">';
		echo '<br/>';
		echo '<input type="submit">';
		echo '</form>';
	}
?>

<?php include 'footer.php';?>

</body>
</html>








