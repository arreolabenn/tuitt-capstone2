<?php

	session_start();
	require_once("connect.php");

	$id = $_POST["item_id"];
	$name = $_POST["item_name"];
	$price = $_POST["item_price"];
	$description = $_POST["item_description"];
	$category_id = $_POST["item_category"];

	$sql = "UPDATE items
			SET name='$name', price=$price, description='$description', category_id='$category_id'
			WHERE id=$id";
	$result = mysqli_query($conn, $sql);

	header("Location: ../views/items.php");