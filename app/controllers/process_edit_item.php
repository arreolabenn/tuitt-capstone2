<?php

	session_start();
	require_once("connect.php");

	$id = $_POST["item_id"];
	$name = $_POST["item_name"];
	$price = $_POST["item_price"];
	$description = $_POST["item_description"];
	$category_id = $_POST["item_category"];

	if(isset($_FILES["image"]) && $_FILES["image"]["size"] > 0 ) {
		$sql1 = "SELECT image_path FROM items WHERE id=$id";
		$result = mysqli_query($conn, $sql1);
		$assoc = mysqli_fetch_assoc($result);

		$cur_image_path = $assoc["image_path"];
		unlink($cur_image_path);

		$today = getdate();
		$new_image_name = $today[0] . "-" . $_FILES["image"]["name"];
		$new_image_path = "../assets/images/" . $new_image_name;
		move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_path);

		$sql = "UPDATE items
		SET name='$name', price=$price, description='$description', category_id='$category_id', image_path='$new_image_path'
		WHERE id=$id";
		$result = mysqli_query($conn, $sql);

	} else {

		$sql = "UPDATE items
			SET name='$name', price=$price, description='$description', category_id='$category_id'
			WHERE id=$id";
		$result = mysqli_query($conn, $sql);

	}

	$_SESSION["edited"] = "edited item";

	header("Location: ../views/items.php");