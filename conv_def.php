<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<p>Addin to database...</p>
<body>
<?php
    include("db.php");
    mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
    mysql_set_charset('utf8');
    if (trim($_GET['sinps'])!="" && trim($_GET['sindef'])!="" && trim($_GET['pali'])!="" ){
		$sin = "[ ".$_GET['sinps']." ] ".$_GET['sindef'];
		$result = mysql_query("UPDATE dict SET new_sin='".$sin."' WHERE pali LIKE '".$_GET['pali']."'  COLLATE utf8_general_ci ;"); 
		if ($result) {
		    echo "<script type=\"text/javascript\">
			window.close();
			</script>";
		}	  	
    } else {
    	echo "<center><h2>ලබාදීමට ඇති සියල්ල ලබාදෙන්න.</h2></center>";
    }
    
?>

</body>
</html>
