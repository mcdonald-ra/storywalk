<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Story Walk--Register</title>
<?php include 'header.php';?>

<script type="text/javascript">

//Function to check valid name
function checkName(){
	var namevar = document.getElementById("name").value;
	if (!(/^[a-zA-Z]/.test(namevar))){
		document.getElementById("nameerror").innerHTML = "* Name can only contain letters and whitespace.";
	}
	else{
		document.getElementById("nameerror").innerHTML = "*";
	}
}

function checkUser(){
	var uservar = document.getElementById("username").value;
	if (uservar.indexOf(' ') >= 0){
		document.getElementById("usererror").innerHTML = "* Username cannot contain whitespace.";
	}
	else{
		document.getElementById("usererror").innerHTML = "*";
	}
}
</script>

<?php
// Try to connect with the MySQL Server
$con = mysql_connect('ajax.cs.mercer.edu',"story",'***********');

if (!$con)
  {
  die('Could not connect to mySQL: ' . mysql_error());
  }

// Try to open your DataBase
if (!mysql_select_db("story", $con))
  {
   die ('Could not open DB: ' . mysql_error());
  }
  
//Define and set errors to empty values
$userErr = $passErr = $pass2Err = $emailErr = "";
  
//Function to check that both passwords are the same
function samepass($pass, $pass2){
	if($pass1 == $pass1){
		return true;
	}
	else{
		return false;
		$pass2Err = "Passwords do not match!";
	}
}
  
//Function to strengthen password
function validPass($pass){
	if (preg_match('#[0-9]#',$pass)){ //Tests for a number
		if (preg_match('/[A-Z]/', $pass)){ //Tests for a capital 
			return true;
		}
	}
	else{
		return false;
		$passErr = "Password must contain a capital letter and a numeral!";
	}
}

//Function to check for pre-existing username
function validUser($un){
	$result = mysql_query("SELECT * FROM accounts WHERE username='" . $un . "'");
	$rows = mysql_num_rows($result);
	if ($rows > 0){
		return false;
		$userErr = "Username already exists!";
	}
	else{
		return true;
	}
}

//Funtion to check for valid email
function validMail($mail){
	if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
		return true;
	}
	else{
		return false;
		$emailErr = "Email is not valid!";
	}
}
  
//Add record to table
if (isset($_REQUEST['name'])) //Checks that name is set
	{
	if (samepass($_POST[password], $_POST[passwordVerify])) //Checks that password fields match
	{
		if(validPass($_POST[password])) //Checks that password contains a capital and a number
		{ 
			if(validUser($_POST[username])) //Checks that username doesn't exist 
			{
				if(validMail($_POST[email]))
				{
					$encryptPass=md5($_POST[password]);
				
					$sql="INSERT INTO accounts (name, username, password, email)
					VALUES
					('$_POST[name]','$_POST[username]','$encryptPass','$_POST[email]')";
		
					if (!mysql_query($sql,$con))
					{
					die('Error adding Account: ' . mysql_error());
					}
			
					echo "Success";
					$cookieusername = "saveuser";
					$cookieuservalue = $_POST[username];
					$cookiepassname = "savepass";
					$encryptPass = md5($_POST[password]);
					$cookiepassvalue = $encryptPass;
					setcookie($cookieusername,$cookieuservalue,time() + (86400 * 30), "/"); //sets cookie for 30 days
					setcookie($cookiepassname,$userpassvalue,time() + (86400 * 30), "/");
					header("Location: index.php");
				}
			}
		}
	}

}
?>

<h1>Create an Account</h1>

<form method="post">
	<label for="name">Name: </label><input type="text" name="name" id="name" onchange="checkName()">
	<span class="error" id="nameerror">* </span><br/>
	
	<label for="username">Username: </label><input type="text" name="username" id="username" onchange="checkUser()">
	<span class="error" id="usererror">* <?php echo $userErr;?></span><br/>
	
	<label>Password: </label><input type="password" name="password" id="password">
	<span class="error" id="passerror">* <?php echo $passErr;?></span><br/>
	
	<label>Repeat Password: </label><input type="password" name="passwordVerify" id="passwordVerify">
	<span class="error" id="pass2error">* <?php echo $pass2Err;?></span><br/>
	
	<label for="email">Email: </label><input type="text" name="email" id="email">
	<span class="error" id="emailerror">* <?php echo $emailErr;?></span><br/>
	<input type="submit">
</form>

<?php include 'footer.php';?>

</body>
</html>








