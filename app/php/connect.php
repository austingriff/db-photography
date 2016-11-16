<?php

	/**
	 * @author austin griffin
	 * 09/27/16
	 */

	$db_name = "dbphotography";
	$mysql_username = "root";
	$mysql_password = "Password1";
	$server_name = "localhost";

	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

	if(!$conn){
		echo "<< connection to database failed! ERROR: ".mysqli_connect_error();
	}/*
	else {
		echo "<< connection to database successful!";
	}*/

?>
