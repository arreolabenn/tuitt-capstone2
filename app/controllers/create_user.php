<?php

	require_once("connect.php");

	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars(password_hash($_POST["password"], PASSWORD_BCRYPT));
	$firstname = htmlspecialchars($_POST["firstname"]);
	$lastname = htmlspecialchars($_POST["lastname"]);
	$email = htmlspecialchars($_POST["email"]);
	$address = htmlspecialchars($_POST["address"]);

	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0){
		die("user_exists");
	} else {

		$sql_insert = "INSERT INTO users (username, password, firstname, lastname, email, address) 
					   VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$address')";
		$result = mysqli_query($conn, $sql_insert);

		if($result) {
			echo "success";
		} else {
			echo "error";
		}
	
	}

	mysqli_close($conn);

?>
