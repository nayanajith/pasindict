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
</body>
</html>
