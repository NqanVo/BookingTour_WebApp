<?php
	$mysqli = new mysqli("localhost","root","","data_tourdulich");
	mysqli_set_charset($mysqli, 'UTF8');

	// Check connection
	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}
?>