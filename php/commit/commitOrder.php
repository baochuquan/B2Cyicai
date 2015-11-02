<?php
//-------------------------------------------------------------
//for commitorder.html
//$.post by commitOrder.js
//to commit order
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

		// Assume invalid values:
		$userinfo = mysqli_real_escape_string ($dbc, trim($_POST['user_info']));

		// Need the database connection:
		$q = "INSERT INTO orders (user_id, user_info, total, order_date, addr, reciver, reci_phone) VALUES ({$_POST['user_id']}, '{$_POST['user_info']}', {$_POST['total']}, NOW(), '{$_POST['addr']}', '{$_POST['reciver']}', '{$_POST['reci_phone']}')";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		$q = "SELECT order_id FROM orders WHERE user_id={$_POST['user_id']} ORDER BY order_date DESC";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		$order_id = mysqli_fetch_array($r, MYSQLI_NUM);

		for($i = 0; $i < count($_POST['oc_id']); $i++){
			$q = "UPDATE order_content SET order_id={$order_id[0]}, cmt_status='Y' WHERE user_id={$_POST['user_id']} AND selected='Y'";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		}
		echo "Success";
	}
}
?>