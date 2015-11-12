<?php
//-------------------------------------------------------------
//for order_management.html
//$.post by getAllOrderInfo.js
//to update the sendstate of an order
//-------------------------------------------------------------
require ('../../../includes/config.inc.php');

if (!isset($_COOKIE['username']) || $_COOKIE['userlevel'] == 0) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

		// Need the database connection:
		require (MYSQL);

		$q = "UPDATE orders SET sendstate='Y' WHERE order_id={$_POST['order_id']} LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		echo "Success";
	}
}
?>