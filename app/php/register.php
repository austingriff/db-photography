<?php

/**
 * @author austin griffin
 */

 /*
  * Creates a unique id
  */
 function generateID(){
 	$temp_id ='';
 	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
 	for ($i = 0; $i < 11; $i++) {
 		$temp_id .= $characters[rand(0, strlen($characters) - 1)];
 	}
 	return $temp_id;
 }

/*
 * Ajax calls this to check if email exists in database
 */
if(isset($_POST["emailcheck"])){

	// connect to database
	include_once("connect.php");

	// get email and check if it exists
	$email = $_POST['emailcheck'];
	$sql = "SELECT user_id FROM users WHERE email='$email' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $email_check = mysqli_num_rows($query);

	// email does not exist in database
    if ($email_check < 1) {
	    echo '<strong style="color:#009900;font-size:12pt;">' . $email . ' is available</strong>';
	    exit();
    }
	// email does exist in database
	else {
	    echo '<strong style="color:#F00;font-size:12pt;">' . $email . ' is taken</strong>';
	    exit();
    }
}

/*
 * Ajax calls this to insert user into database
 */
if(isset($_POST["u"])){

	// connect to database
	include_once("connect.php");
	date_default_timezone_set('America/Chicago');

	// gather post variables
	$u = $_POST['u'];									// user's name
	$e = mysqli_real_escape_string($conn, $_POST['e']); // user's email
	$p = $_POST['p'];									// user's password

	// used to check if email already exists
	$sql = "SELECT user_id FROM users WHERE email='$e' LIMIT 1";
  $query = mysqli_query($conn, $sql);
	$e_check = mysqli_num_rows($query);

	// FORM DATA ERROR HANDLING
	if($u == "" || $e == "" || $p == ""){
		echo 'missing_data';
        exit();
	} else if ($e_check > 0){
		echo 'email_in_system';
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 100) {
		echo 'name_size_error';
        exit();
    } else if (is_numeric($u[0])) {
		echo 'name_has_number';
        exit();
    } else {
	// END FORM DATA ERROR HANDLING BEGIN INSERTION

		// encrypt password
		$salttemp = sha1(rand());
		$salttemp = substr($salttemp, 0, 10);
		$encrypted = base64_encode(sha1($p . $salttemp, true) . $salttemp);
		$hash = array("salt" => $salttemp, "encrypted" => $encrypted);
		$encrypted_password = $hash["encrypted"];
		$salt = $hash["salt"];

		// idk what this does but it fixes a bug when registering
		//$uid = mysqli_insert_id($conn);


		// message details for email
		//$subject = 'TAMU Department of Anthropology Account Activation';
		//$message = 'A request has been made by '.$u.' at '.$e.' to create an account! Please click the link approve the request:  "http://www.calorie-conscious.com/admin/SD/php/activation.php?e='.$e.'&p='.$salt.'"';
		//$headers = "From: admin@calorie-conscious.com\n";

		// generate more data
		$user_id = generateID();
		$signup = date('Y-m-d H:i:s');
		$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
		$sql = "INSERT INTO users (user_id, name, email, password, salt, signup, ip) VALUES('$user_id','$u','$e','$encrypted_password','$salt','$signup','$ip')";

		// try to insert user into table
		if($query = mysqli_query($conn, $sql)){
			/*
			// try to send activation email
			if(mail('austingriff@tamu.edu',$subject,$message,$headers)) {
				echo "signup_success";
				exit();
			} else { // failed to send email error
				echo "email_send_failed";
				exit();
			}*/
			echo "signup_success";
		} else { // failed to insert user into table
			echo 'insert_user_failed';
			exit();
		}
	}
	exit();
}
?>
