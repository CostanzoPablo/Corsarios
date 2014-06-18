<?php
	//< > \ " '
	foreach ($_GET as $key => $value) {
		$_GET[$key] = htmlentities(addslashes($_GET[$key]));
	}
	foreach ($_POST as $key => $value) {
		$_POST[$key] = htmlentities(addslashes($_POST[$key]));
	}  
?>
