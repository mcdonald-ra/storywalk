<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>My Account | Story Walk</title>

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

<h1>My Account</h1>

<?php
	if(!isset($_COOKIE['saveuser']) && !isset($_COOKIE['savepass'])){
		echo '<p>You must be logged in to access this page!</p>';
		echo '<form method="post">';
		echo '<label for="userlogin">Username: </label>';
		echo '<input type="text" name="userlogin" id="userlogin"><br/>';
		echo '<label for="passwordlogin">Password: </label>';
		echo '<input type="password" name="passwordlogin" id="passwordlogin"><br/>';
		echo '<input type="submit" value="Submit">';
		echo '</form>';
		echo '<p><a href="register.php">I don\'t have an account.</a></p>';
	}
	else{
		//Get the account info of the currently-logged-in account 
		$result = mysql_query("SELECT * FROM accounts WHERE username='" . $_COOKIE['saveuser'] . "'");
		echo "<table>";
		
		while($row = mysql_fetch_array($result)){
			echo "<tr><td>Username:</td>";
			echo "<td>" . $row['username'] . "</td></tr>";
			echo "<tr><td>Name:</td>";
			echo "<td>" . $row['name'] . "</td></tr>";
			echo "<tr><td>Email:</td>";
			echo "<td>" . $row['email'] . "</td></tr>";
		}
		echo "</table>";
		
		echo '<p><a href="editaccount.php">Edit your account information.</a></p>';
	}
?>

<?php include 'footer.php';?>

</body>
</html>








