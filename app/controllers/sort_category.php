<?php

	session_start();

	$id = $_GET["category"];
	if($id > 0){
		$_SESSION["category"] = $id;
	} else {
		unset($_SESSION["category"]);
	}

	header("Location: ../views/catalog.php?page=1");