<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Bamboo  
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20090820

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>පාලි සිංහල ශබ්දකෝෂය</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">පාලි සිංහල ශබ්දකෝෂය   </a></h1>
			<p></p>
		</div>
	</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href=".">Home</a></li>
			<li><a href="./login.php">Login</a></li>
			<li><a href="./conv.php">Convert English meanings/definitions to Sinhala.</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<h2 class="title"><a href="#">පාලි සිංහල ශබ්දකෝෂය   </a></h2>
				<div class="entry">
					
<?php

	// user,pass check
	include("db.php");
	include("config.php");

    if (isset($_POST['user'])){
        $user = $_POST['user'];
		$pass = $_POST['pass'];
		mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
		mysql_select_db($db_name) or die(mysql_error());
		mysql_set_charset('utf8');
		$result = mysql_query("SELECT pass FROM auth WHERE user LIKE '".$user."'");
		$row = mysql_fetch_assoc($result);
		if ($row['pass'] == crypt($pass, $config_crypt_salt)){
			$temp = md5(rand());
			$res1 = mysql_query("UPDATE auth SET temp ='".$temp."' WHERE user LIKE '".$user."'");
			setcookie("auth", $user."|".$temp, time()+$config_session_time);

?>
		<center><h1>Welcome, <?php echo $user?></h1></center>

		<script type="text/JavaScript">
		<!--
		setTimeout("location.href = './mod_home.php';",1500);
		-->
		</script>


<?php	
		} else {
?>
			<h2>Login failed, try again.</h2>
<?php
		}
	} else {
?>
    <h2>Login</h2>
    <br>
    <form action="login.php" method="post">
        <p>User Name <input type="text" name="user" /></p>
        <p>Password <input type="password" name="pass" /></p>
        <p><input type="submit" value="Login"/></p>
    </form>
    <br>

<?php
	}
?>
				</div>
			</div>

	
		<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer-wrapper">
	<div id="footer">
		<p>Copyright (c) 2012 PALISINDICTIONARY.</p>
	</div>
	<!-- end #footer -->
</div>
</body>
</html>

