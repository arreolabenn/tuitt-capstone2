<?php

	session_start();
	require_once("connect.php");

	$name = $_POST["name"];
	$price = $_POST["price"];
	$description = $_POST["description"];
	$category_id = $_POST["category_id"];
	$today = getdate();
	$image_name = $today[0] . "-" . $_FILES["image"]["name"];
	$image_path = "../assets/images/" . $image_name; //store path (use name)
	move_uploaded_file($_FILES["image"]["tmp_name"], "./".$image_path); //use tmp_name

	$sql="INSERT INTO items(name, description, price, image_path, category_id)
		  VALUES ('$name', '$description', '$price', '$image_path', '$category_id')";
	mysqli_query($conn, $sql);

	$_SESSION["added"] = "added new item";

	header("Location: ../views/items.php");