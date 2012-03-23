<?php
	function check_submit($text){
		$pos = strpos($text, "'");
		$pos += strpos($text, "[");
		$pos += strpos($text, "]");
		$pos += strpos($text, "|");
		$pos += strpos($text, "\"");
		if ($pos != 0){
			echo "<center><h2>සාවද්‍ය සංඛේත ඉවත් කරන්න.</h2></center>";    
        	exit(1);
		}
	}
?>