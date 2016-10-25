/************************************************************************

	This file contains the javascript functions for processing
	a new user account.  It makes an ajax call to register.php
	
************************************************************************/

/**
 * restrict certain characters 
 */
function restrict(elem){
	var tf = document.getElementById(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-zA-Z ]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}

/**
 * check if email already exists 
 */
function checkemail(){
	var e = document.getElementById("email").value;
	if(e != ""){
		document.getElementById("enamestatus").innerHTML = '<img src="imgs/extra/loading.gif">';
		var ajax = ajaxObj("POST", "php/register.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				document.getElementById("enamestatus").innerHTML = ajax.responseText;
			}
		}
		ajax.send("emailcheck="+e);
	}
}

/**
 * check if both paswords match password 
 */
function checkpass(){
	var p1 = document.getElementById("pass1").value;
	var p2 = document.getElementById("pass2").value;
	if(p1 != p2){
		var elem = document.getElementById("confirm").innerHTML = '<strong style="color:#F00;font-size:12pt;">No Match</strong>';
	}
	else{
		document.getElementById("confirm").innerHTML = '<strong style="color:#009900;font-size:12pt;">Match</strong>';
	}
}

/**
 * check the strength of the password 
 */
function strength(){

	var password = document.getElementById("pass1").value;

	function scorePassword(pass) {
		var strength = 0;
		if(pass.length >= 5)
			strength++;
		if(pass.match(/[a-z]+/)) 
			strength++;
		if(pass.match(/[0-9]+/)) 
			strength++;
		if(pass.match(/[A-Z]+/)) 
			strength++;
		return strength;
	}

	var score = scorePassword(password);
	
	if (score >= 4)
		document.getElementById("strength").innerHTML = '<strong style="color:#009900;font-size:12pt;">Very Strong</strong>';
	else if (score >= 3)
		document.getElementById("strength").innerHTML = '<strong style="color:#6F3;font-size:12pt;">Strong</strong>';
	else if (score >= 2)
		document.getElementById("strength").innerHTML = '<strong style="color:#FC0;font-size:12pt;">Medium</strong>';
	else
		document.getElementById("strength").innerHTML = '<strong style="color:#F00;font-size:12pt;">Weak</strong>';
}

/**
 * main signup function 
 */
function signup(){

	var u = document.getElementById("username").value;
	var e = document.getElementById("email").value;
	var p1 = document.getElementById("pass1").value;
	var p2 = document.getElementById("pass2").value;
	var status = document.getElementById("status");
	
	// check empty variables
	if(u == "" || e == "" || p1 == "" || p2 == ""){
		status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Fill Out All Form Data</strong>';
	} 
	// check matching password
	else if(p1 != p2){
		status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Passwords Do Not Match</strong>';
	} 
	// process information
	else {
		status.innerHTML = '<img src="imgs/extra/loading.gif">';
		var ajax = ajaxObj("POST", "php/register.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				// if signup new user failed
				if(ajax.responseText != "signup_success"){
					if(ajax.responseText == "missing_data"){
						status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Fill Out Form</strong>';
					}
					else if(ajax.responseText == "email_in_system"){
						status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Email Already in System</strong>';
					}
					else if(ajax.responseText == "name_has_number"){
						status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Name Cannot Contain a Number</strong>';
					}
					else if(ajax.responseText == "name_size_error"){
						status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Name needs to be between 3 and 100 characters</strong>';
					}
					else if(ajax.responseText == "insert_user_failed"){
						status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Failed to insert user into database.</strong>';
					}
					else if(ajax.responseText == "email_send_failed"){
						status.innerHTML = '<strong style="color:#F00;font-size:12pt;">Email Send Failure. Make sure email address is correct.</strong>';
					}
					else {
						status.innerHTML = ajax.responseText;
					}
					document.getElementById("register-form").style.display = "block";
				}
				// else successfully added user to database 
				else {
					window.scrollTo(0,0);
					document.getElementById("register").style.width = '500px';
					document.getElementById("register-form").innerHTML = "<div id='register-message'><p>Welcome "+u+", all users must first be approved by administration! You will not be able to access the application page until your account has been approved. You will recieve an email at <u>"+e+"</u> when your account has been activated.</p></div>";
				}
			}
		}
		ajax.send("u="+u+"&e="+e+"&p="+p1);
	}
}