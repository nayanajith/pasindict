<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
<body>
<?php
	include("auth.php");
	include("db.php");
	mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    //echo "<br><center></center><br>";
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
	$result = mysql_query("SELECT * FROM dict WHERE new_sin NOT LIKE '' COLLATE utf8_general_ci;");
	echo "<p>You may leave the entries that are need to be removed as it is for the time being,
    only commit the ones that are correct.</p>";
	echo "<center><table>";
    while($row = mysql_fetch_assoc($result)) {
    	echo "<tr><td><a href=\"mod_edit.php?pali=".$row['pali'].
    	"&sin=".$row['sin'].
    	"&new_sin=\" target=\"_blank\">Commit</a></td>
    	<td>".$row['pali']."</td><td>".$row['sin']."</td><td>".$row['new_sin']."</td></tr>";

    }
    echo "</table><br><a href=\"./mod_lookup.php\">Refresh</a></center>";
    
?>
</body>
</html>
