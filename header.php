<?php
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo '<link rel="icon" type="image/ico" href="http://blackhawk.cs.mercer.edu/www/Story/favicon.ico" />';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	echo '</head>';
	echo '<body>';
	echo '<div id="navdiv">';
	
	echo '<div id="user" style="background-color:#FFFECE;position:absolute;top:0;right:0;padding:5px;">';
	if(isset($_COOKIE['saveuser'])){
		echo '<span>Welcome back, <a href="account.php">' . $_COOKIE['saveuser'] . '</a>!</span><br/>';
		echo '<span><a href="logout.php"><em>Not you?</em></a></span>';
	}
	else{
		echo '<span><a href="register.php">Register</a> or </span>';
		echo '<span><a href="log.php">Log in</a></span>';
	}
	echo '</div>';
	
	echo '<div id="head"><a href="index.php"><img src="header.png" alt="Story Walk" id="heading"></a></div>';
	echo '<nav id="navbar">';
  		echo '<ul>';
			echo '<li id="home"><a href="index.php">Home</a></li>';
			echo '<li id="about">';
			echo '<a title="click to close" class="less" href="#">X</a>';
			echo '<a title="click to open" class="more" href="#about">Z</a>';
			echo '<a href="about.php">About</a>';
				echo '<ul>';
				echo '<li><a href="aboutStory.php">About Story Walk</a></li>';
				echo '<li><a href="aboutStaff.php">About the Staff</a></li>';
				echo '</ul>';
			echo '</li>';
			echo '<li id="stories"><a href="stories.php">Stories</a></li>';
			echo '<li id="legal"><a href="privacypolicy.php">Privacy Policy</a></li>';
			echo '<li id="account">';
				echo '<a title="click to close" class="less" href="#">X</a>';
				echo '<a title="click to open" class="more" href="#account">Z</a>';
				echo '<a href="account.php">Account</a>';
			if(isset($_COOKIE['saveuser'])){
				echo '<ul>';
				echo '<li><a href="mystories.php">My Stories</a></li>';
				echo '<li><a href="logout.php">Log Out</a></li>';
				echo '</ul>';
				}
			else{
				echo '<ul>';
				echo '<li><a href="register.php">Register</a></li>';
				echo '<li><a href="log.php">Log In</a></li>';
				echo '</ul>';
			}
			echo '</li>';
			echo '</ul>';
		echo '</nav>';
	echo '</div>';
	
	echo '<div id="clearit"></div>';
	
	echo '<div id="wrapper">';
	echo '<div id="maindiv">';
?>




