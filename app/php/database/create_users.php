<?php
/*******************************************************************************

	create_users.php
	* creates the users table
	* users(user_id, name, email, password, salt, user_level, ip,
					signup, lastedit, activated, edit_log)

*******************************************************************************/

	function generateID(){
		$temp_id ='';
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		for ($i = 0; $i < 11; $i++) {
			$temp_id .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $temp_id;
	}

	date_default_timezone_set('America/Chicago');

	// create users table if it doenst exist
	$tbl_users = "CREATE TABLE IF NOT EXISTS users (
		user_id VARCHAR(11) NOT NULL,
		name VARCHAR(100) NOT NULL,
		email VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL,
		salt VARCHAR(10) NOT NULL,
		user_level ENUM('a','b','c','d') NOT NULL DEFAULT 'a',
		ip VARCHAR(255) NOT NULL,
		signup DATETIME NOT NULL,
		last_login DATETIME NULL,
		activated ENUM('0','1') NOT NULL DEFAULT '0',
		PRIMARY KEY (user_id),
		UNIQUE KEY (email)
	);";

	// execute query and check for success
	$query = mysqli_query($conn, $tbl_users);
	if ($query === TRUE) {
		echo "<h3>users table created OK :) </h3>";
	} else {
		echo "<h3>users table NOT created :( </h3>";
	}

	// create an admin user
	$user_id = generateID();
	$u = "Admin";
	$e = "admin";
	$encrypted_password = "b6aw4MGiheLECXzoucVzo1P1ly4wYjk5YjExOWM0";
	$salt = "0b99b119c4";
	$signup = date('Y-m-d H:i:s');
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

	// insert the admin user
	$sql = "INSERT INTO users (user_id, name, email, password, salt, user_level, signup, ip, activated) VALUES('$user_id','$u','$e','$encrypted_password','$salt', 'd', '$signup','$ip','1')";

	// check for successfull insert
	if($query = mysqli_query($conn, $sql)){
		echo "successfully inserted user!!!";
	} else {
		echo "failed to insert user!!";
	}
?>
