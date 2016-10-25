<?php
	include_once("php/connect.php");
	include_once("php/include/session_manager_admin.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Register New User</title>

  <link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/my-form.css" rel="stylesheet" type="text/css" media="screen">
  <link href="css/containers.css" rel="stylesheet" type="text/css" media="screen">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Type" content="cache" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="rating" content="General" />
	<meta name="revisit-after" content="7 days" />
  <meta name="ROBOTS" content="All" />
  <meta name="Keywords" content="Texas A&M, TAMU, Department of Anthropology, New User, Register" />
	<meta name="Description" content="Create a new user account for the Department of Anthropology at Texas A&M."/>

	<script src="js/ajax.js"></script>
	<script src="js/main.js"></script>
	<script src="js/register.js"></script>
</head>

<body>
	<div id="container">
		<?php include_once("php/include/header.php"); ?>
		<div id="body">
			<div id="register" class="center-div">
				<div id="register-form" class="my-form">
					<h1>Register New Account</h1>
					<input id="username" type="text" placeholder="Name" onkeyup="restrict('username')">
					<span id="unamestatus"></span>
					<input id="email" type="text" placeholder="Email" onblur="checkemail()">
					<span id="enamestatus"></span>
					<input id="pass1" type="password" placeholder="Password" onkeyup="strength()">
					<span id="strength"></span>
					<input id="pass2" type="password" placeholder="Confirm Password" onkeyup="checkpass()">
					<span id="confirm"></span>
					<input type="submit" value="Register Account" onclick="signup()">
					<span id="status" style="text-align:center;"></span>
				</div>
			</div>
		</div>
  </div>
	<?php include_once("php/include/footer.php"); ?>
</body>
</html>
