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
    include("db.php");
    $searchterm = $_POST['pali'];
    trim ($searchterm);
    /*check if search term was entered*/
    if (!$searchterm){
        echo 'සෙවීම සදහා පාලි වචනයක් ලබා දෙන්න.';
        exit(1);
    }
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    echo "<br><center><u>ප්‍රතිඵල</u></center><br>";
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    $result = mysql_query("SELECT * FROM dict WHERE pali LIKE '".$searchterm."' COLLATE utf8_general_ci;");
    $row = mysql_fetch_assoc($result);
    $f=0;
    if ($row){
        echo "&nbsp;".($f+1).". '".$row['pali']."'<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['sin'];
    } else {
        $result = mysql_query("SELECT * FROM dict WHERE pali LIKE '%".$searchterm."%' COLLATE utf8_general_ci;");
        $f = 0;
        while($row = mysql_fetch_assoc($result)){
            echo "&nbsp;".($f+1).". '".$row['pali']."'<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['sin'];
            echo "<br><br>";
            $f = $f +1;
            if ($f>29){
                echo "<br><center>ගැළපීම් 30ට වඩා ඇත(මෙහි දැක්වෙන්නෙ මුල් 30 පමණි), සෙවීම වඩා විශේෂ කරන්න.</center>";
                break;
            }
        }
        if ( ($f < 30) && ($f > 0) )
            echo "<br><center>ගැළපීම් ".$f."ක් හමුවිනි.</center>";
        if ($f == 0)
            echo "<br><center>ඔබ සෙවූ වචනය හමුනොවිනි.</center>";
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
