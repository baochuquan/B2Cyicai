<?php
//this is the main page for the site.
//include the configuration file:
header("Content-Type:text/html; charset=utf-8");

require ('../../../includes/config.inc.php');

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

		$flag = "success";

		// set all default = 'N'
		$q = "DELETE FROM imges WHERE product_id={$_POST['product_id']} AND img_name='{$_POST['checked']}' LIMIT 1";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 0)
			$flag = "failed";
		echo $flag;
		mysqli_close($dbc);
	}
}
?>