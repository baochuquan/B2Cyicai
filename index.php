<?php
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = '衣彩';
include ('includes/head.html');

// Welcome the user (by name if they are logged in):
echo '<h1>欢迎 ';
if (isset($_SESSION['username'])) {
	echo ", {$_SESSION['username']}";
}
echo '!</h1>';
?>
<p>Spam spam spam spam spam spam
spam spam spam spam spam spam 
spam spam spam spam spam spam 
spam spam spam spam spam spam.</p>
<p>Spam spam spam spam spam spam
spam spam spam spam spam spam 
spam spam spam spam spam spam 
spam spam spam spam spam spam.</p>

<?php include ('includes/foot.html'); ?>
