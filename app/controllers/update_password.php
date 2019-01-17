<?php

	session_start();
	require_once("connect.php");

	$id = $_POST["password_user_id"];
	$old_password = $_POST["change_cur_password"];
	$new_password = htmlspecialchars(password_hash($_POST["change_new_password"], PASSWORD_BCRYPT));

	$sql = "SELECT password FROM users WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$assoc = mysqli_fetch_assoc($result);

	if(password_verify($old_password, $assoc["password"])) {
		
		$sql2 = "UPDATE users SET password='$new_password' WHERE id=$id";
		$result2 = mysqli_query($conn, $sql2);
		echo "success";

	} else {
		echo "fail";
	}