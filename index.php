<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Story Walk</title>
<script type='text/javascript'>
	function hideIt(){
		document.getElementById("log").style.display="none";
	}
	
	function showIt(){
		document.getElementById("log").style.display="block";
	}
</script>

<!-- load jQuery and the plugin -->
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="bjqs-1.3.min.js"></script>

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
		setcookie($cookieusername,$cookieuservalue,@time() + (86400 * 30), "/"); //sets cookie for 30 days
		setcookie($cookiepassname,$userpassvalue,@time() + (86400 * 30), "/");
		header("Location: login.php"); //Redirect to logged in page
	}
	else{
		echo "Login failed; username or password incorrect";
	}
}
?>

<?php include 'header.php';?>

<div id="container">

      <!--  Outer wrapper -->
      <div id="banner-fade">

        <!-- start Basic Jquery Slider -->
        <ul class="bjqs">
          <li><a href="openbeta.php">
		  <img src="/www/story/slider/openbeta.png" title="Story Walk is now open for beta testing!" alt="Story Walk is now open for beta testing!">
		  </a></li>
          <li><a href="http://friendsoftattnall.org/">
		  <img src="/www/story/slider/park2.jpg" title="Tattnall Square Park, where testing is currently taking place" alt="Tattnall Square Park, where testing is currently taking place">
		  </a></li>
        </ul>
        <!-- end Basic jQuery Slider -->

      </div>
      <!-- End outer wrapper -->

      <script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 320,
            width       : 620,
            responsive  : true
          });

        });
      </script>
</div>

<h3>What is Story Walk?</h3>

<p><strong>Story Walk</strong> is a creative endeavor by two students
at Mercer University. It seeks to promote literacy, fitness, and computer
literacy all at the same time, particularly with young students.</p>
<p>For further information, check out our <a href="/www/Story/about.php">about
page</a>.</p>

<div id="indexuser">
<?php
	if(!isset($_COOKIE['saveuser']) && !isset($_COOKIE['savepass'])){
		echo '<p><a href="register.php">Register</a></p>';
		echo '<p><a href="javascript:showIt()">Log in</a></p>';
		
		echo '<div id="log" style="display:none;text-align:left;width:50%;margin-left:auto;margin-right:auto;">';
		echo '<form method="post">';
		echo '<label for="userlogin">Username: </label>';
		echo '<input type="text" name="userlogin" id="userlogin"><br/>';
		echo '<label for="passwordlogin">Password: </label>';
		echo '<input type="password" name="passwordlogin" id="passwordlogin"><br/>';
		echo '<input type="submit" value="Submit">';
		echo '<input type="button" onclick="hideIt()" value="Cancel">';
		echo '</form>';
		echo '</div>';
	}
	else{
		echo "<p>Welcome back, " . $_COOKIE['saveuser'] . "!</p>";
		echo '<p><a href="account.php">My Account</a></p>';
		echo '<p><a href="logout.php">Log out</a></p>';
	}
?>
</div>

<?php include 'footer.php';?>

</body>
</html>








