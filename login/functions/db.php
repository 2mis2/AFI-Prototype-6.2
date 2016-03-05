<?php 
/* establishes connection to database; server, username, password, database */
$con = mysqli_connect('localhost', 'root', '', 'login_db');

/* this functions counts the number of rows inside the table within the database */
function row_count($result){


return mysqli_num_rows($result);

}


/* this function allows a user to clean their data and escape the database */
function escape($string) {
	global $con;
/* return - escapes the data for user */
	return mysqli_real_escape_string($con, $string);


}
/*this function confirms that the query from the database is good  */
function confirm($result) {

	global $con;

	if(!$result) {

		die("QUERY FAILED" . mysqli_error($con));

	}

}


/* this function enables a user to establish a connection and query the database */
function query($query) {
/* grabs connection to the database */
	global $con;

	$result =  mysqli_query($con, $query);

	confirm($result);

	return $result;


}




/* this function establishes a connection to the database and fetches an array */
function fetch_array($result) {

	global $con;


	return mysqli_fetch_array($result);



}









 ?>