<?php
//this is the main page for the site.
//include the configuration file:
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else { 
	// Need the database connection:
	require (MYSQL);

	// Define the query...
	foreach ($_POST as $key => $value) {
		if ($_POST[$key] == "allusers") {
			$q = "SELECT COUNT(user_id) FROM users WHERE userlevel=0";
		}
		else if ($_POST[$key] == "successusers") {
			$q = "SELECT COUNT(user_id) FROM users WHERE userlevel=0 AND active IS NULL";
		}			
		else {
			$q = "SELECT COUNT(user_id) FROM users WHERE userlevel=0 AND active IS NOT NULL";
		}
		$r = @mysqli_query($dbc, $q);
		// Get the mount of registered users
		$useramount = mysqli_fetch_array($r, MYSQLI_NUM);
		echo "{$useramount['0']} ";	
	}
	mysqli_free_result($r);
	mysqli_close($dbc);
}
?>
