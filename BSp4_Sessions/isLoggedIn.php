<?php
	session_start();
	if(!isset($_SESSION["login"])) {
		header('Location: http://localhost/medt/BSp4_Sessions/index.php/');
		exit;
	}
?>