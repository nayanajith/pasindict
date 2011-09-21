<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<p>Addin to database...</p>
<body>
<?php
    include("db.php");
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    $sin = "[ ".$_GET['sinps']." ] ".$_GET['sindef'];
    $result = mysql_query("UPDATE dict SET sin='".$sin."' WHERE pali LIKE '".$_GET['pali']."'  COLLATE utf8_general_ci ;"); 
    if ($result)
        echo "success";
?>
<script type="text/javascript">
    window.close();
</script>
</body>
</html>
