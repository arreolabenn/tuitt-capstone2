<?php

	session_start();

	if(isset($_GET["sort"])) {

		$sort = $_GET["sort"];

		if($sort == "price_asc") {
			$_SESSION["sort"] = "price";
			echo "1";
		} else if($sort == "price_des") {
			$_SESSION["sort"] = "price DESC";
			echo "2";
		} else if($sort == "name_asc") {
			$_SESSION["sort"] = "name";
			echo "3";
		} else if($sort == "name_des") {
			$_SESSION["sort"] = "name DESC";
			echo "4";
		}
	
	}

	header("Location: ../views/catalog.php?page=1");

?>