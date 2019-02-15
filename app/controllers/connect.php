<?php 

	$host = "sql306.epizy.com";
	$username = "epiz_23455717";
	$password = "BIiqBewXMY";
	$database_name = "epiz_23455717_wtf";

	// $host = "localhost";
	// $username = "root";
	// $password = "";
	// $database_name = "ecom_db_tuitt";

	// $host = "localhost";
	// $username = "root";
	// $password = "";
	// $database_name = "ecom_db";

	$conn = mysqli_connect($host, $username, $password, $database_name);

	if(!$conn) {
		echo "Not Connected. Try Again Later" . mysqli_error($conn);
	}

?>