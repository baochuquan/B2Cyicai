<?php
//this is the main page for the site.
//include the configuration file:
header("Content-Type:text/html; charset=utf-8");

require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username'])) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
		// Need the database connection:
		require (MYSQL);

		// set all default = 'N'
		$q = "UPDATE address SET default_addr='N' WHERE user_id={$_POST['user_id']}";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		$q = "UPDATE address SET default_addr='Y' WHERE user_id={$_POST['user_id']} AND addr_id={$_POST['addr_id']} LIMIT 1";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		echo "Success";
		mysqli_close($dbc);
	}
}