<?php

	session_start();
	require_once("connect.php");

	$id = $_POST["user_id"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$password = $_POST["password"];

	$sql = "SELECT password FROM users WHERE id=$id";
	$query = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($query);

	if(password_verify($password, $result["password"])) {
		$sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', address='$address' WHERE id=$id";
		$query = mysqli_query($conn, $sql);

		$sql2 = "SELECT * FROM users WHERE id=$id";
		$result = mysqli_query($conn, $sql2);
		$_SESSION["user"] = mysqli_fetch_assoc($result);

		echo "success";
	} else {
		echo "failed";
	}
