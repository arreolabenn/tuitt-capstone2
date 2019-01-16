<?php

	session_start();
	require_once("connect.php");

	$name = $_POST["name"];
	$price = $_POST["price"];
	$description = $_POST["description"];
	$category_id = $_POST["category_id"];
	$image_path = "../assets/images/" . $_FILES["image"]["name"]; //store path (use name)
	move_uploaded_file($_FILES["image"]["tmp_name"], "./".$image_path); //use tmp_name

	$sql="INSERT INTO items(name, description, price, image_path, category_id)
		  VALUES ('$name', '$description', '$price', '$image_path', '$category_id')";
	mysqli_query($conn, $sql);

	header("Location: ../views/catalog.php");