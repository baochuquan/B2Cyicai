<?php
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == '')) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else { 
	// Need the database connection:
	require (MYSQL);
	$q = "SELECT COUNT(user_id) FROM order_content WHERE user_id={$_POST['user_id']} AND cmt_status='N'";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	$num = mysqli_fetch_array($r, MYSQLI_NUM);
	echo $num[0];
	mysqli_close($dbc);
}
?>