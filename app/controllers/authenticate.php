<?php

	session_start();

	require_once("connect.php");

	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars($_POST["password"]);

	$sql = "SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
	$user_info = mysqli_fetch_assoc($result);

	if(!password_verify($password, $user_info["password"])) {
		die("login_failed");
	} else {
		$_SESSION["user"] = $user_info;
	}

	// echo $_SESSION['user']['username'];

	echo "login_success";

	mysqli_close($conn);

?>