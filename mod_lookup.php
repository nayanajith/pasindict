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
<script type="text/javascript">
function submit_change(pali, sin_id, new_id)
{
    if (sin_id!="" && new_id!=""){
        var sinbox = document.forms['form'].elements[sin_id]; 
        var newbox = document.forms['form'].elements[new_id]; 

        window.location = "./mod_lookup.php?pali=" + pali + "&sin=" +newbox.value+ "&new_sin=";
    }
    else
        window.location = "./mod_lookup.php?pali=" + pali + "&sin="+"&new_sin=";

}
function submit_delete(pali)
{
	window.location = "./mod_lookup.php?pali=" + pali + "&delete=1";
}
</script>
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">පාලි සිංහල ශබ්දකෝෂය   </a></h1>
			<p></p>
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
	include("auth.php");
	include("db.php");
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());

    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    
    if (isset($_GET['pali']) && isset($_GET['sin']) && isset($_GET['new_sin'])){
        $pali = $_GET['pali'];
        $sin = $_GET['sin'];
        $new_sin = $_GET['new_sin'];
        list($user, $temp) = explode("|", $_COOKIE['auth']);
        if ($sin==""){
            $result = mysql_query("UPDATE dict set new_sin='' WHERE pali LIKE '".$pali."' COLLATE utf8_general_ci;");  
        } else {
            $res1 = mysql_query("INSERT INTO commits VALUES ('".$user."','".$pali."','".date("Y-m-d")."')");
            $result = mysql_query("UPDATE dict set sin='".$sin."', new_sin='".$new_sin."' WHERE pali LIKE '".$pali."' COLLATE utf8_general_ci;"); 
        }
    } 
    
    if (isset($_GET['pali']) && isset($_GET['delete'])) {
		$result = mysql_query("DELETE from dict WHERE pali='".$_GET['pali']." 'COLLATE utf8_general_ci;"); 
		$result = mysql_query("DELETE from commits WHERE pali='".$_GET['pali']."';"); 
    }
    $result = mysql_query("SELECT * FROM dict WHERE new_sin NOT LIKE '' COLLATE utf8_general_ci;");
    echo "<center><p>You may leave the entries that are need to be removed as it is for the time being,
    only commit the ones that are correct.</p></center>";
    $t=0;
    echo "<form name=\"form\">";
    echo "<center><table width=\"90%\">";    
    while(($row = mysql_fetch_assoc($result)) && $t<50) {
        echo "<tr>";
        echo "<td>".$row['pali']."</td>";
        echo "<td>";
        echo "<input type=\"text\" name=\"sin".$t."\"  style=\"width:30%;\" value=\"".$row['sin']."\" >";
        echo "<input type=\"text\" name=\"new".$t."\" style=\"width:30%;\" value=\"".$row['new_sin']."\" >";
    	echo "<input type=\"button\" name=\"sinb".$t."\" value=\"Commit\"  onclick=\"submit_change('".$row['pali']."','sin".$t."','new".$t."')\" >";
        echo "<input type=\"button\" name=\"remb".$t."\" value=\"Remove\"  onclick=\"submit_change('".$row['pali']."','','')\" >";
        echo "<input type=\"button\" name=\"delb".$t."\" value=\"Delete\"  onclick=\"submit_delete('".$row['pali']."')\" >";
        echo "</td>";
        echo "</tr>";
        $t+=1;
    } 
    echo "</table></center>";
    echo "</form>";
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
