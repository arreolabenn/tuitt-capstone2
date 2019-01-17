<?php 

	session_start();
	require_once("connect.php");

	$id = $_POST["id"];

	$sql = "SELECT id, username, role_id FROM users WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$assoc = mysqli_fetch_assoc($result);
	extract($assoc);

	if($role_id == 1) {
		if($_SESSION["user"]["id"] == $id) {
			echo "cannot revoke own admin rights";
		} else {
			$sql = "UPDATE users SET role_id=2 WHERE id=$id";
			mysqli_query($conn, $sql);

			echo "revoked ". $username ."'s admin rights";
		}

	} else {
		$sql = "UPDATE users SET role_id=1 WHERE id=$id";
		mysqli_query($conn, $sql);

		if($_SESSION["user"]["id"] == $id) {
			$_SESSION["user"]["role_id"] = 1;
		}

		echo $username . " made into an admin";
	}

