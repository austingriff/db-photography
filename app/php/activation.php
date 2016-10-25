<?php
if (isset($_GET['e']) && isset($_GET['p'])) {

	// connect to database
    include_once("connect.php");

	// get user credentials from URL
	$e = $_GET['e'];	// user's email
	$s = $_GET['p']; 	// user's password

	// Evaluate the lengths of the incoming $_GET variable
	if(strlen($e) < 5 || $s == ""){
		// Log this issue into a text file and email details to yourself
		header("location: ../message.php?msg=activation_string_length_issues");
    	exit();
	}

	// Check their credentials against the database
	$sql = "SELECT * FROM users WHERE email='$e' AND salt='$s' LIMIT 1";
  $query = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($query);

	// Evaluate for a match in the system (0 = no match, 1 = match)
	if($numrows == 0){
		// Log this potential hack attempt to text file and email details to yourself
		header("location: ../message.php?msg=activation_credentials_no_match");
    	exit();
	}

	// Match was found, you can activate them
	$sql = "UPDATE users SET activated='1' WHERE email='$e' LIMIT 1";
  $query = mysqli_query($conn, $sql);

	// Optional double check to see if activated in fact now = 1
	$sql = "SELECT * FROM users WHERE email='$e' AND activated='1' LIMIT 1";
  $query = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($query);

		// Evaluate the double check
    if($numrows == 0){
			// Log this issue of no switch of activation field to 1
      header("location: ../message.php?msg=activation_failure");
    	exit();
    } else if($numrows == 1) {

		//send email notificaiton to user
		$subject = 'Iconography Account Activated';
		$message = 'Your account has been activated! Please login using your email and password! Login at: "http://calorie-conscious.com/admin/NA/login.php"';
		$headers = 'From: admin@calorie-conscious.com';

		// send activation email and insert unser into users table
		if(mail($e,$subject,$message,$headers)) {
			header("location: ../message.php?msg=activation_success");
			exit();
		}
		// failed to send email error
		else {
			header("location: ../message.php?msg=activation_success_email_failed");
			exit();
		}
    	exit();
    }
} else {
	// Log this issue of missing initial $_GET variables
	header("location: ../message.php?msg=activation_missing_get_variables");
    exit();
}
?>
