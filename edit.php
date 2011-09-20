<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<body>
<?php
    include("db.php");
    $searchterm = $_POST['pali'];
    $meaning = $_POST['meaning'];
    trim ($searchterm);
    trim ($meaning);
    /*check if search term was entered*/
    if (!$searchterm){
        echo 'සෙවීම සදහා පාලි වචනයක් ලබා දෙන්න.';
    }
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    $result = mysql_query("SELECT * FROM dict WHERE pali LIKE '".$searchterm."' COLLATE utf8_general_ci;"); 
    $row = mysql_fetch_assoc($result);
    if ($row){
        $res = mysql_query("UPDATE dict SET sin = '".$meaning."' WHERE pali LIKE '".$searchterm."' COLLATE utf8_general_ci;");
        echo "තිබූ සිංහල තේරුම, '".$row['sin']."' වෙනස් කරන ලදී.";
    } else {
        mysql_query("INSERT INTO new_dict VALUES('".$searchterm."', '".$meaning."');");
        echo "අලුතින් එකතු කරන ලදී.";
    }
?>
</body>
</html>
