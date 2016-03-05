<?php include("functions/init.php");


	session_destroy();

/* unset session cookie and minus time given in functions.php under user login function */
	if(isset($_COOKIE['email'])) {

		unset($_COOKIE['email']);

		setcookie('email', '', time()-86400);


	}


redirect("login.php");




