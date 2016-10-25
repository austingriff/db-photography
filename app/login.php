<!DOCTYPE HTML>
<html>
<head>
	<title>Login</title>

  <link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/my-form.css" rel="stylesheet" type="text/css" media="screen">
  <link href="css/containers.css" rel="stylesheet" type="text/css" media="screen">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Type" content="cache" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="rating" content="General" />
	<meta name="revisit-after" content="7 days" />
  <meta name="ROBOTS" content="All" />
  <meta name="Keywords" content="Texas A&M, TAMU, Department of Anthropology, Login" />
	<meta name="Description" content="Login for the Department of Anthropology student database."/>

	<script src="js/ajax.js"></script>
	<script src="js/main.js"></script>
	<script src="js/login.js"></script>
</head>

<body>
	<div id="container">
		<?php include_once("php/include/header.php"); ?>
		<div id="body">
			<div id="login" class="center-div">
				<div id="login-form" class="my-form">
					<h1>Login</h1>
					<input id="email" type="text" placeholder="Email" onfocus="emptyElement('status')">
					<input id="password" type="password" placeholder="Password" onfocus="emptyElement('status')">
					<input id="loginbtn" type="submit" value="Login" onclick="login()">
					<span id="status" style="text-align:center;"></span>
				</div>
			</div>
		</div>
  </div>
	<?php include_once("php/include/footer.php"); ?>
</body>
</html>
