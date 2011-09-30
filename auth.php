<?php
	if (isset($_COOKIE['auth'])){
		$auth = $_COOKIE['auth'];
		include("db.php");
		include("config.php");
   		mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    	mysql_select_db($db_name) or die(mysql_error());
    	mysql_set_charset('utf8');

   		list($user, $temp) = explode("|", $auth);
   		$result = mysql_query("SELECT * FROM auth WHERE user LIKE '".$user."' AND temp LIKE '".$temp."'");
		$row = mysql_fetch_assoc($result);
		if ($row){
			// authenticated
			echo "<center><table border=0 width=90%><tr>
			<td>Hello, ".$user.".<a>  </a><a href=\"./mod_home.php\">Home</a>
			</td>
			<td align=\"right\"><a href=\"./chng_pass.php\">Change Password</a><a> </a> 
				<a href=\"./logout.php\">Log Out</a></td>
			</tr></table></center>";
			// renew user session
			setcookie("auth",$auth,time()+$user_session_time);
		} else {
			// warn
			echo "<center><h3>
				Seems like someone has logged in using your user name and password after you have
				logged in to the system. A relogin will fix this but make sure to change your password.
				</h3></center>";
			exit(1);
		}
		
	} else {
		echo "<center><h3>Your session is over, please relogin.</h3></center>";
		exit(1);
	}
?>