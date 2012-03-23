<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<body>
<?php
    include("db.php");
    include("util.php");
    $searchterm = $_POST['pali'];

    check_submit($_POST['pali']);
    check_submit($_POST['sinps']);
    check_submit($_POST['sindef']);    
    
    $meaning = "[ ".$_POST['sinps']." ] ".$_POST['sindef'];
    $searchterm = trim ($searchterm);
    $meaning = trim ($meaning);
    /*check if search term was entered*/
    if (!$searchterm){ 
        echo 'සෙවීම සදහා පාලි වචනයක් ලබා දෙන්න.';
        exit(1);
    }
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    $result = mysql_query("SELECT * FROM dict WHERE pali LIKE '".$searchterm."' COLLATE utf8_general_ci;"); 
    $row = mysql_fetch_assoc($result);
    if ($row){
        $res = mysql_query("UPDATE dict SET new_sin = '".$meaning."' WHERE pali LIKE '".$searchterm."' COLLATE utf8_general_ci;");
        echo "තිබූ සිංහල තේරුම, '".$row['sin']."' වෙනස් කරන ලදී.";
    } else {
        mysql_query("INSERT INTO new_dict VALUES('".$searchterm."', '".$meaning."');");
        echo "අලුතින් එකතු කරන ලදී.";
    }
?>
</body>
</html>
