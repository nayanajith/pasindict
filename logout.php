<?php 
	if (isset($_COOKIE['auth'])) {
		setcookie("auth","", time()-10);
		echo "<html><body><center>
		You have successfully logged out.<br>
		<a href=\".\">Home</a>
		</center></body></html>";
	}
?>