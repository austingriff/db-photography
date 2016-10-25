/************************************************************************

	This file contains the javascript functions for logging in
	a user account.  It makes an ajax call to login.php

*************************************************************************/

/**
 * sends user input via ajax to login.php
 * processes the ajax response and alerts the user
 */
function login(){
	var e = document.getElementById("email").value;
	var p = document.getElementById("password").value;
	if(e == "" || p == ""){
		document.getElementById("status").innerHTML = '<strong style="color:#F00;font-size:12pt;">Fill Out Form</strong>';
	} else {
		document.getElementById("loginbtn").style.display = "none";
		document.getElementById("status").innerHTML = '<img src="imgs/extra/loading.gif">';
		var ajax = ajaxObj("POST", "php/login2.php");
		ajax.onreadystatechange = function() {
			if(ajaxReturn(ajax) == true) {
				if(ajax.responseText == "login_failed"){
					document.getElementById("status").innerHTML = '<strong style="color:#F00;font-size:12pt;">Login Failed</strong>';
					document.getElementById("loginbtn").style.display = "block";
				}
				else if(ajax.responseText == "login_failed_email"){
					document.getElementById("status").innerHTML = '<strong style="color:#F00;font-size:12pt;">Email Not Found</strong>';
					document.getElementById("loginbtn").style.display = "block";
				}
				else if(ajax.responseText == "login_failed_email_no"){
					document.getElementById("status").innerHTML = '<strong style="color:#F00;font-size:12pt;">Account Not Activated.</strong>';
					document.getElementById("loginbtn").style.display = "block";
				}
				else if(ajax.responseText == "login_failed_pass"){
					document.getElementById("status").innerHTML = '<strong style="color:#F00;font-size:12pt;">Incorrect Password</strong>';
					document.getElementById("loginbtn").style.display = "block";
				}
				else if(ajax.responseText == "login_success"){
					window.location = "index.php";
				}
			}
		}
		ajax.send("e="+e+"&p="+p);
	}
}
