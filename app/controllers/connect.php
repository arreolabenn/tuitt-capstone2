<?php 

	$host = "db4free.net";
	$username = "wheresthefoodph";
	$password = "09252012";
	$database_name = "ecom_db_tuitt";

	$conn = mysqli_connect($host, $username, $password, $database_name);

	if(!$conn) {
		echo "Not Connected. Try Again Later" . mysqli_error($conn);
	}

?>