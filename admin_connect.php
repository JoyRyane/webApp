<?php
	$hostname = "localhost";
	$dbUser = "root";
	$dbPassword = "";
	$dbName = "roadagent";
	$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);
	if(!$conn){
		die("Something went wrong!!");
	}
?>