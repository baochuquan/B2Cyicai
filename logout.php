<?php
// This is the logout page for the site.
require ('includes/config.inc.php'); 
$page_title = '退出';
include ('includes/head.html');

// If no username session variable exists, redirect the user:
if (!isset($_SESSION['username'])) {

	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
	
} else { // Log out the user.

	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-3600); // Destroy the cookie.

}

// Print a customized message:
echo '<h3>您已退出账户。</h3>';

include ('includes/foot.html');
?>
