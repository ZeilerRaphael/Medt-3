<?php
	session_start();
	if(!isset($_SESSION["login"])) {
		header('Location: http://localhost/medt/BSP5/index.php/');
		exit;
	}
?>