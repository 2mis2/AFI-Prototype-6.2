<?php



/****************helper functions ********************/

/* fucntion clear information / text coming from the form */
function clean($string) {


return htmlentities($string);


}


/* function for page redirect */
function redirect($location){


return header("Location: {$location}");

}

/* function to set session messages e.g. password updated  */
function set_message($message) {

/* if message is not empty then apply session */
	if(!empty($message)){


		$_SESSION['message'] = $message;

	}else {
/*  do not present errors on the screen*/
		$message = "";

	}


}


/* this function echos set_message  */
function display_message(){


	if(isset($_SESSION['message'])) {


		echo $_SESSION['message'];
/*unset makes sure message doesn't stay after echoed  */
		unset($_SESSION['message']);

	}



}


/*function to create form security by encrypting a string  */
function token_generator(){

/* create unique id and mt_rand random number generator - md5 function encrypts */
$token = $_SESSION['token'] =  md5(uniqid(mt_rand(), true));

return $token;

/* EXAMPL - TOKEN GENERATOR ENCRYPTS STRING ENTERED AS PER LINE 34 OF RECOVER.PHP CODE */
}


function validation_errors($error_message) {

$error_message = <<<DELIMITER

<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> $error_message
</div>

DELIMITER;

return $error_message;
		




}

/* function checks sql database to see if email already exists in the database */

function email_exists($email) {

	$sql = "SELECT id FROM users WHERE email = '$email'";

	$result = query($sql);

	if(row_count($result) == 1 ) {

		return true;

	} else {


		return false;

	}



}


/* function checks sql database to see if username already exists in the database */
function username_exists($username) {

	$sql = "SELECT id FROM users WHERE username = '$username'";

	$result = query($sql);
/*  if a database row count returns a value  */
	if(row_count($result) == 1 ) {

		return true;

	} else {


		return false;

	}



}

/* function to send email for validation code link */
function send_email($email, $subject, $msg, $headers){


return mail($email, $subject, $msg, $headers);


}



/****************Validation functions ********************/



function validate_user_registration(){
/* empty array to display all validation errors from form */
	$errors = [];
/* variable for min number of characters for form field */
	$min = 3;
/* variable for max number of characters for form field */
	$max = 20;


/* checks server to see if any post requests were made from registration form */
	if($_SERVER['REQUEST_METHOD'] == "POST") {

/* pulls out the values entered into registration form / cleans any unwanted characters */
		$first_name 		= clean($_POST['first_name']);
		$last_name 			= clean($_POST['last_name']);
		$username 		    = clean($_POST['username']);
		$email 				= clean($_POST['email']);
		$password			= clean($_POST['password']);
		$confirm_password	= clean($_POST['confirm_password']);


/* function checks how many characters are in each form post and ensures it is not less than minimum or more than maximum length requirement */
		if(strlen($first_name) < $min) {

			$errors[] = "Your first name cannot be less than {$min} characters";

		}

		if(strlen($first_name) > $max) {

			$errors[] = "Your first name cannot be more than {$max} characters";

		}




		if(strlen($last_name) < $min) {

			$errors[] = "Your Last name cannot be less than {$min} characters";

		}


		if(strlen($last_name) > $max) {

			$errors[] = "Your Last name cannot be more than {$max} characters";

		}

		if(strlen($username) < $min) {

			$errors[] = "Your Username cannot be less than {$min} characters";

		}

		if(strlen($username) > $max) {

			$errors[] = "Your Username cannot be more than {$max} characters";

		}

/* function to display error if user enters a username which already exists */
		if(username_exists($username)){

			$errors[] = "Sorry that username is already is taken";

		}



		if(email_exists($email)){

			$errors[] = "Sorry that email already is registered";

		}



		if(strlen($email) < $min) {

			$errors[] = "Your email cannot be more than {$max} characters";

		}
/* if password is not equal to confirm password then display an error */
		if($password !== $confirm_password) {

			$errors[] = "Your password fields do not match";

		}


/* if the empty array is not empty i.e. contains errors loop through errors and echo the errors */
		if(!empty($errors)) {

			foreach ($errors as $error) {
/* diplays validation errors function warning from lines 74 to 84 */
			echo validation_errors($error);

			
			}


		} else {

/*  if no errors then display message to show registration was successful and to check email for validation link */
			if(register_user($first_name, $last_name, $username, $email, $password)) {


/* this function uses pre-defined classes from bootstrap and displays the message for successful registration */
				set_message("<p class='bg-success text-center'>Please check your email or spam folder for activation link</p>");
/* custom function to redirect to index page */
				redirect("index.php");


			} else {

/* this function uses pre-defined classes from bootstrap and displays the message for user not registered */
				set_message("<p class='bg-danger text-center'>Sorry we could not register the user</p>");

				redirect("index.php");

			}



		}



	} // post request 



} // function 

/*Register user function - registers users details in database */

function register_user($first_name, $last_name, $username, $email, $password) {

/* escape function prevents SQL injection  */
	$first_name = escape($first_name);
	$last_name  = escape($last_name);
	$username   = escape($username);
	$email      = escape($email);
	$password   = escape($password);


/* check to see if email is already registered */
	if(email_exists($email)) {


		return false;


	} else if (username_exists($username)) {

		return false;

	} else {
/* md5 function will encrypt the password */
		$password   = md5($password);
/*  function to encyrpt username and generate random key for validation code */
		$validation_code = md5($username + microtime());
/* inserts registration form information values into SQL database */
		$sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active)";
		$sql.= " VALUES('$first_name','$last_name','$username','$email','$password','$validation_code', 0)";
		$result = query($sql);
		confirm($result);

/* email function message for account activiation */
		$subject = "Activate Account";
		$msg = " Please click the link below to activate your Account
		http://localhost.com/login/activate.php?email=$email&code=$validation_code
		";

		$headers = "From: noreply@donnybourke.com";


/* sends email based upon send email function defined in lines 140 to 143 */
		send_email($email, $subject, $msg, $headers);


		return true;

	}



} 


/****************Activate user functions ********************/

/* this function links to activate PHP */
function activate_user() {

/* check server variables for a request method equal to a get request */
	if($_SERVER['REQUEST_METHOD'] == "GET") {
/* gets email and validation code */
		if(isset($_GET['email'])) {


			$email = clean($_GET['email']);

			$validation_code = clean($_GET['code']);

/*  checks database to see if email and validation codes match and confirms if there is a match with database*/
			$sql = "SELECT id FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' ";
			$result = query($sql);
			confirm($result);
/* if row count function is equal to one then we know that the above query worked - i.e. email and validation code match */
			if(row_count($result) == 1) {
/* this query will update the SQL database to activate the user */
			$sql2 = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."' ";	
			$result2 = query($sql2);
			confirm($result2);
/* displays success message upon successful validation and confirms account activation */
			set_message("<p class='bg-success'>Your account has been activated please login</p>");

			redirect("login.php");


		} else {
/* displays message when account cannot be activated */
			set_message("<p class='bg-danger'>Sorry Your account could not be activated </p>");

			redirect("login.php");


			}




		} 


	}



} // function 

/****************Validate user login functions ********************/


/* links to line 23 on login.php */
function validate_user_login(){

	$errors = [];

	$min = 3;
	$max = 20;


/* check server variables for a request method equal to a post request */
	if($_SERVER['REQUEST_METHOD'] == "POST") {

/*  removes any whitespace, replaces spaces with hyphens, removes non-alphanumeric characters, and makes everything lowercase. */
		$email 		= clean($_POST['email']);
		$password	= clean($_POST['password']);
/* checks if remember on login is selected */
		$remember   = isset($_POST['remember']);




		if(empty($email)) {

			$errors[] = "Email field cannot be empty";

		}


		if(empty($password)) {

			$errors[] = "Password field cannot be empty";

		}



		if(!empty($errors)) {

				foreach ($errors as $error) {

				echo validation_errors($error);

				
				}


			} else {

/* if the user can login then they will be redirected to admin page */
				if(login_user($email, $password, $remember)) {


					redirect("admin.php");


				} else {

/* display error message if user cannot login */
				echo validation_errors("Your credentials are not correct");		



				}



			}



	}


} // function 


/****************User login functions ********************/

/* this function returns true or false depending upon whether the user can login or not */
	function login_user($email, $password, $remember) {

/* select password and id from user where the email entered = email in database */
		$sql = "SELECT password, id FROM users WHERE email = '".escape($email)."' AND active = 1";

		$result = query($sql);
/* if row count is equal to one then we have found the user / record */
		if(row_count($result) == 1) {
/*  fetches user / record result from the database */
			$row = fetch_array($result);
/* takes password from the record */
			$db_password = $row['password'];

/*  md5 is used to decode password - this function compares password entered in form with password stored in database*/
			if(md5($password) === $db_password) {
/* If remember is checked (login.php) then set a cookie */
				if($remember == "on") {
/* login cookie is set - email, email content, time function and set cookie for 24 hours  */
					setcookie('email', $email, time() + 86400);

				}

/* if password is verified then save email in a session then logged in function on line 543 is created */
				$_SESSION['email'] = $email;



				return true;

			} else {

/* if a user / record is not found then return false */
				return false;
			}









			return true;

		} else {


			return false;



		}



	} // end of function



/****************logged in function ********************/



function logged_in(){
/* makes sure that session is set and returns true if set  */
/* checking if a session or a cookie is set  */
	if(isset($_SESSION['email']) || isset($_COOKIE['email'])){


		return true;

	} else {


		return false;
	}




}	// functions




/****************Recover Password function ********************/



function recover_password() {

/* checks that our form is working */
	if($_SERVER['REQUEST_METHOD'] == "POST") {
/* If session and post token are equal then execute  */
		if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

			$email = clean($_POST['email']);

/* checks to see if email exists */
			if(email_exists($email)) {

/* creates validation code for password reset */
			$validation_code = md5($email + microtime());

/* sets cookies to expire after 15 minutes after which user has to go to recover page and get a new validation code */
			setcookie('temp_access_code', $validation_code, time()+ 900);

/* Inserts the validation code column within the user table  */
			$sql = "UPDATE users SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
			$result = query($sql);



			$subject = "Please reset your password";
			$message =  " Here is your password rest code {$validation_code}

			Click here to reset your password http://localhost/login/code.php?email=$email&code=$validation_code

			";

			$headers = "From: noreply@donnybourke.com";




/* sends email as above with validation code for password reset */
			send_email($email, $subject, $message, $headers);



/*  */
			set_message("<p class='bg-success text-center'>Please check your email or spam folder for a password reset code</p>");

			redirect("index.php");

/* handles situation where email does not exist */
			} else {


				echo validation_errors("This emails does not exist");


			}


/* handles if token is not set "if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token'])" by redirecting to a different page */
		} else {


			redirect("index.php");

		}




		// token checks

 /* if the cancel button on password reset is clicked this will redirect to the login page  */
		if(isset($_POST['cancel_submit'])) {

			redirect("login.php");


		}



	} // post request





} // functions




/**************** Code  Validation ********************/


function validate_code () {

/* check to see if the cookie is set */
	if(isset($_COOKIE['temp_access_code'])) {
/* if email and code are not set then redirect to index.php (!) */
			if(!isset($_GET['email']) && !isset($_GET['code'])) {

				redirect("index.php");


			} else if (empty($_GET['email']) || empty($_GET['code'])) {

				redirect("index.php");


			} else {


/* check to see if post code is set */
				if(isset($_POST['code'])) {

					$email = clean($_GET['email']);
/*  */
					$validation_code = clean($_POST['code']);
/* query checks to see if the code exists and it can be compared with a code in the database */
					$sql = "SELECT id FROM users WHERE validation_code = '".escape($validation_code)."' AND email = '".escape($email)."'";
					$result = query($sql);
/* checks to see if codes compare and redirects */
					if(row_count($result) == 1) {

						setcookie('temp_access_code', $validation_code, time()+ 300);
/* send to redirect page and verify that the user came from the code.php reset page */
						redirect("reset.php?email=$email&code=$validation_code");


					} else {


/* if the incorrect validation code is typed or entered incorrectly then a validation error message is displayed */
						echo validation_errors("Sorry wrong validation code");

					}
		




				}



			}








	} else {
/* if the email validation code is not entered into the code page within the allotted time then the validation cookie expires and redirects to recover page */
		set_message("<p class='bg-danger text-center'>Sorry your validation cookie has expired</p>");

		redirect("recover.php");


	}







}



/**************** Password Reset Function ********************/


function password_reset() {
/* check the temporary access cookie time and that it has not expired */
	if(isset($_COOKIE['temp_access_code'])) {

/* check the email URL and code */
		if(isset($_GET['email']) && isset($_GET['code'])) {


/* check token inside the form to make sure data comes from the form  */
			if(isset($_SESSION['token']) && isset($_POST['token'])) {

/* confirms that form token and session token are the same */
				if($_POST['token'] === $_SESSION['token']) {

/* confirms that passwords match  */
					if($_POST['password']=== $_POST['confirm_password'])  { 

/*  encyrpts updated password*/
						$updated_password = md5($_POST['password']);

/* updates password in database from reset password in form field */
						$sql = "UPDATE users SET password = '".escape($updated_password)."', validation_code = 0 WHERE email = '".escape($_GET['email'])."'";
						query($sql);



						set_message("<p class='bg-success text-center'>You passwords has been updated, please login</p>");

						redirect("login.php");
						

						} else {

							echo validation_errors("Password fields don't match");


						}


				  }

	

			} 



		} 


	}else {

/* if temp access cookie has expired the following message will be displayed  */
		set_message("<p class='bg-danger text-center'>Sorry your time has expired</p>");

		redirect("recover.php");




		}


}









