<?php
	// start session
	session_start();

	// check if user is even logged in
	if(!isset($_SESSION['anthropology_username'])){
		header("location: ../message.php?msg=logout_no_user");
		exit();
	}

	// set session data to an empty array
	$_SESSION = array();

	// destroy the session variables
	session_destroy();

	// check to see if their sessions was destroied
	if(isset($_SESSION['anthropology_username'])){
		header("location: ../message.php?msg=logout_failed");
		exit();
	} else {
		header("location: ../index.php");
		exit();
	}
?>
