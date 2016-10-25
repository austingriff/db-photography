<?php
/*******************************************************************************

	make_database.php
	** ONLY RUN THIS FILE ONCE **
	* creates the database for the website
	* creates all the tables in the database
	* inserts inital data into the tables

*******************************************************************************/

	// get connection to the mysql database
	$conn = mysql_connect('localhost', 'root', 'Password1');

	// Check connection
	if (!$conn) {
	    die('Could not connect: ' . mysql_error());
	}
	else {
		// Create database
		$sql = "CREATE DATABASE dbphotography";
		if (mysql_query($sql, $conn)) {
		    echo "Database created successfully";
				// connect to newly created database
				include_once("../connect.php");
				// makes users table and inserts admin user
				include_once("create_users.php");
		} else {
		    echo "Error creating database: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
?>
