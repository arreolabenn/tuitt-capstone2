<?php 

	$host = "localhost";
	$username = "root";
	$password = "";
	$database_name = "ecom_db";

	$conn = mysqli_connect($host, $username, $password, $database_name);

	if(!$conn) {
		echo "Not Connected. Try Again Later" . mysqli_error($conn);
	}

	// echo "Connected Successfully";

?>