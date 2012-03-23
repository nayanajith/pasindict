<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
<head>
<script type="text/javascript">
function show_alert(pali, sin_id, new_id)
{
    if (sin_id!="" && new_id!=""){
        var sinbox = document.forms['form'].elements[sin_id]; 
        var newbox = document.forms['form'].elements[new_id]; 

        window.location = "./mod_lookup.php?pali=" + pali + "&sin=" +newbox.value+ "&new_sin=";
    }
    else
        window.location = "./mod_lookup.php?pali=" + pali + "&sin="+"&new_sin=";

}
</script>
</head>
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
    $t=0;
    echo "<form name=\"form\">";
    echo "<center><table width=\"90%\">";    
    while($row = mysql_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['pali']."</td>";
        echo "<td>";
        echo "<input type=\"text\" name=\"sin".$t."\"  style=\"width:40%;\" value=\"".$row['sin']."\" >";
        echo "<input type=\"text\" name=\"new".$t."\" style=\"width:40%;\" value=\"".$row['new_sin']."\" >";
    	echo "<input type=\"button\" name=\"sinb".$t."\" value=\"Commit\"  onclick=\"show_alert('".$row['pali']."','sin".$t."','new".$t."')\" >";
        echo "<input type=\"button\" name=\"remb".$t."\" value=\"Remove\"  onclick=\"show_alert('".$row['pali']."','','')\" >";
        
        echo "</td>";
        echo "</tr>";
        $t+=1;
    } 
    echo "</table></center>";
    echo "</form>";
?>

</body>
</html>
