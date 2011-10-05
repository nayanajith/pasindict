<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<center><h2>Convert English meanings to Sinhala</h2></center>
<body>
<?php
    include("db.php");
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    if (isset($_GET['sinps']) && isset($_GET['sindef']) && isset($_GET['pali']) ) {
        include("util.php");
        if (checkSubmit($_GET['sinps']) == FALSE or checkSubmit($_GET['sindef']) == FALSE) {
            echo "<center><h2>සාවද්‍ය සංඛේත ඉවත් කරන්න.</h2></center>";
            echo "<br><br>";
            exit(1);
        }
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
</body>
</html>
