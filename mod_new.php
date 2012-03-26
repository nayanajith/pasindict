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
			<li><a href="./conv.php">Convert English meanings/definitions to Sinhalese.</a></li>
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
						include("auth.php");
						include("db.php");
						mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
						//echo "<br><center></center><br>";
						mysql_select_db($db_name) or die(mysql_error());
						mysql_set_charset('utf8');
						
						if (isset($_GET['pali']) && isset($_GET['sin'])){
							$pali = $_GET['pali'];
							$sin = $_GET['sin'];
							list($user, $temp) = explode("|", $_COOKIE['auth']);
							if ($sin!=""){
								$res1 = mysql_query("INSERT INTO commits VALUES ('".$user."','".$pali."','".date("Y-m-d")."')");
								$result = mysql_query("INSERT INTO dict VALUES ('".$pali."','".$sin."','')"); 
							}
							$result = mysql_query("DELETE FROM new_dict where pali LIKE '".$pali."' COLLATE utf8_general_ci;");   
						} 
						$result = mysql_query("SELECT * FROM new_dict;");
						echo "<center><p>You may leave the entries that are need to be removed as it is for the time being,
						only commit the ones that are correct.</p></center>";
						echo "<center><table>";
						while($row = mysql_fetch_assoc($result)) {
							echo "<tr><td><a href=\"mod_new.php?pali=".$row['pali'].
							"&sin=".$row['sin'].
							"\">Commit</a></td>
							<td><a href=\"mod_new.php?pali=".$row['pali']."&sin=\" >Remove</a></td>
							<td>".$row['pali']."</td><td>".$row['sin']."</td>";

						}
						echo "</table><br><a href=\"./mod_new.php\">Refresh</a></center>";
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


