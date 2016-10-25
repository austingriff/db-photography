<?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
//if(isset($_POST["e"])){

	// CONNECT TO THE DATABASE
	include_once('database.php');
	date_default_timezone_set('America/Chicago');

	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	//$e = $_POST['e'];
	//$p = $_POST['p'];

	$e = "Admin";
	$p = "Password1";

	// FORM DATA ERROR HANDLING
	if($e == "" || $p == ""){
		echo "login_failed";
    exit();
	} else {
	// END FORM DATA ERROR HANDLING
		// try and get user where email is $e
		$user = Db::getInstance()->get('users', array('email', '=', $e));

		if($user->count() != 1){ // should only find one user
			echo "login_failed_email"; // failed to find email in database
			exit();
		} else {

			//echo "inside!";
			$user->results();
			$salt = $user->salt;
			$encrypted_password = $user->password;
			$hash = base64_encode(sha1($p . $salt, true) . $salt);
			echo $salt;
			//echo $salt;

			if ($encrypted_password == $hash) {

				$user = Db::getInstance()->query("SELECT * FROM users WHERE email=? AND activate='1'", array($e));
				if($user->count() != 1){
					// email address not activated
					echo "login_failed_email_no";
					exit();
				} else {
					// success
					$user->results();
					$db_id = $user->user_id;
					$db_username = $user->name;
					$db_pass_str = $user->password;

					session_start();
					$_SESSION['anthropology_userid'] = $db_id;
					$_SESSION['anthropology_username'] = $db_username;
					$_SESSION['anthropology_password'] = $db_pass_str;
					$_SESSION['anthropology_email'] = $e;
					// update user info
					$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
					$last_login = date('Y-m-d H:i:s');
					$user = Db::getInstance()->update('users', 'user_id', $db_id, array(
							'ip' => $ip,
							'last_login' => $last_login
					));
					echo "login_success";
					exit();
				}
			} else {
				// failed to verify password
				echo "login_failed_pass";
				exit();
			} // end find password
		} // end find email
	} // end data form error checking
	exit();
//}
?>
