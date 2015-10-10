<?php
// This page allows a logged-in user to change their password.
require ('../../includes/config.inc.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
			
	// Check for a new password and match against the confirmed password:
	$p = FALSE;
	$p = mysqli_real_escape_string ($dbc, $_POST['password1']);
	
	if ($p) { // If everything's OK.
		// Make the query:
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_COOKIE['user_id']} LIMIT 1";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		echo "Success";
		mysqli_close($dbc); // Close the database connection.
		exit();

	} else { // Failed the validation test.
		echo "Failed";
	}
	mysqli_close($dbc); // Close the database connection.
} // End of the main Submit conditional.
?>
