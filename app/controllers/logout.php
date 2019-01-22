<?php

	session_start();

	session_destroy();

	session_start();

	$_SESSION["status"] = "logout";

	header("Location: ../views/home.php");

?>
