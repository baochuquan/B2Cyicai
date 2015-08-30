<?php
require ('../includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	$e = mysqli_real_escape_string ($dbc, $_POST['usermail']);
	$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	
	if ($e && $p) { // If everything's OK.
		// Query the database:
		$q = "SELECT user_id, username, userlevel FROM users WHERE (usermail='$e' AND pass=SHA1('$p')) AND active IS NULL";		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (@mysqli_num_rows($r) == 1) { // A match was made.

			// Register the values:
			$_COOKIE = mysqli_fetch_array ($r, MYSQLI_ASSOC);
			setcookie("user_id", $_COOKIE["user_id"], time()+3600, '/');
			setcookie("username", $_COOKIE["username"], time()+3600, '/');
			setcookie("userlevel", $_COOKIE["userlevel"], time()+3600, '/');
			mysqli_free_result($r);
			mysqli_close($dbc);
			echo "Success";
			exit(); // Quit the script.				
		} else { // No match was made.
			echo "Unmatch";
		}
	} else { // If everything wasn't OK.
		echo "Error";
	}
	mysqli_close($dbc);
} // End of SUBMIT conditional.
?>