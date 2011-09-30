<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<body>
<?php
	if (isset($_GET['pali']) && isset($_GET['sin']) && isset($_GET['new_sin'])) {
		$pali = $_GET['pali'];
		$sin = $_GET['sin'];
		$new_sin = $_GET['new_sin'];
	} else {		
		$pali = $_POST['pali'];
		$sin = $_POST['sin'];
		$new_sin = $_POST['new_sin'];
	}
	include("auth.php");
	include("db.php");
	list($user, $temp) = explode("|", $_COOKIE['auth']);

	mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
 	mysql_set_charset('utf8');
 	$res = mysql_query("SELECT * FROM dict WHERE pali LIKE '".$pali."' COLLATE utf8_general_ci;"); 
 	$row = mysql_fetch_assoc($res);
 	$res1 = mysql_query("INSERT INTO commits VALUES ('".$user."','".$pali."','".date("Y-m-d")."')");
 	if ($row){
 		$result = mysql_query("UPDATE dict set sin='".$sin."', new_sin='".$new_sin."'  WHERE pali LIKE '".$pali."' COLLATE utf8_general_ci;"); 
		echo "edit";
	} else {
		$result = mysql_query("INSERT INTO dict VALUES ('".$pali."','".$sin."','".$new_sin."')"); 
		echo "add";
	}
?>
<script type="text/javascript">
    window.close();
</script>
</body>
</html>