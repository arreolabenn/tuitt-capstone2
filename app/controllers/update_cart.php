<?php

	session_start();

	require_once("connect.php");

	function getCartCount() {
		return array_sum($_SESSION["cart"]);
	}

	$item_id = $_POST["item_id"];
	$item_quantity = $_POST["item_quantity"];

	// $_SESSION["cart"][$item_id] = $item_quantity;


	if($item_quantity == "0"){
		unset($_SESSION["cart"][$item_id]);
	} else {
		if(isset($_SESSION["cart"][$item_id])) {
			$_SESSION["cart"][$item_id] += $item_quantity;
		} else {
			$_SESSION["cart"][$item_id] = $item_quantity;
		}
	}


	echo getCartCount();

?>