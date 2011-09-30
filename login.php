<?php
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	// user,pass check
	include("db.php");
	include("config.php");
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    $result = mysql_query("SELECT pass FROM auth WHERE user LIKE '".$user."'");
	$row = mysql_fetch_assoc($result);
	if ($row['pass'] == sha1($pass)){
		$temp = md5(rand());
		$res1 = mysql_query("UPDATE auth SET temp ='".$temp."' WHERE user LIKE '".$user."'");
		setcookie("auth", $user."|".$temp, time()+$user_session_time);
		echo "<html><body><center><h1>Welcome, ".$user."</h1></center></body>
		<script type=\"text/JavaScript\">
		<!--
		setTimeout(\"location.href = './mod_home.php';\",1500);
		-->
		</script></html>";
	} else {
		echo "<html><body><center>You are not authenticated.</center></body></html>";
	}
?>
