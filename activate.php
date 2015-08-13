<?php
// This page activates the user's account.
require ('includes/config.inc.php'); 
$page_title = '账户激活';
include ('includes/head.html');

// If $x and $y don't exist or aren't of the proper format, redirect the user:
if (isset($_GET['x'], $_GET['y']) 
	&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
	&& (strlen($_GET['y']) == 32 )
	) {

	// Update the database...
	require (MYSQL);
	$q = "UPDATE users SET active=NULL WHERE (usermail='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "') LIMIT 1";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	// Print a customized message:
	if (mysqli_affected_rows($dbc) == 1) {
		echo "<h3>验证完成。</h3>";
	} else {
		echo '<p class="error">验证失败。</p>'; 
	}
	mysqli_close($dbc);

} else { // Redirect.

	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.

} // End of main IF-ELSE.

include ('includes/foot.html');
?>
