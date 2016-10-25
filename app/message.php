<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);

// ACTIVATION MESSAGE HANDLING //

	// ACTIVATION FAILURE
	if($msg == "activation_failure"){
		$message = '<h2>Activation Error!</h2>
					<p>Sorry there seems to have been an issue activating your account at this time. Please contact site admin to resolve your issue.</p>';
	}
	// ACTIVATION STING LENGTH ISSUES
	else if($msg == "activation_string_length_issues"){
		$message = '<h2>Activation Error!</h2>
					<p>Activation link string length issue.</p>';
	}
	// ACTIVATION MISSING GET VARIABLES
	else if($msg == "activation_missing_get_variables"){
		$message = '<h2>Activation Error!</h2>
					<p>Missing GET variables. Please report this error to the email account which the activation link was sent.</p>';
	}
	// ACTIVATION USER CREDENTIALS DO NOT MATCH
	else if($msg == "activation_credentials_no_match"){
		$message = '<h2>Activation Error!</h2>
					<p>Activation link error. Credentials did not match system records.</p>';
	}
	// ACTIVATION SUCCESS
	else if($msg == "activation_success"){
		$message = '<h2>Activation Success!</h2>
					<p>The account has been activated.</p>';
	}
	// ACTIVATION SUCCESS EMAIL FAILED
	else if($msg == "activation_success_email_failed"){
		$message = '<h2>Activation Success! ERROR: User Email Failed</h2>
					<p>The account was successfully activated, but the email notifying the user failed to send!</p>';
	}

// LOGOUT MESSAGE HANDLING //

	// LOUTOUT FAILED
	else if($msg == "logout_failed"){
		$message = '<h2>Failed to log out!</h2>
					<p>Please close your internet browser.</p>';
	}
	// LOUTOUT FAILED
	else if($msg == "logout_no_user"){
		$message = '<h2>No one is logged in!</h2>
					<p>Sorry, there is no user logged in at the moment.</p>';
	}
	// LOUTOUT SUCCESS
	else if($msg == "logout_success"){
		$message = '<h2>Successful Logout!</h2>
					<p>You have successfully logged out.</p>';
	}

// RAW MESSAGE
	else {
		$message = $msg;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Message</title>

  <link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
  <link href="css/containers.css" rel="stylesheet" type="text/css" media="screen">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Type" content="cache" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="rating" content="General" />
	<meta name="revisit-after" content="7 days" />
  <meta name="ROBOTS" content="All" />
  <meta name="Keywords" content="Texas A&M, TAMU, Department of Anthropology, Message" />
	<meta name="Description" content="An important message from the system!"/>
</head>

<body>
	<div id="container">
		<?php include_once("php/include/header.php"); ?>
		<div id="body">
			<div id="message">
				<?php echo $message; ?>
			</div>
		</div>
  </div>
	<?php include_once("php/include/footer.php"); ?>
</body>
</html>
