<?php

	session_start();
	require_once("connect.php");

	$id = $_POST['id'];
	$complete_order_query = "UPDATE orders SET status_id=2 WHERE id=$id";
	$result = mysqli_query($conn, $complete_order_query);