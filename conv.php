<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<p>Convert English meanings to Sinhala</p>
<body>
<?php
    include("db.php");
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    $result = mysql_query("SELECT * FROM dict WHERE (LOWER(sin) RLIKE '\].[a-z]' AND new_sin ='') OR LOWER(new_sin) RLIKE '\].[a-z]' COLLATE utf8_general_ci ;"); 
    $f=0;
    while ($row = mysql_fetch_assoc($result)) {
        list($ps, $def) = explode("]", $row['sin']);
        $ps = trim(str_replace("[", "", $ps));
        $def = trim($def);
        echo $f." '".$row['pali']."'<br>";
        echo "<form action=\"conv_def.php?\" method=\"get\" target=\"_blank\">
            <input type=\"hidden\" name=\"pali\" value=\"".$row['pali']."\"><br>
            <input type=\"text\" name=\"sinps\"  size=\"10\" value=\"".$ps."\">
            <input type=\"text\" name=\"sindef\" size=\"100\" value=\"".$def."\"><br>
            <input type=\"submit\" value=\"change\" onclick=\"refresh();\"/>
            </form>";
        echo "<br><br>";
        $f = $f +1;
        if ($f>49){
            break;
        }
    }
?>
<a href="./conv.php">More...</a>

<script language="Javascript">
<!--
function refresh()
{
    setTimeout("location.href = './conv.php';",1000);
    return true;
}
-->
</script>
<noscript>You need Javascript enabled for this to work</noscript>
</body>
</html>
