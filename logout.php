<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '退出';
include ('includes/header.html');

// If no username session variable exists, redirect the user:
if (!isset($_SESSION['username'])) {

	$url = BASE_URL . 'index_new.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
	
} else { // Log out the user.
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-3600); // Destroy the cookie.
	$url = BASE_URL . 'index_new.php';
	ob_end_clean();
	header("Location: $url");
	exit();
}
?>

<?php include ('includes/footer.html') ?>