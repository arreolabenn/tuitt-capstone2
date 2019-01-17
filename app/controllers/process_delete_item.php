<?php

	session_start();
	require_once("connect.php");

	$id = $_GET["id"];

	$sql = "SELECT image_path from items WHERE id=$id";
	$retrieve = mysqli_query($conn, $sql);
	$assoc = mysqli_fetch_assoc($retrieve);
	unlink($assoc["image_path"]);
	$sql2 = "DELETE FROM items WHERE id=$id";
	$deletion = mysqli_query($conn, $sql2);

	header("Location: ../views/items.php");