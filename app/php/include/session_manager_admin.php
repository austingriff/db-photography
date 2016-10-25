<?php
/*******************************************************************************

	session_manager_admin.php
	* contains the session management for pages which require admin credentials

*******************************************************************************/

	session_start();
	date_default_timezone_set('America/Chicago');

	// if user is not logged in redirect to login page
	if(!isset($_SESSION['anthropology_username'])){
		header('location: login.php');
	} else { // else check the user's user_level
		$email = $_SESSION['anthropology_email'];
		$sql = "SELECT user_level FROM users WHERE email='".$email."';";
		$query = mysqli_query($conn, $sql);
		// check query execution
		if($query){ // the query successfully executed
			if(mysqli_num_rows($query) > 0){ // the query returned a result
				// get row and user_level from row
				$row = mysqli_fetch_assoc($query);
				$level = $row['user_level'];
				// redirect user if not admin
				if($level != 'd'){
					header("location: message.php?msg=admin_not_correct_userlevel");
				}
			} else { // the query did not find a result
				header("location: message.php?msg=failed_to_select_user:".$email);
			}
		}	else { // the query failed to execute
				header("location: message.php?msg=mysqli_query_error:".mysqli_error($conn));
		}
	}
?>
