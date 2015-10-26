<?php
//-------------------------------------------------------------
//for shoppingcart.html
//$.post by cartManageDetail.js
//to change the cart amount in the database
//-------------------------------------------------------------
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

	$q = "UPDATE order_content SET quantity={$_POST['num']} WHERE user_id={$_POST['user_id']} AND oc_id={$_POST['oc_id']} LIMIT 1";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	echo "Success";
	mysqli_close($dbc);
}
?>