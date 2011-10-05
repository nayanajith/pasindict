<?php
	function checkSubmit($text){
		$pos = strpos($text, "'");
		$pos += strpos($text, "[");
		$pos += strpos($text, "]");
		$pos += strpos($text, "|");
		$pos += strpos($text, "\"");
		return $pos == 0;
	}
?>