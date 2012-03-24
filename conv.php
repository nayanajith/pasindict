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
			<p>Convert English meanings to Sinhala</p>
		</div>
		<div id="search">
			<form method="get" action="">
				<fieldset>
				<input type="text" name="s" id="search-text" size="15" value="enter keywords here..." />
				<input type="submit" id="search-submit" value="GO" />
				</fieldset>
			</form>
		</div>
	</div>
	</div>
	<!-- end #header -->
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href=".">Home</a></li>
			<li><a href="./login.php">Login</a></li>
			<li><a href="./conv.php">Convert English meanings/definitions to Sinhalese.</a></li>
		</ul>
	</div>
	<!-- end #menu -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<h2 class="title"><a href="#">Convert English meanings to Sinhala </a></h2>
				<div class="entry" style="text-align:left;">
					<?php
						include("db.php");
						mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
						mysql_select_db($db_name) or die(mysql_error());
						mysql_set_charset('utf8');
						if (isset($_GET['sinps']) && isset($_GET['sindef']) && isset($_GET['pali']) ) {
							include("util.php");
							check_submit($_GET['sinps']);
							check_submit($_GET['sindef']);
							
							if (trim($_GET['sinps'])!="" && trim($_GET['sindef'])!="" && trim($_GET['pali'])!="" ){
								$sin = "[ ".$_GET['sinps']." ] ".$_GET['sindef'];
								$result = mysql_query("UPDATE dict SET new_sin='".$sin."' WHERE pali LIKE '".$_GET['pali']."'  COLLATE utf8_general_ci ;");     
							} else {
								echo "<center><h2>ලබාදීමට ඇති සියල්ල ලබාදෙන්න.</h2></center>";
								echo "<br><br>";
								exit(1);
							}
						} 
						$result = mysql_query("SELECT * FROM dict WHERE (LOWER(sin) RLIKE '\].[a-z]' AND new_sin ='') OR LOWER(new_sin) RLIKE '\].[a-z]' COLLATE utf8_general_ci ;"); 
						$f=0;
						
						while ($row = mysql_fetch_assoc($result)) {
							list($ps, $def) = explode("]", $row['sin']);
							$ps = trim(str_replace("[", "", $ps));
							$def = trim($def);
							echo $f." '".$row['pali']."'<br>";
							echo "<form action=\"conv.php?\" method=\"get\">
								<input type=\"hidden\" name=\"pali\" value=\"".$row['pali']."\"><br>
								<textarea type=\"text\" name=\"sinps\" rows=\"1\" cols=\"10\">".$ps."</textarea>
								<textarea name=\"sindef\" rows=\"1\" cols=\"60\">".$def."</textarea><br>
								<input type=\"submit\" value=\"change\" />
								</form>";
							echo "<br><br>";
							$f = $f +1;
							if ($f>49){
								break;
							}
						}
					?>
					<a href="./conv.php">More...</a>
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
		<p>Copyright (c) 2008 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
	</div>
	<!-- end #footer -->
</div>
</body>
</html>
