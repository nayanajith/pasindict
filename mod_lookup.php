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
    $result = mysql_query("SELECT * FROM dict WHERE new_sin NOT LIKE '' COLLATE utf8_general_ci;");
    echo "<center><p>You may leave the entries that are need to be removed as it is for the time being,
    only commit the ones that are correct.</p></center>";
    echo "<center><table>";
    while($row = mysql_fetch_assoc($result)) {
    	echo "<tr><td><a href=\"mod_lookup.php?pali=".$row['pali'].
    	"&sin=".$row['new_sin'].
    	"&new_sin=\">Commit</a></td>
        <td><a href=\"mod_lookup.php?pali=".$row['pali'].
        "&sin=&new_sin=\">Remove</a></td>
    	<td>".$row['pali']."</td><td>".$row['sin']."</td><td>".$row['new_sin']."</td></tr>";

    }
    echo "</table><br><a href=\"./mod_lookup.php\">Refresh</a></center>";
?>
</body>
</html>
