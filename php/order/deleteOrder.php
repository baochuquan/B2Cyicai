<?php
//-------------------------------------------------------------
//for myorder.html
//$.post by getOrderInfo.js
//to get all the order infomation of a user
//-------------------------------------------------------------
require ('../../includes/config.inc.php');

if (!isset($_COOKIE['username'])) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

		// Need the database connection:
		require (MYSQL);

		$q = "DELETE FROM orders WHERE order_id={$_POST['order_id']} AND user_id={$_POST['user_id']} LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		$q = "DELETE FROM order_content WHERE order_id={$_POST['order_id']} AND user_id={$_POST['user_id']}";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		echo "Success";
	}
}
?>