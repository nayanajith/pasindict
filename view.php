<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<body>
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
</body>
</html>
