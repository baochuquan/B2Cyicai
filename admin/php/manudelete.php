<?php
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

	$q = "DELETE FROM users WHERE usermail='" . $_POST['usermail'] . "' LIMIT 1";
	$r = @mysqli_query($dbc, $q);
	if (!$r) {
 		printf("Error: %s\n", mysqli_error($dbc));
 		exit();
 	}
 	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
 		echo "Success";
 	}
 	else {
 		echo "Failed";
 	}
 	mysqli_close($dbc);
}
?>